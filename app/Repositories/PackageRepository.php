<?php

namespace App\Repositories;

use App\Enums\Package\PackageStatusEnum;
use App\Enums\Post\PostStatusEnum;
use App\Http\DTO\PackageData;
use App\Models\Package;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class PackageRepository
{
    public function getAll(array $params): LengthAwarePaginator
    {
        return Package::query()->paginate($params['limit']);
    }

    public function create(PackageData $packageData): Model|Package
    {
        return Package::query()->create($packageData->toArray());
    }

    public function activate(int $id): JsonResponse
    {
        $package = Package::query()
            ->where('id', $id)
            ->where('status', PackageStatusEnum::INACTIVE->value)->first();

        if (!$package) {
            return response()->json(['status' => 'Package already active']);
        }

        $package->update(['status' => PackageStatusEnum::ACTIVE->value]);

        return response()->json(['status' => 'success']);
    }

    public function getActive(array $params): LengthAwarePaginator
    {
        return Package::query()
            ->where('status', PostStatusEnum::ACTIVE->value)
            ->paginate($params['limit']);
    }

    public function getByUser(array $params, User $user): LengthAwarePaginator
    {
        return $user->packages()
            ->withPivot(['publications', 'created_at'])
            ->paginate($params['limit']);
    }

    public function buy(Package $package, User $user): JsonResponse
    {
        $user->packages()->attach(
            $package->getKey(),
            [
                'publications' => $package->publications,
                'created_at' => now()
            ]
        );

        return response()->json(['status' => 'success']);
    }

    public function getById(int $id): Model|Package
    {
        return Package::query()->find($id);
    }
}
