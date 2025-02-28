@extends('layouts.app')

@section('title', 'Регистрация')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="auth-wrapper">
        <div class="auth-form">
            <h1 class="form_title">Регистрация</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label for="name" class="form_label">Имя:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form_input">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="form_label">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form_input">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="form_label">Пароль:</label>
                    <input type="password" name="password" id="password" required class="form_input">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form_label">Подтверждение пароля:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="form_input">
                </div>
                <button type="submit" class="form_button">Зарегистрироваться</button>
            </form>
            <a href="{{ route('login') }}" class="form_link">Уже есть аккаунт? Войти</a>
        </div>
    </div>
@endsection