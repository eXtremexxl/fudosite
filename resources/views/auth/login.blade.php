@extends('layouts.app')

@section('title', 'Вход')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="auth-wrapper">
        <div class="auth-form">
            <h1 class="form_title">Вход</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
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
                <button type="submit" class="form_button">Войти</button>
            </form>
            <a href="{{ route('register') }}" class="form_link">Нет аккаунта? Зарегистрироваться</a>
        </div>
    </div>
@endsection