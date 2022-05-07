<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modalAjaxView" class="modal-dialog modal-dialog-centered">

    </div>
</div>


<!-- FOOTER START -->
<footer id="footer" style="background-color:#26901b;">
    <div class="container">
        <div class="footer-menu">
            <div class="col-6 col-sm-3 footer-cols-left">
                <h2 class="customers abt-comp__footer">О компании</h2>
                <ul>
                    @foreach ($pages as $page)
                        <li>
                            <a href="{{route('page',['page' => $page->slug])}}">{{$page->{'title_'.app()->getLocale()} }}</a>
                        </li>
                    @endforeach
                    <li><a href="{{route("aboutCompany")}}">О компании</a></li>
                    <li><a href="{{route("contacts")}}">Контакты</a></li>
                    <li><a href="{{route("news")}}">Новости</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-3 footer-cols-right">
                <h2 class="customers">Покупателям</h2>
                <ul>
                    <li><a href="{{route("payment")}}">Оплата и доставка</a></li>
                    <li><a href="{{route("return")}}">Как вернуть</a></li>
                    <li><a href="{{route('faq')}}">Вопросы и ответы</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 footer-abt">
                <div class="main-footer">
                    <div class="footer-tel">
                        @if ($contact->phone)
                            <a href="tel:{{$contact->phone}}" class="tel-a">+{{$contact->phone}}</a>
                        @endif
                        @if ($contact->phone2)
                            <a href="tel:{{$contact->phone2}}" class="tel-a">+{{$contact->phone2}}</a>
                        @endif
                    </div>
                    <p class="footer-desc">Заказывайте товары круглосуточно и задавайте вопросы.</p>
                    <div class="footer-social">
                        @if ($contact->telegram)
                            <a href="{{$contact->telegram}}" target="_blank"><span class="fab fa-telegram"></span></a>
                        @endif
                        @if ($contact->fb)
                            <a href="{{$contact->fb}}" target="_blank"><span class="fab fa-facebook-f"></span></a>
                        @endif
                        @if ($contact->instagram)
                            <a href="{{$contact->instagram}}" target="_blank"><span class="fab fa-instagram"></span></a>
                        @endif
                        <a href="https://yandex.uz/navi/-/CCUmINdjPD" target="_blank"><span
                                class="fas fab fa-map-marker-smile"></span></a>
                    </div>
                    <div class="footer-store">
                        <a href="{{$contact->ios_app_url}}">
                            <img src="{{asset('img/apps/apple.png', env('APP_SSL'))}}" alt="app-store">
                        </a>
                        <a href="{{$contact->android_app_url}}">
                            <img src="{{asset('img/apps/play.png', env('APP_SSL'))}}" alt="play-market">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="horizontal-spacer">
            <hr>
        </div>

        <div class="copyright">
            <div class="copyright-left">
                <span>© Интернет-магазин Ushop. Доставка продуктов на дом.</span>

            </div>
            <div class="copyright-right">
                <p>Есть вопрос? Напишите нам письмо
                    или воспользуйтесь формой <a href="{{route('faq')}}">обратной связи</a></p>
            </div>
        </div>


    </div>
</footer>

<a href="#" class="vanillatop"></a>
