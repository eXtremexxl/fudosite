<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $dish = Dish::findOrFail($request->dish_id);
        $cart = session()->get('cart', []);
        $cart[$dish->id] = [
            'name' => $dish->name,
            'price' => $dish->price,
            'quantity' => ($cart[$dish->id]['quantity'] ?? 0) + 1,
        ];
        session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $dishId = $request->dish_id;
        $quantity = (int) $request->quantity;

        if (isset($cart[$dishId])) {
            if ($quantity > 0) {
                $cart[$dishId]['quantity'] = $quantity;
            } else {
                unset($cart[$dishId]); // Удаляем, если количество 0
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Корзина обновлена');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $dishId = $request->dish_id;

        if (isset($cart[$dishId])) {
            unset($cart[$dishId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Блюдо удалено из корзины');
    }
}