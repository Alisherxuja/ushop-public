<?php

namespace App\Models\Base\Info;

use App\Models\Base\Products\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $logo_url
 * @property string $slug
 * @property boolean $is_popular
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property CategoryBrand[] $categoryBrands
 * @property Product[] $products
 */
class Brand extends Model
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
    protected $fillable = ['name', 'logo', 'slug', 'is_popular', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset(\Storage::disk('public')->url($this->logo), env('APP_SSL')) : null;
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
                'source' => 'name'
            ]
        ];
    }

    public static function search(Request $request)
    {
        return self::query()
            ->when($request->name, function (Builder $query) use ($request) {
                $query->where('name', 'ilike', '%' . $request->name . '%');
            })
            ->when(!is_null($request->status), function (Builder $query) use ($request) {
                $query->where('status', $request->status);
            });
    }
}
