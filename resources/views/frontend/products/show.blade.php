@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <!-- Product Details -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="product-image-container">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                @else
                    <div class="bg-secondary rounded" style="height: 400px;"></div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('frontend.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>

            <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
            <p class="text-muted mb-3">
                <i class="fas fa-tag me-2"></i>{{ $product->category->name }}
            </p>

            <div class="mb-4">
                <div class="d-flex align-items-baseline gap-3">
                    <h2 class="text-primary mb-0">₹{{ number_format($product->price) }}</h2>
                    @if($product->package_price && $product->package_price < $product->price)
                        <div>
                            <span class="badge bg-success">Combo Price: ₹{{ number_format($product->package_price) }}</span>
                            <small class="text-muted d-block">Save ₹{{ number_format($product->price - $product->package_price) }} in combo</small>
                        </div>
                    @endif
                </div>
            </div>

            @if($product->in_stock)
                <span class="badge bg-success mb-3"><i class="fas fa-check-circle me-1"></i> In Stock</span>
            @else
                <span class="badge bg-danger mb-3"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
            @endif

            <div class="mb-4">
                <h5>Description</h5>
                <p class="text-muted">{{ $product->description ?? 'High-quality furniture item perfect for your home.' }}</p>
            </div>

            @if($product->specifications)
                <div class="mb-4">
                    <h5>Specifications</h5>
                    <p class="text-muted">{{ $product->specifications }}</p>
                </div>
            @endif

            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg add-to-combo-detail" 
                    data-product-id="{{ $product->id }}" 
                    data-product-name="{{ $product->name }}" 
                    data-price="{{ $product->price }}" 
                    data-package-price="{{ $product->package_price ?? $product->price }}">
                    <i class="fas fa-plus me-2"></i>Add to Custom Combo
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
    </div>

    <!-- Related Products for Combo -->
    @if($relatedProducts->count() > 0)
    <section class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Create Your Combo</h3>
            <p class="text-muted mb-0">Select 2 more items to get combo pricing</p>
        </div>

        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm product-card">
                    <a href="{{ route('frontend.products.show', $related->slug) }}" class="text-decoration-none">
                        <div class="product-image" style="height: 200px; overflow: hidden;">
                            @if($related->image)
                                <img src="{{ $related->image }}" class="card-img-top" alt="{{ $related->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="bg-secondary" style="width: 100%; height: 100%;"></div>
                            @endif
                        </div>
                    </a>
                    <div class="card-body">
                        <small class="text-muted">{{ $related->category->name }}</small>
                        <h6 class="card-title mt-1">
                            <a href="{{ route('frontend.products.show', $related->slug) }}" class="text-dark text-decoration-none">
                                {{ $related->name }}
                            </a>
                        </h6>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="h6 mb-0 text-primary">₹{{ number_format($related->price) }}</span>
                                @if($related->package_price)
                                    <br><small class="text-success">Combo: ₹{{ number_format($related->package_price) }}</small>
                                @endif
                            </div>
                            <button class="btn btn-sm btn-outline-primary add-to-combo" 
                                data-product-id="{{ $related->id }}" 
                                data-product-name="{{ $related->name }}" 
                                data-price="{{ $related->price }}" 
                                data-package-price="{{ $related->package_price ?? $related->price }}">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>

<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}
.product-image-container img {
    max-height: 500px;
    object-fit: contain;
}
</style>
@endsection
