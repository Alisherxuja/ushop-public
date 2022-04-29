<?php

namespace App\Models\Base\Products;

use App\Models\Base\Info\Brand;
use App\Models\Base\Info\Category;
use App\Models\Base\Info\Measure;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Orders\OrderProduct;
use App\Models\Base\Users\UserProductsHistory;
use App\Models\Base\Users\Wishlist;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $measure_id
 * @property string $slug
 * @property string $name_ru
 * @property string $name_uz
 * @property string $sku
 * @property string $unicode
 * @property float $price
 * @property float $discount
 * @property float $old_price
 * @property int $stock
 * @property mixed $info_ru
 * @property mixed $info_uz
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Category $category
 * @property Brand $brand
 * @property Measure $measure
 * @property ProductAttachment[] $productAttachments
 * @property Wishlist[] $wishlists
 * @property UserProductsHistory[] $userProductsHistories
 * @property Cart[] $carts
 * @property OrderProduct[] $orderProducts
 * @property ProductReview[] $productReviews
 */
class Product extends Model
{
    use SoftDeletes;
    use Sluggable;

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
    protected $fillable = ['category_id', 'brand_id', 'measure_id', 'slug', 'name_ru', 'name_uz', 'sku', 'unicode',
        'price', 'discount', 'old_price', 'stock', 'info_ru', 'info_uz', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {
        $image = collect($this->productAttachments)->where('is_avatar', true)->first();
        if (empty($image)) {
            $image = collect($this->productAttachments)->orderBy('id')->first();
        }
        return $image->image_url ?? null;
    }

    public function getInfoUzAttribute($value)
    {
        return json_decode($value);
    }

    public function getInfoRuAttribute($value)
    {
        return json_decode($value);
    }

    public function scopeAvailableProducts(Builder $query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeFilter(Builder $query)
    {
        return $query
            ->when(request('category'), function ($q) {
                $q->whereIn('category_id', request('category'));
            })->when(request('brand'), function ($q) {
                $q->whereIn('brand_id', request('brand'));
            })->when(request('name'), function ($q) {
                $q->where(function (Builder $t) {
                    $t->where('name_ru', 'ilike', '%' . request('name') . '%')
                        ->orWhere('name_uz', 'ilike', '%' . request('name') . '%');
                });
            });
    }

    public function scopeFilterCategory(Builder $query)
    {
        return $query->when(request('categories'), function ($q) {
            $q->where('category_id', request('categories'));
        });
    }

    public function scopeFilterBrand(Builder $query)
    {
        return $query->when(request('brands'), function ($q) {
            $q->where('brand_id', request('brands'));
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Base\Info\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Base\Info\Brand');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measure()
    {
        return $this->belongsTo('App\Models\Base\Info\Measure');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttachments()
    {
        return $this->hasMany('App\Models\Base\Products\ProductAttachment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists()
    {
        return $this->hasMany('App\Models\Base\Users\Wishlist');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userProductsHistories()
    {
        return $this->hasMany('App\Models\Base\Users\UserProductsHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Base\Orders\Cart');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\Models\Base\Orders\OrderProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReviews()
    {
        return $this->hasMany('App\Models\Base\Products\ProductReview', 'product_id', 'id')
            ->limit(5)
            ->with(['user'])
            ->where('status', ProductReview::STATUS_SHOW)
            ->orderByDesc('id');
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
