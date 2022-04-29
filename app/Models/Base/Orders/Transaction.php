<?php

namespace App\Models\Base\Orders;

use App\Helpers\Format;
use Illuminate\Database\Eloquent\Model;


/**
 * @property integer $id
 * @property integer $order_id
 * @property string $transaction_id
 * @property integer $perform_time
 * @property integer $cancel_time
 * @property integer $amount
 * @property integer $state
 * @property integer $reason
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Order $order
 */
class Transaction extends Model
{
    const TIMEOUT = 43200000;

    const STATE_CREATED = 1;
    const STATE_COMPLETED = 2;
    const STATE_CANCELLED_BEFORE_PAY = -1;
    const STATE_CANCELLED_AFTER_PAY = -2;


    const STATE_CANCELLED                = -1;
    const STATE_CANCELLED_AFTER_COMPLETE = -2;

    const REASON_RECEIVERS_NOT_FOUND         = 1;
    const REASON_PROCESSING_EXECUTION_FAILED = 2;
    const REASON_EXECUTION_FAILED            = 3;
    const REASON_CANCELLED_BY_TIMEOUT        = 4;
    const REASON_FUND_RETURNED               = 5;
    const REASON_UNKNOWN                     = 10;


    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'transaction_id', 'perform_time', 'cancel_time', 'amount',
        'state', 'reason', 'comment', 'created_at', 'updated_at', 'deleted_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Base\Orders\Order');
    }

    public function isExpired()
    {
        // todo: Implement transaction expiration check
        // for example, if transaction is active and passed TIMEOUT milliseconds after its creation, then it is expired
        return $this->state == self::STATE_CREATED && \App\Helpers\Format::datetime2timestamp($this->create_time) - time() > self::TIMEOUT;
    }

    public function cancel($reason)
    {
        // todo: Implement transaction cancelling on data store

        // todo: Populate $cancel_time with value
        $this->cancel_time = Format::timestamp2datetime(Format::timestamp());

        // todo: Change $state to cancelled (-1 or -2) according to the current state

        if ($this->state == self::STATE_COMPLETED) {
            // Scenario: CreateTransaction -> PerformTransaction -> CancelTransaction
            $this->state = self::STATE_CANCELLED_AFTER_COMPLETE;
        } else {
            // Scenario: CreateTransaction -> CancelTransaction
            $this->state = self::STATE_CANCELLED;
        }

        // set reason
        $this->reason = $reason;

        // todo: Update transaction on data store
        $this->save();
    }
}
