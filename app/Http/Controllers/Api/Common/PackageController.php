<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\BaseGetRequest;
use App\Http\Resources\Package\PackageResource;
use App\Services\PackageService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PackageController extends Controller
{
    public function __construct(
        private PackageService $service
    ) {
    }

    public function index(BaseGetRequest $request): AnonymousResourceCollection
    {
        return PackageResource::collection(
            $this->service->getActive($request->validated())
        );
    }
}
