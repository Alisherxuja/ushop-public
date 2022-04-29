<?php


namespace App\Models\Base\Products;


use App\Models\Base\Info\Brand;
use App\Models\Base\Info\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwProduct
 * @package App\Models\Base\Products
 * @property integer $id
 * @property integer $status
 * @property string $name_uz
 * @property string $name_ru
 * @property string $sku
 * @property string $slug
 * @property string $price
 * @property string $discount
 * @property string $old_price
 * @property string $stock
 * @property integer $unicode
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $brand_slug
 * @property string $brand_logo
 * @property integer $brand_status
 * @property integer $category_id
 * @property integer $category_parent_id
 * @property string $category_name_ru
 * @property string $category_name_uz
 * @property string $category_slug
 * @property integer $category_status
 * @property integer $measure_id
 * @property string $measure_name_ru
 * @property string $measure_name_uz
 * @property string $measure_symbol_ru
 * @property string $measure_symbol_uz
 * @property string $created_at
 * @property string $updated_at
 */
class VwProduct extends Model
{
    protected $table = 'vw_products';

    public function avatar(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Base\Products\ProductAttachment', 'product_id', 'id')
            ->where('is_avatar', true);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function productReviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Base\Products\ProductReview', 'product_id', 'id');
    }

    public function productAttachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Base\Products\ProductAttachment', 'product_id', 'id');
    }

    public function scopeOrderByAsdDesc(Builder $query): Builder
    {
        $sort = request('sort');

        switch ($sort) {
            case 'price':
                $query->orderBy('vw_products.price');
                break;
            case '-price':
                $query->orderByDesc('vw_products.price');
                break;
            case 'name':
                $query->orderBy('vw_products.name_' . \App::getLocale());
                break;
            case '-name':
                $query->orderByDesc('vw_products.name_' . \App::getLocale());
                break;
            default:
                $query->orderByDesc('vw_products.id');
        }
        return $query;
    }

    public function scopeFilterByBrands(Builder $builder)
    {
        $brands = request('brands', '');
        $brands = explode(',', $brands);
        $brands = Brand::query()->whereIn('slug', $brands)->pluck('id');

        return $builder->when(request('brands'), function (Builder $builder) use ($brands) {
            return $builder->whereIn('p.brand_id', $brands);
        });
    }

    public function scopeFilterByPrice(Builder $builder)
    {
        $price_from = request('price_from');
        $price_to = request('price_to');

        return $builder->when($price_from, function (Builder $builder) use ($price_from) {
            return $builder->where('vw_products.price', '>=', $price_from);
        })->when($price_to, function (Builder $builder) use ($price_to) {
            return $builder->where('vw_products.price', '<=', $price_to);
        });
    }
}
