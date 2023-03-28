<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio
 *
 * @property int $id
 * @property int $user_id
 * @property string $symbol
 * @property float $number_of_shares
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|Portfolio newModelQuery()
 * @method static Builder|Portfolio newQuery()
 * @method static Builder|Portfolio query()
 * @method static Builder|Portfolio whereCreatedAt($value)
 * @method static Builder|Portfolio whereId($value)
 * @method static Builder|Portfolio whereNumberOfShares($value)
 * @method static Builder|Portfolio whereSymbol($value)
 * @method static Builder|Portfolio whereUpdatedAt($value)
 * @method static Builder|Portfolio whereUserId($value)
 * @mixin Eloquent
 */
class Portfolio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'symbol',
        'number_of_shares',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
