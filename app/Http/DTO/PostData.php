<?php

namespace App\Http\DTO;

readonly class PostData extends BaseDto
{
    public function __construct(
        public string $title,
        public string $description,
        public int $userId,
        public int|null $id = null
    ) {
    }
}
