<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->register($request->validated());
        return $this->successResponse(data: $response);
    }

    public function login(LoginRequest $request)
    {
        $response = $this->authService->login($request->validated());

        return $this->successResponse(data: $response);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse();
    }
}
