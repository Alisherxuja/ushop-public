<?php

namespace App\Models\Base\Orders;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $full_name
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 */
class OrderReceiver extends Model
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
    protected $fillable = ['user_id', 'full_name', 'phone', 'created_at', 'updated_at'];

}
