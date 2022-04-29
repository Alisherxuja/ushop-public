<?php

namespace App\Models\Base\Users;

use App\Models\Base\Products\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Product $product
 */
class UserProductsHistory extends Model
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
    protected $fillable = ['user_id', 'product_id', 'created_by', 'uuid', 'updated_by', 'created_at', 'updated_at'];

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
    public function product()
    {
        return $this->belongsTo('App\Models\Base\Products\Product');
    }
}
