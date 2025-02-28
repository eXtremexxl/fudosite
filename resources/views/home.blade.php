@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="section__container header__container" id="home">
        <div class="header__image">
            <img src="{{ asset('assets/header_enhanced.png') }}" alt="header" />
        </div>
        <div class="header__content">
            <div class="header__tag">
                Быстрее всех
                <img src="{{ asset('assets/delivery-bike.png') }}" alt="header tag" />
            </div>
            <h1>Самая быстрая доставка вашей <span>еды</span></h1>
            <p class="section__description">
                Наша задача - наполнить ваш желудок вкусной едой с быстрой и бесплатной доставкой.
            </p>
            <div class="header__btns">
                <a href="{{ route('menu') }}" class="btn">Начать</a>
            </div>
        </div>
    </div>

    <section class="section__container service__container" id="service">
        <p class="section__subheader">Что мы предлагаем</p>
        <h2 class="section__header">Ваш любимый партнёр по доставке еды</h2>
        <div class="service__grid">
            <div class="service__card">
            <img src="{{ asset('assets/easy.svg') }}" alt="service" class="service__icon" />
                <h4>Простота заказа</h4>
                <p>Всего несколько шагов для заказа еды</p>
            </div>
            <div class="service__card">
            <img src="{{ asset('assets/fast.svg') }}" alt="service" class="service__icon" />
                <h4>Быстрая доставка</h4>
                <p>Доставка всегда вовремя и даже быстрее</p>
            </div>
            <div class="service__card">
            <img src="{{ asset('assets/quality.svg') }}" alt="service" class="service__icon" />
                <h4>Лучшее качество</h4>
                <p>Не только быстро, но и качество на первом месте</p>
            </div>
        </div>
    </section>

    <section class="section__container menu__container home-menu-section" id="menu">
        <p class="section__subheader">Наше меню</p>
        <h2 class="section__header">Блюда, в которые вы влюбитесь</h2>
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($dishes as $dish)
                    <div class="swiper-slide">
                        <div class="menu__card">
                            @if ($dish->image)
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" />
                            @else
                                <div class="no-image">Нет изображения</div>
                            @endif
                            <div class="menu__card__details">
                                <h4>{{ $dish->name }}</h4>
                                <h5><span>₽</span>{{ $dish->price }}</h5>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                    <button type="submit" class="order-button">
                                        Заказать
                                        <span><i class="ri-arrow-right-line"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section__container client__container" id="client">
        <div class="client__image">
            <img src="{{ asset('assets/client2.png') }}" alt="client" />
        </div>
        <div class="client__content">
            <p class="section__subheader">Что говорят клиенты</p>
            <h2 class="section__header">Отзывы наших клиентов</h2>
            @if ($reviews->isNotEmpty())
                @foreach ($reviews as $review)
                    <p class="section__description review-quote">&ldquo;{{ $review->content }}&rdquo;</p>
                    <div class="client__details">
                        <img src="{{ asset('assets/user.jpg') }}" alt="client" />
                        <div>
                            <h4>{{ $review->user->name }}</h4>
                            <h5>Любитель еды</h5>
                        </div>
                    </div>
                    <div class="client__rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span><i class="{{ $i <= $review->rating ? 'ri-star-fill' : 'ri-star-line' }}"></i></span>
                        @endfor
                        <span>{{ $review->rating }}</span>
                    </div>
                @endforeach
            @else
                <p class="section__description review-quote">&ldquo;Пока нет отзывов.&rdquo;</p>
                <div class="client__details">
                    <img src="{{ asset('assets/user.jpg') }}" alt="client" />
                    <div>
                        <h4>Имя пользователя</h4>
                        <h5>Любитель еды</h5>
                    </div>
                </div>
                <div class="client__rating">
                    <span><i class="ri-star-line"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span>0</span>
                </div>
            @endif
        </div>
    </section>

    <section class="motivation__container">
        <h2 class="section__header">Вдохновение каждый день</h2>
        <p class="section__quote" id="quote">"Секрет успеха в том, чтобы начать. Великие дела начинаются с первого шага."</p>
        <p class="section__author" id="author">Конфуций</p>
    </section>



@endsection