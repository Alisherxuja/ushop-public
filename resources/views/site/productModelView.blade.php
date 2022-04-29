
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <div class="modal-body__left col-6">

                        <div id="owl-brat" class="owl-carousel owl-theme">
                            @foreach ($product->productAttachments as $item)
                                <div class="item modal-item">
                                    <img src="{{$item->image_url}}" alt="{{$product->{'name_'.app()->getLocale()} }}">
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="modal-body__right col-6">
                        <div class="modal-product__title">
                            <h3 class="bold"></h3>
                        </div>

                        <div class="modal-product__price">
                            <span class="product-thumb__prices"></span>
                            <span class="product-currency">{{$product->price}}</span>
                        </div>

                        <div class="type-products">
                            <span>за {{$product->measure->{'name_'.app()->getLocale()} }}</span>
                        </div>

                        <div class="abt-prdct">
                            <h3 style="font-weight: 700">О товаре</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-share">
                    <p>Поделиться в соц. сетях</p>
                    <div class="main-share center">
                        <div class="box-share" style="margin-left: -16px">
                            <div class="icon-box center">
                                <i class="fab fa-instagram fa-3x"></i>
                            </div>
                            <div class="inner-box center">
                                <p>Instagram</p>
                            </div>
                        </div>

                        <div class="box-share">
                            <div class="icon-box center fac">
                                <i class="fab fa-facebook-f fa-3x"></i>
                            </div>
                            <div class="inner-box center">
                                <p>Facebook</p>
                            </div>
                        </div>

                        <div class="box-share">
                            <div class="icon-box center ib-t">
                                <i class="fab fa-twitter fa-3x"></i>
                            </div>
                            <div class="inner-box center">
                                <p>Twitter</p>
                            </div>
                        </div>

                        <div class="box-share">
                            <div class="icon-box center ib-g">
                                <i class="fab fa-telegram fa-3x"></i>
                            </div>
                            <div class="inner-box center">
                                <p>Telegram</p>
                            </div>
                        </div>

                        <div class="box-share">
                            <div class="icon-box center ib-w">
                                <i class="fab fa-whatsapp fa-3x"></i>
                            </div>
                            <div class="inner-box center">
                                <p>Whatsapp</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary view-to_basket" data-bs-dismiss="modal">
                    <a href="{{route('product', ['product' => $product->slug])}}" style="color: white;">Подробнее</a>
                </button>
            </div>
        </div>