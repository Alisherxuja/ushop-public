@extends('layouts.site.base')

@section('content')

    <div class="cart-main">
        <div class="container-lg">
            <h2 class="bold">Корзина</h2>

            <div class="basket-product__items d-flex justify-content-between mb-5">
                <div class="basket-left col-8">
                    <h3 class="bold">В наличии
                        <span class="quan-basket__items">
                            <span class="total-count">{{$cart->count()}}</span> товара
                        </span>
                    </h3>
                    <hr>
                    <div class="modal-body">
                        <table class="show-cart table">
                            @foreach ($cart as $item)
                                <tr class="basket-tr">
                                    <td class="basket-tr_title col-8" style="font-size: 30px; color: black;">
                                        <img src="{{$item->product->avatar}}" alt="img" style="width: 50px">
                                        {{$item->product->{'name_'.app()->getLocale()} }}
                                    </td>
                                    <td class="col-3">
                                        <div class="input-group d-flex align-items-center">
                                            <button class="minus-item input-group-addon minus-btn main__product-btn"
                                                    style="padding: 4px 5px" data-id="{{$item->id}}">
                                                <i class="fas fa-minus" style="color: white"></i>
                                            </button>
                                            <input type="text" class="item-count form-control main__product-num"
                                                   data-id="{{$item->id}}"
                                                   value="{{$item->qty}}">
                                            <button class="plus-item input-group-addon plus-btn main__product-btn border-0"
                                                    style="padding: 4px 5px; border: none" data-id="{{$item->id}}">
                                                <i class="fas fa-plus" style="color: white"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="col-1">
                                        <button class="delete-item border-0 w-100" style="background: none; margin-top: 5px" data-id="{{$item->id}}">
                                            <span style="border: none; font-size: 30px;" class="fad fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="basket-right col-3">
                    <div class="basket-right_col">
                        <form>

                            <div class="mb-3 d-flex justify-content-between">
                                <span><span class="total-count">{{ count($cart) }}</span> товара</span>
                                <span><span class="total-cart"></span>{{$cart->sum('product_price')}} сум</span>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{route('cart.delete')}}" class="btn reset-basket bold clear-cart">
                                    Очистить корзину
                                </a>

                                <a href="{{ !Auth::guest() ? 'javascript:void(0)' : route('user.order.view')}}" class="btn ord-time bold">Оформить заказ</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="basket-recommendations">
                <h3 class="bold">Возможно вы забыли заказать</h3>

                <div class="owl-carousel owl-theme" id="owl-cart_sug">
                    @foreach ($recommends as $recommend)
                        <div class="owl-car-item main__product" style="position: unset;" id="{{$recommend->id}}">
                            <a href="{{route('product',['product' => $recommend->slug])}}">
                                <div class="img_container main__product-img">
                                    <img src="{{$recommend->avatar}}" alt="img" class="imagee">
                                </div>
                                <div class="o-item_info"><span>{{$recommend->price}}</span>•<span>so`m</span>
                                </div>
                                <h4 class="o-item_title"
                                    style="text-transform: uppercase;">{{$recommend->{'name_'.app()->getLocale()} }}</h4>
                            </a>






                            <div class="order-quan">
                                <div class="button d-flex justify-content-between">
                                    <!-- zakaz knopkasi -->

                                    <a href="{{route('cart',['product' => $recommend->id])}}"
                                       class="add-to-cart d-flex align-items-center">
                                        <i class="fad fa-shopping-cart"></i>
                                    </a>

                                    <button type="button" data-bs-toggle="modal"
                                            class="btn product-modal-open"
                                            data-url="{{route('productModalView',['product' => $recommend->id])}}"
                                            data-bs-target="#exampleModal">
                                        <i class="far fad fa-expand-alt"></i>
                                    </button>

                                    <a href="{{route('favorite.removeOrCreate',['product' => $recommend->id])}}"
                                       class="d-flex justify-content-center align-items-center">
                                        @if (in_array($recommend->id, $favoritePIds))
                                            <i class="fad fa-bookmark"></i>
                                        @else
                                            <span class="far fa-bookmark btn-ico_header"></span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection

@section('customScript')

    <script>
        $("#owl-cart_sug").owlCarousel({
            items: 1,
            loop: true,
            margin: 15,
            autoplay: true,
            dots: false,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                450: {
                    items: 2
                },
                650: {
                    items: 3
                },
                1000: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    </script>

@endsection
