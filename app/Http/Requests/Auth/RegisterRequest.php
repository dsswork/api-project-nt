<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Common\BaseRequest;
use App\Models\User;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:' . User::class . ',email',
            'password' => 'required|min:8'
        ];
    }
}
