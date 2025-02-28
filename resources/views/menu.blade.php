@extends('layouts.app')

@section('title', 'Меню')

@section('content')
    <section class="section__container menu__container menu-page">
        <div class="menu__header">
            <p class="section__subheader">Наше меню</p>
            <h2 class="section__header">Еда, которая заставит ваши вкусовые рецепторы петь!</h2>
        </div>

        <!-- Фильтр -->
        <form method="GET" action="{{ route('menu') }}" class="filter__form">
            <div class="filter__wrapper">
                <div class="filter__group">
                    <label for="category_id">Категория</label>
                    <select name="category_id" id="category_id" onchange="this.form.submit()">
                        <option value="">Все категории</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter__group">
                    <label for="price_min">Цена от</label>
                    <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}" min="0" step="0.01">
                </div>
                <div class="filter__group">
                    <label for="price_max">Цена до</label>
                    <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}" min="0" step="0.01">
                </div>
                <div class="filter__group">
                    <label for="sort">Сортировка</label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>По имени</option>
                        <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>По цене ↑</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>По цене ↓</option>
                    </select>
                </div>
                <button type="submit" class="filter__btn">Применить</button>
            </div>
        </form>

        <!-- Сетка блюд -->
        <div class="menu__grid">
            @if ($dishes->isEmpty())
                <p class="menu__empty">Блюд в этой категории пока нет</p>
            @else
                @foreach ($dishes as $dish)
                    <div class="menu__card">
                        <div class="menu__card__image">
                            @if ($dish->image)
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" />
                                <div class="menu__card__overlay"></div>
                            @else
                                <div class="no-image">Нет изображения</div>
                            @endif
                        </div>
                        <div class="menu__card__content">
                            <div class="menu__card__header">
                                <h4>{{ $dish->name }}</h4>
                                <h5><span>₽</span>{{ number_format($dish->price, 2) }}</h5>
                            </div>
                            <p class="menu__card__description">{{ Str::limit($dish->description, 100) }}</p>
                            <div class="menu__card__rating">
                                <span class="rating__stars">★ {{ number_format($dish->averageRating(), 1) }}</span>
                                <span>({{ $dish->ratings->count() }})</span>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" class="menu__card__form">
                                @csrf
                                <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                <button type="submit" class="menu__card__btn">
                                    В корзину
                                    <i class="ri-shopping-cart-line"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}" />
@endsection