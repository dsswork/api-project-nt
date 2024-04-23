<?php

namespace App\Http\Requests\Package;

use App\Enums\Package\PackageStatusEnum;
use App\Http\Requests\Common\BaseRequest;
use App\Models\Package;
use Illuminate\Validation\Rule;

class ActiveIdRequest extends BaseRequest
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
                Rule::exists(Package::class, 'id')
                    ->where('status', PackageStatusEnum::ACTIVE->value)
            ]
        ];
    }
}
