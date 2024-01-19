<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class MembersEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $validToken;
   
    
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($validToken)
    {
        $this->validToken = $validToken;
       
        
       
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@supplyme.com')
                    ->subject('Congratulations')
                    ->view('Admin.invite-mail.invite-email-template')
                    ->with(['token' => $this->validToken,]);
    }
}
