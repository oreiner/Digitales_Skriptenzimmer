<?php

namespace App\Http\Controllers\Admin\Api;

use App\UserToTest;
use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
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
	
		if(!isset($rangeStart)) { $rangeStart = date('Y-m-d', strtotime("-6 months")) ; }
		if(!isset($rangeEnd)) { $rangeEnd = date('YYYY-mm-dd'); }
	
		return Test::query()->withCount([
					'UserToTest as downloaded' => function ($query) use ($rangeStart, $rangeEnd) {
						$query->where('created_at','>=',$rangeStart)->where('created_at','<=',date('YYYY-mm-dd'));
					},
					'UserToTest as uploaded' => function ($query) use ($rangeStart, $rangeEnd) {
						$query->where('created_at','>=',$rangeStart)->where('created_at','<=',date('YYYY-mm-dd'))->whereNotNull('grade');
					}
				])->paginate(10);

       #return Test::with('UserToTest')->latest()->paginate(10);
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

    }
}
