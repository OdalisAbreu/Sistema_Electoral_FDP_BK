<?php

namespace App\Services;

use App\Models\Distrito;
use App\Models\Municipio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginServices
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('username', 'password'))) {
            $distrito = Distrito::find($request->user()->distrito);
            $municipio = Municipio::find($request->user()->municipio);
            return response()->json([
                'id' => $request->user()->id,
                'toke' => $request->user()->createToken('token')->plainTextToken,
                'role' => $request->user()->role_id,
                'user' => $request->user()->username,
                'name' => $request->user()->name,
                'last_name' => $request->user()->last_name,
                'municipio_id' => $request->user()->municipio,
                'municipio' => $municipio ? $municipio->name : '',
                'distrito_id' => $request->user()->distrito,
                'iamge' => $request->user()->image ?? '',
                'distrito' => $distrito ? $distrito->name : '',
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
        $user->username = $data['username'];
        $user->role_id = $data['role_id'];
        $user->name = $data['name'] ?? '';
        $user->last_name = $data['last_name'] ?? '';
        $user->municipio = $data['municipio'] ?? '';
        $user->distrito = $data['distrito'] ?? '';
        $user->password = bcrypt($data['password']);
        $user->image = $data['image'] ?? '';
        $user->save();
        return $user;
    }
    public function updateUser(array $data)
    {
        $user = User::find($data['id']);
        $user->username = $data['username'];
        $user->role_id = $data['role_id'];
        $user->name = $data['name'] ?? '';
        $user->last_name = $data['last_name'] ?? '';
        $user->municipio = $data['municipio'] ?? '';
        $user->distrito = $data['distrito'] ?? '';
        $user->image = $data['image'] ?? '';
        $user->save();
        return $user;
    }

    public function updatePassword(array $data)
    {
        $user = User::find($data['id']);
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
