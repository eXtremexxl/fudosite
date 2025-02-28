@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <section class="section__container cart__container cart-page">
        <div class="cart__header">
            <p class="section__subheader">Ваша корзина</p>
            <h2 class="section__header">Ваши выбранные блюда</h2>
        </div>
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif
        @if (empty($cart))
            <p class="cart__empty">Корзина пуста</p>
        @else
            <div class="cart__grid">
                @foreach ($cart as $id => $item)
                    <?php $dish = \App\Models\Dish::find($id); ?>
                    <div class="cart__card">
                        <div class="cart__card__image">
                            @if ($dish && $dish->image)
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $item['name'] }}" />
                            @else
                                <div class="no-image">Изображение отсутствует</div>
                            @endif
                        </div>
                        <div class="cart__card__details">
                            <div class="cart__card__header">
                                <h4>{{ $item['name'] }}</h4>
                                <h5><span>₽</span>{{ number_format($item['price'], 2) }}</h5>
                            </div>
                            <form action="{{ route('cart.update') }}" method="POST" class="cart__form">
                                @csrf
                                <input type="hidden" name="dish_id" value="{{ $id }}">
                                <div class="quantity__group">
                                    <label>Количество:</label>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" step="1">
                                    <button type="submit" class="btn btn-update">Обновить</button>
                                </div>
                            </form>
                            <p class="cart__card__total">Итого: ₽{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            <form action="{{ route('cart.remove') }}" method="POST" class="cart__remove__form">
                                @csrf
                                <input type="hidden" name="dish_id" value="{{ $id }}">
                                <button type="submit" class="btn-delete">
                                    Удалить
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cart__total">
                <p>Общая сумма: ₽{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}</p>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-order">Оформить заказ</button>
                </form>
            </div>
        @endif
    </section>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}" />
@endsection