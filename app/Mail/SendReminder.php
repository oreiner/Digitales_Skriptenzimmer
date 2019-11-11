<?php

namespace App\Mail;

use App\User;
use App\UserToTest;
use App\Test;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
	public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		//silly workaround to check if open feedbacks is M3. sends a different message. get all UserToTests for this user, check if open one is M3 (test_id==7)
		$m3 = UserToTest::where('user_id',$this->user->id)->where('feedback_status','0')->where('test_id','7')->first();
		if ($m3){
			$mail = $this->markdown('emails.reminderM3')->from(config('mail.from.sender'), config('app.name'))->subject('Erinnerung Skriptenzimmer-Protokoll')->with('name',$this->user->name)->with('date',$m3->reminder_date); //reminder_date impossible to set at the moment
		}else {
			$mail = $this->markdown('emails.reminder')->from(config('mail.from.sender'), config('app.name'))->subject('Erinnerung Skriptenzimmer-Protokoll')->with('name',$this->user->name);
		}
		return $mail;
    }
}
		

