<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AddUserController extends Controller
{
    public function store(Request $request)
    {        
       	$this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

       	$user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id == 1 ? $request->role_id : 2;
        $user->sirket_id = $request->sirket;
        $user->il_id = $request->il;
        $user->ilce_id = $request->ilce;
        $user->save();

        return redirect()->to('/admin/dashboard');
    }
}
