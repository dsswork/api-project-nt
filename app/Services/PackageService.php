<?php

namespace App\Services;

use App\Http\DTO\PackageData;
use App\Http\Resources\Package\PackageResource;
use App\Http\Resources\Package\PackageUserResource;
use App\Models\Package;
use App\Models\User;
use App\Repositories\PackageRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PackageService
{
    public function __construct(
        private PackageRepository $repository,
        private UserRepository $userRepository
    ) {
    }

    public function getAll(array $params): LengthAwarePaginator
    {
        return $this->repository->getAll($params);
    }

    public function create(PackageData $packageData): Package|Model
    {
        return $this->repository->create($packageData);
    }

    public function activate(int $id): JsonResponse
    {
        return $this->repository->activate($id);
    }

    public function getActive(array $params): LengthAwarePaginator
    {
        return $this->repository->getActive($params);
    }

    public function getByUser(array $params, User $user): LengthAwarePaginator
    {
        return $this->repository->getByUser($params, $user);
    }

    public function buy(int $id, User $user): JsonResponse
    {
        if($this->userRepository->hasPublications($user)) {
            return response()->json(['message' => 'you have active package']);
        }

        $package = $this->repository->getById($id);

        return $this->repository->buy($package, $user);
    }


}
