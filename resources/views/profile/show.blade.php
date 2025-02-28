@extends('layouts.app')

@section('title', 'Детали заказа #' . $order->id)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="profile-container">
        <h1 class="profile-title">Детали заказа #{{ $order->id }}</h1>

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <table class="order-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->total }} ₽</td>
                    <td>{{ $order->status_in_russian }}</td> <!-- Перевод на русский -->
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            </tbody>
        </table>

        <h2 class="profile-subtitle">Состав заказа</h2>
        @if ($order->items->isEmpty())
            <p>В заказе нет позиций.</p>
        @else
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Блюдо</th>
                        <th>Количество</th>
                        <th>Цена за шт.</th>
                        <th>Итого</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->dish->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }} ₽</td>
                            <td>{{ $item->price * $item->quantity }} ₽</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div style="display: flex; gap: 1rem; align-items: center;">
            @if ($order->status === \App\Models\Order::STATUS_PENDING)
                <form action="{{ route('profile.orders.cancel', $order) }}" method="POST" class="inline-form">
                    @csrf
                    <button type="submit" class="form_button" onclick="return confirm('Вы уверены, что хотите отменить заказ #{{ $order->id }}?')">Отменить заказ</button>
                </form>
            @endif
            <a href="{{ route('profile.index') }}" class="profile-link">Назад к личному кабинету</a>
        </div>
    </div>
@endsection