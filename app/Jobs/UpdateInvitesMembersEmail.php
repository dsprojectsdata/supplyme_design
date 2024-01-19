<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdateMembersEmail;

class UpdateInvitesMembersEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $updateValidToken;
    public $updateEmail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($updateValidToken,$updateEmail)
    {
        $this->updateValidToken = $updateValidToken;
        $this->updateEmail = $updateEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->updateEmail)->send(new UpdateMembersEmail($this->updateValidToken));
    }
}
