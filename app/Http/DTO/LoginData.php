<?php

namespace App\Http\DTO;

readonly class LoginData extends BaseDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
