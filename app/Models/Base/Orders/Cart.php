<?php

namespace App\Models\Base\Orders;

use App\Models\Base\Products\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $user_id
 * @property string $uuid
 * @property float $qty
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Product $product
 */
class Cart extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'user_id', 'uuid', 'qty', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Base\Products\Product');
    }
}
