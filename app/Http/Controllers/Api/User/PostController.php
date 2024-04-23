<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\DTO\PostData;
use App\Http\Requests\Common\BaseGetRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct(
        private PostService $service
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BaseGetRequest $request): ResourceCollection
    {
        /* @var User $user */
        $user = auth()->user();
        return PostResource::collection(
            $this->service->getByUser(
                $request->validated(),
                $user
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): PostResource
    {
        $postData = new PostData(...$request->validated());
        return PostResource::make(
            $this->service->create($postData)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): PostResource
    {
        Gate::authorize('view', $post);
        return PostResource::make(
            $this->service->show($post)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post, UpdatePostRequest $request): JsonResponse
    {
        Gate::authorize('edit', $post);
        $postData = new PostData(...$request->validated());
        return $this->service->update($postData, $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        Gate::authorize('delete', $post);
        return $this->service->delete($post);
    }

    public function activate(Post $post): JsonResponse
    {
        Gate::authorize('activate', $post);
        return $this->service->activate($post);
    }
}
