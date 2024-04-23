<?php

namespace App\Services;

use App\Http\DTO\UserData;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class RegisterService
{
    public function __construct(
        private UserRepository $repository
    )
    {
    }

    public function register(UserData $userData): JsonResponse
    {
        $user = $this->repository->create($userData);
        $token = $user->createToken('auth token');

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
