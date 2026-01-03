<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function  register(array $data)
    {
        // User::query()->create($data);
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $token =  $user->createToken('auth-token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $data){
        $user = User::query()->where('email',$data['email'])->first();

        if($user && Hash::check($data['password'], $user->password)){
           
            $token =  $user->createToken('auth-token')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token
            ];
        }

        throw new AuthenticationException();

    }
}

