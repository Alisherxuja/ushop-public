<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Orders\Order;
use App\Models\Base\Orders\OrderAddress;
use App\Models\Base\Orders\OrderProduct;
use App\Models\Base\Site\PaymentType;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'frame' => 'nullable',
            'structure' => 'nullable',
            'entrance' => 'nullable',
            'floor' => 'nullable',
            'number' => 'nullable',
            'address_name' => 'required|string|max:255',
            'payment_type_id' => 'required|exists:payment_types,id',
            'comment' => 'nullable|string|max:500',
            'delivery_date' => 'nullable',
            'before_specified_time' => 'nullable',
            'do_not_ring_doorbell' => 'nullable',
            'leave_door' => 'nullable',
            'exit_permit_required' => 'nullable',
        ]);
        $data['phone'] = clearPhone($data['phone']);
        $cart = Cart::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get();
        if (count($cart) == 0) {
            return back()->with('unexpected-error', 'Empty cart');
        }
        $paymentType = PaymentType::query()->find($data['payment_type_id']);
        \DB::beginTransaction();
        try {
            $address = OrderAddress::query()->create([
                'address' => $data['address'],
                'phone' => $data['phone'],
                'name' => $data['address_name'],
                'frame' => $data['frame'],
                'structure' => $data['structure'],
                'entrance' => $data['entrance'],
                'floor' => $data['floor'],
                'number' => $data['number'],
            ]);

            $price = Cart::query()
                ->selectRaw(\DB::raw('SUM(p.price*carts.qty) as price'))
                ->leftJoin('products as p', 'p.id', 'carts.product_id')
                ->where(function ($query) {
                    $query->where('uuid', get_uuid())
                        ->when(!auth('web')->guest(), function ($q) {
                            $q->orWhere('user_id', auth('web')->id());
                        });
                })->first();

            $order = Order::query()->create([
                'user_id' => \Auth::guard('web')->id(),
                'order_address_id' => $address->id,
                'payment_type_id' => $data['payment_type_id'],
                'uuid' => get_uuid(),
                'delivery_date' => $data['delivery_date'] ?? date('Y-m-d'),
                'comment' => $data['comment'],
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
                ->where(function ($query) {
                    $query->where('uuid', get_uuid())
                        ->when(!auth('web')->guest(), function ($q) {
                            $q->orWhere('user_id', auth('web')->id());
                        });
                })
                ->delete();
            \DB::commit();
            return redirect()->route('user.order.payment', ['order' => $order]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors($data)->with('unexpected-error', 'Unexpected error - ' . $e->getMessage());
        }
        \DB::rollBack();
        return back()->withErrors($data);
    }

    public function orderPage()
    {
        $payments = PaymentType::query()
            ->where('status', PaymentType::STATUS_ACTIVE)
            ->get()
            ->groupBy('type');

        $user = \Auth::guard('web')->user();
        $cart = Cart::query()
            ->select([
                'carts.*',
                \DB::raw('(carts.qty * p.price) as product_price')
            ])
            ->leftJoin('products as p', 'p.id', 'carts.product_id')
            ->with(['product'])
            ->where(function ($query) {
                $query->where('carts.uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('carts.user_id', auth('web')->id());
                    });
            })
            ->get();

        $dates = [];
        for ($i = 1; $i < 8; $i++) {
            $dates[date("Y-m-d", strtotime("+$i day"))] = [
                '08:00 - 10:00',
                '10:00 - 12:00',
                '12:00 - 14:00',
                '14:00 - 16:00',
                '16:00 - 18:00',
                '18:00 - 20:00',
                '20:00 - 22:00',
            ];
        }
        return view('site.cabinet.order-page', [
            'payments' => $payments,
            'user' => $user,
            'cart' => $cart,
            'dates' => $dates
        ]);
    }

    public function history()
    {
        $orders = Order::query()
            ->with(['orderProducts.product', 'orderAddress'])
            ->where('user_id', \Auth::id())
            ->orderByDesc('id')
            ->get();
        return view('site.cabinet.order-history', ['orders' => $orders]);
    }

    public function payment(Order $order)
    {
        return view('site.cabinet.payment', ['order' => $order]);
    }

    public function reOrder(Order $order)
    {
        $address = $order->orderAddress->makeHidden(['id', 'created_at', 'updated_at'])->toArray();
        $data = $order->makeHidden(['id', 'created_at', 'updated_at', 'uuid', 'status'])->toArray();
        try {
            $newOrderAddress = OrderAddress::query()->create($address);
            $data['uuid'] = get_uuid();
            $data['status'] = Order::STATUS_NEW;
            $data['order_address_id'] = $newOrderAddress->id;
            $data['delivery_date'] = date('Y-m-d');
            $data['device_type'] = Order::DEVICE_TYPE_WEB;
            $newOrder = Order::query()->create($data);
            foreach ($order->orderProducts as $item) {
                OrderProduct::query()->create([
                    'order_id' => $newOrder->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'discount' => $item->product->discount,
                    'price' => $item->product->price,
                    'status' => OrderProduct::STATUS_PENDING
                ]);
            }
            return redirect()->route('user.order.payment', ['order' => $newOrder]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error cloning order');
        }
    }

    public function successPayment(Order $order)
    {
        return view('site.cabinet.order-success', ['order' => $order]);
    }
}
