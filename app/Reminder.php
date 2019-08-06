<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reminder extends Model
{

    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	use SoftDeletes;
	
    protected $fillable = [
       'test_id', 'dates', 'multi', 'rangeStart', 'rangeEnd', 'mailTiming', 'mailTiming2'
    ];

    public function Test()
    {
        return $this->belongsTo(Test::class);
    }
	
    public function getReminderByTestId($testid){
        $reminder = Reminder::where('test_id',$testid)->with('test')->get();
        return $reminder;
    }
	

}
