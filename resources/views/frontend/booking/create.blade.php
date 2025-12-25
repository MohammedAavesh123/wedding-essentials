@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Complete Your Booking</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5 class="alert-heading"><i class="fas fa-box-open me-2"></i>{{ $package->name }}</h5>
                        <p class="mb-0"><strong>Total Amount:</strong> <span class="text-primary fw-bold">₹{{ number_format($finalPrice) }}</span></p>
                        
                        @if(isset($comboItems) && count($comboItems) > 0)
                            <hr>
                            <h6>Selected Items:</h6>
                            <ul class="mb-0">
                                @foreach($comboItems as $item)
                                    <li>{{ $item['name'] }} - ₹{{ number_format($item['packagePrice'] ?? $item['price']) }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <form action="{{ route('frontend.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <input type="hidden" name="final_price" value="{{ $finalPrice }}">
                        <input type="hidden" name="customized_items" value="{{ json_encode($customizedItems) }}">

                        <h5 class="mb-3">Customer Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" name="customer_name" class="form-control" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="customer_email" class="form-control" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="customer_phone" class="form-control" value="{{ Auth::user()->phone }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Delivery Date</label>
                                <input type="date" name="delivery_date" class="form-control" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                        </div>

                        <h5 class="mb-3 mt-2">Delivery Address</h5>
                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="customer_address" class="form-control" rows="2" required>{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ Auth::user()->city }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" value="{{ Auth::user()->state }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Pincode</label>
                                <input type="text" name="pincode" class="form-control" value="{{ Auth::user()->pincode }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Special Instructions (Optional)</label>
                            <textarea name="special_instructions" class="form-control" rows="2"></textarea>
                        </div>

                        <hr>
                        <h5 class="mb-3">Payment Details</h5>
                        <div class="form-group mb-3">
                            <label>Advance Payment Amount (Min ₹1000)</label>
                            <input type="number" name="advance_amount" class="form-control" value="2000" min="1000" max="{{ $finalPrice }}" required>
                            <small class="text-muted">Remaining amount can be paid on delivery.</small>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">Proceed to Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
