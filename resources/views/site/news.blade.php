@extends('layouts.site.base')

@section('content')

    <div class="container">
        <div class="message-head p-5">
            <h2 class="bold">Сообщения</h2>
            <p>
                Если у вас срочный вопрос, позвоните в службу поддержки
                <span><a href="tel:+998901234567" style="text-decoration: none;">+998 90 123 45 67</a></span>
            </p>
            <p>
                Ответы на многие вопросы уже есть в
                <span><a href="{{route('faq')}}" style="text-decoration: none; ">нашем FAQ.</a></span>
            </p>
            <p>По другим проблемам, напишите нам.</p>
            <div class="d-flex justify-content-center">
                <a href="{{route('faq')}}" class="tex-supp col-md-4 col-sm-5">Написать в поддержку</a>
            </div>
        </div>
        <hr>
        @foreach ($articles as $item)
            <div class="message-dashboard mb-2">
                <h3 class="dash-title">{{$item->{'title_'.app()->getLocale()} }}</h3>
                <div class="date-delete">
                    <span class="dash-date">{{$item->created_at->format('d.m.Y')}}</span>
                </div>
                <div class="dash-sms_text">
                    <div>
                        {{$item->{'content_'.app()->getLocale()} }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
