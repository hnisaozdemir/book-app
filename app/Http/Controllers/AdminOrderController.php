<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

   public function updateOrderState($orderItemId, $state)
{
    $item = OrderItems::findOrFail($orderItemId);
    $item->state = $state;
    $item->save();

    return redirect()->back()->with('success', 'Sipariş durumu güncellendi.');
}
}