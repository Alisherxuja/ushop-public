<?php

namespace App\Models\Base\Products;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property string $image_url
 * @property boolean $is_avatar
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 */
class ProductAttachment extends Model
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
    protected $fillable = ['product_id', 'image', 'is_avatar', 'created_at', 'updated_at'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset(\Storage::disk('public')->url($this->image), env('APP_SSL')) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Base\Products\Product');
    }
}
