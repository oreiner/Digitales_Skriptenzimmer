<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\UserToTest;
use App\MailPdf;
use App\Reminder;
use App\Mail\SendDigest;
use Mail;
use App;

class SendDigestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:digest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Emails to moderators with new users and new comments';

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
	   $new_users = User::whereNull('email_verified_at')->whereDate('created_at','>=',date('Y-m-d' , strtotime ( "previous monday" )))->orderByRaw('substring_index(name, \' \', -1)')->get();  
	   //$new_comments = MailPdf::whereDate('created_at','>=',date('Y-m-d' , strtotime ( "previous monday" )))->with('UserToTest')->with('user')->get(); 
	   $new_comments = UserToTest::where('feedback_status','1')->with('user')->with('mailpdfs')->whereHas('mailpdfs',function($query){ $query->whereNotNull('questions')->whereNotNull('answers')->whereDate('updated_at','>=',date('Y-m-d' , strtotime ( "previous monday" )));})->get();
	   //$content = [$new_users, $new_comments];
	   Mail::to('skriptenzimmer@gmail.com')->cc('info@skripte.koeln')->queue(new SendDigest($new_users, $new_comments));

	   $this->info(' Digest sent successfully!');

    }
	
}
