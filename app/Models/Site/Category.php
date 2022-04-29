<?php

namespace App\Models\Site;

class Category extends \App\Models\Base\Info\Category
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $primaryKey = 'slug';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Base\Products\Product', 'category_id', 'id')
            ->with(['productAttachments'])
            ->inRandomOrder();
    }
}