<?php

namespace App\Jobs;

use App\Mail\MembersEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Log;

class InvitesMembersEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $validToken;
    public $demail;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($validToken, $demail)
    {
        $this->validToken = $validToken;
        $this->demail = $demail;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->demail)->send(new MembersEmail($this->validToken));
    }
}
