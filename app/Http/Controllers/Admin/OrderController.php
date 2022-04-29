<?php


namespace App\Http\Controllers\Admin;


use App;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderProductResource;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Base\Orders\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['user', 'orderAddress', 'courier'])
            ->select(['orders.*'])
            ->when($request->username, function ($query) use ($request) {
                $query->join('users as u', 'u.id', 'orders.user_id')
                    ->where('u.name', 'ilike', "%$request->username%");
            })
            ->when($request->address, function ($query) use ($request) {
                $query->join('order_addresses as oa', 'oa.id', 'orders.order_address_id')
                    ->where('oa.address', 'ilike', "%$request->address%");
            })
            ->when($request->phone, function ($query) use ($request) {
                $query->join('order_addresses as oa1', 'oa1.id', 'orders.order_address_id')
                    ->where('oa1.phone', $request->phone);
            })
            ->when($request->uuid, function ($query) use ($request) {
                $query->where('orders.uuid', $request->uuid);
            })
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('orders.created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('orders.created_at', '<=', $request->date_to);
            })
            ->when($request->id, function ($query) use ($request) {
                $query->where('orders.id', $request->id);
            })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('orders.status', $request->status);
            })
            ->whereNotIn('orders.status', [Order::STATUS_CANCELED, Order::STATUS_DELIVERED])
            ->paginate();
        return success_out(OrderResource::collection($orders), true);
    }

    public function delivered(Request $request)
    {
        $orders = Order::query()
            ->with(['user', 'orderAddress', 'courier'])
            ->select(['orders.*'])
            ->when($request->username, function ($query) use ($request) {
                $query->join('users as u', 'u.id', 'orders.user_id')
                    ->where('u.name', 'ilike', "%$request->username%");
            })
            ->when($request->address, function ($query) use ($request) {
                $query->join('order_addresses as oa', 'oa.id', 'orders.order_address_id')
                    ->where('oa.address', 'ilike', "%$request->address%");
            })
            ->when($request->phone, function ($query) use ($request) {
                $query->join('order_addresses as oa1', 'oa1.id', 'orders.order_address_id')
                    ->where('oa1.phone', $request->phone);
            })
            ->when($request->uuid, function ($query) use ($request) {
                $query->where('orders.uuid', $request->uuid);
            })
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('orders.created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('orders.created_at', '<=', $request->date_to);
            })
            ->when($request->id, function ($query) use ($request) {
                $query->where('orders.id', $request->id);
            })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('orders.status', $request->status);
            })
            ->whereIn('orders.status', [Order::STATUS_DELIVERED])
            ->paginate();
        return success_out(OrderResource::collection($orders), true);
    }

    public function cancelled(Request $request)
    {
        $orders = Order::query()
            ->with(['user', 'orderAddress', 'courier'])
            ->select(['orders.*'])
            ->when($request->username, function ($query) use ($request) {
                $query->join('users as u', 'u.id', 'orders.user_id')
                    ->where('u.name', 'ilike', "%$request->username%");
            })
            ->when($request->address, function ($query) use ($request) {
                $query->join('order_addresses as oa', 'oa.id', 'orders.order_address_id')
                    ->where('oa.address', 'ilike', "%$request->address%");
            })
            ->when($request->phone, function ($query) use ($request) {
                $query->join('order_addresses as oa1', 'oa1.id', 'orders.order_address_id')
                    ->where('oa1.phone', $request->phone);
            })
            ->when($request->uuid, function ($query) use ($request) {
                $query->where('orders.uuid', $request->uuid);
            })
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('orders.created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('orders.created_at', '<=', $request->date_to);
            })
            ->when($request->id, function ($query) use ($request) {
                $query->where('orders.id', $request->id);
            })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('orders.status', $request->status);
            })
            ->whereIn('status', [Order::STATUS_CANCELED])
            ->paginate();
        return success_out(OrderResource::collection($orders), true);
    }

    public function get(Order $order)
    {
        return success_out($this->getResource($order));
    }

    public function change(Order $order)
    {
        $order->changeStatus();
        if ($order->save())
            return success_out($order);
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function cancel(Order $order)
    {
        if ($order->update(['status' => Order::STATUS_CANCELED, 'comment' => \request('comment')]))
            return success_out($order);
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    private function getResource(Order $order): array
    {
        return [
            'order_info' => [
                'id' => $order->id,
                'payment_type' => optional($order->paymentType)->{'name_' . App::getLocale()},
                'total_price' => $order->total_price,
                'uuid' => $order->uuid,
                'comment' => $order->comment,
                'status' => $order->status,
                'status_name' => $order->status_name,
                'paid_status_name' => $order->status >= 3 ? 'Paid' : 'Payment pending',
                'paid_status' => $order->status >= 3 ? 10 : 0,
                'created_at' => $order->created_at,
            ],
            'client' => [
                'name' => $order->user->name,
                'phone' => $order->user->phone,
                'email' => $order->user->email,
                'first_name' => optional($order->user->profile)->first_name,
                'last_name' => optional($order->user->profile)->last_name,
                'gender' => optional($order->user->profile)->gender,
                'birth_date' => optional($order->user->profile)->birth_date,
            ],
            'address' => [
                'address' => $order->orderAddress->address,
                'coordinates' => json_decode($order->orderAddress->coordinates),
                'first_name' => $order->orderAddress->name,
                'phone' => $order->orderAddress->phone,
                'landmark' => $order->orderAddress->landmark
            ],
            'courier' => [
                'name' => optional($order->courier)->name,
                'phone' => optional($order->courier)->phone,
                'car_number' => optional($order->courier)->car_number,
                'car_type' => optional($order->courier)->car_type,
                'car_model' => optional($order->courier)->car_model,
                'status' => optional($order->courier)->status,
            ],
            'products' => OrderProductResource::collection($order->orderProducts)
        ];
    }
}
