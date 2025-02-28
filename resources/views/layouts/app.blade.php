<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @yield('styles') <!-- Здесь подключаются стили конкретных страниц -->
    <title>@yield('title') - Fudo</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets/logo.png') }}" alt="logo" />
                        <span>Fudo</span>
                    </a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li><a href="{{ route('home') }}">Главная</a></li>
                <li><a href="{{ route('menu') }}">Меню</a></li>
                <li><a href="{{ route('reviews') }}">Отзывы</a></li>
                <li><a href="{{ route('cart') }}">Корзина</a></li>
                @auth
                    <li><a href="{{ route('profile.index') }}">Личный кабинет</a></li>
                    @if (auth()->user()->is_admin)
                        <li><a href="{{ route('admin.index') }}">Админ-панель</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn">
                                <span><i class="ri-login-box-line"></i></span>
                                Выйти
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <button class="btn" onclick="window.location.href='{{ route('login') }}'">
                            <span><i class="ri-login-box-line"></i></span>
                            Войти
                        </button>
                    </li>
                @endauth
            </ul>
            <div class="nav__btns">
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn">
                            <span><i class="ri-login-box-line"></i></span>
                            Выйти
                        </button>
                    </form>
                @else
                    <button class="btn" onclick="window.location.href='{{ route('login') }}'">
                        <span><i class="ri-login-box-line"></i></span>
                        Войти
                    </button>
                @endauth
            </div>
        </nav>
        @yield('content')
    </header>

    <footer>
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets/logo.png') }}" alt="logo" />
                        <span>Fudo</span>
                    </a>
                </div>
                <p class="section__description">
                    Наша задача - наполнить ваш желудок вкусной едой с быстрой и бесплатной доставкой.
                </p>
                <ul class="footer__socials">
                    <li><a href="#"><i class="ri-vk-fill"></i></a></li> <!-- ВКонтакте -->
                    <li><a href="#"><i class="ri-youtube-fill"></i></a></li> <!-- YouTube -->
                    <li><a href="#"><i class="ri-instagram-fill"></i></a></li> <!-- Instagram -->
                </ul>
            </div>
            <div class="footer__col">
                <h4>О нас</h4>
                <ul class="footer__links">
                    <li><a href="#">О компании</a></li>
                    <li><a href="#">Возможности</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="{{ route('menu') }}">Меню</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Компания</h4>
                <ul class="footer__links">
                    <li><a href="#">Почему Fudo?</a></li>
                    <li><a href="#">Сотрудничество</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Блог</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Поддержка</h4>
                <ul class="footer__links">
                    <li><a href="{{ route('profile.index') }}">Аккаунт</a></li>
                    <li><a href="#">Центр поддержки</a></li>
                    <li><a href="#">Обратная связь</a></li>
                    <li><a href="#">Связаться с нами</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2025 Anastasia Vaskina. All rights reserved.
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>