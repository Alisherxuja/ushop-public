<?php

namespace App\Models\Base\Orders;

use App\Models\Base\Products\ProductReview;
use App\Models\Base\Site\Courier;
use App\Models\Base\Site\DeliveryType;
use App\Models\Base\Site\Feedback;
use App\Models\Base\Site\PaymentType;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_address_id
 * @property integer $delivery_type_id
 * @property integer $payment_type_id
 * @property integer $courier_id
 * @property float $price
 * @property float $delivery_price
 * @property float $total_price
 * @property string $uuid
 * @property string $comment
 * @property string $device_type
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 * @property OrderAddress $orderAddress
 * @property DeliveryType $deliveryType
 * @property Courier $courier
 * @property PaymentType $paymentType
 * @property OrderProduct[] $orderProducts
 * @property ProductReview[] $productReviews
 * @property Transaction[] $transactions
 * @property Feedback[] $feedbacks
 */
class Order extends Model
{
    const STATUS_CANCELED = 0;
    const STATUS_NEW = 1;
    const STATUS_PAYMENT_PENDING = 2;
    const STATUS_PAYMENT_PAID = 3;
    const STATUS_PAYMENT_ACCEPT = 4;
    const STATUS_SHIPPING = 5;
    const STATUS_DELIVERED = 10;

    const DEVICE_TYPE_WEB = 'web';
    const DEVICE_TYPE_TELEGRAM = 'telegram';
    const DEVICE_TYPE_MOBILE = 'mobile';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'order_address_id', 'delivery_type_id', 'payment_type_id', 'courier_id', 'price',
        'delivery_price', 'total_price', 'uuid', 'comment', 'status', 'created_at', 'updated_at', 'deleted_at',
        'delivery_date', 'before_specified_time', 'do_not_ring_doorbell', 'leave_door', 'exit_permit_required','device_type'];

    protected $appends = ['status_name'];

    public function getStatusNameAttribute()
    {
        return self::getStatusList($this->status);
    }

    public static function getStatusList($value = null)
    {
        $list = [
            self::STATUS_CANCELED => 'ОТМЕНЕН',
            self::STATUS_NEW => 'НОВЫЙ',
            self::STATUS_PAYMENT_PENDING => 'ПЛАТЕЖ НА ОЖИДАНИИ',
            self::STATUS_PAYMENT_PAID => 'ОПЛАТА ОПЛАТИТ',
            self::STATUS_PAYMENT_ACCEPT => 'ПРИЕМ ОПЛАТЫ',
            self::STATUS_SHIPPING => 'ПЕРЕВОЗКИ',
            self::STATUS_DELIVERED => 'ДОСТАВЛЕН',
        ];
        if (!is_null($value)) {
            return optional($list)[$value];
        }
        return $list;
    }

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
    public function orderAddress()
    {
        return $this->belongsTo('App\Models\Base\Orders\OrderAddress');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryType()
    {
        return $this->belongsTo('App\Models\Base\Site\DeliveryType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courier()
    {
        return $this->belongsTo('App\Models\Base\Site\Courier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentType()
    {
        return $this->belongsTo('App\Models\Base\Site\PaymentType');
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
        return $this->hasMany('App\Models\Base\Products\ProductReview');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Base\Orders\Transaction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Base\Site\Feedback');
    }

    public function changeStatus()
    {
        $this->status = Order::STATUS_DELIVERED;
    }
}
