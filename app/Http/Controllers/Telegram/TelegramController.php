<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Resources\Telegram\CartResource;
use App\Http\Resources\Telegram\WishlistResource;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Products\Product;
use App\Models\Base\Site\PaymentType;
use App\Models\Base\Users\Wishlist;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function favoriteList()
    {
        $favorites = Wishlist::query()
            ->with(['product'])
            ->when(!auth('web')->guest(), function ($query) {
                $query->orWhere('user_id', auth('web')->id());
            })
            ->where('uuid', get_uuid())
            ->get();

        return success_out(WishlistResource::collection($favorites));
    }

    public function addOrRemoveFavorite(Product $product)
    {
        $favorite = Wishlist::query()
            ->with(['product'])
            ->when(!auth('web')->guest(), function ($query) {
                $query->orWhere('user_id', auth('web')->id());
            })
            ->where('uuid', get_uuid())
            ->where('product_id', $product->id)
            ->first();
        if ($favorite) {
            $favorite->delete();
            return success_out(['message' => 'Removed']);
        } else {
            Wishlist::query()->create([
                'product_id' => $product->id,
                'uuid' => get_uuid(),
                'user_id' => optional(auth('web'))->id()
            ]);
            return success_out(['message' => 'Added']);
        }
    }

    public function addCart(Request $request, Product $product)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);

        Cart::query()->updateOrCreate(
            ['uuid' => get_uuid(), 'product_id' => $product->id],
            ['uuid' => get_uuid(), 'product_id' => $product->id, 'qty' => request('amount', 1), 'user_id' => $data['user_id']]
        );
        return success_out(['message' => 'Product successfully added to cart']);
    }

    public function removeCart(Cart $cart)
    {
        $cart->delete();
        return success_out(['message' => 'Product removed']);
    }

    public function removeCartAll(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        Cart::query()
            ->where('uuid', get_uuid())
            ->where('user_id', $data['user_id'])
            ->delete();
        return success_out(['message' => 'All product removed']);
    }

    public function cartList(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $cart = Cart::query()
            ->with(['product'])
            ->where('uuid', get_uuid())
            ->where('user_id', $data['user_id'])
            ->get();

        return success_out(CartResource::collection($cart));
    }

    public function increment(Request $request, Product $product)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $cart = Cart::query()->where('product_id', $product->id)
            ->where(function ($query) use ($data) {
                $query->where('carts.uuid', get_uuid())
                    ->orWhere('carts.user_id', $data['user_id']);
            })->first();

        if ($cart->update(['qty' => $cart->qty + request('amount', 1)])) {
            return success_out(['message' => 'Added']);
        }
        return error_out(['amount' => ['Error adding amount']], 422, 'Error adding amount');
    }

    public function decrement(Request $request, Product $product)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $cart = Cart::query()->where('product_id', $product->id)
            ->where(function ($query) use ($data) {
                $query->where('carts.uuid', get_uuid())
                    ->orWhere('carts.user_id', $data['user_id']);
            })->first();

        if ($cart->qty > request('amount', 1)) {
            if ($cart->update(['qty' => $cart->qty - request('amount', 1)])) {
                return success_out(['message' => 'Removed']);
            }
        }
        return error_out(['amount' => ['Error removing amount']], 422, 'Error removing amount');
    }

    public function paymentList()
    {
        $payments = PaymentType::query()
            ->select(['type', 'name_' . app()->getLocale(), 'id'])
            ->where('status', PaymentType::STATUS_ACTIVE)
            ->get()
            ->groupBy('type');

        return success_out($payments);
    }
}