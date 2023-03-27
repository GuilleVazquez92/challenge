<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller


{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $token = $this->authService->login($credentials);
        if ($token) {
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Incorrect Credentials'], 401);
        }
    }

    public function register(RegisterRequest $request)
    {

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $token = $this->authService->register($data);

        return response()->json(['token' => $token], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
