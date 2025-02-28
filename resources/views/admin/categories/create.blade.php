@extends('layouts.admin')

@section('title', 'Добавить категорию')

@section('content')
    <h1>Добавить категорию</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label>Название:</label>
            <input type="text" name="name" required>
        </div>
        <button type="submit">Сохранить</button>
    </form>
    <a href="{{ route('categories.index') }}">Назад к списку</a>
@endsection