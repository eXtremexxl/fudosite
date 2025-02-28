<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dishes = Dish::with('category')->take(6)->get(); // 6 блюд для слайдера
        $reviews = Review::with('user')->orderBy('created_at', 'desc')->take(1)->get(); // 1 отзыв для секции
        return view('home', compact('dishes', 'reviews'));
    }
}