<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create(Request $request, $slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please login to continue booking.');
        }

        $package = Package::where('slug', $slug)->firstOrFail();
        $customizedItems = json_decode($request->customized_items, true);
        $finalPrice = $request->final_price ?? $package->base_price;

        return view('frontend.booking.create', compact('package', 'customizedItems', 'finalPrice'));
    }

    public function createCustomCombo(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please login to continue booking.');
        }

        $items = json_decode($request->combo_items, true);
        
        if (!$items || count($items) < 3) {
            return back()->with('error', 'Invalid combo items.');
        }

        // Get Custom Combo package
        $package = Package::firstOrCreate(
            ['slug' => 'custom-combo'],
            [
                'name' => 'Custom Combo',
                'description' => 'User created custom combo',
                'base_price' => 0,
                'status' => true,
                'is_featured' => false
            ]
        );
        
        $package->base_price = $request->total_price; // Override price for display

        $finalPrice = $request->total_price;
        $customizedItems = ['added' => [], 'removed' => []]; // Not used for custom combo but required by view

        // Pass items to view to display them
        $comboItems = $items;

        return view('frontend.booking.create', compact('package', 'customizedItems', 'finalPrice', 'comboItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'delivery_date' => 'required|date|after:today',
            'advance_amount' => 'required|numeric|min:1000',
        ]);

        try {
            DB::beginTransaction();

            $booking = new Booking();
            $booking->booking_number = 'BK-' . strtoupper(Str::random(8));
            $booking->user_id = Auth::id();
            $booking->package_id = $request->package_id;
            $booking->customer_name = $request->customer_name;
            $booking->customer_email = $request->customer_email;
            $booking->customer_phone = $request->customer_phone;
            $booking->customer_address = $request->customer_address;
            $booking->city = $request->city;
            $booking->state = $request->state;
            $booking->pincode = $request->pincode;
            
            $booking->total_amount = $request->final_price;
            $booking->advance_amount = $request->advance_amount;
            $booking->pending_amount = $request->final_price - $request->advance_amount;
            $booking->customized_items = $request->customized_items; // JSON string
            $booking->delivery_date = $request->delivery_date;
            $booking->special_instructions = $request->special_instructions;
            $booking->status = 'pending';
            $booking->payment_status = 'unpaid';
            $booking->save();

            DB::commit();

            // Redirect to Payment Gateway (Razorpay)
            return redirect()->route('frontend.booking.payment', $booking->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        $booking = Booking::with('package')->findOrFail($id);
        
        // For demo: Mark as partially paid
        $booking->update(['payment_status' => 'partially_paid']);

        return view('frontend.booking.payment', compact('booking'));
    }

    public function success(Request $request)
    {
        $bookingId = $request->booking_id;
        $booking = Booking::with('package')->findOrFail($bookingId);
        
        // Update payment status
        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);
        
        // Create payment record
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->advance_amount,
            'payment_method' => $request->payment_method ?? 'demo',
            'transaction_id' => 'TXN_' . strtoupper(uniqid()),
            'status' => 'completed',
        ]);

        return view('frontend.booking.success', compact('booking'));
    }
}
