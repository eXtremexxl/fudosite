<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель - @yield('title')</title>
    <style>
        /* Сброс стилей */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #333;
            line-height: 1.6;
        }

        /* Хедер */
        .admin-header {
            background: linear-gradient(135deg, #f54748, #d83e3e);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .admin-nav {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .admin-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .admin-nav a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Контент */
        .content {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        h1 {
            font-size: 2.5rem;
            color: #2e2e2e;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.8rem;
            color: #f54748;
            margin: 2rem 0 1rem;
            font-weight: 600;
            text-align: center;
        }

        /* Статистика */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-box {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-box p:first-child {
            font-size: 1.2rem;
            color: #595959;
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        .stat-box p:last-child {
            font-size: 1.8rem;
            font-weight: 700;
            color: #f54748;
        }

        /* Действия */
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            justify-content: center;
            margin-bottom: 2.5rem;
        }

        .actions a {
            padding: 0.8rem 1.8rem;
            background: #f54748;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .actions a:hover {
            background: #d83e3e;
            transform: scale(1.05);
        }

        /* Фильтр */
        .filter-form {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2.5rem;
        }

        .filter-form div {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            align-items: center;
            justify-content: center;
        }

        .filter-form label {
            font-size: 1rem;
            color: #2e2e2e;
            font-weight: 500;
            margin-right: 0.5rem;
        }

        .filter-form select,
        .filter-form input[type="date"] {
            padding: 0.6rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            min-width: 160px;
            background: #fafafa;
            transition: border-color 0.3s ease;
        }

        .filter-form select:focus,
        .filter-form input[type="date"]:focus {
            border-color: #f54748;
            outline: none;
        }

        .filter-form button {
            padding: 0.6rem 1.8rem;
            background: #f54748;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .filter-form button:hover {
            background: #d83e3e;
            transform: scale(1.05);
        }

        /* Таблицы */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        th, td {
            padding: 1.2rem;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f54748;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        td {
            color: #333;
            font-size: 1rem;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* Статусы */
        td:nth-child(4) {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }
        td:nth-child(4)[data-status="Ожидает подтверждения"] {
            background-color: #fff3cd;
            color: #856404;
        }
        td:nth-child(4)[data-status="Подтверждён"] {
            background-color: #cce5ff;
            color: #004085;
        }
        td:nth-child(4)[data-status="Готовится"] {
            background-color: #f8d7da;
            color: #721c24;
        }
        td:nth-child(4)[data-status="В доставке"] {
            background-color: #cce5ff;
            color: #004085;
        }
        td:nth-child(4)[data-status="Завершён"] {
            background-color: #d4edda;
            color: #155724;
        }
        td:nth-child(4)[data-status="Отменён"] {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Действия в таблице */
        td a, td button {
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        td a {
            background: #f54748;
            color: white;
            text-decoration: none;
            margin-right: 0.5rem;
        }

        td a:hover {
            background: #d83e3e;
            transform: scale(1.05);
        }

        td button {
            background: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
        }

        td button:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        /* Ссылки внизу */
        a:not(.actions a):not(td a) {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: #f54748;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 0.5rem;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        a:not(.actions a):not(td a):hover {
            background: #d83e3e;
            transform: scale(1.05);
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .admin-header {
                padding: 1rem;
            }

            .admin-nav {
                flex-direction: column;
                gap: 1rem;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
                align-items: center;
            }

            .filter-form div {
                flex-direction: column;
                align-items: stretch;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .stat-box {
                min-width: 100%;
            }

            .filter-form select,
            .filter-form input[type="date"] {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <nav class="admin-nav">
            <a href="{{ route('admin.index') }}">Главная</a>
            <a href="{{ route('orders.index') }}">Заказы</a>
            <a href="{{ route('dishes.index') }}">Блюда</a>
            <a href="{{ route('categories.index') }}">Категории</a>
            <a href="{{ route('home') }}">Перейти на сайт</a>
        </nav>
    </header>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>