@extends('layouts.admin')

@section('title', 'Управление блюдами')

@section('content')
    <h1>Список блюд</h1>
    <a href="{{ route('dishes.create') }}">Добавить блюдо</a>
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Изображение</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dishes as $dish)
                <tr>
                    <td>{{ $dish->name }}</td>
                    <td>{{ $dish->category->name ?? 'Без категории' }}</td>
                    <td>{{ $dish->price }} ₽</td>
                    <td>
                        @if ($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" style="max-width: 100px;">
                        @else
                            Нет изображения
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dishes.edit', $dish) }}">Редактировать</a>
                        <form action="{{ route('dishes.destroy', $dish) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection