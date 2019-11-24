<?php

namespace App\Http\Controllers\Admin\Api;

use App\Test;
use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
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
        return Test::latest()->paginate(10);
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
        $this->validate($request,[
            'name'=>'required|string|max:191|unique:tests',
			'position'=> 'required|numeric',
            'no_of_examiner'=> 'required|numeric',
            'description'=> 'nullable|string',
        ]);


        $test = Test::create([
            'name'=>$request->name,
			'position'=>$request->position,
            'no_of_examiner'=>$request->no_of_examiner,
            'description'=>$request->description
        ]);
		
		Reminder::create([
            'test_id'=>$test->id
        ]);
		
		return $test;
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
        $test=Test::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|string|max:191|unique:tests,name,'.$test->id,
			'position'=> 'required|numeric',
            'no_of_examiner'=> 'required|numeric',
            'description'=>'nullable|string'
        ]);
        $test->update($request->all());
        return ['message'=>'Updated the test info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $this->authorize('isAdmin');
        $test=Test::findOrFail($id);
        $test->delete();
        return ['message'=>'Test successfully deleted'];
    }

    public function search(){
        if($search = \Request::get('q')){
            $tests =Test::where(function ($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('no_of_examiner', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            })->paginate(20);
        }else{
            $tests= Test::latest()->paginate(20);
        }
        return $tests;
    }
}
