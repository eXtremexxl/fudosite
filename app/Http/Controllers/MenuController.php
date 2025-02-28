<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Dish::query();

        // Фильтр по категории
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Фильтр по минимальной цене
        if ($request->has('price_min') && is_numeric($request->price_min)) {
            $query->where('price', '>=', $request->price_min);
        }

        // Фильтр по максимальной цене
        if ($request->has('price_max') && is_numeric($request->price_max)) {
            $query->where('price', '<=', $request->price_max);
        }

        // Сортировка
        $sort = $request->input('sort', 'name'); // По умолчанию по имени
        if (in_array($sort, ['name', 'price', 'price_desc'])) {
            if ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->orderBy($sort, 'asc');
            }
        }

        $dishes = $query->get();
        return view('menu', compact('dishes', 'categories'));
    }
}