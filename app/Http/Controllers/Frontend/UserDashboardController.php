<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['package', 'payment'])
            ->latest()
            ->get();
            
        return view('dashboard', compact('bookings'));
    }

    public function showBooking($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $id)
            ->with(['package', 'payment', 'items.product'])
            ->firstOrFail();

        return view('frontend.dashboard.booking-show', compact('booking'));
    }
}
