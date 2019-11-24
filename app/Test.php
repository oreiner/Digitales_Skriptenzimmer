<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
	use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	use SoftDeletes;
	
    protected $fillable = [
        'name', 'position', 'description', 'no_of_examiner'
    ];

	protected $softCascade = ['TestExaminer', 'UserToTest', 'Reminder'];
	
    public function getExaminerByTestId($testid){
		//
    }
	
	 public function TestExaminer()
    {
        return $this->hasMany('\App\TestExaminer');
    }
	
	 public function UserToTest()
    {
        return $this->hasMany('\App\UserToTest');
    }
	
	public function Reminder()
    {
        return $this->hasMany('\App\Reminder');
    }
	
}
