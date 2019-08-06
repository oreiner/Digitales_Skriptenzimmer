<?php

namespace App\Http\Controllers\Admin\Api;

use App\Examiner;
use App\TestExaminer;
use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Debugbar;

class ReminderController extends Controller
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
        return Reminder::with('test')->latest()->paginate(10);
        //  }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
       $reminder=Reminder::findOrFail($id);
        $val = $this->validate($request,[
            'multi'=>'boolean',
            'rangeStart'=> 'required|date',
            'rangeEnd'=>'required|date',
			'mailTiming'=>'nullable|numeric',
			'mailTiming2'=>'nullable|numeric'
        ]);
		$reminder->update($request->all());
		
        return ['message'=>'Updated the Reminder info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
    }

    public function search(){
        if($search = \Request::get('q')){
            $reminders =Reminder::where(function ($query) use ($search){
                $query->where('id', 'LIKE', "%$search%")
                    ->orWhere('test_id', 'LIKE', "%$search%");
            })->paginate(20);
        }else{
            $reminders= Reminder::latest()->paginate(20);
        }
        return $reminders;
    }


}
