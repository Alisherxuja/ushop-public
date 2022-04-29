@extends('layouts.site.base')

@section('content')
    <div class="order-history_main">
        <div class="container">
            <div class="row">

                <h2 class="history-main_h2">История заказов</h2>

                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach ($orders as $order)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="{{'flush-headingOne-'.$order->id}}">
                                <button class="accordion-button collapsed d-flex justify-content-between" type="button"
                                        data-bs-toggle="collapse" data-bs-target="{{'#flush-collapse-'.$order->id}}"
                                        aria-expanded="false"
                                        aria-controls="{{'flush-headingOne-'.$order->id}}">
                                    <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                        <span>Дата: {{$order->created_at->format('d.m.Y')}} </span>
                                        <span>Время заказа: {{$order->created_at->format('H:i')}}</span>
                                        <span>Адрес доставки: {{$order->orderAddress->name}}</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="{{'flush-collapse-'.$order->id}}" class="accordion-collapse collapse"
                                 aria-labelledby="{{'flush-headingOne-'.$order->id}}"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @foreach ($order->orderProducts as $product)
                                        <div class="history-accordion-top d-flex justify-content-between align-items-center col-12">
                                            <a href="{{route('product',['product' => $product->product->slug])}}"
                                               class="d-flex align-items-center text-decoration-none">
                                                <img src="{{$product->product->avatar}}" alt="">
                                                <p style="font-size: 18px; color: black; margin-top: 5px; width: 650px">
                                                    {{$product->product->{'name_'.app()->getLocale()} }}</p>
                                            </a>
                                            <div class="sidebar-product-item-price">
                                                <span>{{$product->qty}}</span>
                                            </div>
                                            <a href="{{route('cart',['product' =>$product->product_id])}}"
                                               class="addCart">
                                                <i class="fad fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="btn-repeat_order d-flex justify-content-end">
                                        <a href="{{route('user.reOrder', ['order' => $order->id])}}"
                                           class="btn btn-success">Заказать еще раз</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
