<?php

namespace App\Models\Base\Info;

use App\Models\Base\Products\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $name_uz
 * @property string $name_ru
 * @property string $image
 * @property string $image_url
 * @property boolean $is_popular
 * @property string $slug
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Category $category
 * @property Category[] $children
 * @property Category $parent
 * @property CategoryBrand[] $categoryBrands
 * @property Product[] $products
 */
class Category extends Model
{
    use Sluggable;
    use SoftDeletes;

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['parent_id', 'name_uz', 'name_ru', 'image', 'is_popular', 'slug', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset(\Storage::disk('public')->url($this->image), env('APP_SSL')) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Base\Info\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryBrands()
    {
        return $this->hasMany('App\Models\Base\Info\CategoryBrand');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Base\Products\Product');
    }

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_ru'
            ]
        ];
    }
}
