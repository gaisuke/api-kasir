<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property float $price
 * @property int $stock
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property CartDetail[] $cartDetails
 * @property OrderDetail[] $orderDetails
 */
class Product extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    protected $dates = ['created_at'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'price', 'stock', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartDetails()
    {
        return $this->hasMany('App\Models\CartDetail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
