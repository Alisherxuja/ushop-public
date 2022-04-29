<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\CartResource;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Products\Product;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
    {
        $cart = Cart::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('carts.uuid', get_uuid())
                    ->when(!Auth::guest(), function ($q) {
                        $q->orWhere('carts.user_id', Auth::id());
                    });
            })
            ->orderBy('id')
            ->get();

        return success_out(CartResource::collection($cart));
    }

    public function add(Product $product)
    {
        $cart = Cart::query()->updateOrCreate(
            ['uuid' => get_uuid(), 'product_id' => $product->id],
            ['uuid' => get_uuid(), 'product_id' => $product->id, 'qty' => request('amount', 1), 'user_id' => optional(auth())->id()]
        );
        return success_out(CartResource::make($cart));
    }

    public function increment(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'amount' => 'required|integer'
        ]);

        if ($data['amount'] > $cart->product->stock || ($data['amount'] + $cart->qty) > $cart->product->stock) {
            return error_out(['amount' => ['No that amount of product']]);
        }

//        $cart = Cart::query()
//            ->where(function ($query) {
//                $query->where('carts.uuid', get_uuid())
//                    ->when(!Auth::guest(), function ($q) {
//                        $q->orWhere('carts.user_id', Auth::id());
//                    });
//            })->first();

        if ($cart->update(['qty' => $cart->qty + request('amount', 1)])) {
            return success_out(CartResource::make($cart));
        }
        return error_out(['amount' => ['No that amount of product']]);
    }

    public function decrement(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'amount' => 'required|integer'
        ]);

        if ($data['amount'] >= $cart->qty) {
            return error_out(['amount' => ['You can not decrement that amount']]);
        }

//        $cart = Cart::query()
//            ->where(function ($query) {
//                $query->where('carts.uuid', get_uuid())
//                    ->when(!Auth::guest(), function ($q) {
//                        $q->orWhere('carts.user_id', Auth::id());
//                    });
//            })->first();

        if ($cart->update(['qty' => $cart->qty - request('amount', 1)])) {
            return success_out(CartResource::make($cart));
        }
        return error_out(['amount' => ['No that amount of product']]);
    }

    public function updateByProduct(Request $request, Product $product)
    {
        $data = $request->validate([
            'amount' => 'required|integer'
        ]);

        if ($data['amount'] > $product->stock) {
            return error_out(['amount' => ['No that amount of product']]);
        }

        if ($data['amount'] > 0) {
            $cart = Cart::query()->updateOrCreate(
                ['uuid' => get_uuid(), 'product_id' => $product->id],
                ['uuid' => get_uuid(), 'product_id' => $product->id, 'qty' => request('amount', 1), 'user_id' => optional(auth())->id()]
            );

            return success_out(CartResource::make($cart));
        }
        return error_out(['amount' => ['Error']], 422, 'Error updating qty');
    }

    public function clear()
    {
        Cart::query()
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!Auth::guest(), function ($q) {
                        $q->orWhere('user_id', Auth::id());
                    });
            })->delete();
        return success_out([]);
    }

}
