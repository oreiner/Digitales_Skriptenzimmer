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
	   $new_users = User::whereNull('manually_verified_at')->whereDate('created_at','>=',date('Y-m-d' , strtotime ( "previous monday" )))->orderByRaw('substring_index(name, \' \', -1)')->get();  
	   //$new_comments = MailPdf::whereDate('created_at','>=',date('Y-m-d' , strtotime ( "previous monday" )))->with('UserToTest')->with('user')->get(); 
	   $new_comments = UserToTest::where('feedback_status','1')->with('user')->with('mailpdfs') 
						->whereHas('mailpdfs',function($query){ $query->whereNotNull('questions')->whereNotNull('answers')->whereDate('updated_at','>=',date('Y-m-d' , strtotime ( "previous monday" )));})
						->get();
		//make short comments appear first to detect problem protocls faster //deprecated
		//$question_length = 'mailpdf.questions';
		//$new_comments = $new_comments->sortBy(function($question_length) { return strlen($question_length);});
		//dd($new_comments);
	   //$content = [$new_users, $new_comments];
	   
	   	// Used to determine the shortest comment (question of mailpdf) a UserToTest has
		$maxCommentLength = function ($shortest, $mailpdf) {
			$length = strlen($mailpdf->questions);
			if ((($length < $shortest) && ($length > 0 )) || $shortest == 0 ) {
			   return $length;
			 }
			//echo "shortest: ".$shortest." len: ".$length; //debug
			return $shortest;
		};

		// Sort the users array using a comparator function and our max length helper
		$new_comments = $new_comments->sort(function ($u1, $u2) use ($maxCommentLength) {
			$max1 = $u1->mailpdfs->reduce($maxCommentLength, 0);
			$max2 = $u2->mailpdfs->reduce($maxCommentLength, 0);
			
			// Shift element right
			if ($max1 > $max2) {
				return 1;
			}
			
			// Shift element left
			if ($max1 < $max2) {
				return -1;
			}
			
			// Keep same index
			return 0;
		});
	   
	   //send digest
	   Mail::to(config('mail.from.sender'))->cc('info@skripte.koeln')->queue(new SendDigest($new_users, $new_comments));

	//notify in cli about digest
	   $this->info(' Digest sent successfully!');

    }
	

	
}
