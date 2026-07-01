<?php

namespace App\Services;

use App\Models\User;
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

    public function index()
    {
        $users =  User::with('profile')->get();
        return $users;
    }

    public function show(User $user)
    {
        $test =  $user->load('profile');
        return $test;
    }

    public function createComment(Model $model, array $data)
    {
        $model->comments()->create([
            'content' => $data['content']
        ]);
    }
    public function store(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->profile()->create([
            'address' => $data['addresss'],
        ]);
    }
}
