@extends('layouts.admin')

@section('title', 'Редактировать заказ #' . $order->id)

@section('content')
    <h1>Редактировать заказ #{{ $order->id }}</h1>
    <p>Пользователь: {{ $order->user->name }}</p>
    <p>Сумма: {{ $order->total }} ₽</p>
    <p>Дата: {{ $order->created_at->format('d.m.Y H:i') }}</p>

    <h2>Состав заказа</h2>
    @if ($order->items->isEmpty())
        <p>В заказе нет позиций.</p>
    @else
        <table>
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

    <h2>Изменить статус</h2>
    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Статус:</label>
            <select name="status">
                <option value="{{ \App\Models\Order::STATUS_PENDING }}" {{ $order->status === \App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_PENDING] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_CONFIRMED }}" {{ $order->status === \App\Models\Order::STATUS_CONFIRMED ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_CONFIRMED] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_PREPARING }}" {{ $order->status === \App\Models\Order::STATUS_PREPARING ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_PREPARING] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_DELIVERING }}" {{ $order->status === \App\Models\Order::STATUS_DELIVERING ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_DELIVERING] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_COMPLETED }}" {{ $order->status === \App\Models\Order::STATUS_COMPLETED ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_COMPLETED] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_CANCELED }}" {{ $order->status === \App\Models\Order::STATUS_CANCELED ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_CANCELED] }}
                </option>
            </select>
        </div>
        <button type="submit">Обновить</button>
    </form>

    <a href="{{ route('orders.index') }}">Назад к списку</a>
@endsection