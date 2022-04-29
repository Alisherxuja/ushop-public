<?php

namespace App\Models\Base\Info;

use App\Models\Base\Orders\OrderAddress;
use App\Models\Base\Users\UserAddress;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $name_uz
 * @property string $name_ru
 * @property boolean $has_delivery
 * @property string $slug
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Location $location
 * @property Location $parent
 * @property UserAddress[] $userAddresses
 * @property OrderAddress[] $orderAddresses
 */
class Location extends Model
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
    protected $fillable = ['parent_id', 'name_uz', 'name_ru', 'has_delivery', 'slug', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Base\Info\Location', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAddresses()
    {
        return $this->hasMany('App\Models\Base\Users\UserAddress');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderAddresses()
    {
        return $this->hasMany('App\Models\Base\Orders\OrderAddress');
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Location::class, 'id', 'parent_id');
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

    public static function search(Request $request)
    {
        return self::query()
            ->with(['parent'])
            ->when($request->name, function (Builder $query) use ($request) {
                $query->where('locations.name_ru', 'ilike', '%' . $request->name . '%')
                    ->orWhere('locations.name_uz', 'ilike', '%' . $request->name . '%');
            })
            ->when($request->parent_name, function (Builder $query) use ($request) {
                $query->leftJoin('locations as p', 'p.id', 'locations.parent_id')
                    ->where('p.name_ru', 'ilike', '%' . $request->parent_name . '%')
                    ->orWhere('p.name_uz', 'ilike', '%' . $request->parent_name . '%');
            })
            ->when(!is_null($request->status), function (Builder $query) use ($request) {
                $query->where('locations.status', $request->status);
            })->orderByDesc('locations.id');
    }
}
