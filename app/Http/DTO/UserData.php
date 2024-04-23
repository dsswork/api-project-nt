<?php

namespace App\Http\DTO;

readonly class UserData extends BaseDto
{
    public function __construct(
        public string $email,
        public string $password,
        public null|string $name = null,
    ) {
    }
}
