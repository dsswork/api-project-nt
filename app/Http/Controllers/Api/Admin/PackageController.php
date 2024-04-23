<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTO\PackageData;
use App\Http\Requests\Common\BaseGetRequest;
use App\Http\Requests\Package\PackageIdRequest;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Services\PackageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PackageController extends Controller
{
    public function __construct(
        private PackageService $service
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BaseGetRequest $request): AnonymousResourceCollection
    {
        return PackageResource::collection(
            $this->service->getAll(
                $request->validated()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request): PackageResource
    {
        $packageData = new PackageData(...$request->validated());
        return PackageResource::make(
            $this->service->create($packageData)
        );
    }

    public function activate(PackageIdRequest $request): JsonResponse
    {
        return $this->service->activate($request->package);
    }
}
