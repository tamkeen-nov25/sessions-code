<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
       $users =  User::get();
       return view('users.index',compact('users'));
    }

    public function create(){
        return view('create');
    }

    public function store(StoreUserRequest $request){
     
        User::create($request->validated());
                return redirect()->route('users.index');

    }

    public function edit($user){
        $user = User::find($user);
        return view('users.edit',compact('user'));
    }

    public function update($user,UpdateUserRequest $request){
        User::find($user)
        ->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($user){
        User::find($user)->delete();
        // $user->delete();
        return redirect()->route('users.index');
    }

    public function home(){
        return view('home');
    }
}
