<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Только авторизованные пользователи могут оформлять заказы
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Корзина пуста');
        }

        // Подсчитываем общую сумму
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Создаём заказ
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        // Добавляем элементы заказа
        foreach ($cart as $dishId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $dishId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Очищаем корзину после оформления
        session()->forget('cart');

        return redirect()->route('profile.index')->with('success', 'Заказ успешно оформлен');
    }
}