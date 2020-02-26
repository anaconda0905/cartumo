<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    var $content;

    public function __construct($content)
    {
        //
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        //return $this->markdown('emails.site.register', array('content', $this->content));

        return $this->from(env('PRIMARY_EMAIL_ADDRESS'))
                    ->subject($this->content['title'])
                    ->markdown('emails.site.register', array('content', $this->content));
    }
}
