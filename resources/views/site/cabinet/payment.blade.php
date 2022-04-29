@extends('layouts.site.base')

@section('content')
    <div class="container">
        <div class="order-main">
            <h3 class="bold mt-5">Вашы заказы</h3>
            <div class="order-form_info">
                <div class="order-about_right">
                    <div class="basket-left">
                        @foreach ($order->orderProducts as $product)
                            <div class="product-on-basket d-flex align-items-center justify-content-between">
                                <a href="javascript:void(0)"
                                   class="products-item d-flex align-items-center justify-content-between">
                                    <img src="{{$product->product->avatar}}" alt="img">
                                    <span>{{$product->product->{'name_'.app()->getLocale()} }} x {{$product->qty}}</span>
                                </a>
                                <span>{{ number_format(($product->qty * $product->price), 0, ',', ' ') }} сум</span>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="basket-right w-100">
                        <div class="basket-right_col">
                            <div class="mb-3 d-flex justify-content-between">
                                <span>Общый: </span>
                                <span><span class="total-count">{{ count($order->orderProducts) }}</span> товара</span>
                                <span><span class="total-cart"></span>{{number_format($order->orderProducts->sum('price'), 0, ',', ' ')}} сум</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($order->paymentType->type == 'online')
            <div class="d-flex align-items-start mt-5 mb-5">
                <form method="POST" action="{{config('paycom.endpoint_url')}}">
                    <!-- Идентификатор WEB Кассы -->
                    <input type="hidden" name="merchant" value="{{config('paycom.merchant_id')}}"/>
                    <!-- Сумма платежа в тийинах -->
                    <input type="hidden" name="amount" value="{{$order->total_price * 100}}"/>
                    <!-- Поля Объекта Account -->
                    <input type="hidden" name="account[order_id]" value="{{$order->id}}"/>
                    <input type="hidden" name="lang" value="{{app()->getLocale()}}"/>
                    <!-- URL возврата после оплаты или отмены платежа.
                         Если URL возврата не указан, он берется из заголовка запроса Referer.
                         URL возврата может содержать параметры, которые заменяются Paycom при запросе.
                         Доступные параметры для callback:
                         :transaction - id транзакции или "null" если транзакцию не удалось создать
                         :account.{field} - поля объекта Account
                         Пример: https://your-service.uz/paycom/:transaction -->
                    <input type="hidden" name="callback"
                           value="{{route('user.order.success',['order' => $order->id])}}"/>
                    <input type="hidden" name="callback_timeout" value="{{3000}}"/>
                    <button type="submit" class="btn btn-success">Оплатить с помощью <b>Payme</b></button>
                </form>
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center">
                <a class="btn btn-success my-5" href="{{route('main')}}">Ваш заказ успешно принят! Ждите...</a>
            </div>
        @endif
    </div>

@endsection

@section('customScript')

@endsection
