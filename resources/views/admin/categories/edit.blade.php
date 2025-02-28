@extends('layouts.admin')

@section('title', 'Редактировать категорию')

@section('content')
    <h1>Редактировать категорию</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Название:</label>
            <input type="text" name="name" value="{{ $category->name }}" required>
        </div>
        <button type="submit">Обновить</button>
    </form>
    <a href="{{ route('categories.index') }}">Назад к списку</a>
@endsection