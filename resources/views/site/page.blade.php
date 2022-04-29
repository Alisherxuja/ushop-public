@extends('layouts.site.base')

@section('content')

    <!-- MAIN START -->
    <div class="empty-favorite" style="padding: 100px 0">
        <div class="container-lg">
            {!! $page->{'content_'.app()->getLocale()} !!}
        </div>
    </div>
    <!-- MAIN END -->
@endsection
