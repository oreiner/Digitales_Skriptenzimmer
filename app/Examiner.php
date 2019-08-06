<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examiner extends Model
{
	use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	use SoftDeletes;

    protected $fillable = [
        'name', 'description'
    ];
	
	protected $softCascade = ['TestExaminer', 'mail_pdfs'];
	
	 public function TestExaminer()
    {
        return $this->hasMany('\App\TestExaminer');
    }
	
	
	 public function mail_pdfs()
    {
        return $this->hasMany('\App\MailPdf');
    }
}
