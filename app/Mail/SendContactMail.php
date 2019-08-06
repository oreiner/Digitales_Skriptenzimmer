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

class SendContactMail extends Mailable implements ShouldQueue
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
		$mail = $this->markdown('emails.contactmail')->from('info@skripte.koeln', 'Skriptenzimmer Köln')->subject('Erinnerung Skriptenzimmer-Protokoll')->with('name',$this->user->name);
		return $mail;
    }
}
