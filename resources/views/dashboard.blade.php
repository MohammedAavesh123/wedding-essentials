@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle fa-5x text-primary"></i>
                    </div>
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-home me-2"></i>Home
                        </a>
                        <a href="{{ route('frontend.packages.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-box me-2"></i>Browse Packages
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 opacity-75">Total Bookings</h6>
                                    <h2 class="card-title mb-0">{{ $bookings->count() }}</h2>
                                </div>
                                <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 opacity-75">Confirmed</h6>
                                    <h2 class="card-title mb-0">{{ $bookings->where('status', 'confirmed')->count() }}</h2>
                                </div>
                                <i class="fas fa-check-circle fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 opacity-75">Pending</h6>
                                    <h2 class="card-title mb-0">{{ $bookings->where('status', 'pending')->count() }}</h2>
                                </div>
                                <i class="fas fa-clock fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0"><i class="fas fa-list me-2"></i>My Bookings</h4>
                </div>
                <div class="card-body p-0">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Booking #</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td class="fw-bold">{{ $booking->booking_number }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($booking->package->image)
                                                    <img src="{{ $booking->package->image }}" alt="{{ $booking->package->name }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                {{ $booking->package->name }}
                                            </div>
                                        </td>
                                        <td class="fw-bold text-primary">₹{{ number_format($booking->total_amount) }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'confirmed' => 'success',
                                                    'processing' => 'info',
                                                    'delivered' => 'primary',
                                                    'cancelled' => 'danger'
                                                ];
                                                $color = $statusColors[$booking->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }}">{{ ucfirst($booking->status) }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $paymentColors = [
                                                    'unpaid' => 'danger',
                                                    'partially_paid' => 'warning',
                                                    'paid' => 'success'
                                                ];
                                                $pColor = $paymentColors[$booking->payment_status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $pColor }}">{{ ucfirst(str_replace('_', ' ', $booking->payment_status)) }}</span>
                                        </td>
                                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('frontend.dashboard.booking.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No bookings yet</h5>
                            <p class="text-muted">Start exploring our amazing packages!</p>
                            <a href="{{ route('frontend.packages.index') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Browse Packages
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
