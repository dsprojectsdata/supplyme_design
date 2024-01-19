<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateMembersEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $updateValidToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($updateValidToken)
    {
        $this->updateValidToken = $updateValidToken;
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
                    ->view('Admin.invite-mail.update-invite-email-template')
                    ->with(['token' => $this->updateValidToken,]);
    }
}
