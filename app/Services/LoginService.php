<?php

namespace App\Services;

use App\Http\DTO\LoginData;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function login(LoginData $userData): JsonResponse
    {
        if(Auth::attempt($userData->toArray())) {
            $user = $this->repository->getByEmail($userData->email);
            $token = $user->createToken('auth token');

            return response()->json([
                'token' => $token->plainTextToken
            ]);
        }

        return response()->json([
            'message' => 'Credentials incorrect'
        ], 401);
    }
}
