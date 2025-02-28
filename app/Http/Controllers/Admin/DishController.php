<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::with('category')->get();
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.dishes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048', // Максимум 2MB, только изображения
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dishes', 'public');
            $data['image'] = $path;
        }

        Dish::create($data);
        return redirect()->route('dishes.index')->with('success', 'Блюдо добавлено');
    }

    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно есть
            if ($dish->image && \Storage::disk('public')->exists($dish->image)) {
                \Storage::disk('public')->delete($dish->image);
            }
            $path = $request->file('image')->store('dishes', 'public');
            $data['image'] = $path;
        }

        $dish->update($data);
        return redirect()->route('dishes.index')->with('success', 'Блюдо обновлено');
    }

    public function destroy(Dish $dish)
    {
        if ($dish->image && \Storage::disk('public')->exists($dish->image)) {
            \Storage::disk('public')->delete($dish->image);
        }
        $dish->delete();
        return redirect()->route('dishes.index')->with('success', 'Блюдо удалено');
    }
}