<?php

namespace App;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    public function log($message)
    {
        Log::info($message);
    }
}
