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
        if (Auth::attempt($request->only('username', 'password'))) {
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
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
    }

    public function createUser(array $data)
    {
        $user = new User();
        $user->name = $data['username'];
        $user->role_id = $data['role_id'];
        $user->name = $data['name'] ?? '';
        $user->last_name = $data['last_name'] ?? '';
        $user->municipio = $data['municipio'] ?? '';
        $user->distrito = $data['distrito'] ?? '';
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
