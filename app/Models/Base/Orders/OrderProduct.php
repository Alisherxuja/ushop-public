<?php

namespace App\Models\Base\Orders;

use App\Models\Base\Products\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property float $qty
 * @property int $discount
 * @property float $price
 * @property integer $status
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property Product $product
 */
class OrderProduct extends Model
{
    const STATUS_CANCELED = 0;
    const STATUS_PENDING = 5;
    const STATUS_ACCEPTED = 10;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'qty', 'discount', 'price', 'status', 'comment', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Base\Orders\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Base\Products\Product');
    }
}
