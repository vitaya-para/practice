@extends('layouts.auth')

@section('title')
    Вход
@endsection

@section('body')
    <div class="text-center" style="padding:50px 0">
        <div class="logo">вход</div>
        <div class="login-form-1">
            <form id="login-form" class="text-left" method="post" action="{{route('user.login_index')}}">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <button type="submit">Войти</button>
                </div>

                @include('layouts.spbstu')
            </form>
        </div>
    </div>
@endsection
