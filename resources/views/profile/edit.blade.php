@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="profile-container">
        <h1 class="profile-title">Редактировать профиль</h1>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div>
                <label class="form_label" for="name">Имя:</label>
                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" required class="form_input">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="form_label" for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required class="form_input">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <button type="submit" class="form_button">Сохранить</button>
                <a href="{{ route('profile.index') }}" class="profile-link">Назад</a>
            </div>
        </form>
    </div>
@endsection