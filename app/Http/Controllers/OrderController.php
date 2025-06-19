<?php
namespace App\Http\Controllers;

use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
$orders = Order::with('items.product')
    ->where('user_id', auth()->user()?->id)
    ->latest()
    ->get();

    }
}

