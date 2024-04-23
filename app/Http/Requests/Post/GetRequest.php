<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Common\BaseGetRequest;
use App\Models\User;

class GetRequest extends BaseGetRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'author' => 'int|exists:' . User::class . ',id'
            ]
        );
    }
}
