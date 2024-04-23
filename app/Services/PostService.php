<?php

namespace App\Services;

use App\Enums\Post\PostStatusEnum;
use App\Http\DTO\PostData;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(
        private readonly PostRepository $repository,
        private readonly UserRepository $userRepository,
    )
    {
    }

    public function getAll(array $params): ResourceCollection
    {
        $posts = $this->repository->getAll($params);
        return PostResource::collection($posts);
    }

    public function create(PostData $postData): Post|Model
    {
        return $this->repository->create($postData);
    }

    public function show(Post $post): Post
    {
        return $this->repository->show($post);
    }

    public function update(PostData $postData, Post $post): JsonResponse
    {
        $this->repository->update($postData, $post);
        return response()->json();
    }

    public function delete(Post $post): JsonResponse
    {
        $this->repository->delete($post);
        return response()->json();
    }

    public function getActive(array $params): LengthAwarePaginator
    {
        return $this->repository->getActive($params);
    }

    public function getByUser(array $params, User $user): LengthAwarePaginator
    {
        return $this->repository->getByUser($params, $user);
    }

    public function activate(Post $post): JsonResponse
    {
        /* @var User $user */
        $user = auth()->user();

        if ($post->status === PostStatusEnum::ACTIVE) {
            return response()->json(['message' => 'post already activated']);
        }

        if ($this->userRepository->hasPublications($user)) {
            try {
                DB::beginTransaction();
                $this->repository->activate($post);
                $publicationsLast = $this->userRepository->decrementPublications($user);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json(['message' => 'you dont have publications']);
        }

        return response()->json([
            'status' => 'success',
            'last publications' => $publicationsLast
        ]);
    }


}
