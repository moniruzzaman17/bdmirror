<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $mobile;
    public $address;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $mobile, $address)
    {
        $this->url = $url;
        $this->mobile = $mobile;
        $this->address = $address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $this->url;
        $mobile = $this->mobile;
        $address = $this->address;
        $me = Auth::guard('citizen')->user()->name;
        return $this->view('mail.welcome', compact('url','mobile','address'))->subject('Emergency Help Seeking From '.$me);
    }
}
