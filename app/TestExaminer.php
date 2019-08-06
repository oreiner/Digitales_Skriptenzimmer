<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestExaminer extends Model
{
	use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	use SoftDeletes;
	
    protected $fillable = [
        'test_id', 'examiner_id', 'pdf','about_pdf'
    ];

    public function examiner()
    {
        return $this->belongsTo(Examiner::class);
    }



    public function test()
    {
        return $this->belongsTo(Test::class);
    }



}
