<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishRating;
use Illuminate\Http\Request;

class DishRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Dish $dish)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Проверяем, покупал ли пользователь блюдо
        $userOrders = auth()->user()->orders()->whereHas('items', function ($query) use ($dish) {
            $query->where('dish_id', $dish->id);
        })->exists();

        if (!$userOrders) {
            return redirect()->back()->with('error', 'Вы можете оценить блюдо только после его покупки');
        }

        DishRating::updateOrCreate(
            ['user_id' => auth()->id(), 'dish_id' => $dish->id],
            ['rating' => $request->rating]
        );

        return redirect()->back()->with('success', 'Рейтинг сохранён');
    }
}