@extends('layouts.site.base')

@section('content')

    <!-- MAIN START -->
    <main>
        <div class="container-lg">
            <div class="row d-flex justify-content-center">
                @if (session('success'))
                    {{session('success')}}
                @endif
                <h2 style="margin-top: 30px;">Вопросы</h2>
                <div class="faq-main d-flex justify-content-between">

                    <div class="faq-left" style="width: 48%">
                        <div class="faq">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="{{'panelsStayOpen-headingOne-'.$faq->id}}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="{{'#panelsStayOpen-collapseOne-'.$faq->id}}"
                                                    aria-expanded="true"
                                                    aria-controls="{{'panelsStayOpen-collapseOne-'.$faq->id}}">
                                                <p class="fw-bold m-0">{{$faq->question}}</p>
                                            </button>
                                        </h2>
                                        <div id="{{'panelsStayOpen-collapseOne-'.$faq->id}}"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="{{'panelsStayOpen-headingOne-'.$faq->id}}">
                                            <div class="accordion-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                    <div class="faq-right" style="width: 48%;">
                        <div class="form-faq">
                            <div class="containar">
                                <h3>ЗАДАЙТЕ СВОЙ ВОПРОС</h3>
                                <form action="{{route('faq.create')}}" method="POST">
                                    @csrf
                                    <label for="fname">Имя</label>
                                    <input type="text" class="form-control" id="fname" name="name"
                                           placeholder="Введите Имя и Фамилию"
                                           value="{{old('name')}}" required>
                                    <label for="ftel">Номер телефона</label>
                                    <input type="text" class="form-control" id="ftel" name="phone"
                                           placeholder="+998"
                                           value="{{old('phone')}}" required>
                                    <label for="subject">Описание</label>
                                    <textarea id="subject" class="form-control" name="question"
                                              placeholder="Задайте нам свой вопрос"
                                              style="height:200px" required>{{old('question')}}</textarea>
                                    <button class="btn btn-success btn-lg">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

@endsection

@section('customCss')
    <style>
        .accordion-body > p {
            font-size: 16;
        }
    </style>
@endsection
