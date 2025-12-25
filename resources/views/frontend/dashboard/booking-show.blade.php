@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Booking Details #{{ $booking->booking_number }}</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <div class="row">
        <!-- Main Details -->
        <div class="col-md-8">
            <!-- Package Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary"><i class="fas fa-box me-2"></i>Package Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($booking->package->image)
                            <img src="{{ $booking->package->image }}" alt="{{ $booking->package->name }}" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        @endif
                        <div>
                            <h4 class="mb-1">{{ $booking->package->name }}</h4>
                            <span class="badge bg-light text-dark border">{{ $booking->package->items_count }} Items</span>
                        </div>
                    </div>
                    <p class="text-muted">{{ $booking->package->description }}</p>
                </div>
            </div>

            <!-- Items List -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-success"><i class="fas fa-list-check me-2"></i>Package Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ $item->product->image }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                            {{ $item->item_name }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->product && $item->product->category)
                                            <span class="badge bg-light text-secondary border">{{ $item->product->category->name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->item_type == 'main')
                                            <span class="badge bg-primary">Main Item</span>
                                        @else
                                            <span class="badge bg-info">Add-on</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">₹{{ number_format($item->price) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total Amount:</td>
                                    <td class="fw-bold text-primary fs-5">₹{{ number_format($booking->total_amount) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-md-4">
            <!-- Booking Status -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Booking Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Status</label>
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
                        <div class="mt-1">
                            <span class="badge bg-{{ $color }} fs-6 px-3 py-2 w-100">{{ ucfirst($booking->status) }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Booking Date</label>
                        <div class="fw-bold">{{ $booking->created_at->format('d M Y, h:i A') }}</div>
                    </div>
                    <hr>
                    <div class="mb-0">
                        <label class="text-muted small">Payment Status</label>
                        @php
                            $paymentColors = [
                                'unpaid' => 'danger',
                                'partially_paid' => 'warning',
                                'paid' => 'success'
                            ];
                            $pColor = $paymentColors[$booking->payment_status] ?? 'secondary';
                        @endphp
                        <div class="mt-1">
                            <span class="badge bg-{{ $pColor }} w-100">{{ ucfirst(str_replace('_', ' ', $booking->payment_status)) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Address -->
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Delivery Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <div class="me-3"><i class="fas fa-user text-muted"></i></div>
                        <div>
                            <h6 class="mb-0">Customer Name</h6>
                            <div>{{ $booking->user->name }}</div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3"><i class="fas fa-phone text-muted"></i></div>
                        <div>
                            <h6 class="mb-0">Phone</h6>
                            <div>{{ $booking->user->phone ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3"><i class="fas fa-truck text-muted"></i></div>
                        <div>
                            <h6 class="mb-0">Delivery Address</h6>
                            <div>{{ $booking->shipping_address ?? 'Address not provided' }}</div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-3"><i class="fas fa-calendar text-muted"></i></div>
                        <div>
                            <h6 class="mb-0">Delivery Date</h6>
                            <div>{{ $booking->delivery_date ? $booking->delivery_date->format('d M Y') : 'Not scheduled' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
