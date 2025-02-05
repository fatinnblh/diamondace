<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Check if user is admin
        if ($user->isAdmin()) {
            $totalUsers = User::count();
            $totalOrders = Order::count();
            $pendingOrders = Order::where('status', 'pending')->count();

            return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'pendingOrders'));
        }

        // Regular user dashboard
        $orders = $user->orders()->with(['user'])->get();

        return view('dashboard', compact('orders'));
    }
}
