<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserToTest extends Model
{
	use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

	public function examiner()
    {
        return $this->belongsTo(Examiner::class);
    }

	
    public function mailpdfs()
    {
        return $this->hasMany(MailPdf::class);
    }





}
