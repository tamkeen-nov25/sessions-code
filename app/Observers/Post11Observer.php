<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class Post11Observer
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        Log::info("dssdsds");
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
          logger('uplaradated fired');
        Log::info("dssdsds");
        
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
