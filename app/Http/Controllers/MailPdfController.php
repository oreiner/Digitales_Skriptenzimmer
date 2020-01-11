<?php

namespace App\Http\Controllers;

use App\Examiner;
use App\Helper\Helper;
use App\Http\Requests\MailPdfEditFormRequest;
use App\Http\Requests\MailPdfFormRequest;
use App\Mail\SendMailPdf;
use App\MailPdf;
use App\Test;
use App\TestExaminer;
use App\User;
use App\UserToTest;
use App\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Debugbar;

class MailPdfController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
          $this->middleware('auth');
    }



    public function index()
    {

        $usertotest =UserToTest::where('user_id', auth()->user()->id)->where('feedback_status','0')->first();
        if($usertotest){

            $sessions=array();
            $mailPdfRequestDate='';

            $firstYear = (int)date('Y') - 6;
            $lastYear = $firstYear + 6;
            for($i=$firstYear;$i<=$lastYear;$i++)
            {

                $startDate1=$i.'-10-01';
                $endDate1=($i+1).'-03-31';


                if ($startDate1 <= date('Y-m-d',strtotime($usertotest->created_at)) && $endDate1 >= date('Y-m-d',strtotime($usertotest->created_at))) {
                    $mailPdfRequestDate='WS '.$i.'/'.($i+1);
                }

                $startDate2=($i+1).'-04-01';
                $endDate2=($i+1).'-09-30';

                if ($startDate2 <= date('Y-m-d',strtotime($usertotest->created_at)) && $endDate2 >= date('Y-m-d',strtotime($usertotest->created_at))) {
                    $mailPdfRequestDate='SS '.($i+1);
                }



                $sessions['WS '.$i.'/'.($i+1)]='WS '.$i.'/'.($i+1);
                $sessions['SS '.($i+1)]='SS '.($i+1);
            }

            return view('mailpdf.feedback',compact('usertotest','sessions','mailPdfRequestDate'));
        }else {
            $mailPdf=new MailPdf();
			//get tests for user to choose
            $tests = Test::all()->sortBy('position')->pluck('name', 'id','position')->toArray();
			//get subjects for chosen test
			//$ids = TestExaminer::where('test_id',$request->testid)->with('examiner')->pluck('examiner_id');
			//$faecher = Examiner::whereIn('id',$ids)->pluck('description');
			//redirect user to download protocoll if 
            if (auth()->user()->getMailPdfCount()>0) {
                return view('mailpdf.index', compact('tests', 'mailPdf'));
            }else{
                Session::flash('success', "Du hast heute schon die maximale Zahl an Protokollen heruntergeladen");
                return redirect('/');
            }
       }
        //return view('mailpdf.index',compact('tests','usertotest','flag'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailPdfFormRequest $request)
    {

		$testExaminers= TestExaminer::where('test_id',$request->test_id)->whereIn('examiner_id',$request->examinerlist)->with('examiner')->with('test')->get();

		$usertotest=new UserToTest();
		$usertotest->user_id =auth()->user()->id;
		$usertotest->test_id =$request->test_id;
		$usertotest->reminder_date =$request->date;
		$usertotest->save();
		
		//users should get watermark, moderators and admins shouldn't
		if(auth()->user()->type=="user"){
			$watermark = TRUE;
		} else {
			$watermark = FALSE;
		}

        foreach($testExaminers as $testExaminer) {
            $helper=new Helper();
            $filename=$helper->generatePdf($testExaminer->pdf,auth()->user()->name, $watermark);
            $mailpdf=new MailPdf();
            $mailpdf->user_to_test_id =$usertotest->id;
            $mailpdf->examiner_id =$testExaminer->examiner_id;
            $mailpdf->mailpdf =$filename;
            $mailpdf->save();
        }
        $mailpdfs= MailPdf::where('user_to_test_id',$usertotest->id)->whereIn('examiner_id',$request->examinerlist)->get();
        $content = [
                   'from_email'=> config('mail.from.sender'),
				   'name'=> config('mail.from.name'),
                   'username'=> auth()->user()->name,
                   'queryMailPdfs'=> $mailpdfs,
                  ];

		//if user is moderator, allow him not receive emails
		if ($request->with_email){
			try {
				Mail::to(auth()->user()->email)->send(new SendMailPdf($content)); //queues by default in class
				User::find(auth()->user()->id)->decrement('pdf_count');
				// echo 'Mail send successfully';
			   // $mailpdfs= MailPdf::where('user_to_test_id',$usertotest->id)->whereIn('examiner_id',$request->examinerlist)->delete();
			} catch (\Exception $e) {
				echo 'Error - '.$e;
				//  die;
			}
		}
		
        Session::flash('success', 'Die Protokolle wurden an deine E-Mail-Adresse versandt. Dies kann bis zu eine Stunde dauern. Wir bitten um Geduld!');
        return redirect()->route('mailpdf.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MailPdfEditFormRequest $request, $id)
    {
        $usertotest = UserToTest::find($id);
        $usertotest->semester_session=$request->semester_session;
        $usertotest->extra_information=$request->extra_information;
        $usertotest->grade          =$request->grade;
        $usertotest->feedback_status='1';
        $usertotest->save();

        $questions=$request->questions;
        $answers=$request->answers;
        $testid=$request->test_id;
       // $examinerlist=$request->examinerlist;
        $j=0;
        foreach($request->mailpdflist as $mailpdf) {
            $question=$questions[$j];
            $answer=$answers[$j];
            $mailpdf=MailPdf::find($mailpdf);
            $testExaminer=TestExaminer::where('test_id','=',$testid)->where('examiner_id','=',$mailpdf->examiner_id)->first();
            $examiner=Examiner::find($mailpdf->examiner_id);
            $pdf = new \FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial',null,10);
            $pdf->Write( 5, "Prüfer : ".$examiner->name."\n\nSemester : ".$request->semester_session."\n\nFragen :\n".$question."\n\nAntworten :\n".$answer."\n\nZusältzliche Informationen :\n".$request->extra_information."\n\nNote :\n".$request->grade);
            
            
			//$statement = DB::select("SHOW TABLE STATUS LIKE 'mail_pdfs'");
            //$next_id = intval( $statement[0]->Auto_increment) + $j; //autoincrement doesn't get rechecked before creating the next file, so manually increment with the already existing $j
			$comment_id = $mailpdf->id;
            $distination_path = $comment_id.'_mergepdf.pdf'; //changed time() to next mail pdf id. this is unique enough and should make it easier to delete specific comments. change back if you have a different solution
            $filename=public_path('img/mergepdf/'.$distination_path);
            $pdf->Output($filename, 'F');

            $files = [public_path('img/mergepdf/'.$distination_path),public_path('img/pdf/'.$testExaminer->pdf)];
            $pdf = new Fpdi();
            foreach ($files as $file) {
                $pageCount = $pdf->setSourceFile($file);
                for ($i = 0; $i < $pageCount; $i++) {
                    $tpl = $pdf->importPage($i + 1, '/MediaBox');
                    $pdf->addPage();
                    $pdf->useTemplate($tpl);
                }
            }
            $distination_path = $testExaminer->pdf;
            $filename=public_path('img/pdf/'.$distination_path);
            $pdf->Output($filename, 'F');

            $mailpdf->questions =$question;
            $mailpdf->answers =$answer;
            $mailpdf->save();
            $j++;
        }
        Session::flash('success', 'Dein Protokoll wurde erfolgreich gespeichert. Vielen Dank für deine Mitarbeit!');
        return redirect('/');
    }

	/* resends currently open protokol, in case user has issues */
	public function resend($id)
    {
		
		//get old data
		$usertotest = UserToTest::with('mailpdfs')->find($id);
		$testExaminers= TestExaminer::where('test_id',$usertotest->test_id)->whereIn('examiner_id',$usertotest->mailpdfs->pluck('examiner_id'))->get();
		
		
		//update mailpdf with new file name and watermark
		foreach($testExaminers as $testExaminer) {
            $helper=new Helper();
            $filename=$helper->generatePdf($testExaminer->pdf,auth()->user()->name);
			$mailpdf =  MailPdf::where('user_to_test_id',$usertotest->id)->where('examiner_id',$testExaminer->examiner_id)->first();
			$mailpdf->mailpdf = $filename;
            $mailpdf->save();
        }
        $mailpdfs= MailPdf::where('user_to_test_id',$usertotest->id)->get();
        $content = [
                   'from_email'=> config('mail.from.sender'),
				   'name'=> config('mail.from.name'),
                   'username'=> auth()->user()->name,
                   'queryMailPdfs'=> $mailpdfs,
                  ];
		
        try {
            Mail::to(auth()->user()->email)->send(new SendMailPdf($content)); //queues by default in class
            //User::find(auth()->user()->id)->decrement('pdf_count'); //don't decrement for resends
        } catch (\Exception $e) {
            echo 'Error - '.$e;
            //  die;
        }
        Session::flash('success', 'Die Protokolle wurden erneut an deine E-Mail-Adresse versandt. Bitte kontrolliere sonst deinen Spamordner und deine E-Mail-Adresse unter "Profil"');
        return redirect()->route('mailpdf.index');
		
		/*
		// this way, would recompile the file, the above way only changes the watermark and if the file in "pdf" was changed
		//get data so far
		$usertotest = UserToTest::with('mailpdfs')->find($id);
		$testExaminers= TestExaminer::where('test_id',$usertotest->test_id)->whereIn('examiner_id',$usertotest->mailpdfs->pluck('examiner_id'))->get();
		//$mailpdfs= MailPdf::where('user_to_test_id',$usertotest->id)->get();
		
		//update data
		foreach($testExaminers as $testExaminer) {
            //new watermark and filename
			$helper=new Helper();
            $filename=$helper->generatePdf($testExaminer->pdf,auth()->user()->name);
			//register new name
			$mailpdf =  MailPdf::where('user_to_test_id',$usertotest->id)->where('examiner_id',$testExaminer->examiner_id)->first();
			$mailpdf->mailpdf = $filename;
            $mailpdf->save();
			//recompile file
			$comments = MailPdf::where('user_to_test_id',$usertotest->id)->where('examiner_id',$testExaminer->examiner_id)->whereNotNull('questions')->pluck('id'); //skip still open protocolls by using NULL in questions. This is where I wish my SQL was different with mailpdf child of user and test
			$files = [public_path('img/originalpdf/'.$testExaminer->pdf)]; //make sure to grab original uploaded pdf!!
			
			foreach ($comments as $comment_id){
				$distination_path = $comment_id.'_mergepdf.pdf'; 
				array_unshift($files, public_path('img/mergepdf/'.$distination_path));
			}
			
			$pdf = new Fpdi();
			foreach ($files as $file) {
				$pageCount = $pdf->setSourceFile($file);
				for ($i = 0; $i < $pageCount; $i++) {
					$tpl = $pdf->importPage($i + 1, '/MediaBox');
					$pdf->addPage();
					$pdf->useTemplate($tpl);
				}
			}	
			$distination_path = $testExaminer->pdf;
			$filename=public_path('img/pdf/'.$distination_path);
			$pdf->Output($filename, 'F');	
			
        }
        $mailpdfs= MailPdf::where('user_to_test_id',$usertotest->id)->get();
        $content = [
                   'from_email'=> 'info@skripte.koeln',
				   'name'=> 'Skriptenzimmer Köln',
                   'username'=> auth()->user()->name,
                   'queryMailPdfs'=> $mailpdfs,
                  ];
		
        try {
            Mail::to(auth()->user()->email)->send(new SendMailPdf($content)); //queues by default in class
            //User::find(auth()->user()->id)->decrement('pdf_count'); //don't decrement for resends
        } catch (\Exception $e) {
            echo 'Error - '.$e;
            //  die;
        }
        Session::flash('success', 'Die Protokolle wurden erneut an deine E-Mail-Adresse versandt. Bitte kontrolliere sonst deinen Spamordner und deine E-Mail-Adresse unter "Profil"');
        return redirect()->route('mailpdf.index');
	*/
		

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=MailPdf::findOrFail($id);
        
		/* maybe overkill. soft delete makes sure comment won't be injected in recompiled file. normal mailpdf.update doesn't repeat old merges anyway
		$comment_id = $record->user_to_test_id;
		$comment = $comment_id.'_mergepdf.pdf';
		$filename=public_path('img/mergepdf/'.$comment);
		File::delete($filename);  
		*/
		//UserToTest::destroy($id); would destroy all comments, maybe one from four is good etc

		$record->delete();
		
        return ['message'=>'User comment successfully deleted'];
    }

	public function getFaecherByTestId(Request $request){

		$ids = TestExaminer::where('test_id',$request->testid)->with('examiner')->pluck('examiner_id');
		$faecher = Examiner::whereIn('id',$ids)->groupBy('description')->orderBy('description', 'ASC')->pluck('description');

		echo json_encode([
                            'faecher'=>$faecher,
							'num_faecher'=>$faecher->count()
                             ]);

    }
	
    public function getExaminerByTestId(Request $request){
		//Debugbar::info($request);
		
        $testExaminers= TestExaminer::where('test_id',$request->testid)->with('examiner')->with('test')->get()->sortBy('examiner.name', SORT_NATURAL|SORT_FLAG_CASE); //get examiner collection and sort by last name, when format is "last name, first name"
		//$testExaminers = TestExaminer::where('test_id', $request->testid)->with('examiner')->with('test')->get()->map(function ($item, $key) {$item->examiner->last_name = array_slice(explode(' ', $item->examiner->name), -1)[0]; return $item; }) ->sortBy('examiner.last_name'); //get examiner collection and sort by last name, when format is "first name last name"	
		
      	$result = array();
        $num=0;
        foreach($testExaminers as $testExaminer) {
            $result[$num]['id'] = (int) $testExaminer->examiner_id;
            $result[$num]['text'] = $testExaminer->examiner->name;
            $num++;
        }
        $result;
        $test=Test::find($request->testid);
        //   echo json_encode($users);
        echo json_encode([
                            'examiners'=>$result,
                            'no_of_examiner'=>$test->no_of_examiner
                             ]);

    }
	
	public function getExaminerByFach(Request $request){
		
		$testExaminers= TestExaminer::where('test_id',$request->testid)->whereHas('examiner',function ($q) use ($request) {$q->whereIn('description',$request->fach);} )->with('examiner')->with('test')->get()->sortBy('examiner.name', SORT_NATURAL|SORT_FLAG_CASE); //get examiner collection and sort by last name, when format is "last name, first name"
        //$testExaminers= TestExaminer::where('test_id',$request->testid)->whereHas('examiner',function ($q) use ($request) {$q->whereIn('description',$request->fach);} )->with('examiner')->with('test')->get()->map(function ($item, $key) {$item->examiner->last_name = array_slice(explode(' ', $item->examiner->name), -1)[0]; return $item; }) ->sortBy('examiner.last_name'); //get examiner collection and sort by by last name, when format is "first name last name"		
        $result = array();
        $num=0;
        foreach($testExaminers as $testExaminer) {
            $result[$num]['id'] = (int) $testExaminer->examiner_id;
            $result[$num]['text'] = $testExaminer->examiner->name;
            $num++;
        }
        $result;
        $test=Test::find($request->testid);
        //   echo json_encode($users);
        echo json_encode([
                            'examiners'=>$result,
                            'no_of_examiner'=>$test->no_of_examiner
                             ]);



    }
	
	   public function loadReminderDates(Request $request)
    {
		$start = Reminder::where('test_id',$request->testid)->value('rangeStart');
		$end = Reminder::where('test_id',$request->testid)->value('rangeEnd');
		$multi = Reminder::where('test_id',$request->testid)->value('multi');
		if ($end==NULL){
			$end = $start;
		}
        //   echo json_encode($users);
        echo json_encode([
                            'rangeStart'=>$start,
                            'rangeEnd'=>$end,
							'multiDates'=>$multi
                             ]);

    }

  
}
