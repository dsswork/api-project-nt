<?php

namespace App\Http\DTO;

readonly class BaseDto
{
    public function toArray(): array
    {
        $array = json_decode(json_encode($this), true);
        return $this->toSnakeCase($array);
    }

    private function toSnakeCase(mixed $array): array
    {
        $camelCaseArray = [];
        foreach ($array as $key => $value) {
            $camelCaseArray[str($key)->snake()->toString()] = $value;
        }
        return $camelCaseArray;
    }
}
