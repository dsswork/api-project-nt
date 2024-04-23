<?php

namespace App\Http\Requests\Package;

use App\Http\Requests\Common\BaseRequest;
use App\Models\Package;

class PackageIdRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'package' => [
                'required',
                'int',
                'exists:'. Package::class .',id'
            ]
        ];
    }
}
