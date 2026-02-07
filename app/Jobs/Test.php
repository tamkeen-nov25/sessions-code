<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class Test implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $file;
    public function __construct($file)
    {
        // $this-.file
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::create();
        Log::info("test");
    }
}
