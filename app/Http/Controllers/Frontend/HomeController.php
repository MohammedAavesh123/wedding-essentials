<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Product;
use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Show latest featured packages first
        $featured_packages = Package::where('status', true)
            ->where('is_featured', true)
            ->withCount('items')
            ->latest()
            ->get();

        // Get products grouped by category, latest first within each category
        $products = Product::where('status', true)
            ->where('in_stock', true)
            ->with('category')
            ->latest()
            ->get();
            
        $recent_bookings_count = Booking::where('created_at', '>=', now()->subDay())->count();

        return view('frontend.home', compact('featured_packages', 'products', 'recent_bookings_count'));
    }
}
