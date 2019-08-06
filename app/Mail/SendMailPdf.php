<?php

namespace App\Mail;

use App\TestExaminer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendMailPdf extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
	public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
  	
    public function __construct($content)
    {
        $this->content=$content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

       // $mail = $this->subject('The subject', ['content' => $this->content])->markdown('emails.mailpdf');
	
        $mail = $this->markdown('emails.sendmailpdf')->
          from($this->content['from_email'], $this->content['name'])->
          subject('Prüfungsprotokoll')->
          with('content',$this->content);

        //loop through attachments and attach to $mail
        $testExaminers =  TestExaminer::all();
        foreach($this->content['queryMailPdfs'] as $queryMailPdf) {
            //attach the file
            $mail->attach(public_path('img/mailpdf/'.$queryMailPdf->mailpdf));
        }

        //return and execute sending the mailable
        return $mail;

    }
}
