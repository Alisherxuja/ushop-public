<!-- HEADER START -->
<header>
    <div class="preloader">
        <div class="preloader-5"></div>
    </div>
    {{--<nav class="navbar navbar-expand-lg navbar-light bg-light u-header d-flex justify-content-between">
        <div class="container-fluid container d-flex justify-content-between">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo01">

                <ul class="navbar-nav mb-2 mb-lg-0 d-flex justify-content-between">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" aria-current="page"
                           href="tel:+998946384336">
                            <span>
                                <i class="far fa-phone-square-alt" style="font-size: 20px; margin-right: 8px"></i>
                            </span>
                            +998946384336
                        </a>
                    </li>

                    <li class="tg-header nav-item dropdown d-flex flex-column align-items-center justify-content-center">
                        <a class="header-tg_bot d-flex align-items-center justify-content-center"
                           href="https://t.me/Shohrux99">
                            <i style="margin-right: 10px; font-size: 25px;" class="fab fa-telegram"></i>
                            Наш телеграм бот
                        </a>
                    </li>

                    <li class="tg-header nav-item d-flex flex-column align-items-center justify-content-center">
                        <a class="header-tg_bot d-flex align-items-center justify-content-center"
                           href="{{route('news')}}">
                            <i style="margin-right: 10px; font-size: 25px;" class="far fa-newspaper"></i>
                            Новости
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        @if (auth('web')->guest())
                            <a style="background: none;"
                               class="cd-signin header-faq nav-link active d-flex align-items-center"
                               href="javascript:void(0)">
                                <i class="fas fa-history" style="font-size: 20px; margin-right: 8px"></i>
                                История заказов
                            </a>
                        @else
                            <a class="header-faq nav-link active d-flex align-items-center" aria-current="page"
                               href="{{route('user.order.history')}}">
                                <i class="fas fa-history" style="font-size: 20px; margin-right: 8px"></i>
                                История заказов
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="header-faq nav-link active d-flex align-items-center" aria-current="page"
                           href="{{route('faq')}}">
                            <i class="far fa-question-circle" style="font-size: 20px; margin-right: 8px"></i>
                            Часто задаваемые вопросы
                        </a>
                    </li>
                    @if (!auth('web')->guest())
                        <li class="nav-item">
                            <a class="nav-link active ord-time" aria-current="page" href="{{route('user.order.view')}}">
                                <img src="{{asset('img/img/icons/time.svg', env('APP_SSL'))}}" alt="clock"
                                     style="margin-right: 3px;">
                                Оформить заказ
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>--}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-light u-header d-flex justify-content-between first-nav">
        <div class="container-fluid d-flex justify-content-between main-nav">

            <a class="navbar-brand cardcontainer first-logo" href="{{route('main')}}">
                <img class="nav-logo" width="100px" src="{{asset('img/img/icons/logo.svg', env('APP_SSL'))}}" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">

                <ul class="navbar-nav mb-2 mb-lg-0 d-flex justify-content-between">
                    <li class="nav-item header-phone_number">
                        <a class="nav-link active d-flex align-items-center" aria-current="page"
                           href="tel:{{$contact->phone}}">
                            <span>
                                <i class="far fa-phone-square-alt" style="font-size: 20px; margin-right: 8px"></i>
                            </span>
                            +{{$contact->phone}}
                        </a>
                    </li>

                    <li class="tg-header nav-item dropdown d-flex flex-column align-items-center justify-content-center">
                        <a class="nav-link header-tg_bot d-flex align-items-center justify-content-center"
                           @if ($contact->telegram) href="{{$contact->telegram}}"
                           @else href="javascript:void(0)" @endif >
                            <i style="margin-right: 10px; font-size: 25px;" class="fab fa-telegram"></i>
                            Наш телеграм бот
                        </a>
                    </li>

                    <li class="tg-header nav-item d-flex flex-column align-items-center justify-content-center">
                        <a class="nav-link header-tg_bot d-flex align-items-center justify-content-center"
                           href="{{route('news')}}">
                            <i style="margin-right: 10px; font-size: 25px;" class="far fa-newspaper"></i>
                            Новости
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        @if (auth('web')->guest())
                            <a href="javascript:void(0)" class="cd-signin header-faq nav-link d-flex align-items-center"
                               style="background: none;">
                                <i class="fas fa-history" style="font-size: 20px; margin-right: 8px"></i>
                                История заказов
                            </a>
                        @else
                            <a class="header-faq nav-link active d-flex align-items-center" aria-current="page"
                               href="{{route('user.order.history')}}">
                                <i class="fas fa-history" style="font-size: 20px; margin-right: 8px"></i>
                                История заказов
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="header-faq nav-link active d-flex align-items-center" aria-current="page"
                           href="{{route('faq')}}">
                            <i class="far fa-question-circle" style="font-size: 20px; margin-right: 8px"></i>
                            Часто задаваемые вопросы
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (app()->getLocale() == 'ru')
                            <a class="header-faq nav-link active d-flex align-items-center" aria-current="page"
                               href="{{ url('/uz') }}">
                                <i class="fad fa-globe-americas text-white"
                                   style="font-size: 20px; margin-right: 8px"></i>
                                UZB
                            </a>
                        @else
                            <a class="header-faq nav-link active d-flex align-items-center" aria-current="page"
                               href="{{ url('/ru') }}">
                                <i class="fad fa-globe-americas text-white"
                                   style="font-size: 20px; margin-right: 8px"></i>
                                РУС
                            </a>
                        @endif

                    </li>
                    @if (!auth('web')->guest())
                        <li class="nav-item">
                            <a class="nav-link active ord-time" aria-current="page" href="{{route('user.order.view')}}">
                                <img src="{{asset('img/img/icons/time.svg', env('APP_SSL'))}}" alt="clock"
                                     style="margin-right: 3px;">
                                Оформить заказ
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <nav
        class="navbar main-nav nav-white navbar-expand-lg navbar-light bg-light d-flex justify-content-center nav-white ">
        <div class="container-fluid container-lg d-flex justify-content-between nd-header">
            <a class="navbar-brand cardcontainer second-logo" href="{{route('main')}}">
                <img class="nav-logo" width="100px" src="{{asset('img/img/icons/logo.svg', env('APP_SSL'))}}" alt="">
            </a>
            <div class="collapse nd-header sd-header navbar-collapse d-flex justify-content-around" id="navbarScroll">

                <div class="d-flex align-items-center">
                    <li class="catalog-menu">
                        <button type="button"
                                class="category-menu_href btn-open first d-flex align-items-center justify-content-center">
                            <i class="cat-ico mx-2 fad fa-bars"></i>Категории
                        </button>
                    </li>

                    {{--<form method="get" class="d-flex media-search" action="{{route('search')}}">
                        <input class="form-control col-6 search-area search-form_input" name="q" type="search" placeholder="Найти продукт"
                               aria-label="Search" value="{{request('q')}}">
                        <button class="btn btn-outline-success search-area" type="submit">
                            <img src="{{asset('img/img/icons/searchblack.svg', env('APP_SSL'))}}" alt="">
                        </button>
                    </form>--}}

                    <form class="d-flex media-search" method="get" action="{{route('search')}}">
                        <input class="form-control me-2 search-area" name="q" type="search" placeholder="Найти продукт"
                               aria-label="Search" value="{{request('q')}}">
                        <button class="btn btn-outline-success search-area" type="submit">
                            <img src="{{asset('img/img/icons/searchblack.svg', env('APP_SSL'))}}">
                        </button>
                    </form>


                </div>
                <ul class="d-flex header-menu flex-wrap justify-content-center align-items-center">

                    @if (auth('web')->guest() )
                        <li>
                            <a class="cd-signin basket-order__btn"
                               href="javascript:void(0)">
                                <img class="btn-ico_header" src="{{asset('img/img/icons/auth.svg', env('APP_SSL'))}}"
                                     alt="">
                                Войти
                            </a>
                        </li>
                    @else
                    <!-- Registered accounts -->
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-btn user_name-nav" href="javascript:void(0)" id="account-menu"
                               role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('img/img/icons/acc.svg', env('APP_SSL'))}}"
                                     alt="auth"> {{auth('web')->user()->name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="account-menu">
                                <li><a class="dropdown-item" href="{{route('user.cabinet')}}">Мой аккаунт</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{route('logout')}}">Выход</a></li>
                            </ul>
                        </li>
                    @endif

                    <li>
                        <a href="{{route('favorite')}}" class="nav-btn d-flex align-items-center">
                            <i class="far fa-bookmark" style="color: #0DB14B; margin-right: 9px;"></i>Избранное</a>
                    </li>

                    <li>
                        <div id="containersr" class="nav-btn d-flex align-items-center">
                            <img class="btn-ico_header" src="{{asset('img/img/icons/basket.svg', env('APP_SSL'))}}"
                                 alt="">
                            <!-- Menu Button -->
                            <div class="menu-btn-2 offside-button">
                                Корзина(<span class="total-count">{{count($cart)}}</span>)
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Off-canvas Elements -->
    <nav id="menu-2" class="offside d-flex flex-column" style="padding-top: 0;">
        <a href="javascript:void(0)" class="icon icon--cross menu-btn-2--close h--left">
            <i class="fas fa-times" style="font-size: 35px; color: #2b2b2b; background: white;"></i>
        </a>
        <div class="basket-nav_items d-flex flex-column justify-content-between">

            <div class="modal-body">
                <table class="show-cart table">
                    @foreach ($cart as $item)
                        <tr class="basket-tr" style="border-bottom: 1px solid #5f5f5f">
                            <td class="basket-tr_title"
                                style="font-size: 14px !important; color: black; width: 60px">{{$item->product->{'name_'.app()->getLocale()} }}</td>
                            <td>
                                <div class="input-group d-flex align-items-center">
                                    <button class="minus-item input-group-addon minus-btn main__product-btn"
                                            style="padding: 4px 5px" data-id="">
                                        <i class="fas fa-minus" style="color: white"></i>
                                    </button>
                                    <input type="text" class="item-count form-control main__product-num"
                                           data-id="{{$item->id}}"
                                           value="{{$item->qty}}">
                                    <button class="plus-item input-group-addon plus-btn main__product-btn border-0"
                                            style="padding: 4px 5px; border: none" data-id="">
                                        <i class="fas fa-plus" style="color: white"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('cart.delete.one', ['cart' => $item->id])}}"
                                   class="delete-item border-0" data-id="{{$item->id}}">
                                    <span style="border: none; font-size: 20px;" class="fad fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="nav-basket__btn d-flex flex-column main-nav">
                <span class="overall-proce__basket">Итого: <span
                        class="total-cart">{{$cart->sum('product_price')}}</span> сум</span>
                <hr>

                @if (auth()->guard('web')->guest())
                    {{--For NON registered accounts--}}
                    <a href="javascript:void(0)" class="cd-signin basket-order__btn">
                        Оформить заказ
                    </a>
                @else
                    {{--For registered accounts--}}
                    <a href="{{route('user.order.view')}}" class="basket-order__btn">
                        Оформить заказ
                    </a>
                @endif

                <a href="{{route('cart.delete')}}" class="basket-navto_page clear-cart">
                    Очистить корзину
                </a>
                <a href="{{route('cart.view')}}" class="basket-navto_page">
                    Перейти в корзину
                </a>
            </div>
        </div>
    </nav>

    <!-- Site Overlay -->
    <div class="site-overlay"></div>


    <div class="zeynep">
        <button class="close-zeynep">
            <i class="fas fa-times"></i>
        </button>
        <ul>
            @foreach ($categories as $category)
                <li class="has-submenu">
                    <div class="table-ul_li d-flex">
                        <a href="{{ route('category', ['category'=> $category->slug]) }}"
                           style="text-transform: lowercase; width: 80%">
                            {{$category->name}}
                        </a>
                        <a href="javascript:void(0)" data-submenu="{{'categories-'.$category->id}}"
                           style="background-color: rgba(236,236,236,0.25); border-radius: 3px; margin: 2px; width: 20%; display: flex; justify-content: center; align-content: center">
                            <span style="color: rgba(29,29,29,0.82); font-size: 20px;"
                                  class="fas fa-arrow-circle-right"></span>
                        </a>
                    </div>
                    <div id="{{'categories-'.$category->id}}" class="submenu">
                        <div class="submenu-header">
                            <a data-submenu-close="{{'categories-'.$category->id}}">Главная</a>
                        </div>
                        <label style="text-transform: lowercase;"></label>
                        <ul>
                            @foreach ($category->children as $item)
                                <li>
                                    <a style="text-transform: lowercase;"
                                       href="{{route('category',['category'=> $item->slug])}}">
                                        {{$item->{'name_'.app()->getLocale()} }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>


    <div class="zeynep-overlay"></div>

</header>

<div @if (count($errors) > 0) class="cd-user-modal is_visible" @else class="cd-user-modal" @endif>
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="javascript:void(0)">Вход в аккаунт</a></li>
            <li><a href="javascript:void(0)">Создать аккаунт</a></li>
        </ul>

        <!-- log in form -->
        <div id="cd-login" @if (session('login-errors')) class="is-selected" @endif>
            <form class="cd-form" action="{{route('login')}}" method="post">
                @csrf
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signin-email">Телефон номер</label>
                    <input class="full-width has-padding has-border" id="signin-email" type="tel" name="phone"
                           placeholder="Телефон">
                    @error('phone')
                    <span class="cd-error-message is-visible">Укажите корректный номер телефона!</span>
                    @enderror
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signin-password">Пароль</label>
                    <input class="full-width has-padding has-border" id="signin-password" type="password"
                           placeholder="Пароль" name="password">
                    <a href="javascript:void(0)" class="hide-password">Показать</a>
                    @error('password')
                    <span class="cd-error-message is-visible">Укажите пароль!</span>
                    @enderror
                    <span class="cd-error-message"></span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" id="remember-me" checked name="remember" value="1">
                    <label for="remember-me">Запомнить меня</label>
                </p>

                <p class="fieldset">
                    <button type="submit" class="full-width signfromheader w-100 sign-up_header">
                        Вход
                    </button>
                </p>
            </form>

            <p class="cd-form-bottom-message"><a href="javascript:void(0)">Вы забыли пароль?</a></p>
        </div>
        <!-- cd-login -->

        <!-- sign up form -->
        <div id="cd-signup" @if (session('sign-up')) class="is-selected" @endif>
            <form class="cd-form" action="{{route('signUp')}}" method="post">
                @csrf
                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-username">Имя пользователя</label>
                    <input class="full-width has-padding has-border" id="signup-username" type="text"
                           placeholder="Имя пользователя" name="name" required>
                    @error('name')
                    <span class="cd-error-message is-visible">Укажите корректную форму!</span>
                    @enderror
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email">Телефон номер</label>
                    <input class="full-width has-padding has-border" id="signup-email" type="tel"
                           placeholder="Телефон номер" name="phone" required>
                    @error('phone')
                    <span class="cd-error-message is-visible">Укажите корректный номер телефона!</span>
                    @enderror
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password">Пароль</label>
                    <input class="full-width has-padding has-border" id="signup-password" type="password"
                           placeholder="Пароль" name="password" required>
                    <a href="javascript:void(0)" class="hide-password">Показать</a>
                    @error('password')
                    <span class="cd-error-message is-visible">Укажите пароль!</span>
                @enderror
                <ul>
                    <span class="fw-bold text-danger">Пароль должен состоится из:</span>
                    <li>1. Минимум 6 знаков</li>
                    <li>2. Любые символы</li>
                </ul>
                </p>

                <p class="fieldset">
                    <button type="submit" class="full-width has-padding signfromheader w-100 sign-up_header">
                        Создать аккаунт
                    </button>
                </p>
            </form>
        </div>
        <!-- cd-signup -->

        <!-- reset password form -->
        <div id="cd-reset-password">
            <p class="cd-form-message">
                Вы забыли пароль? Введите ваш номер телефона и мы отправим вам код для доступа!
            </p>
            <form class="cd-form" method="post" action="{{route('resetPassword')}}">
                @csrf
                <p class="fieldset">
                    <label class="image-replace cd-email" for="reset-email">Телефон номер</label>
                    <input class="full-width has-padding has-border" id="reset-email" type="tel"
                           placeholder="Телефон номер" name="phone">
                    @error('phone')
                    <span class="cd-error-message is-visible">Укажите корректный номер телефона!</span>
                    @enderror
                </p>

                <p class="fieldset">
                    <button type="submit" class="btn full-width has-padding signfromheader w-100 sign-up_header">
                        Сбросить пароль
                    </button>
                </p>
            </form>
            <p class="cd-form-bottom-message"><a href="javascript:void(0)">Перейти к авторизацию</a></p>
        </div>
        <!-- cd-reset-password -->

        <a href="javascript:void(0)" class="cd-close-form">Закрыть</a>
    </div>
    <!-- cd-user-modal-container -->
</div>

<!-- HEADER END -->
