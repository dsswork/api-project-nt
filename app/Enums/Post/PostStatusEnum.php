<?php

namespace App\Enums\Post;

enum PostStatusEnum: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }
}
