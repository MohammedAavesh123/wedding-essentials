@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 text-center">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="text-success mb-3">Payment Successful!</h2>
                    <p class="lead mb-4">Your booking has been confirmed</p>
                    
                    <div class="bg-light p-4 rounded mb-4">
                        <h5 class="mb-3">Booking Details</h5>
                        <div class="row text-start">
                            <div class="col-md-6 mb-2">
                                <strong>Booking Number:</strong><br>
                                <span class="text-primary">{{ $booking->booking_number }}</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Package:</strong><br>
                                {{ $booking->package->name }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Total Amount:</strong><br>
                                ₹{{ number_format($booking->total_amount) }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Paid Amount:</strong><br>
                                <span class="text-success">₹{{ number_format($booking->advance_amount) }}</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-muted mb-4">
                        <i class="fas fa-envelope me-2"></i>
                        A confirmation email has been sent to {{ $booking->customer_email }}
                    </p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-home me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Clear combo items as booking is complete
    localStorage.removeItem('comboItems');
    if (typeof comboItems !== 'undefined') {
        comboItems = [];
    }
    if (typeof updateComboBuilder === 'function') {
        updateComboBuilder();
    }
</script>
@endsection
