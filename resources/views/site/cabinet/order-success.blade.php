@extends('layouts.site.base')

@section('content')

    {{--{{$order}}--}}

    <div class="container-lg">

        <h2 class="py-5">Продукты закажен. Статус вашего заказ:</h2>

            <h3 class="text-center mb-5" style="color: green">в ожидании</h3>

        @if ($order->status == \App\Models\Base\Orders\Order::STATUS_PAYMENT_PAID)
            <h2>Ваш заказ принят!</h2>
            <p>Если у вас будет вопросы звоните на номер +998909090810</p>
        @endif
    </div>

@endsection
