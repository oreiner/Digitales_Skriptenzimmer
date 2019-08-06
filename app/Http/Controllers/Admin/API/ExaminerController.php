<?php

namespace App\Http\Controllers\Admin\Api;

use App\Examiner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExaminerController extends Controller
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
        //return Examiner::latest()->paginate(10);
        //return Examiner::orderByRaw('substring_index(name, \' \', -1)')->paginate(10); //order by last name, when format is "first name last name"
		return Examiner::orderBy('name','asc')->paginate(10); //order by last name, when format is "last name, first name"
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
            'name'=>'required|string|max:191|unique:examiners',
            'description'=> 'string'
        ]);


        return Examiner::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
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
        $examiner=Examiner::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|string|max:191|unique:examiners,name,'.$examiner->id,
            'description'=> 'string',
        ]);
        $examiner->update($request->all());
        return ['message'=>'Updated the examiner info'];
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
        $examiner=Examiner::findOrFail($id);
        $examiner->delete();
        return ['message'=>'Examiner successfully deleted'];
    }

    public function search(){
        if($search = \Request::get('q')){
            $examiners =Examiner::where(function ($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            })->paginate(20);
        }else{
            $examiners= Examiner::latest()->paginate(20);
        }
        return $examiners;
    }
}
