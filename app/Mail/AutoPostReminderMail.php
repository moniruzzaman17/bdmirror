<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoPostReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $complaint;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$complaint)
    {
        $this->title = $title;
        $this->complaint = $complaint;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = $this->title;
        $complaint = $this->complaint;
        return $this->view('mail.autopostreminder',compact('title','complaint'));
    }
}
