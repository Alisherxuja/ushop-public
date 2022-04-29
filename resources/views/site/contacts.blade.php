@extends('layouts.site.base')

@section('content')

    <div class="container-lg">
       <h1 class="py-5 fw-bold">Контакты</h1>
        <div class="contacts-info d-flex mb-5 faq-right">

            <div class="contact-info_left col-4">
                <h3 class="fw-bold mb-5">Город Ташкент</h3>
                <div class="info_left__map">
                    <h4>Наш адрес</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Tashkent, Mirzo G'olib 4-tor ko'chasi, 38</p>
                </div>

                <div class="info_left__tel">
                    <h4>Наш телефон номер</h4>
                    <p><i class="fas fa-phone-square-alt"></i> +998909090810</p>
                </div>
            </div>

            <div class="contact-info_right col-8">
                <div style="position:relative;overflow:hidden;"><a href="https://yandex.uz/navi/10335/tashkent/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Ташкент</a><a href="https://yandex.uz/navi/10335/tashkent/?ll=69.196226%2C41.351392&mode=whatshere&utm_medium=mapframe&utm_source=maps&whatshere%5Bpoint%5D=69.197756%2C41.352596&whatshere%5Bzoom%5D=18&z=14" style="color:#eee;font-size:12px;position:absolute;top:14px;">4-й проезд Мирзы Галиба, 38 на карте Ташкента, ближайшее метро Беруни — Яндекс.Карты</a><iframe src="https://yandex.uz/map-widget/v1/-/CCUmINdnHD" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
            </div>
        </div>
    </div>

@endsection
