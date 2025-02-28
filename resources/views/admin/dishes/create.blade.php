@extends('layouts.admin')

@section('title', 'Добавить блюдо')

@section('content')
    <h1>Добавить блюдо</h1>
    <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Название:</label>
            <input type="text" name="name" required>
            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Описание:</label>
            <textarea name="description"></textarea>
        </div>
        <div>
            <label>Цена:</label>
            <input type="number" name="price" step="0.01" required>
            @error('price') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Категория:</label>
            <select name="category_id">
                <option value="">Без категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Изображение:</label>
            <input type="file" name="image" accept="image/*">
            @error('image') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Сохранить</button>
    </form>
    <a href="{{ route('dishes.index') }}">Назад к списку</a>
@endsection