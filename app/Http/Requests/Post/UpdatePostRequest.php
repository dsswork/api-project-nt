<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Common\BaseRequest;

class UpdatePostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:2000',
            'userId' => 'required|int'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'userId' => auth()->id(),
        ]);
    }
}
