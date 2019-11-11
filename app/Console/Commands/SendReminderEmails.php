<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\UserToTest;
use App\Reminder;
use App\Mail\SendReminder;
use Mail;
use App;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Emails to users with due protocols, on dates as defined by user_to_tests and with timing as defined by reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		   //$email_date = Reminder::where('test_id',x)->value('mailTiming');
		   //where('reminder_date', '=', date('Y-m-d'))
		   $pending_users = UserToTest::where('feedback_status','0')->get();  
		   
		   foreach($pending_users as $user){
			   
			   $testdate = $user->reminder_date;
			   $test_id = $user->test_id;
			   
			   $timing1 = Reminder::where('test_id',$test_id)->value('mailTiming');
			   $timing2 = Reminder::where('test_id',$test_id)->value('mailTiming2');
			   
			   $email_date1 = date('Y-m-d', strtotime($testdate. ' +' . $timing1 .' days'));
			   $email_date2 = date('Y-m-d', strtotime($testdate. ' +' . $timing2 .' days'));
			   
			   if (date('Y-m-d') == $email_date1 || date('Y-m-d') == $email_date2){
				   $user_info = User::where('id',$user->user_id)->first();
				   $email = $user_info->email;
				   Mail::to($email)->queue(new SendReminder($user_info));
				   sleep(5);
			   }
		   }

		$this->info(' Reminder messages sent successfully!');

    }
	
}
