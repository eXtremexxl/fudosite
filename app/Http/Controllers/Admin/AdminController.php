<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Статистика
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalDishes = Dish::count();

        // Фильтры для заказов
        $query = Order::with('user')->orderBy('created_at', 'desc');

        // Фильтр по статусу
        $status = $request->input('status');
        if (!empty($status) && in_array($status, ['pending', 'processing', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        // Фильтр по дате
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if (!empty($dateFrom) && \DateTime::createFromFormat('Y-m-d', $dateFrom) !== false) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if (!empty($dateTo) && \DateTime::createFromFormat('Y-m-d', $dateTo) !== false) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        // Получаем отфильтрованные заказы
        $orders = $query->take(5)->get();

        // Блюда
        $dishes = Dish::orderBy('name')->take(5)->get();

        return view('admin.index', compact('totalOrders', 'totalRevenue', 'totalDishes', 'orders', 'dishes'));
    }
}