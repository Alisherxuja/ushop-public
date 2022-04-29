<?php

namespace App\Models\Base\Orders;

use App\Models\Base\Info\Location;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $location_id
 * @property string $address
 * @property mixed $coordinates
 * @property integer $phone
 * @property string $name
 * @property string $landmark
 * @property string $frame
 * @property string $structure
 * @property string $entrance
 * @property string $floor
 * @property string $number
 * @property string $created_at
 * @property string $updated_at
 * @property Location $location
 * @property Order[] $orders
 */
class OrderAddress extends Model
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
    protected $fillable = ['location_id', 'address', 'coordinates', 'phone', 'name', 'landmark', 'frame', 'structure', 'entrance', 'floor', 'number', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Base\Info\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Base\Orders\Order');
    }
}
