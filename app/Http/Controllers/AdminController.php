<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
{
    $today = Carbon::today();

    $orders = Order::with(['user', 'orderDetails']) // Eager load both relationships
            ->where('status', 'pending')
            ->whereDate('created_at', $today)
            ->latest()
            ->paginate(10);

    return view('admin.index', [
        'orders' => $orders
    ]);
}


public function orders() 
{
    $orders = Order::with('user')
                   ->orderByRaw("CASE WHEN status = 'pending' THEN 1 ELSE 2 END") // Prioritize pending orders
                   ->latest()
                   ->paginate(10);
                   
    return view('admin.orders', [
        'orders' => $orders
    ]);
}

}
