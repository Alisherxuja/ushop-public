<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\OrderResource;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Orders\Order;
use App\Models\Base\Orders\OrderAddress;
use App\Models\Base\Orders\OrderProduct;
use App\Models\Base\Site\PaymentType;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->with(['orderProducts.product', 'user', 'paymentType'])
            ->where('user_id', \Auth::id())
            ->paginate();

        return success_out(OrderResource::collection($orders), true);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_name' => 'required|string|max:255',
            'payment_type_id' => 'required|exists:payment_types,id',
            'frame' => 'nullable',
            'structure' => 'nullable',
            'entrance' => 'nullable',
            'floor' => 'nullable',
            'number' => 'nullable',
            'comment' => 'nullable|string|max:500',
            'delivery_date' => 'nullable',
            'before_specified_time' => 'nullable',
            'do_not_ring_doorbell' => 'nullable',
            'leave_door' => 'nullable',
            'exit_permit_required' => 'nullable',
        ]);
        $data['phone'] = clearPhone($data['phone']);
        $data['user_id'] = \Auth::id();

        $cart = Cart::query()
            ->with(['product'])
            ->where(function ($query) use ($data) {
                $query->where('uuid', get_uuid())
                    ->orWhere('user_id', $data['user_id']);
            })
            ->get();
        if (count($cart) == 0) {
            return error_out(['message' => 'Cart empty'], 422, 'Cart empty');
        }

        \DB::beginTransaction();
        try {
            $address = OrderAddress::query()->create([
                'address' => $data['address'],
                'phone' => $data['phone'],
                'name' => $data['address_name'],
                'frame' => $data['frame'] ?? null,
                'structure' => $data['structure'] ?? null,
                'entrance' => $data['entrance'] ?? null,
                'floor' => $data['floor'] ?? null,
                'number' => $data['number'] ?? null,
            ]);

            $price = Cart::query()
                ->selectRaw(\DB::raw('SUM(p.price*carts.qty) as price'))
                ->leftJoin('products as p', 'p.id', 'carts.product_id')
                ->where(function ($query) use ($data) {
                    $query->where('uuid', get_uuid())
                        ->orWhere('user_id', $data['user_id']);
                })->first();

            $order = Order::query()->create([
                'device_type' => Order::DEVICE_TYPE_MOBILE,
                'user_id' => $data['user_id'],
                'order_address_id' => $address->id,
                'payment_type_id' => $data['payment_type_id'],
                'uuid' => get_uuid(),
                'delivery_date' => $data['delivery_date'] ?? date('Y-m-d'),
                'comment' => $data['comment'] ?? null,
                'status' => Order::STATUS_NEW,
                'price' => $price->price,
                'total_price' => $price->price, //add to total_price delivery_price,
                'before_specified_time' => optional($data)['before_specified_time'] ?? false,
                'do_not_ring_doorbell' => optional($data)['do_not_ring_doorbell'] ?? false,
                'leave_door' => optional($data)['leave_door'] ?? false,
                'exit_permit_required' => optional($data)['exit_permit_required'] ?? false,
            ]);

            foreach ($cart as $item) {
                OrderProduct::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'discount' => $item->product->discount,
                    'price' => $item->product->price,
                    'status' => OrderProduct::STATUS_PENDING
                ]);
            }

            Cart::query()
                ->with(['product'])
                ->where(function ($query) use ($data) {
                    $query->where('uuid', get_uuid())
                        ->orWhere('user_id', $data['user_id']);
                })
                ->delete();
            \DB::commit();
            if ($order->paymentType->type == 'online') {
                $base64 = base64_encode('m=' . config('paycom.merchant_id') . ';ac.order_id=' . $order->id . ';a=' . $order->total_price * 100);
                return success_out([
                    'payme_url' => config('paycom.endpoint_url') . '/' . $base64
                ]);
            }
            return success_out([
                'message' => 'Order successfully created'
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return error_out(['message' => $e->getMessage()], 422, 'Unexpected error');
        }
    }

    public function paymentType()
    {
        $payments = PaymentType::query()
            ->select(['type', 'name_' . app()->getLocale(), 'id'])
            ->where('status', PaymentType::STATUS_ACTIVE)
            ->get()
            ->groupBy('type');

        return success_out($payments);
    }

    public function dates()
    {
        $dates = [];
        for ($i = 1; $i < 8; $i++) {
            $dates[] = [
                'name' => date("Y-m-d", strtotime("+$i day")),
                'value' => [
                    '08:00 - 10:00',
                    '10:00 - 12:00',
                    '12:00 - 14:00',
                    '14:00 - 16:00',
                    '16:00 - 18:00',
                    '18:00 - 20:00',
                    '20:00 - 22:00',
                ]
            ];
        }
        return success_out($dates);
    }
}
