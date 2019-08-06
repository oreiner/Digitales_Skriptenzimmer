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

class SendDigest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
	public $new_users, $new_comments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_users, $new_comments)
    {
        $this->new_users = $new_users;
		$this->new_comments = $new_comments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$mail = $this->markdown('emails.digest')->from('info@skripte.koeln', 'Skriptenzimmer Köln')->subject('Digest: neue Benutzer und Kommentare ')->with('new_users',$this->new_users)->with('new_comments',$this->new_comments);
		return $mail;
    }
}
