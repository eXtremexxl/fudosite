@extends('layouts.admin')

@section('title', 'Панель управления')

@section('styles')

@endsection

@section('content')
    <h1>Панель управления</h1>

    <div class="stats">
        <div class="stat-box">
            <p>Всего заказов</p>
            <p>{{ $totalOrders }}</p>
        </div>
        <div class="stat-box">
            <p>Доход (завершённые)</p>
            <p>{{ $totalRevenue }} ₽</p>
        </div>
        <div class="stat-box">
            <p>Всего блюд</p>
            <p>{{ $totalDishes }}</p>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('dishes.create') }}">Добавить блюдо</a>
        <a href="{{ route('categories.index') }}">Управление категориями</a>
        <a href="{{ route('orders.index') }}">Все заказы</a>
        <a href="{{ route('dishes.index') }}">Все блюда</a>
    </div>

    <h2>Последние заказы</h2>
    <form class="filter-form" method="GET" action="{{ route('admin.index') }}">
        <div>
            <label for="status">Статус:</label>
            <select name="status" id="status">
                <option value="">Все</option>
                <option value="{{ \App\Models\Order::STATUS_PENDING }}" {{ request('status') === \App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_PENDING] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_CONFIRMED }}" {{ request('status') === \App\Models\Order::STATUS_CONFIRMED ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_CONFIRMED] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_PREPARING }}" {{ request('status') === \App\Models\Order::STATUS_PREPARING ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_PREPARING] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_DELIVERING }}" {{ request('status') === \App\Models\Order::STATUS_DELIVERING ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_DELIVERING] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_COMPLETED }}" {{ request('status') === \App\Models\Order::STATUS_COMPLETED ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_COMPLETED] }}
                </option>
                <option value="{{ \App\Models\Order::STATUS_CANCELED }}" {{ request('status') === \App\Models\Order::STATUS_CANCELED ? 'selected' : '' }}>
                    {{ \App\Models\Order::$statusTranslations[\App\Models\Order::STATUS_CANCELED] }}
                </option>
            </select>

            <label for="date_from">С даты:</label>
            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}">

            <label for="date_to">По дату:</label>
            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}">

            <button type="submit">Фильтровать</button>
        </div>
    </form>

    @if ($orders->isEmpty())
        <p>Заказов нет.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->total }} ₽</td>
                        <td data-status="{{ $order->status_in_russian }}">{{ $order->status_in_russian }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order) }}">Редактировать</a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить заказ?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('orders.index') }}">Все заказы</a>
    @endif

    <h2>Блюда</h2>
    @if ($dishes->isEmpty())
        <p>Блюд нет.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishes as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }} ₽</td>
                        <td>
                            <a href="{{ route('dishes.edit', $dish) }}">Редактировать</a>
                            <form action="{{ route('dishes.destroy', $dish) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить блюдо?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('dishes.index') }}">Все блюда</a>
        <a href="{{ route('dishes.create') }}">Добавить блюдо</a>
    @endif
@endsection