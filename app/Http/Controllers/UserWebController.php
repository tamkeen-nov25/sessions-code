<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWebController extends Controller
{
    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user =  User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::login($user);

        return view('home');
    }

    public function loginView()
    {
        return view('login');
    }



    public function login(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }
        // Auth::login($user);
        // $user = User::query()->where('email', $request->email)
        //     ->first();
        // // $user = User::query()->where('email', $request->email)->exists();
        // if ($user) {
        //     if (Hash::check($request->password, $user->password)) {
        //         $token = $user->createToken('api-token')->plainTextToken;
        //         return response()->json([
        //             'user' => $user,
        //             'token' => $token
        //         ]);
        //     }
        //     return response()->json([
        //         'message' => "wrong password",
        //     ], 401);
        // }

        // return response()->json([
        //     'message' => "unauthenticated",
        // ], 401);


        $response = $this->authService->login($request->validated());

        return $this->successResponse(data: $response);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('register');
    }
}
