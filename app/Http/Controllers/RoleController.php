<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // public function store(Request $request){
    //    return  Role::create([
    //         'name'=>$request->name,
    //         'user_id' => $request->user_id
    //     ]);
    // }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return $role->load('permissions');
    }

    public function storeEmployee(Request $request)
    {
        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($request->has('roles')) {
            $employee->assignRole($request->roles);
            // $employee->givePermissionTo($request->permissions);
        }

        return $employee->load('roles');
    }
}
