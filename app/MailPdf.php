<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MailPdf extends Model
{
	
	use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	
    protected $fillable = [
        'user_id', 'test_id', 'examiner_id', 'mailpdf'
    ];

    public function examiner()
    {
        return $this->belongsTo(Examiner::class);
    }

	public function TestExaminer()
    {
        return $this->belongsTo(TestExaminer::class);
    }
	
    public function getExaminerByTestId($testid){
        $testExaminers= TestExaminer::where('test_id',$testid)->with('examiner')->with('test')->get();
        return $testExaminers;
    }
	
		
	public function getFaecherByTestId($testid){

		$ids = TestExaminer::where('test_id',$testid)->with('examiner')->pluck('examiner_id');
		$faecher = Examiner::whereIn('id',$ids)->groupBy('description')->orderBy('description', 'ASC')->pluck('description');

		return $faecher;
    }
	
	public function getExaminerByFach($testid, $fach){
		$testExaminers= TestExaminer::where('test_id',$request->testid)->whereHas('examiner',function ($q) use ($fach) {$q->whereIn('description',$fach);} )->with('examiner')->with('test')->get();
        return $testExaminers;
    }
	
	public function loadReminderDates($testid){
        $reminder = Reminder::where('test_id',$testid)->get();
        return $reminder;
    }
}
