<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with('items.dish')->get();
        return view('profile.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('profile.index')->with('error', 'Доступ запрещён');
        }
        $order->load('items.dish');
        return view('profile.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('profile.index')->with('error', 'Доступ запрещён');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('profile.index')->with('error', 'Нельзя отменить заказ с этим статусом');
        }

        $order->update(['status' => 'cancelled']);
        return redirect()->route('profile.index')->with('success', 'Заказ отменён');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('profile.index')->with('success', 'Профиль обновлён');
    }
}