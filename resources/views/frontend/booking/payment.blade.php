@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0"><i class="fas fa-credit-card me-2"></i>Complete Payment</h3>
                </div>
                <div class="card-body p-5">
                    <!-- Booking Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Booking Number</h6>
                            <p class="fw-bold">{{ $booking->booking_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Package</h6>
                            <p class="fw-bold">{{ $booking->package->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Total Amount</h6>
                            <p class="fw-bold text-primary">₹{{ number_format($booking->total_amount) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Advance Payment</h6>
                            <p class="fw-bold text-success h4">₹{{ number_format($booking->advance_amount) }}</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Payment Options -->
                    <h5 class="mb-4">Select Payment Method</h5>
                    <form action="{{ route('frontend.booking.success') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card h-100 payment-option" onclick="selectPayment('razorpay')">
                                    <div class="card-body text-center">
                                        <input type="radio" name="payment_method" value="razorpay" id="razorpay" required>
                                        <label for="razorpay" class="d-block mt-2">
                                            <i class="fas fa-credit-card fa-3x text-primary mb-2"></i>
                                            <h6>Razorpay</h6>
                                            <small class="text-muted">Card/UPI/Wallet</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 payment-option" onclick="selectPayment('paytm')">
                                    <div class="card-body text-center">
                                        <input type="radio" name="payment_method" value="paytm" id="paytm" required>
                                        <label for="paytm" class="d-block mt-2">
                                            <i class="fas fa-mobile-alt fa-3x text-info mb-2"></i>
                                            <h6>PayTM</h6>
                                            <small class="text-muted">Wallet/UPI</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 payment-option" onclick="selectPayment('cash')">
                                    <div class="card-body text-center">
                                        <input type="radio" name="payment_method" value="cash" id="cash" required>
                                        <label for="cash" class="d-block mt-2">
                                            <i class="fas fa-money-bill-wave fa-3x text-success mb-2"></i>
                                            <h6>Cash on Delivery</h6>
                                            <small class="text-muted">Pay Later</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle me-2"></i>Complete Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-option {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid #e0e0e0;
}

.payment-option:hover {
    border-color: #0d6efd;
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-option input[type="radio"]:checked + label {
    color: #0d6efd;
}

.payment-option:has(input:checked) {
    border-color: #0d6efd;
    background-color: #f8f9fa;
}
</style>

<script>
function selectPayment(method) {
    document.getElementById(method).checked = true;
}
</script>
@endsection

@section('js')
<script>
    // Clear combo items as the booking is now created
    localStorage.removeItem('comboItems');
    if (typeof updateComboBuilder === 'function') {
        comboItems = [];
        updateComboBuilder();
    }
</script>
@endsection
