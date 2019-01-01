<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $from_email;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_email='',$comment=''){
        $this->from_email = $from_email;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.comment')
                    ->from('demo@gmail.com', 'Demo')
                    ->subject('Someone commentted on your thread')
                    ->with('from',$this->from_email)
                    ->with('comment',$this->comment);
    }
}
