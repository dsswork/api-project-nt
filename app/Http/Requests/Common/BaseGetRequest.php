<?php

namespace App\Http\Requests\Common;

class BaseGetRequest extends BaseRequest
{
    public const PER_PAGE = 8;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable|int',
            'limit' => 'nullable|int',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'limit' => $this->limit ?? self::PER_PAGE,
        ]);
    }
}
