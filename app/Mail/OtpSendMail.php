<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otpSendMail;
    public $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otpSendMail,$otp)
    {
        $this->otpSendMail = $otpSendMail;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('nitesh@3edgetechnologies.com')
        ->subject('OTP by supply-me')
        ->view('Auth.otpmail')
        ->with('data', $this->otpSendMail, $this->otp) ;
    }
}
