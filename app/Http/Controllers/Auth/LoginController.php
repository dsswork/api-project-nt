<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTO\LoginData;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $service
    )
    {
    }

    public function store(LoginRequest $request): JsonResponse
    {
        $userData = new LoginData(...$request->validated());
        return $this->service->login($userData);
    }
}
