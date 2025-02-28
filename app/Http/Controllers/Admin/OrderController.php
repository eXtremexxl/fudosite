<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.dish')->get(); // Загружаем все заказы с данными пользователя и блюд
        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        $order->load('items.dish'); // Загружаем детали заказа
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // Валидация входных данных
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Order::STATUS_PENDING,
                Order::STATUS_CONFIRMED,
                Order::STATUS_PREPARING,
                Order::STATUS_DELIVERING,
                Order::STATUS_COMPLETED,
                Order::STATUS_CANCELED,
            ]),
        ]);

        // Обновление статуса
        $order->update([
            'status' => $request->input('status'),
        ]);

        // Перенаправление с сообщением об успехе
        return redirect()->route('orders.index')->with('success', 'Статус заказа успешно обновлён');
    }
    
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удалён');
    }
}