<?php

namespace App\Http\Controllers\Admin\Api;

use App\UploadPdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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
            'category'       => 'required',
            'upload_pdf'        => 'required|mimes:pdf',
        ]);

        $upload_pdf=$request->upload_pdf;
        $filename = time().'_'.$upload_pdf->getClientOriginalName();
        $destinationPath = public_path('img/uploadpdf/');
        $upload_pdf->move($destinationPath, $filename);

        return UploadPdf::create([
            'title'=>$request->title,
            'category'=>$request->category,
			'Semester'=>$request->Semester,
            'upload_pdf'=>$filename,
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
    public function updateUploadPdf(Request $request)
    {
        $uploadPdf=UploadPdf::findOrFail($request->id);
        $this->validate($request,[
            'title'        => 'required',
            'category'       => 'required',
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
        $uploadPdf->category=$request->category;
		$uploadPdf->Semester=$request->Semester;
        $uploadPdf->description=$request->description;
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
