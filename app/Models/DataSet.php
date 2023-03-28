<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\DataSet
 *
 * @property int $id
 * @property string $symbol
 * @property string $date
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|DataSet newModelQuery()
 * @method static Builder|DataSet newQuery()
 * @method static Builder|DataSet query()
 * @method static Builder|DataSet whereCreatedAt($value)
 * @method static Builder|DataSet whereDate($value)
 * @method static Builder|DataSet whereId($value)
 * @method static Builder|DataSet wherePrice($value)
 * @method static Builder|DataSet whereSymbol($value)
 * @method static Builder|DataSet whereUpdatedAt($value)
 * @mixin Eloquent
 */
class DataSet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'symbol',
        'date',
        'price',
    ];
}
