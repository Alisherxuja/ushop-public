<?php

namespace App\Models\Base\Products;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $product_review_id
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property ProductReview $productReview
 */
class ProductReviewAttachment extends Model
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
    protected $fillable = ['product_review_id', 'image', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productReview()
    {
        return $this->belongsTo('App\Models\Base\Products\ProductReview');
    }
}
