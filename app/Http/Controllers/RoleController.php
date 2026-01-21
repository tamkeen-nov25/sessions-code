<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(Request $request){
       return  Role::create([
            'name'=>$request->name,
            'user_id' => $request->user_id
        ]);
    }
    
}
