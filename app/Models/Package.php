<?php

namespace App\Models;

use App\Enums\Package\PackageStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property float price
 * @property int publications
 * @property PackageStatusEnum status
 *
 */
class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'publications',
        'status'
    ];

    protected $casts = [
        'status' => PackageStatusEnum::class
    ];

    public function packageUsers(): HasMany
    {
        return $this->hasMany(PackageUser::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
