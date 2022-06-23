@extends('layouts.site.base')

@section('customCss')
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /*jssor slider bullet skin 057 css*/
        .jssorb057 .i {
            position: absolute;
            cursor: pointer;
        }

        .jssorb057 .i .b {
            fill: none;
            stroke: #fff;
            stroke-width: 2200;
            stroke-miterlimit: 10;
            stroke-opacity: 0.4;
        }

        .jssorb057 .i:hover .b {
            stroke-opacity: .7;
        }

        .jssorb057 .iav .b {
            stroke-opacity: 1;
        }

        .jssorb057 .i.idn {
            opacity: .3;
        }

        /*jssor slider arrow skin 051 css*/
        .jssora051 {
            display: block;
            position: absolute;
            cursor: pointer;
        }

        .jssora051 .a {
            fill: none;
            stroke: #fff;
            stroke-width: 360;
            stroke-miterlimit: 10;
        }

        .jssora051:hover {
            opacity: .8;
        }

        .jssora051.jssora051dn {
            opacity: .5;
        }

        .jssora051.jssora051ds {
            opacity: .3;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <!-- MAIN START -->
    <div class="container-lg">
        <div style="padding:0; margin:0; background-color:#fff;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">
            <div id="jssor_1"
                 style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin"
                     style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;"
                         src="{{asset('img/carousel/spin.svg', env('APP_SSL'))}}"/>
                </div>
                @include('components.banners')
            </div>
        </div>
    </div>

    <div class="container">
        <div class="index-block d-flex">
            <div class="index-block_items d-flex align-items-center">
                <div class="block-card d-flex">
                    <div class="block-icon"><img src="{{asset('img/index-block/1.png', env('APP_SSL'))}}" alt=""></div>
                    <div class="block-title" style="font-size: 20px;">
                        <h3>И все на каждый день</h3>
                        <p>Выбирайте из 40 000 товаров: у нас есть фрукты и овощи, мясо и рыба, все для дома и товары
                            для животных</p>
                    </div>
                </div>
                <div class="block-card d-flex">
                    <div class="block-icon"><img src="{{asset('img/index-block/2.png', env('APP_SSL'))}}" alt=""></div>
                    <div class="block-title">
                        <h3>И свежесть и качество</h3>
                        <p>Будьте уверены: мы тщательно следим за свежестью и качеством продуктов на складе и на всех
                            этапах доставки</p>
                    </div>
                </div>
                <div class="block-card d-flex">
                    <div class="block-icon"><img src="{{asset('img/index-block/3.png', env('APP_SSL'))}}" alt=""></div>
                    <div class="block-title">
                        <h3>И WOW-удобно</h3>
                        <p>Планируйте и экономьте время: оформляйте и получайте заказы где и когда удобно</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $i = 0; ?>
    @foreach ($categories as $category)
        @if (isset($adds[$i]))
            <div class="banner-first banner-rd-link">
                <div class="container-lg d-flex justify-content-center align-items-center">
                    <div class="row banner-content">
                        <a href="{{  $adds[$i]['url'] ?? 'javascript:void(0)'}}">
                            <img src="{{ $adds[$i]['image_url'] }}" alt="img">
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="index-advise">
            <div class="container">
                <div class="our-advice d-flex">
                    <div class="advise-left1 col-3">
                        <h3 class="our-advise-txt">
                            {{$category->{'name_'.app()->getLocale()} }}
                        </h3>
                        <a class="advise-btn" href="{{route('category',['category'=> $category->slug])}}">
                            <p>Показать все</p>
                        </a>
                    </div>

                    <div class="advise-right col-9">
                        <div class="">
                            <div class="owl-carousel owl-carouselMain">
                                @foreach ($category->products()->take(5)->get() as $product)
                                    <div class="owl-car-item main__product" style="position: unset;" id="">
                                        <a href="{{route('product', ['product' => $product->slug])}}">
                                            <div class="img_container main__product-img">
                                                <img src="{{$product->avatar}}"
                                                     alt="img" class="imagee">
                                            </div>
                                            <div class="o-item_info">
                                                <span>{{$product->price}}</span>•<span>so`m</span>
                                            </div>
                                            <h4 class="o-item_title"
                                                style="text-transform: uppercase;">
                                                {{ $product->{'name_'.app()->getLocale()} }}
                                            </h4>
                                        </a>

                                        {{--                                    <div class="input-group d-flex align-items-center">--}}
                                        {{--                                        <button class="minus-item input-group-addon minus-btn main__product-btn"--}}
                                        {{--                                                style="padding: 4px 5px" data-id="">--}}
                                        {{--                                            <i class="fas fa-minus" style="color: white"></i>--}}
                                        {{--                                        </button>--}}
                                        {{--                                        <input type="text" class="item-count form-control main__product-num" data-id=""--}}
                                        {{--                                               disabled value="1">--}}
                                        {{--                                        <button class="plus-item input-group-addon plus-btn main__product-btn border-0"--}}
                                        {{--                                                style="padding: 4px 5px; border: none" data-id="">--}}
                                        {{--                                            <i class="fas fa-plus" style="color: white"></i>--}}
                                        {{--                                        </button>--}}
                                        {{--                                    </div>--}}

                                        <div class="order-quan">
                                            <div class="button d-flex justify-content-between">
                                                <!-- zakaz knopkasi -->

                                                <a href="{{route('cart',['product' =>$product->id])}}"
                                                   class="add-to-cart d-flex align-items-center">
                                                    <i class="fad fa-shopping-cart"></i>
                                                </a>

                                                <button type="button" data-bs-toggle="modal"
                                                        class="btn product-modal-open"
                                                        data-url="{{route('productModalView',['product' => $product->id])}}"
                                                        data-bs-target="#exampleModal">
                                                    <i class="far fad fa-expand-alt"></i>
                                                </button>

                                                <a href="{{route('favorite.removeOrCreate',['product' => $product->id])}}"
                                                   class="d-flex justify-content-center align-items-center">
                                                    @if (in_array($product->id, $favoritePIds))
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
            </div>
        </div>
        <?php $i++; ?>
    @endforeach


    <div class="container mt-5">
        <div class="abt-us">
            <div class="abt-us_title d-flex flex-column align-items-center border-bottom border-3">
                <h2 class="fw-bold">«Ushop.uz» — Интернет-магазин товаров для дома и офиса</h2>
                <p class="text-center">Пробки, лишние затраты, долгий поиск нужных продуктов и ожидание в очередях…
                    Забудьте обо всем! Интернет-магазин «Ushop.uz» доставляет продукты питания, канцтовары,
                    хозяйственные товары и многое другое на дом и в офис.</p>
            </div>

            <div class="abt-us_items d-flex flex-wrap">
                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/ea083f592b7d46f146c798a171221f22.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Богатый ассортимент</h5>
                    <p>По обилию ассортимента наш интернет-магазин ничем не уступает крупным супермаркетам</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/3ca71ad3d3406d32cf7fb2cf3d101316.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Экономия времени</h5>
                    <p>Вы сможете, не выходя из офиса выбрать необходимые товары с нашего интернет магазина, для Вашего
                        дома и офиса.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/f6b157aaef6e84c52fe7c85ddab293a0.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Акции</h5>
                    <p>Мы постоянно проводим акции и сезонные распродажи. Соответствующие скидки отмечены на сайте —
                        специальными стикерами.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/4f815227da781d303d362883e10cd139.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Доступные цены</h5>
                    <p>Только для Вас – дешевле чем в супермаркетах и магазинах! Исключение затрат на аренду помещения,
                        позволяет нам снизить цену, поэтому продукты в нашем интернет-магазине дешевле, чем в
                        стандартном супермаркете.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/45c138c5df2c795599e41d09eb0d2c27.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Контроль качества</h5>
                    <p>Прямые договоры и поставки от ведущих производителей, благодаря которым Вы получаете только
                        качественные продукты питания с доставкой на дом и в офис.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/80ffa54be7c87d1309f2303fffd51343.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Быстрая доставка</h5>
                    <p>При покупке товаров до 200 000 сум, доставка осуществляется за 9 000 сум в пределах города
                        Ташкента. Минимальная сумма заказа 100 000 сум. Выбранные Вами товары принесут прямо к Вашим
                        дверям.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/384bea37220d6fe0c4ea2525bb7d6fc1.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Способы оплаты</h5>
                    <p>Оплатить Ваши покупки можете не только наличными, но и пластиковой картой, перечислением и через
                        систему «Payme». У всех курьеров интернет магазина «Ushop» при себе есть терминал для оплаты
                        картами.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/ff3f3b9df37fff82c94225109d4ba590.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Удобно</h5>
                    <p>Для Вашего удобства, в нашем интернет-магазине разработана усовершенствованная система обработки
                        заказа и доставки продуктов. Просто добавьте товар в корзину на сайте, или сделайте заказ по
                        телефону и закажите доставку.</p>
                </div>

                <div class="abt-us_item col-6 col-md-4 d-flex flex-column align-items-center">
                    <img src="{{asset('img/whywe/59e9b467b21094b6fd15e1291bd35f79.png', env('APP_SSL'))}}" alt="">
                    <h5 class="fw-bolder">Каталог товаров</h5>
                    <p>Удобный каталог, где легко выбирать и приятно покупать!</p>
                </div>


            </div>


        </div>
    </div>

    <!-- MAIN END -->
@endsection

@section('customScript')
    <script type="text/javascript">
        window.jssor_1_slider_init = function () {

            var jssor_1_SlideoTransitions = [
                [{b: -1, d: 1, kX: 16}],
                [{b: -1, d: 1, y: 200, rY: -360, sX: 0.5, sY: 0.5, p: {y: {o: 32, d: 1, dO: 9}, rY: {c: 0}}}, {
                    b: 0,
                    d: 3000,
                    y: 0,
                    o: 1,
                    rY: 0,
                    sX: 1,
                    sY: 1,
                    e: {y: 1, o: 13, rY: 1, sX: 1, sY: 1},
                    p: {
                        y: {dl: 0},
                        o: {dl: 0.1, rd: 3},
                        rY: {dl: 0.1, o: 33},
                        sX: {dl: 0.1, o: 33},
                        sY: {dl: 0.1, o: 33}
                    }
                }],
                [{b: -1, d: 1, y: 200, rY: -360, sX: 0.5, sY: 0.5, p: {y: {o: 32, d: 1, dO: 9}, rY: {c: 0}}}, {
                    b: 0,
                    d: 3000,
                    y: 0,
                    o: 1,
                    rY: 0,
                    sX: 1,
                    sY: 1,
                    e: {y: 1, o: 13, rY: 1, sX: 1, sY: 1},
                    p: {
                        y: {dl: 0},
                        o: {dl: 0.1, rd: 3},
                        rY: {dl: 0.1, o: 33},
                        sX: {dl: 0.1, o: 33},
                        sY: {dl: 0.1, o: 33}
                    }
                }],
                [{b: -1, d: 1, y: 100, rY: -360, sX: 0.5, sY: 0.5, p: {y: {o: 32, d: 1, dO: 9}, rY: {c: 0}}}, {
                    b: 0,
                    d: 3000,
                    y: 0,
                    o: 1,
                    rY: 0,
                    sX: 1,
                    sY: 1,
                    e: {y: 1, o: 13, rY: 1, sX: 1, sY: 1},
                    p: {
                        y: {dl: 0},
                        o: {dl: 0.02, rd: 3},
                        rY: {dl: 0.02, o: 33},
                        sX: {dl: 0.02, o: 33},
                        sY: {dl: 0.02, o: 33}
                    }
                }],
                [{b: 2000, d: 1000, y: 50, e: {y: 3}}],
                [{b: -1, d: 1, bl: [8]}, {b: 2000, d: 1000, bl: [3], e: {bl: 3}}],
                [{b: -1, d: 1, rp: 1}, {b: 2000, d: 1000, o: 0.6}, {b: 2000, d: 1000, rp: 0}],
                [{b: -1, d: 1, sX: 0.7}],
                [{b: 1000, d: 2000, y: 195, e: {y: 3}}],
                [{b: 600, d: 2000, y: 195, e: {y: 3}}],
                [{b: 1400, d: 2000, y: 195, e: {y: 3}}],
                [{b: -1, d: 1, sX: 0.7, ls: 2}, {b: 0, d: 800, o: 1, ls: 0, e: {ls: 6}}],
                [{b: -1, d: 801, rp: 1}],
                [{b: -1, d: 1, kY: -6}],
                [{b: -1, d: 1, x: 30, kY: -10}, {b: 1400, d: 1500, x: 0, o: 1, e: {x: 27, o: 6}}],
                [{b: -1, d: 1, c: {t: 0}}, {b: 1400, d: 1500, c: {t: 339}, e: {c: {t: 3}}}],
                [{b: -1, d: 1, x: 30, kY: -10}, {b: 1700, d: 1500, x: 0, o: 1, e: {x: 27, o: 6}}],
                [{b: -1, d: 1, c: {t: 0}}, {b: 1700, d: 1500, c: {t: 339}, e: {c: {t: 3}}}],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {b: 400, d: 1000, o: 1, sX: 1, sY: 1, e: {sX: 3, sY: 3}}],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 0,
                    d: 1800,
                    x: -347,
                    y: -94,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 180,
                    d: 1520,
                    x: -230,
                    y: -217,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 400,
                    d: 1500,
                    x: -120,
                    y: -179,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 500,
                    d: 1600,
                    x: 120,
                    y: -167,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 800,
                    d: 800,
                    x: 301,
                    y: -100,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 600,
                    d: 1000,
                    x: 312,
                    y: -92,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }],
                [{b: -1, d: 1, sX: 0.3, sY: 0.3}, {
                    b: 100,
                    d: 800,
                    x: 388,
                    y: -161,
                    o: 1,
                    sX: 1,
                    sY: 1,
                    e: {x: 3, y: 3, sX: 3, sY: 3}
                }]
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideDuration: 800,
                $SlideEasing: $Jease$.$OutQuint,
                $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlideo$,
                    $Transitions: jssor_1_SlideoTransitions
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$,
                    $SpacingX: 16,
                    $SpacingY: 16
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <script type="text/javascript">jssor_1_slider_init();</script>
@endsection
