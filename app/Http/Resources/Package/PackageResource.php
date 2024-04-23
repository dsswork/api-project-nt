<?php

namespace App\Http\Resources\Package;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Package
 */
class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = [];
        if ($this->status) {
            $status['status'] = $this->status->label();
        }

        return array_merge(
            [
                'id' => $this->getKey(),
                'name' => $this->name,
                'price' => $this->price,
                'publications' => $this->publications,
            ],
            $status
        );
    }
}
