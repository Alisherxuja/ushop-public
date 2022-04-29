<?php

namespace App\Models\Base\Site;

use App\Models\Base\Orders\Order;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $comment
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Order $order
 */
class Feedback extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'order_id', 'comment', 'status', 'created_at', 'updated_at'];

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
    public function order()
    {
        return $this->belongsTo('App\Models\Base\Orders\Order');
    }
}
