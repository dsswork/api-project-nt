<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\GetRequest;
use App\Http\Resources\Post\PostResource;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    public function __construct(
        private PostService $service
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GetRequest $request): ResourceCollection
    {
        return PostResource::collection(
            $this->service->getActive($request->validated())
        );
    }
}
