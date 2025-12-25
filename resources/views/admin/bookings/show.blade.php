@extends('adminlte::page')

@section('title', 'Booking Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Booking #{{ $booking->id }}</h1>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Items</h6>
                </div>
                <div class="card-body">
                    <h5>Package: {{ $booking->package->name }}</h5>
                    <p class="text-muted">{{ $booking->package->description }}</p>
                    
                    <h6 class="mt-4 mb-3 font-weight-bold">Package Items & Add-ons</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->items as $item)
                                <tr>
                                    <td style="width: 60px;">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ $item->product->image }}" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($item->item_type == 'main')
                                            <span class="badge badge-primary">Main</span>
                                        @else
                                            <span class="badge badge-info">Add-on</span>
                                        @endif
                                    </td>
                                    <td>₹{{ number_format($item->price) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Total Amount:</strong> ₹{{ number_format($booking->total_amount, 2) }}</p>
                            <p><strong>Advance Paid:</strong> ₹{{ number_format($booking->advance_amount, 2) }}</p>
                            <p><strong>Pending Amount:</strong> ₹{{ number_format($booking->pending_amount, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Delivery Date:</strong> {{ $booking->delivery_date ? $booking->delivery_date->format('d M Y') : 'Not set' }}</p>
                            <p><strong>Payment Status:</strong> 
                                <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : ($booking->payment_status === 'partially_paid' ? 'warning' : 'danger') }}">
                                    {{ ucfirst(str_replace('_', ' ', $booking->payment_status)) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $booking->shipping_address ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="delivered" {{ $booking->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
