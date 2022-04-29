<?php


namespace App\Http\Controllers;


use App\Helpers\Format;
use App\Models\Base\Orders\Order;
use App\Models\Base\Orders\Transaction;
use Illuminate\Http\Request;

class PaycomController extends Controller
{
    public function handle(Request $request)
    {
        $method = $request->get('method');
        $params = $request->get('params');
        return $this->handleMethod($method, $params);
    }

    public function handleMethod(string $name, array $params)
    {
        switch ($name) {
            case 'CheckPerformTransaction':
                return $this->checkPerformTransaction($params);
            case 'CreateTransaction':
                return $this->createTransaction($params);
            case 'PerformTransaction':
                return $this->performTransaction($params);
            case 'CancelTransaction':
                return $this->cancelTransaction($params);
            case 'CheckTransaction':
                return $this->checkTransaction($params);
            case 'GetStatement':
                return $this->getStatement($params);
            default:
                return paycom_error();
        }
    }

    public function checkPerformTransaction(array $params)
    {
        $amount = $params['amount'];
        $order_id = $params['account']['order_id'];
        $order = Order::query()->where('id', $order_id)->first();
        if (!$order)
            return paycom_error(31050);
        if ($amount < config('paycom.min_amount') || $amount > config('paycom.max_amount'))
            return paycom_error(31001);

        if (isset($params['account'], $params['account']['order_id'], $params['amount']))
            return paycom_success(['allow' => true]);
        return paycom_error(31050);
    }

    public function createTransaction(array $params)
    {
        $amount = $params['amount'];
        $order_id = $params['account']['order_id'];
        $order = Order::query()->where('id', $order_id)->first();
        if (!$order)
            return paycom_error(31050);
        if ($amount < config('paycom.min_amount') || $amount > config('paycom.max_amount'))
            return paycom_error(31001);

        $transaction = Transaction::query()->where('transaction_id', $params['id'])->first();
        if ($transaction) {
            if ($transaction->state != Transaction::STATE_CREATED) {
                return paycom_error(31008);
            } elseif ($transaction->isExpired()) {
                $transaction->cancel(Transaction::REASON_CANCELLED_BY_TIMEOUT);
                return paycom_error(31008);
            } else {
                return paycom_success([
                    'create_time' => strtotime($transaction->created_at) * 1000,
                    'transaction' => (string)$transaction->id,
                    'state' => $transaction->state,
                ]);
            }
        } else {
            $transaction = Transaction::query()
                ->where('order_id', $order_id)
                ->whereIn('state', [1, 2])
                ->first();
            if (!empty($transaction)) {
                return paycom_error(31050);
            }
        }

        if (Format::timestamp2milliseconds(1 * $params['time']) - Format::timestamp(true) >= Transaction::TIMEOUT) {
            return paycom_error(31050);
        }

        $transaction = Transaction::query()->create([
            'transaction_id' => $params['id'],
            'order_id' => $params['account']['order_id'],
            'amount' => $params['amount'],
            'state' => Transaction::STATE_CREATED
        ]);

        return paycom_success([
            'create_time' => strtotime($transaction->created_at) * 1000,
            'transaction' => (string)$transaction->id,
            'state' => $transaction->state,
        ]);
    }

    public function performTransaction(array $params)
    {
        $transaction = Transaction::query()->where('transaction_id', $params['id'])->first();
        if ($transaction) {
            if ($transaction->state == Transaction::STATE_CREATED) {
                $transaction->state = Transaction::STATE_COMPLETED;
                $transaction->perform_time = now();
                $order = $transaction->order;
                $order->status = Order::STATUS_PAYMENT_PAID;
                $success = $transaction->save() && $order->save();
            } elseif ($transaction->state == Transaction::STATE_COMPLETED) $success = true;
            else return paycom_error(31008);

            if ($success)
                return paycom_success([
                    'state' => $transaction->state,
                    'perform_time' => strtotime($transaction->perform_time) * 1000,
                    'transaction' => (string)$transaction->id,
                ]);
        }
        return paycom_error(31003);
    }

    public function cancelTransaction(array $params)
    {
        $transaction = Transaction::query()->where('transaction_id', $params['id'])->first();
        if ($transaction) {
            $success = $transaction->state == Transaction::STATE_CANCELLED_BEFORE_PAY || $transaction->state == Transaction::STATE_CANCELLED_AFTER_PAY;
            if ($transaction->state == Transaction::STATE_CREATED) {
                $success = $transaction->update([
                    'state' => Transaction::STATE_CANCELLED_BEFORE_PAY,
                    'reason' => $params['reason'] ?? null,
                    'cancel_time' => now(),
                ]);
            } elseif ($transaction->state == Transaction::STATE_COMPLETED) {
                $order = $transaction->order;
                if ($order->status == Order::STATUS_PAYMENT_PAID) {
                    $order->status = Order::STATUS_PAYMENT_PENDING;
                    $transaction->state = Transaction::STATE_CANCELLED_AFTER_PAY;
                    $transaction->cancel_time = now();
                    $transaction->reason = $params['reason'] ?? null;
                    $success = $order->save() && $transaction->save();
                } else {
                    return paycom_error(31007);
                }
            }

            if ($success)
                return paycom_success([
                    'state' => $transaction->state,
                    'cancel_time' => strtotime($transaction->cancel_time) * 1000,
                    'transaction' => (string)$transaction->id,
                ]);
        }

        return paycom_error(31003);
    }

    public function checkTransaction(array $params)
    {
        $transaction = Transaction::query()->where('transaction_id', $params['id'])->first();

        if ($transaction)
            return paycom_success([
                'create_time' => strtotime($transaction->created_at) * 1000,
                'perform_time' => strtotime($transaction->perform_time) * 1000,
                'cancel_time' => strtotime($transaction->cancel_time) * 1000,
                'transaction' => (string)$transaction->id,
                'state' => $transaction->state,
                'reason' => $transaction->reason,
            ]);

        return paycom_error(31003);
    }

    public function getStatement(array $params)
    {
        return paycom_success([]);
    }
}
