<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createComment(Model $model,array $data)
    {
        $model->comments()->create([
            'content' => $data['content']
        ]);
    }
}
