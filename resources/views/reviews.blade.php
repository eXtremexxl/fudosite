@extends('layouts.app')

@section('title', 'Отзывы')

@section('content')
    <section class="section__container reviews__container">
        <h1 class="section__header">Отзывы о ресторане</h1>
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif
        <div class="reviews__grid">
            @foreach ($reviews as $review)
                <div class="review__card">
                    <p><span>{{ $review->user->name }}</span>: {{ $review->content }} (Оценка: {{ $review->rating }})</p>
                </div>
            @endforeach
        </div>

        @auth
            <form action="{{ route('reviews.store') }}" method="POST" class="review__form">
                @csrf
                <textarea name="content" placeholder="Ваш отзыв" required></textarea>
                <input type="number" name="rating" min="1" max="5" value="5" required>
                <button type="submit">Оставить отзыв</button>
            </form>
        @else
            <p class="auth__message">Войдите, чтобы оставить отзыв.</p>
        @endauth
    </section>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/reviews.css') }}" />
@endsection