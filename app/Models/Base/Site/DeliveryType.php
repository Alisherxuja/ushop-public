<?php

namespace App\Models\Base\Site;

use App\Models\Base\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name_ru
 * @property string $name_uz
 * @property string $description_ru
 * @property string $description_uz
 * @property int $price
 * @property string $short_info_ru
 * @property string $short_info_uz
 * @property boolean $is_default
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Order[] $orders
 */
class DeliveryType extends Model
{
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
    protected $fillable = ['name_ru', 'name_uz', 'description_ru', 'description_uz', 'price', 'short_info_ru', 'short_info_uz', 'is_default', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $hidden = ['updated_at', 'deleted_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Base\Orders\Order');
    }
}
