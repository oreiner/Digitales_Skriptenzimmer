<?php

namespace App\Http\Controllers\Admin\Api;

use App\Examiner;
use App\TestExaminer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TestExaminerController extends Controller
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
       return TestExaminer::with('examiner')->with('test')->latest()->paginate(10);
    }
	
	//used in UserToTest.vue to get all possible TE before filtering by test id. couldn't get this to work more elegantly
    public function displayAll()
    {
       //return TestExaminer::with('examiner')->with('test')->get()->sortBy('examiner.name'); //can't figure out how to set the vuejs filter
	   return TestExaminer::with('examiner')->with('test')->latest()->paginate(10000); //access on UserToTest.vue with testExaminers.data
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'test_id'         =>'required',
            'examiner_id'     =>'required|numeric',
            'pdf'        => 'required|mimes:pdf',
        ],
            [
                'examiner_id.required' => 'Examiner field is required',
                'examiner_id.numeric' => 'Examiner field is required',
                'examiner_id.mimes' => 'Pdf field is required'
            ]
        );

        $pdf=$request->pdf;

        //$filename = time().'_'.$pdf->getClientOriginalName(); //delete time() so moderators control the file name - important for parallel tests i.e. "Physikum"+"Physikum (Zahnmedizin)"
        $filename = $pdf->getClientOriginalName();
		$destinationPath = public_path('img/pdf/');
        $pdf->move($destinationPath, $filename);
		//create backup file to reuse when deleting comments
		$backupPath = public_path('img/originalpdf/');
		copy($destinationPath.$filename, $backupPath.$filename);

		//updateOrCreate instead of create will update the testExaminer if exits, instead of creating duplicates of the testExaminer
        /*return TestExaminer::create([
            'test_id'=>$request->test_id,
            'examiner_id'=>$request->examiner_id,
            'pdf'=>$filename,
            'about_pdf'=>$request->about_pdf
        ]);*/

		return TestExaminer::updateOrCreate(
			['test_id' => $request->test_id, 'examiner_id' => $request->examiner_id],
			['pdf'=>$filename, 'about_pdf'=>$request->about_pdf]
		);

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


    public function profile()
    {
        return auth('api')->user();
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
    public function destroy($id)
    {
      //  $this->authorize('isAdmin');
        $testExaminer=TestExaminer::findOrFail($id);
        $testExaminer->delete();
        if (!empty($testExaminer->pdf)){
                File::delete(public_path('img/pdf/'.$testExaminer->pdf));
        }
        return ['message'=>'Examiner successfully Un-Assigned'];
    }

    public function search(){
        if($search = \Request::get('q')){
            $users =User::where(function ($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('type', 'LIKE', "%$search%");
            })->paginate(20);
        }else{
            $users= User::latest()->paginate(20);
        }
        return $users;
    }

    public function examiners(){
        return Examiner::orderBy('name','ASC')->get(['id','name']);
    }



}
