<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadPdf extends Model
{
    protected $fillable = [
        'id','title', 'upload_pdf', 'Semester', 'Fach'
    ];
}
