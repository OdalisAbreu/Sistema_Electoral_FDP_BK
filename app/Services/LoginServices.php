<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginServices
{
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::attempt($request->only('name', 'password'))) {
            return response()->json([
                'toke' => $request->user()->createToken('token')->plainTextToken,
                'role' => $request->user()->role_id,
                'message' => 'Sucess',
            ]);
        }

        return response()->json([
            'message' => 'Credenciales invalidas',
        ], 401);
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
    }

    public function createUser(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->role_id = $data['role_id'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
