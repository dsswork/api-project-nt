<?php

namespace App\Http\DTO;

readonly class PackageData extends BaseDto
{
    public function __construct(
        public string $name,
        public float $price,
        public int $publications,
        public int|null $id = null
    ) {
    }
}
