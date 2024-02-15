<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LoginServices;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginServices $loginService)
    {
        $this->loginService = $loginService;
    }
    public function login(Request $request)
    {
        return $this->loginService->login($request);
    }

    public function createUser(Request $request)
    {
        return $this->loginService->createUser($request->all());
    }
    public function updateUser(Request $request)
    {
        return $this->loginService->updateUser($request->all());
    }
    public function updatePassword(Request $request)
    {
        return $this->loginService->updatePassword($request->all());
    }
}
