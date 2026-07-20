<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(Request $request)
    {
        // request name 
        $user =  User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);

        $response = $this->authService->register($request->validated());
        return $this->successResponse(data: $response);
    }


    public function login(Request $request)
    {
        $user = User::query()->where('email', $request->email)
            ->first();
        // $user = User::query()->where('email', $request->email)->exists();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'token' => $token
                ]);
            }
            return response()->json([
                'message' => "wrong password",
            ], 401);
        }

        return response()->json([
            'message' => "unauthenticated",
        ], 401);


        $response = $this->authService->login($request->validated());

        return $this->successResponse(data: $response);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        // return $this->successResponse();

        return successResponse();
    }
}
