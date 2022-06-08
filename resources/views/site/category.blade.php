@extends('layouts.site.base')

@section('content')
    <!-- MAIN START -->

    <main class="cd-main-content">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
                <ul class="cd-filters">
                    <li class="placeholder">
                        <a data-type="all" href="javascript:void(0)">Все</a> <!-- selected option on mobile -->
                    </li>
                    <li class="filter">
                        <a class="selected" href="javascript:void(0)" data-type="all">Все</a>
                    </li>
                    <!-- <li class="filter" data-filter=".color-1">
                        <a href="javascript:void(0)" data-type="color-1">что-то</a>
                    </li>
                    <li class="filter" data-filter=".color-2">
                        <a href="javascript:void(0)" data-type="color-2">что-то</a>
                    </li> -->
                </ul> <!-- cd-filters -->
            </div> <!-- cd-tab-filter -->
        </div> <!-- cd-tab-filter-wrapper -->

        <section class="cd-gallery container p-0">
            <ul class="row carts">
                @foreach ($products as $product)
                    <li class="mix">
                        @include('components.product.list')
                    </li>
                @endforeach
            </ul>

            <div class="cd-fail-message mt-5">
                Ничего не найдено
            </div>
        </section>
        <!-- cd-gallery -->

        <div class="cd-filter">
            <form action="{{route('category',['category' => $category->slug])}}" method="get">
                @if ($category->children()->count() > 0)
                    <div class="cd-filter-block">
                        <h4>Category</h4>
                        <ul class="cd-filter-content cd-filters list">
                            @foreach($category->children as $category)
                                <li>
                                    <input class="filter" data-filter=".check1" type="checkbox"
                                           id="{{'c-checkbox-'.$category->id}}"
                                           value="{{$category->id}}"
                                           name="categories[]" @if (in_array($category->id, request('categories', [])))
                                           checked
                                            @endif>
                                    <label class="checkbox-label filter-form"
                                           for="{{'c-checkbox-'.$category->id}}">{{$category->{'name_'.app()->getLocale()} }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="cd-filter-block">
                    <h4>Бренд</h4>
                    <ul class="cd-filter-content cd-filters list">
                        @foreach($brands as $brand)
                            <li>
                                <input class="filter" data-filter=".check1" type="checkbox"
                                       id="{{'checkbox-'.$brand->id}}"
                                       value="{{$brand->id}}"
                                       name="brands[]" @if (in_array($brand->id, request('brands', [])))
                                       checked
                                        @endif>
                                <label class="checkbox-label filter-form" for="{{'checkbox-'.$brand->id}}">{{$brand->name}}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{--                <div class="cd-filter-block">--}}
                {{--                    <h4>Предложения</h4>--}}

                {{--                    <ul class="cd-filter-content cd-filters list">--}}
                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".check1" type="checkbox" id="checkbox11">--}}
                {{--                            <label class="checkbox-label" for="checkbox1">Со скидкой</label>--}}
                {{--                        </li>--}}

                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".check2" type="checkbox" id="checkbox22">--}}
                {{--                            <label class="checkbox-label" for="checkbox2">Новинка</label>--}}
                {{--                        </li>--}}

                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".check3" type="checkbox" id="checkbox33">--}}
                {{--                            <label class="checkbox-label" for="checkbox3">Акции</label>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
                {{--                <div class="cd-filter-block">--}}
                {{--                    <h4>Продукты для...</h4>--}}
                {{--                    <ul class="cd-filter-content cd-filters list">--}}
                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>--}}
                {{--                            <label class="radio-label" for="radio1">Никаких заболеваний</label>--}}
                {{--                        </li>--}}

                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".radio2" type="radio" name="radioButton" id="radio2">--}}
                {{--                            <label class="radio-label" for="radio2">Сахарный диабет</label>--}}
                {{--                        </li>--}}
                {{--                    </ul> <!-- cd-filter-content -->--}}
                {{--                </div>--}}
                {{--                <div class="cd-filter-block">--}}
                {{--                    <h4>Сортировка по...</h4>--}}
                {{--                    <ul class="cd-filter-content cd-filters list">--}}
                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".radio1" type="radio" name="radioButton" id="radio11"--}}
                {{--                                   checked>--}}
                {{--                            <label class="radio-label" for="radio1">Сначала дорогие</label>--}}
                {{--                        </li>--}}

                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".radio2" type="radio" name="radioButton" id="radio22">--}}
                {{--                            <label class="radio-label" for="radio2">Сначала дешевые</label>--}}
                {{--                        </li>--}}

                {{--                        <li>--}}
                {{--                            <input class="filter" data-filter=".radio3" type="radio" name="radioButton" id="radio33">--}}
                {{--                            <label class="radio-label" for="radio2">По алфавиту</label>--}}
                {{--                        </li>--}}
                {{--                    </ul> <!-- cd-filter-content -->--}}
                {{--                </div>--}}
            </form>

            <a href="javascript:void(0)" class="cd-close">Закрыть</a>
        </div>
        <!-- cd-filter -->

        <a href="javascript:void(0)" class="cd-filter-trigger">Фильтры</a>
    </main> <!-- cd-main-content -->

    <!-- MAIN END -->
@endsection

@section('customScript')
    <script src="https://kit.fontawesome.com/f6816dd194.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/filter.js', env('APP_SSL')) }}"></script>

    <script>

        $('.filter-form').on('click', function () {
            $(this).closest('form').submit();
        })

        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                items: 1,
                margin: 10,
                autoplay: true,
                autoWidth: false,
                responsive: {
                    0: {
                        items: 1
                    },
                }
            })
        });
    </script>
@endsection
