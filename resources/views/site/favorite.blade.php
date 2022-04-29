@extends('layouts.site.base')

@section('content')

    @if (session('favorite_added'))
        <div class="view__banner-ad mt-5 mb-5">
            <div class="container">
                <div class="prdct-view__banner d-flex justify-content-center">
                    @if (session('favorite_added'))
                        {{session('favorite_added')}}
                    @endif
                </div>
            </div>
        </div>
    @endif
    <!-- MAIN START -->
    @if (count($favorites) > 0)
        <div class="cart-products">
            <div class="container">
                <div class="row">
                    <h2 class="mt-5 fw-bold text-center">Ваш избранные продукты</h2>
                    <div class="carts">
                        @foreach ($favorites as $favorite)
                            @include('components.product.list', ['product' =>  $favorite->product])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-favorite" style="padding: 100px 0">
            <div class="container-lg">
                <div class="empty-favorite__info d-flex flex-column justify-content-center align-items-center">
                    <h3>Вы еще не выбрали товаров(( Хотите посмотреть наши продукты?</h3>
                    <a href="{{route('main')}}" class="btn btn-success">Посмотреть продуктов</a>
                </div>
            </div>
        </div>
    @endif
    <!-- MAIN END -->
@endsection
