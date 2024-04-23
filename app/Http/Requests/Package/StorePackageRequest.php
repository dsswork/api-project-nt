<?php

namespace App\Http\Requests\Package;

use App\Http\Requests\Common\BaseRequest;

class StorePackageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'publications' => 'required|int|min:1'
        ];
    }
}
