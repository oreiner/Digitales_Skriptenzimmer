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
	protected $new_users, $new_comments, $ids;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_users, $new_comments)
    {
        $this->new_users = $new_users;
		$this->new_comments = $new_comments;
		//passing the collection as property destroys the order for some reason. workaround by getting the ids
		$this->ids = $new_comments->pluck('id');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		//dd($this->new_comments->first()->mailpdfs->first()->id);
		$mail = $this->markdown('emails.digest')->from(config('mail.from.address'), config('app.name'))->subject('Digest: neue Benutzer und Kommentare ')->with('new_users',$this->new_users)->with('new_comments',$this->new_comments)->with('ids',$this->ids);
		return $mail;
    }
}
