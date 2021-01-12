<?php

namespace App\Http\Controllers\Admin\API;

use App\UploadPdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Debugbar;
class UploadPdfController extends Controller
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
        return UploadPdf::latest()->paginate(10);
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
            'title'        => 'required',
            'Semester'       => 'required',						'Fach'       => 'required',
            'upload_pdf'        => 'required|mimes:pdf',
        ]);

        $upload_pdf=$request->upload_pdf;
        $filename = time().'_'.$upload_pdf->getClientOriginalName();
        $destinationPath = public_path('img/uploadpdf/');
        $upload_pdf->move($destinationPath, $filename);
Debugbar::info($request);
        return UploadPdf::create([
            'title'=>$request->title,
            'Semester'=>$request->Semester,
            'upload_pdf'=>$filename,
            'Fach'=>$request->Fach
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
    public function updateUploadPdf(Request $request)
    {Debugbar::info($request);
        $uploadPdf=UploadPdf::findOrFail($request->id);
        $this->validate($request,[
            'title'        => 'required',
            'Semester'       => 'required',						'Fach'       => 'required',
            'upload_pdf'        => 'nullable',
        ]);
       if($request->hasFile('upload_pdf')) {
           $upload_pdf = $request->upload_pdf;
           $filename = time() . '_' . $upload_pdf->getClientOriginalName();
           $destinationPath = public_path('img/uploadpdf/');
           $upload_pdf->move($destinationPath, $filename);
           if (!empty($uploadPdf->upload_pdf)){
               File::delete(public_path('img/uploadpdf/'.$uploadPdf->upload_pdf));
           }
           $uploadPdf->upload_pdf=$filename;
       }
        $uploadPdf->title=$request->title;
		$uploadPdf->Semester=$request->Semester;
        $uploadPdf->Fach=$request->Fach;
        $uploadPdf->save();
        return ['message'=>'Updated the Pdf info'];
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
        $uploadPdf=UploadPdf::findOrFail($id);
        $uploadPdf->delete();
        if (!empty($uploadPdf->upload_pdf)){
            File::delete(public_path('img/uploadpdf/'.$uploadPdf->upload_pdf));
        }
        return ['message'=>'Uploaded Pdf successfully Deleted.'];
    }

    public function search(){
        if($search = \Request::get('q')){
            $pdfs =UploadPdf::where(function ($query) use ($search){
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('Fach', 'LIKE', "%$search%")
                    ->orWhere('Semester', 'LIKE', "%$search%");
            })->paginate(20);
        }else{
            $pdfs= UploadPdf::latest()->paginate(20);
        }
        return $pdfs;
    }

    public function examiners(){
        return Examiner::orderBy('name','ASC')->get(['id','name']);
    }
}
