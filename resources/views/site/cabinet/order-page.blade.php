@extends('layouts.site.base')

@section('content')

    <!-- MAIN START -->
    <div class="container-lg">
        <div class="order-main">
            <a href="{{route('cart.view')}}" class="order-to-basket d-flex align-items-center">
                <i style="color: black; margin-right: 10px" class="fas fa-arrow-left"></i> Вернуться в корзину
            </a>

            @if (count($errors) > 0)
                {{$errors}}
            @endif

            <h3 class="bold mt-5">Оформление заказа</h3>
            @if (session('unexpected-error'))
                {{session('unexpected-error')}}
            @endif
            <div class="order-form_info">
                <form action="{{route('user.order.create')}}" method="post" class="mb-5 d-flex justify-content-between">
                    @csrf
                    <div class="order-about_leftt d-flex flex-column">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="exampleInputTel"
                                   placeholder="Телефон" name="phone" required value="{{$user->phone}}">
                            <label for="exampleInputTel">Телефон</label>
                            @error('phone')
                            <span class="order-error_message is-visible">* Укажите номер телефона!</span>
                            @enderror
                            <div class="form-text">
                                Мы никогда не будем делиться вашим номером телефона ни с кем другим.
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="exampleInputName"
                                   placeholder="Имя" name="name" required
                                   value="{{$user->name}}">
                            <label for="exampleInputName">Имя</label>
                            @error('name')
                            <span class="order-error_message is-visible">* Укажите ваше имя!</span>
                            @enderror
                        </div>

                        <div class="address-order mt-5">
                            <div class="adress-left">
                                <h3 class="bold"><span class="text-danger">*</span>Адрес</h3>
                                <p class="form-text">Вы можете выбрать с карты или напишите ваш адрес внизу</p>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="address" id="floatingInputAddress"
                                           placeholder="Адрес" value="{{old('address')}}">
                                    <label for="floatingInputAddress">Адрес</label>
                                    @error('address')
                                    <span class="order-error_message is-visible">* Обязательное поле!</span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-floating mb-3 marright-24">
                                        <input type="text" name="frame" class="form-control" id="floatingInputBody"
                                               placeholder="Корпус" value="{{old('frame')}}">
                                        <label for="floatingInputBody">Корпус</label>
                                    </div>
                                    <div class="form-floating mb-3 marright-24">
                                        <input type="text" name="structure" class="form-control"
                                               id="floatingInputStructure"
                                               placeholder="Строение" value="{{old('structure')}}">
                                        <label for="floatingInputStructure">Строение</label>
                                    </div>
                                    <div class="form-floating mb-3 marright-24">
                                        <input type="text" name="entrance" class="form-control"
                                               id="floatingInputEntrance"
                                               placeholder="Подъезд" value="{{old('entrance')}}">
                                        <label for="floatingInputEntrance">Подъезд</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-floating mb-3 col-6 marright-2">
                                        <input type="text" name="floor" class="form-control" id="floatingInputFloor"
                                               placeholder="Этаж" value="{{old('floor')}}">
                                        <label for="floatingInputFloor">Этаж</label>
                                    </div>
                                    <div class="form-floating mb-3 col-6">
                                        <input type="text" name="number" class="form-control" id="floatingInputSq"
                                               placeholder="Кв/офис" value="{{old('number')}}">
                                        <label for="floatingInputSq">Кв/офис</label>
                                    </div>
                                </div>
                            </div>

                            <h4 class="mt-4"><span class="text-danger">*</span>Сохраните адрес как шаблон</h4>
                            <div class="form-floating">
                            <textarea name="address_name" class="form-control" placeholder="Leave a comment here"
                                      id="floatingTextarea2"
                                      style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Наименование адреса (например: на работу)</label>
                                @error('address_name')
                                <span class="order-error_message is-visible">* Обязательное поле!</span>
                                @enderror

                                <select class="form-select p-0 addres-template_select" aria-label="Default select example">
                                    <option selected>Или выберите из истории</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="adress-right">
                                <div id="map"></div>
                            </div>
                        </div>

                        <div class="order-payment mb-4">
                            <h3 class="bold">Способ оплаты</h3>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                @foreach ($payments as $key => $payment)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link payment-nav_link" id="{{ 'pills-'.$key.'-tab' }}"
                                           data-bs-toggle="pill"
                                           href="{{ '#pills-'.$key }}" role="tab" aria-controls="{{ 'pills-'.$key }}"
                                           aria-selected="false">
                                            {{$key}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                @foreach ($payments as $key => $payment)
                                    <div class="tab-pane fade show" id="{{ 'pills-'.$key }}" role="tabpanel"
                                         aria-labelledby="{{ 'pills-'.$key.'-tab' }}">
                                        <div class="d-flex">
                                            @foreach($payment as $pay)
                                                <div class="form-check">
                                                    <label class="form-check-label" for="{{'pay-'.$pay->id}}">
                                                        <img class="payment-method__img"
                                                             src="{{$pay->logo_url}}" alt="payme">
                                                        <hr>
                                                        <div class="d-flex justify-content-center">
                                                            <input class="form-check-input" type="radio"
                                                                   name="payment_type_id"
                                                                   @if (old('payment_type_id') == $pay->id) checked
                                                                   @endif
                                                                   value="{{$pay->id}}" id="{{'pay-'.$pay->id}}">
                                                            <span
                                                                class="ms-1">{{$pay->{'name_'.app()->getLocale()} }}</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            @error('payment_type_id')
                            <span class="order-error_message is-visible">* Вы не выбрали способ оплаты!</span>
                            @enderror
                        </div>

                        <div class="form-floating order-comment">
                        <textarea class="form-control" name="comment"
                                  placeholder="Дополнительный номер телефона для связи, код домофона, этаж, подъезд к дому"
                                  id="floatingTextarea">{{old('comment')}}</textarea>
                            <label for="floatingTextarea">Комментарии</label>
                        </div>
                        <button type="submit" class="btn ord-time bold" style="padding: 10px 30px; font-size: 18px">
                            Оформить
                        </button>
                    </div>

                    <div class="order-about_right">

                        <div class="basket-left">
                            @foreach ($cart as $item)
                                <div class="product-on-basket d-flex align-items-center justify-content-between">
                                    <a href="{{route('product', ['product' => $item->product->slug])}}"
                                       class="products-item d-flex align-items-center">
                                        <img src="{{$item->product->avatar}}" alt="img">
                                        <span>{{$item->product->{'name_'.app()->getLocale()} }} x {{$item->qty}}</span>
                                    </a>

                                    <span>{{ number_format($item->product_price, 0, ',', ' ') }} сум</span>

                                    <a href="{{route('cart.delete.one', ['cart' => $item->id])}}"
                                       class="delete-item border-0" data-id="{{$item->id}}">
                                        <span style="border: none; font-size: 20px;" class="fad fa-trash"></span>
                                    </a>
                                </div>
                                <hr>
                            @endforeach
                            <hr>
                            <div class="basket-right w-100">
                                <div class="basket-right_col">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span><span class="total-count">{{ count($cart) }}</span> товара</span>
                                        <span><span class="total-cart"></span>{{number_format($cart->sum('product_price'), 0, ',', ' ')}} сум</span>
                                    </div>
                                </div>
                            </div>

                            <div class="additional-items basket-right_col">
                                <h3 class="fw-bold">Вы можете выбрать время удобное для вас</h3>
                                <ul class="nav nav-pills mb-3" id="pills-date" role="tablist">
                                    <?php $i = 1; ?>
                                    @foreach ($dates as $key => $date)
                                        <li class="nav-item me-0" role="presentation">
                                            <button class="nav-link date-interval @if ($i == 1) active @endif"
                                                    id="{{'pills-'.$i.'-tab'}}"
                                                    data-bs-toggle="pill"
                                                    data-bs-target="{{'#pills-'.$i}}" type="button" role="tab"
                                                    aria-controls="{{'pills-'.$i}}"
                                                    aria-selected="true">
                                                {{date('d M', strtotime($key))}}
                                            </button>
                                        </li>
                                        <?php $i++; ?>
                                    @endforeach
                                </ul>
                                <div class="tab-content me-0" id="pills-date-tabs">
                                    <?php $i = 1; ?>
                                    @foreach ($dates as $key => $date)
                                        <div class="tab-pane fade show @if ($i == 1) active @endif" id="{{'pills-'.$i}}"
                                             role="tabpanel"
                                             aria-labelledby="{{'pills-'.$i.'-tab'}}">
                                            <ul>
                                                @foreach ($date as $index => $time)
                                                    <li class="d-flex w-100">
                                                        <input id="{{$i.'r-'.$index}}" type="radio" name="delivery_date"
                                                               value="{{$key.' '.$time}}"
                                                               @if (old('delivery_date') == ($key.' '.$time)) checked @endif>
                                                        <label for="{{$i.'r-'.$index}}"
                                                               class="w-100 d-flex justify-content-between">
                                                            <p>{{date('d M', strtotime($key))}}, {{$time}}</p>
                                                            <p class="fw-bold me-4">Бесплатно</p></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach
                                </div>

                                <li class="mt-3">
                                    <input id="s1" type="checkbox" class="switch" name="before_specified_time"
                                           value="1">
                                    <label for="s1">Готов получить раньше указанного время</label>
                                </li>
                                <li class="mt-3">
                                    <input id="s2" type="checkbox" class="switch" name="do_not_ring_doorbell" value="1">
                                    <label for="s2">Не звонить в дверь</label>
                                </li>
                                <li class="mt-3">
                                    <input id="s3" type="checkbox" class="switch" name="leave_door" value="1">
                                    <label for="s3">Оставить у двери
                                        <button type="button" class="btn p-0" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                title="1. Убедитесь, что заказ предоплачен, иначе курьер будет вынужден передать покупки лично «в руки». 2. Курьер самостоятельно проверит целостность и полноту заказа. В случае отсутствия какого-либо товара курьер проведет редактирование: итоговая сумма будет пересчитана, а с карты будет списана только фактическая стоимость товаров. 3. Курьер позвонит вам по телефону и оставит заказ у двери. Пожалуйста, сразу заберите покупки в целях сохранности.">
                                            <i class="far fa-question-circle fs-14"></i>
                                        </button>
                                    </label>
                                </li>
                                <li class="mt-3">
                                    <input id="s4" type="checkbox" class="switch" name="exit_permit_required" value="1">
                                    <label for="s4">Требуется разрешение на выезд</label>
                                </li>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MAIN END -->
@endsection

@section('customScript')
    <script>
        $(document).ready(function () {
            $("#exampleInputTel").mask("998 77 777-77-77");
        });
    </script>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=e11f4fe2-5653-4c83-a553-e43f49b373e9"
            type="text/javascript"></script>
    <script>
        ymaps.ready(init);

        function init() {
            var myPlacemark,
                myMap = new ymaps.Map('map', {
                    center: [41.311124, 69.279452],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });

            // Слушаем клик на карте.
            myMap.events.add('click', function (e) {
                var coords = e.get('coords');

                // Если метка уже создана – просто передвигаем ее.
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                // Если нет – создаем.
                else {
                    myPlacemark = createPlacemark(coords);
                    myMap.geoObjects.add(myPlacemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    myPlacemark.events.add('dragend', function () {
                        getAddress(myPlacemark.geometry.getCoordinates());
                    });
                }
                getAddress(coords);
            });

            // Создание метки.
            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                    iconCaption: 'поиск...'
                }, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            }

            // Определяем адрес по координатам (обратное геокодирование).
            function getAddress(coords) {
                myPlacemark.properties.set('iconCaption', 'поиск...');
                ymaps.geocode(coords).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);

                    myPlacemark.properties
                        .set({
                            // Формируем строку с данными об объекте.
                            iconCaption: [
                                // Название населенного пункта или вышестоящее административно-территориальное образование.
                                firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                            ].filter(Boolean).join(', '),
                            // В качестве контента балуна задаем строку с адресом объекта.
                            balloonContent: firstGeoObject.getAddressLine()
                        });

                    /*console.log(firstGeoObject.getAddressLine());
                    document.getElementById('floatingInputCity').value = firstGeoObject.getLocalities();
                    document.getElementById('floatingInputDistrict').value = firstGeoObject.getAdministrativeAreas();
                    document.getElementById('floatingInputStreet').value = firstGeoObject.getPremise();
                    document.getElementById('floatingInputHouse').value = firstGeoObject.getPremise();*/
                    document.getElementById('floatingInputAddress').value = firstGeoObject.getAddressLine();
                });
            }
        }
    </script>
@endsection
