<?php

namespace App\Models\Site;

class Product extends \App\Models\Base\Products\Product
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $primaryKey = 'slug';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttachments()
    {
        return $this->hasMany('App\Models\Base\Products\ProductAttachment', 'product_id', 'id');
    }
}