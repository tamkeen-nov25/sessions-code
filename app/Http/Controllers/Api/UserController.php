<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function store(Request $request)
    // {
    //     $user =  User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //     ]);

    //     Profile::create([
    //         'address' => $request->address,
    //         'user_id' => $user->id
    //     ]);
    // }

    public function store(Request $request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->profile()->create([
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => "success",
            'data' => $user
        ]);
    }

    public function index()
    {
        $users =  User::with('profile')->get();

        return response()->json([
            'message' => "success",
            'data' => $users
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'message' => "success",
            'data' => $user->load('profile')
        ]);
        // return ;
    }

    // public function storeUser(Request $request)
    // {
    //     $user =  User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //     ]);
    // }

    // public function storeProfile(User $user,Request $request){
    //     $user->profile()->create([
    //         'address' => $request->address,
    //     ]);

    // }

    public function attachUserWithPosts(Request $request,User $user){

        $user->posts()->sync($request->post_ids);
    }

    public function getUserPosts(Course $course){
        return $course->load('students');

    }


    public function detachUserWithPosts(Request $request,User $user){
        $user->posts()->detach($request->post_ids);
    }

    
}
