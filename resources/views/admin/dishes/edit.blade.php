@extends('layouts.admin')

@section('title', 'Редактировать блюдо')

@section('content')
    <h1>Редактировать блюдо</h1>
    <form action="{{ route('dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label>Название:</label>
            <input type="text" name="name" value="{{ $dish->name }}" required>
            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Описание:</label>
            <textarea name="description">{{ $dish->description }}</textarea>
        </div>
        <div>
            <label>Цена:</label>
            <input type="number" name="price" step="0.01" value="{{ $dish->price }}" required>
            @error('price') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Категория:</label>
            <select name="category_id">
                <option value="">Без категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $dish->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Текущее изображение:</label>
            @if ($dish->image)
                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" style="max-width: 200px;">
            @else
                <p>Изображение отсутствует</p>
            @endif
        </div>
        <div>
            <label>Новое изображение:</label>
            <input type="file" name="image" accept="image/*">
            @error('image') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Обновить</button>
    </form>
    <a href="{{ route('dishes.index') }}">Назад к списку</a>
@endsection