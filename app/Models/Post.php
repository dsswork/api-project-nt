<?php

namespace App\Models;

use App\Enums\Post\PostStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title
 * @property string description
 * @property PostStatusEnum status
 * @property int user_id
 * @property Carbon published_at
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'published_at'
    ];

    protected $casts = [
        'status' => PostStatusEnum::class,
        'published_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
