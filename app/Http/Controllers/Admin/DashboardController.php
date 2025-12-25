<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'total_packages' => Package::count(),
            'total_products' => Product::count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_amount'),
        ];

        $recent_bookings = Booking::with('user', 'package')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }
}
