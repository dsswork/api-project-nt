<?php

namespace App\Repositories;

use App\Enums\Post\PostStatusEnum;
use App\Http\DTO\PostData;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class PostRepository
{
    protected Model $model;

    public function __construct(
        Post $model
    ) {
        $this->model = $model;
    }

    public function getAll(array $params): LengthAwarePaginator
    {
        return $this->model->query()->paginate($params['limit']);
    }

    public function create(PostData $postData): Model|Post
    {
        return Post::query()->create($postData->toArray());
    }

    public function show(Post $post): Post
    {
        $post->load('user');
        return $post;
    }

    public function update(PostData $postData, Post $post): void
    {
        $post->update($postData->toArray());
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }

    public function getActive(array $params): LengthAwarePaginator
    {
        return Post::query()
            ->where('status', PostStatusEnum::ACTIVE->value)
            ->with('user')
            ->when($params['author'] ?? false, function ($query) use ($params) {
                $query->where('user_id', $params['author']);
            })
            ->latest()
            ->paginate($params['limit']);
    }

    public function getByUser(array $params, User $user): LengthAwarePaginator
    {
        return Post::query()
            ->where('user_id', $user->getKey())
            ->paginate($params['limit']);
    }

    public function activate(Post $post): void
    {
        $post->update([
            'status' => PostStatusEnum::ACTIVE->value,
            'published_at' => now()
        ]);
    }


}
