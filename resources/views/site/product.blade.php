@extends('layouts.site.base')

@section('content')

    <!-- MAIN START -->
    <div class="view__banner-ad mt-5 mb-5">
        <div class="container">
            <div class="prdct-view__banner d-flex justify-content-center">
                <img src="{{ $banner->image_url }}" style="width: 100%" alt="">
            </div>
        </div>
    </div>

    @if (session('favorite_added') || session('add_cart'))
        <div class="view__banner-ad mt-2 mb-5">
            <div class="container">
                <div class="prdct-view__banner d-flex justify-content-center">
                    @if (session('add_cart'))
                        {{session('add_cart')}}
                    @endif

                    @if (session('favorite_added'))
                        {{session('favorite_added')}}
                    @endif
                </div>
            </div>
        </div>
    @endif

    <main style="margin-bottom: 35px;">
        <div class="container d-flex product__view-main">
            <div class="product-general">
                <div class="container__view-main">
                    @foreach ($product->productAttachments as $attachment)
                        <div class="mySlides">
                            <img class="view-img__gallery" src="{{$attachment->image_url}}"
                                 style="width:100%; transition: all .2s" alt="">
                        </div>
                    @endforeach
                    <a class="prev view-btn" onclick="plusSlides(-1)">❮</a>
                    <a class="next view-btn" onclick="plusSlides(1)">❯</a>
                    <div class="row d-flex justify-content-center">
                        @foreach ($product->productAttachments as $attachment)
                            <div class="column">
                                <img class="demo cursor" src="{{$attachment->image_url}}"
                                     style="width:100%"
                                     onclick="currentSlide(1)" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="product-general__info">
                @foreach ($product->productAttachments as $item)
                <div>
                    <h2 style="font-weight: 700">{{$product->{'name_'.app()->getLocale()} }}</h2>
                    <div class="star-rating">
                        @if ($product->productReviews()->count() > 0)
                            <div class="u-rating">
                                @include('components.stars', ['rate' => $product->productReviews()->sum('rate')/$product->productReviews()->count()])
                            </div>
                        @else
                            <div class="u-rating">
                                @include('components.stars', ['rate' => 0])
                            </div>
                        @endif
                    </div>

                    <div class="view-price">
                        <span class="view-price__num">
                            {{ number_format($product->price, 0, ',', ' ') }}
                        </span>
                        <span class="view-price__sum">
                        сум
                        </span>
                    </div>

                    <div class="view-product__rightbot">
                        <a href="{{route('cart',['product' => $product->id])}}" class="btn view-to_basket">
                            <i class="fad fa-cart-plus"></i>
                            В корзину
                        </a>


                        <a href="{{route('favorite.removeOrCreate', ['product' => $product->id])}}"
                           class="btn view-to_liked">
                            @if (in_array($product->id, $favoritePIds))
                                <i class="fad fa-bookmark"></i>
                            @else
                                <span class="far fa-bookmark btn-ico_header"></span>
                            @endif
                        </a>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="abt-prdct">
                    <h3 style="font-weight: 700">О товаре</h3>
                    <p>
                    @if ($product->{'info_'.app()->getLocale()})
                        @foreach ($product->{'info_'.app()->getLocale()} as $key => $item)
                            <p>{{optional($item)->key}}........... @if ($key == 0)
                                    {{optional($item)->value}}
                                @else
                                    <span class="character-links">{{optional($item)->value }}</span>
                                @endif
                            </p>
                            @endforeach
                            @endif
                    </p>

                            <div>
                                <ul>
                                    @if ($product->{'info_'.app()->getLocale()})
                                        @foreach ($product->{'info_'.app()->getLocale()} as $key => $item)
                                            <li>{{optional($item)->key}}........... @if ($key == 0)
                                                    {{optional($item)->value}}
                                                @else
                                                    <span class="character-links">{{optional($item)->value }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>


                </div>
            </div>
        </div>

        <div class="view-recommend">
            <div class="container">
                <h3 style="font-weight: bold">С этим товаром покупают</h3>
                <div class="owl-carousel owl-theme">
                    @foreach ($recommends as $recommend)
                        <div class="item" style="width: 240px; height: 200px;">
                            <div class="d-flex flex-row mb-2">
                                <img src="{{$recommend->avatar}}"
                                     style="width: 140px; height: 140px;">
                                <span>{{$recommend->{'name_'.app()->getLocale()} }}</span>
                            </div>
                            <div class="d-flex justify-content-around">
                                <span>{{$recommend->price}} сум</span>
                                <a href="{{route('cart',['product' => $recommend->id])}}" class="addCart" type="reset">
                                    <i class="fad fa-shopping-cart cart"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
            </div>
        </div>

        @include('components.rate')

    </main>
    <!-- MAIN END -->
@endsection

@section('customScript')

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "flex";
            dots[slideIndex - 1].className += " active";
        }
    </script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1400: {
                    items: 5
                }
            }
        })
    </script>

    <script>
        $('.go-to-comment').on('click', function () {
            $('.write-comment').toggleClass('active show');
            $('.abt-tovar').toggleClass('active show');
        });
    </script>

    <script>
        (function ($) {
            $(document).ready(function () {

                generateID()
                choose()
                generateOption()
                selectionOption()
                removeClass()
                uploadImage()
                submit()
                resetButton()
                removeNotification()
                autoRemoveNotification()
                autoDequeue()

                var ID
                var way = 0
                var queue = []
                var fullStock = 10
                var speedCloseNoti = 1000

                function choose() {
                    var li = $('.ways li')
                    var section = $('.sections section')
                    var index = 0
                    li.on('click', function () {
                        index = $(this).index()
                        $(this).addClass('active')
                        $(this).siblings().removeClass('active')

                        section.siblings().removeClass('active')
                        section.eq(index).addClass('active')
                        if (!way) {
                            way = 1
                        } else {
                            way = 0
                        }
                    })
                }

                function generateOption() {
                    var select = $('select option')
                    var selectAdd = $('.select-option .option')
                    $.each(select, function (i, val) {
                        $('.select-option .option').append('<div rel="' + $(val).val() + '">' + $(val).html() + '</div>')
                    })
                }

                function selectionOption() {
                    var select = $('.select-option .head')
                    var option = $('.select-option .option div')

                    select.on('click', function (event) {
                        event.stopPropagation()
                        $('.select-option').addClass('active')
                    })

                    option.on('click', function () {
                        var value = $(this).attr('rel')
                        $('.select-option').removeClass('active')
                        select.html(value)

                        $('select#category').val(value)
                    })
                }

                function removeClass() {
                    $('body').on('click', function () {
                        $('.select-option').removeClass('active')
                    })
                }

                function uploadImage() {
                    var button = $('.images .pic')
                    var uploader = $('<input type="file" accept="image/*" />')
                    var images = $('.images')

                    button.on('click', function () {
                        uploader.click()
                    })

                    uploader.on('change', function () {
                        var reader = new FileReader()
                        reader.onload = function (event) {
                            images.prepend('<div class="img" style="background-image: url(' + event.target.result + ');" rel="' + event.target.result + '"><span>Удалить</span></div>')
                        }
                        reader.readAsDataURL(uploader[0].files[0])

                    })

                    images.on('click', '.img', function () {
                        $(this).remove()
                    })

                }

                function submit() {
                    var button = $('#send')

                    button.on('click', function () {
                        if (!way) {
                            var title = $('#title')
                            var cate = $('#category')
                            var images = $('.images .img')
                            var imageArr = []


                            for (var i = 0; i < images.length; i++) {
                                imageArr.push({url: $(images[i]).attr('rel')})
                            }

                            var newStock = {
                                title: title.val(),
                                category: cate.val(),
                                images: imageArr,
                                type: 1
                            }

                            saveToQueue(newStock)
                        } else {
                            // discussion
                            var topic = $('#topic')
                            var message = $('#msg')

                            var newStock = {
                                title: topic.val(),
                                message: message.val(),
                                type: 2
                            }

                            saveToQueue(newStock)
                        }
                    })
                }

                function removeNotification() {
                    var close = $('.notification')
                    close.on('click', 'span', function () {
                        var parent = $(this).parent()
                        parent.fadeOut(300)
                        setTimeout(function () {
                            parent.remove()
                        }, 300)
                    })
                }

                function autoRemoveNotification() {
                    setInterval(function () {
                        var notification = $('.notification')
                        var notiPage = $(notification).children('.btn')
                        var noti = $(notiPage[0])

                        setTimeout(function () {
                            setTimeout(function () {
                                noti.remove()
                            }, speedCloseNoti)
                            noti.fadeOut(speedCloseNoti)
                        }, speedCloseNoti)
                    }, speedCloseNoti)
                }

                function autoDequeue() {
                    var notification = $('.notification')
                    var text

                    setInterval(function () {

                        if (queue.length > 0) {
                            if (queue[0].type == 2) {
                                text = ' Your discusstion is sent'
                            } else {
                                text = ' Your order is allowed.'
                            }

                            notification.append('<div class="success btn"><p><strong>Success:</strong>' + text + '</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
                            queue.splice(0, 1)

                        }
                    }, 10000)
                }

                function resetButton() {
                    var resetbtn = $('#reset')
                    resetbtn.on('click', function () {
                        reset()
                    })
                }

                // helpers
                function saveToQueue(stock) {
                    var notification = $('.notification')
                    var check = 0

                    if (queue.length <= fullStock) {
                        if (stock.type == 2) {
                            if (!stock.title || !stock.message) {
                                check = 1
                            }
                        } else {
                            if (!stock.title || !stock.category || stock.images == 0) {
                                check = 1
                            }
                        }

                        if (check) {
                            notification.append('<div class="error btn"><p><strong>Error:</strong> Please fill in the form.</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
                        } else {
                            notification.append('<div class="success btn"><p><strong>Success:</strong> ' + ID + ' is submitted.</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
                            queue.push(stock)
                            reset()
                        }
                    } else {
                        notification.append('<div class="error btn"><p><strong>Error:</strong> Please waiting a queue.</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
                    }
                }

                function reset() {

                    $('#title').val('')
                    $('.select-option .head').html('Category')
                    $('select#category').val('')

                    var images = $('.images .img')
                    for (var i = 0; i < images.length; i++) {
                        $(images)[i].remove()
                    }

                    var topic = $('#topic').val('')
                    var message = $('#msg').val('')
                }
            })
        })(jQuery)
    </script>
@endsection
