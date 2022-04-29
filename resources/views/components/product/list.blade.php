<div class="main__product cart-prdc col-3" style="position: unset; height: max-content">

    <a href="{{route('product',['product' => $product->slug])}}">
        <div class="img_container main__product-img">
            <img src="{{$product->avatar}}" alt="img" class="imagee">
        </div>
        <div class="o-item_info"><span>{{$product->price}}</span>•<span>so`m</span></div>
        <h4 class="o-item_title" style="text-transform: uppercase;">{{$product->{'name_'.app()->getLocale()} }}</h4>
    </a>
    <div class="order-quan">
        <div class="button d-flex justify-content-between">
            <!-- zakaz knopkasi -->

            <a href="{{route('cart',['product' =>$product->id])}}"
               class="add-to-cart d-flex align-items-center">
                <i class="fad fa-shopping-cart"></i>
            </a>

            <button type="button" data-bs-toggle="modal"
                    class="btn product-modal-open"
                    data-url="{{route('productModalView', ['product' => $product->id])}}"
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
