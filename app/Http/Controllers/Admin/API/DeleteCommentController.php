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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;

class DeleteCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
          //$this->middleware('auth');
    }



    public function index()
    {
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
       //
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
        //
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
        
		$comment_id = $record->user_to_test_id;
		$comment = $comment_id.'_mergepdf.pdf';
		$filename=public_path('img/mergepdf/'.$comment);
		Storage::delete($filename);
		//UserToTest::destroy($id);
		
		$record->delete();
		
        return ['message'=>'User comment successfully deleted'];
    }

    public function getExaminerByTestId(Request $request){
        //
    }
}
