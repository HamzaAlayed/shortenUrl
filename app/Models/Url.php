<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Url
 *
 * @property int $id
 * @property string $url
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Url newModelQuery()
 * @method static Builder|Url newQuery()
 * @method static Builder|Url query()
 * @method static Builder|Url whereCreatedAt($value)
 * @method static Builder|Url whereDeletedAt($value)
 * @method static Builder|Url whereId($value)
 * @method static Builder|Url whereShorter($value)
 * @method static Builder|Url whereUpdatedAt($value)
 * @method static Builder|Url whereUrl($value)
 * @method static Builder|Url whereUserId($value)
 * @mixin Eloquent
 * @property string $shorter
 * @method static \Illuminate\Database\Query\Builder|Url onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Url withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Url withoutTrashed()
 * @property-read User|null $user
 */
class Url extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'url', 'shorter', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
