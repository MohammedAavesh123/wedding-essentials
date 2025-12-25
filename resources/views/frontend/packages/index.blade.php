@extends('layouts.frontend')

@section('content')
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-5">Our Marriage Packages</h1>

        <div class="row">
            @foreach($packages as $package)
            <div class="col-md-4 mb-4">
                <div class="card package-card h-100">
                    <div class="position-relative">
                        @if($package->image)
                            <img src="{{ $package->image }}" class="card-img-top" alt="{{ $package->name }}" style="height: 250px; object-fit: cover;">
                        @else
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 250px; display: flex; align-items: center; justify-content: center;">
                                <h3 class="text-white text-center px-3">{{ $package->name }}</h3>
                            </div>
                        @endif
                        @if($package->is_featured)
                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">Premium</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $package->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($package->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="h5 mb-0 text-primary">₹{{ number_format($package->base_price) }}</span>
                            <span class="badge bg-info text-dark">{{ $package->items_count }} Items</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-3">
                        <a href="{{ route('frontend.packages.show', $package->slug) }}" class="btn btn-outline-primary w-100">View Details & Customize</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $packages->links() }}
        </div>
    </div>
@endsection
