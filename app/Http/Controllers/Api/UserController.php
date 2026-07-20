<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}
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
        $this->userService->store($request->validated());
        // (new UserService)->store();



        return response()->json([
            'message' => "success",
            'data' => $user
        ]);
    }

    public function index()
    {
        $users = $this->userService->index();

        return response()->json([
            'message' => "success",
            'data' => $users
        ]);
    }


    public function show(User $user)
    {
        // $user = new User();
        $user = $this->userService->show($user);

        return response()->json([
            'message' => "success",
            'data' => $user
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

    public function attachUserWithPosts(Request $request, User $user)
    {

        $user->posts()->sync($request->post_ids);
    }

    public function getUserPosts(Course $course)
    {
        return $course->load('students');
    }


    public function detachUserWithPosts(Request $request, User $user)
    {
        $user->posts()->detach($request->post_ids);
    }
}
