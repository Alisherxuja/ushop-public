<?php

namespace App\Models\Base\Products;

use App\Models\Base\Orders\Order;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $comment
 * @property integer $rate
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Product $product
 * @property Order $order
 * @property ProductReviewAttachment[] $productReviewAttachments
 */
class ProductReview extends Model
{
    const STATUS_CANCEL = 0;
    const STATUS_NEW = 1;
    const STATUS_DONE = 5;
    const STATUS_SHOW = 10;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'user_id', 'order_id', 'comment', 'rate', 'status', 'created_at', 'updated_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Base\Orders\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReviewAttachments()
    {
        return $this->hasMany('App\Models\Base\Products\ProductReviewAttachment');
    }
}
