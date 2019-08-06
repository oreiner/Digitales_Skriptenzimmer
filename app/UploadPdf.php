<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadPdf extends Model
{
    protected $fillable = [
        'id','title','category', 'upload_pdf', 'Semester', 'description'
    ];
}
