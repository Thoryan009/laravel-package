<?php

namespace App\Modules\Auth\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\AuthRequest;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Resources\AuthResource;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}


    public function login(AuthRequest $request)
    {
        $loginData = $this->authService->login($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'role' => $loginData['user']->type,
            'token' => $loginData['token'],
        ]);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['success' => true, 'message' => 'Logged out successfully']);
    }

    public function user()
    {
        return new AuthResource($this->authService->getUser());
    }
}
