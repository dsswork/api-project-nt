<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Http\Resources\Author\AuthorResource;
use App\Services\AuthorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    public function __construct(
        private AuthorService $service
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        return AuthorResource::collection($this->service->getAll());
    }
}
