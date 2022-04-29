<?php

namespace App\Models\Base\Users;

use App\Models\Base\Settings\Location;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $location_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $address
 * @property mixed $coordinates
 * @property integer $phone
 * @property string $first_name
 * @property string $last_name
 * @property string $landmark
 * @property string $label
 * @property boolean $is_default
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 * @property Location $location
 */
class UserAddress extends Model
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
    protected $fillable = ['user_id','name', 'location_id', 'created_by', 'updated_by', 'deleted_by', 'address', 'coordinates', 'phone', 'first_name', 'last_name', 'landmark', 'label', 'is_default', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Base\Settings\Location');
    }
}
