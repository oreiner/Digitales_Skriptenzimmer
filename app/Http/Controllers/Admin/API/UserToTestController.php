<?php

namespace App\Http\Controllers\Admin\Api;

use App\User;
use App\MailPdf;
use App\UserToTest;
use App\TestExaminer;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Debugbar;

class UserToTestController extends Controller
{
	
	
	
    private $guardName = 'admin_api';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:admin_api');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');

        // if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
        //return UserToTest::with('user')->with('test')->latest()->paginate(10);
		//order by last uploaded comment
		return UserToTest::with('user')->with('test')->orderBy('feedback_status','desc')->orderBy('updated_at','desc')->paginate(10);
		
        //  }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function testDetailByUser($id)
    {
        return MailPdf::where('user_to_test_id',$id)->with('examiner')->latest()->get();

    }







    public function store(Request $request)
    {

        $this->validate($request,[
            'test_id'         =>'required|numeric',
            'examiner_id'=>'required|numeric',
            'pdf'        => 'required|mimes:pdf',
        ]);

        $pdf=$request->pdf;

        $filename = time().'_'.$pdf->getClientOriginalName();
        $destinationPath = public_path('img/pdf/');
        $pdf->move($destinationPath, $filename);


        return TestExaminer::create([
            'test_id'=>$request->test_id,
            'examiner_id'=>$request->examiner_id,
            'pdf'=>$filename,
            'about_pdf'=>$request->about_pdf
        ]);


    }

    public function updateProfile(Request $request){
        $user= auth('api')->user();
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=> 'required|email|string|max:191"|unique:users,email,'.$user->id,
            'password'=>'sometimes|required|string|min:6',
        ]);
        $currentPhoto= $user->photo;
        if($request->photo != $currentPhoto){
            $name=time().'.'.explode('/', explode(':', substr($request->photo,0, strpos($request->photo,';')))[1])[1];
            \Image::make($request->photo)->resize(300, 200)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto =  public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }

        if(!empty($request->password)){
            $request->merge(['password'=>Hash::make($request['password'])]);
        }


        $user->update($request->all());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=> 'required|email|string|max:191"|unique:users,email,'.$user->id,
            'password'=>'sometimes|string|min:6',
            'type'=>'required|string'
        ]);
        $user->update($request->all());
        return ['message'=>'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 //wrong class???
    public function destroy($id)
    {
          $this->authorize('isAdmin');
        $userToTest=UserToTest::findOrFail($id);
        $userToTest->delete();
       // if (!empty($userToTest->pdf)){
      //      File::delete(public_path('img/pdf/'.$userToTest->pdf));
      //  }
        return ['message'=>'All user comments to this test were deleted'];
    }
	
	public function destroyComment($id)
    {
        
		$record=MailPdf::findOrFail($id);
        
		//$comment_id = $record->user_to_test_id;
		//$comment = $comment_id.'_mergepdf.pdf';
		$comment = $id.'_mergepdf.pdf';
		$filename=public_path('img/mergepdf/'.$comment);
		//File::delete($filename); //maybe overkill. soft delete makes sure comment won't be injected in recompiled file. normal mailpdf.update doesn't repeat old merges anyway
		//Debugbar::info($id);
		//Debugbar::info($record);
		//Debugbar::info($comment);
		//Debugbar::info($filename);
		//Debugbar::warning('now');
		//UserToTest::destroy($id);
		$examiner_id = $record->examiner_id;
		$user_to_test_id = $record->user_to_test_id;
		$testid = UserToTest::where('id', $user_to_test_id )->pluck('test_id'); 
		
		//update pdf to recompile without erased comments
		//similar to  MailPdfController@update
		$testExaminer=TestExaminer::where('test_id',$testid)->where('examiner_id',$examiner_id)->first();
		$files = [public_path('img/originalpdf/'.$testExaminer->pdf)];
		if(file_exists($files[0])){ //make sure to grab original uploaded pdf for recompliling!!
			$record->delete(); //delte the mailpdf only if backup pdf is there, otherwise recompile will fail
		}
		
		//find all comments, only for this test! (examiner can belong to more than one test. Anatomie+Physikum Or Kinder+M3)	
		$utt_ids = UserToTest::where('test_id',$testid)->pluck('id');//this is a stupid workaround to constrain the comments to one test 	
		$comments = MailPdf::where('examiner_id',$testExaminer->examiner_id)->whereIn('user_to_test_id',$utt_ids)->whereNotNull('questions')->pluck('id'); //skip still open protocolls by using NULL in questions
		
		foreach ($comments as $comment_id){
			$distination_path = $comment_id.'_mergepdf.pdf'; //changed time() to $id. this is unique enough and should make it easier to delete specific comments.
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

        return ['message'=>'User comment successfully deleted'];
    }

     public function search(){
        if($search = \Request::get('q')){
			//translate name into id
			$users_ids = User::where(function ($query) use ($search){
                $query->Where( 'name', 'LIKE', "%$search%"); 
            })->pluck('id')->toArray();
			//get UserToTests by id
            $users =UserToTest::whereIn('user_id',$users_ids)->with('user')->with('test')->orderBy('feedback_status','desc')->orderBy('updated_at','desc')->paginate(10);
        }else{
            $users= UserToTest::with('user')->with('test')->orderBy('feedback_status','desc')->orderBy('updated_at','desc')->paginate(10);
        }
        return $users;
    }

    public function examiners(){
        return Examiner::orderBy('name','ASC')->get(['id','name']);
    }

    public function unlockUser($id)
    {
        $usertotest= UserToTest::findOrFail($id);
        $usertotest->feedback_status ='1';
        $usertotest->save();
        return $usertotest;
    }




}
