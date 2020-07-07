<?php

namespace App\Http\Controllers;

use App\UploadPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

//testing
use App\Reminder;

class DownloadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $downloads =UploadPdf::orderBy('Semester','ASC')->orderBy('Fach','ASC')->paginate(10);
        return view('download',compact('downloads'));
    }

    public function getDownload($id)
    {
       $uploadPdf=UploadPdf::findOrFail($id);
       $myFile = public_path('/img/uploadpdf/'.$uploadPdf->upload_pdf);
      return response()->download($myFile );
    }


}
