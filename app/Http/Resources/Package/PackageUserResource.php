<?php

namespace App\Http\Resources\Package;

use App\Enums\Package\PackageStatusEnum;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Package
 */
class PackageUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = [];
        if ($this->pivot->publications > 0 && $this->pivot->created_at > now()->subMonth()) {
            $status['status'] = PackageStatusEnum::ACTIVE->label();
        } else {
            $status['status'] = PackageStatusEnum::INACTIVE->label();
        }

        return array_merge(
            [
                'id' => $this->getKey(),
                'name' => $this->name,
                'price' => $this->price,
                'publications' => $this->publications,
                'lastPublications' => $this->pivot->publications,
                'buyingDate' => $this->pivot->created_at->format('d-m-Y')
            ],
            $status
        );
    }
}
