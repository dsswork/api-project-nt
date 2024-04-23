<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTO\UserData;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        private RegisterService $service
    ) {
    }

    public function store(RegisterRequest $request): JsonResponse
    {
        $userData = new UserData(...$request->validated());
        return $this->service->register($userData);
    }
}
