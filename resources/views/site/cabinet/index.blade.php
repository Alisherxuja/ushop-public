@extends('layouts.site.base')

@section('content')

    <main class="container-lg my-account">
        <div class="d-flex justify-content-center">

            <div class="acc_info col-md-8 col-sm-10 col-10">

                <h2 class="fw-bold mb-5 text-center">Ваш личный профиль</h2>

                        @if (count($errors) > 0)
                            {{$errors}}
                        @endif

                        @if (session('updated'))
                            {{session('updated')}}
                        @endif

                        <form action="{{route('user.cabinet.update')}}" method="post" style="width: 100%">
                            @csrf
                            <div class="mb-3">
                                <label for="phoneInput" class="form-label">Телефон</label>
                                <input type="tel" name="phone" class="form-control input-invalid input-valid"
                                       id="phoneInput" value="{{$user->phone}}">
                                <span class="order-error_message {{--order-visible--}}">* Обьязательное поле!</span>

                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Имя</label>
                                <input type="text" name="name" class="form-control input-invalid input-valid"
                                       id="firstnameInput" value="{{$user->name}}">
                                <span class="order-error_message {{--order-visible--}}">* Обьязательное поле!</span>

                            </div>

                            <div class="mb-3">
                                <label for="lastnameInput" class="form-label">Фамилия</label>
                                <input type="text" name="last_name" class="form-control input-invalid input-valid"
                                       id="lastnameInput" value="{{optional($user->profile)->last_name}}">
                            </div>

                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label">Старый Пароль</label>
                                <input type="password" name="old_password" value=""
                                       class="form-control input-invalid input-valid" id="oldPasswordInput">
                                <span class="order-error_message {{--order-visible--}}">* Обьязательное поле!</span>

                            </div>

                            <div class="mb-3">
                                <label for="NewPasswordInput" class="form-label">Новый Пароль</label>
                                <input type="password" name="new_password" value=""
                                       class="form-control input-invalid input-valid" id="NewPasswordInput">

                            </div>

                            <div class="mb-3">
                                <label for="NewPasswordInputConfirm" class="form-label">Подтвердить Пароль</label>
                                <input type="password" name="confirm_new_password" value=""
                                       class="form-control input-invalid input-valid" id="NewPasswordInputConfirm">
                                <span class="order-error_message {{--order-visible--}}">* Пароли не совпадают!</span>

                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Внести изменения</button>
                                    <a href="{{route('main')}}" class="btn btn-danger">Отмена</a>
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
    </main>

@endsection
