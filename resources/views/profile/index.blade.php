@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="profile-container">
        <h1 class="profile-title">Личный кабинет</h1>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <div class="profile-details">
            <p>Имя: {{ auth()->user()->name }}</p>
            <p>Email: {{ auth()->user()->email }}</p>
            <a href="{{ route('profile.edit') }}" class="profile-link">Редактировать профиль</a>
        </div>

        <h2 class="profile-subtitle">Последний заказ</h2>
        @if ($orders->isEmpty())
            <p>У вас пока нет заказов.</p>
        @else
            @php $latestOrder = $orders->sortByDesc('created_at')->first(); @endphp
            <div class="order-section">
                <h3>Заказ #{{ $latestOrder->id }}</h3>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $latestOrder->id }}</td>
                            <td>{{ $latestOrder->total }} ₽</td>
                            <td>{{ $latestOrder->status_in_russian }}</td> <!-- Перевод на русский -->
                            <td>{{ $latestOrder->created_at->format('d.m.Y H:i') }}</td>
                            <td class="action-column">
                                <a href="{{ route('profile.orders.show', $latestOrder) }}" class="profile-link">Подробности</a>
                                @if ($latestOrder->status === \App\Models\Order::STATUS_PENDING)
                                    <form action="{{ route('profile.orders.cancel', $latestOrder) }}" method="POST" class="inline-form">
                                        @csrf
                                        <button type="submit" class="form_button" onclick="return confirm('Вы уверены, что хотите отменить заказ?')">Отменить</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if ($orders->count() > 1)
                <button class="form_button" onclick="openModal()">Показать все заказы</button>
            @endif
        @endif

        <div id="orderModal" class="modal">
            <div class="modal-content">
                <button class="close" onclick="closeModal()">×</button>
                <h2 class="profile-subtitle">Все заказы</h2>
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                                <td>{{ $order->total }} ₽</td>
                                <td>{{ $order->status_in_russian }}</td> <!-- Перевод на русский -->
                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                <td class="action-column">
                                    <a href="{{ route('profile.orders.show', $order) }}" class="profile-link">Подробности</a> <!-- Исправлено $latestOrder на $order -->
                                    @if ($order->status === \App\Models\Order::STATUS_PENDING)
                                        <form action="{{ route('profile.orders.cancel', $order) }}" method="POST" class="inline-form">
                                            @csrf
                                            <button type="submit" class="form_button" onclick="return confirm('Вы уверены, что хотите отменить заказ?')">Отменить</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openModal() { document.getElementById("orderModal").style.display = "block"; }
        function closeModal() { document.getElementById("orderModal").style.display = "none"; }
        window.onclick = function(event) {
            const modal = document.getElementById("orderModal");
            if (event.target === modal) modal.style.display = "none";
        }
    </script>
@endsection