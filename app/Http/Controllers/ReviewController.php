<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function index()
    {
        $reviews = Review::all();
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Ищем существующий отзыв или создаём новый
        Review::updateOrCreate(
            ['user_id' => auth()->id()], // Условие поиска
            [
                'content' => $request->content,
                'rating' => $request->rating,
            ]
        );

        return redirect()->route('reviews')->with('success', 'Отзыв успешно добавлен или обновлён');
    }
}