<?php

namespace App\Http\Resources\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = [];
        if ($this->status) {
            $status['status'] = $this->status->label();
        }

        return array_merge(
            [
                'id' => $this->getKey(),
                'title' => $this->title,
                'description' => $this->description,
                'author' => $this->user->name,
                'publishedDate' => $this->published_at?->format('d-m-Y H:i')
            ],
            $status
        );
    }
}
