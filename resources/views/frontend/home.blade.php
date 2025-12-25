@extends('layouts.frontend')

@section('content')
        <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Wedding Essentials Collection</h1>
            <p class="lead mb-5">Everything you need for a new beginning. Customizable packages starting from ₹50,000.</p>
            <a href="{{ route('frontend.packages.index') }}" class="btn btn-primary btn-lg px-5 rounded-pill">View Packages</a>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="row text-center">
    <!-- Hero Carousel Slider -->
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-slide" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&q=80'); background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row align-items-center" style="min-height: 600px;">
                            <div class="col-lg-7 text-white">
                                <h1 class="display-2 fw-bold mb-4 animate__animated animate__fadeInUp">Wedding Essentials Collection</h1>
                                <p class="lead mb-4 fs-4 animate__animated animate__fadeInUp animate__delay-1s">Everything you need for your new beginning. Premium quality furniture at unbeatable prices.</p>
                                <div class="animate__animated animate__fadeInUp animate__delay-2s">
                                    <a href="{{ route('frontend.packages.index') }}" class="btn btn-warning btn-lg px-5 py-3 me-3 shadow-lg">
                                        <i class="fas fa-eye me-2"></i>Explore Packages
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5 py-3 shadow-lg">
                                        <i class="fas fa-user-plus me-2"></i>Get Started
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide" style="background: linear-gradient(rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8)), url('https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?w=1920&q=80'); background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row align-items-center" style="min-height: 600px;">
                            <div class="col-lg-7 text-white">
                                <h1 class="display-2 fw-bold mb-4">Packages Starting ₹50,000</h1>
                                <p class="lead mb-4 fs-4">Customize your package. Add or remove items as per your needs. Real-time price updates!</p>
                                <a href="{{ route('frontend.packages.index') }}" class="btn btn-light btn-lg px-5 py-3 shadow-lg">
                                    <i class="fas fa-shopping-cart me-2"></i>View Packages
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide" style="background: linear-gradient(rgba(240, 147, 251, 0.7), rgba(245, 87, 108, 0.7)), url('https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=1920&q=80'); background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row align-items-center" style="min-height: 600px;">
                            <div class="col-lg-7 text-white">
                                <h1 class="display-2 fw-bold mb-4">Free Delivery & Installation</h1>
                                <p class="lead mb-4 fs-4">Get your complete home setup delivered and installed for free! 2 Year Warranty on Premium Packages.</p>
                                <a href="{{ route('frontend.packages.index') }}" class="btn btn-success btn-lg px-5 py-3 shadow-lg">
                                    <i class="fas fa-truck me-2"></i>Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" style="width: 3rem; height: 3rem;"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" style="width: 3rem; height: 3rem;"></span>
        </button>
    </div>

    <!-- Featured Packages Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Curated Wedding Packages</h2>
                <p class="text-muted">Choose from our curated packages or customize your own</p>
            </div>
            <div class="row g-4">
                @foreach($featured_packages as $package)
                <div class="col-lg-4 col-md-6">
                    <div class="card package-card h-100 shadow-sm hover-lift">
                        <div class="package-badge">
                            @if($package->base_price >= 250000)
                                <span class="badge bg-warning text-dark">Premium</span>
                            @elseif($package->base_price >= 150000)
                                <span class="badge bg-info">Popular</span>
                            @else
                                <span class="badge bg-success">Best Value</span>
                            @endif
                        </div>
                        @if($package->image)
                            <img src="{{ $package->image }}" alt="{{ $package->name }}" style="height: 200px; width: 100%; object-fit: cover;">
                        @else
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 200px; display: flex; align-items: center; justify-content: center;">
                                <h4 class="text-white text-center px-3">{{ $package->name }}</h4>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $package->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($package->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                <div>
                                    <div class="h4 mb-0 text-primary fw-bold">₹{{ number_format($package->base_price) }}</div>
                                    <small class="text-muted">Starting Price</small>
                                </div>
                                <span class="badge bg-light text-dark border">{{ $package->items_count }} Items</span>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted"><i class="fas fa-check-circle text-success me-1"></i>{{ $package->features }}</small>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('frontend.packages.show', $package->slug) }}" class="btn btn-primary w-100">
                                <i class="fas fa-eye me-2"></i>View & Customize
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('frontend.packages.index') }}" class="btn btn-outline-primary btn-lg px-5">View All Packages</a>
            </div>
        </div>
    </section>

    <!-- Product Showcase Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Our Products</h2>
                <p class="text-muted">Browse our extensive collection of furniture and appliances</p>
            </div>
            
            
            <!-- Category Tabs -->
            <ul class="nav nav-pills justify-content-center mb-4" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab">
                        All Products
                    </button>
                </li>
                @foreach($products->groupBy('category_id') as $categoryId => $categoryProducts)
                    @php $category = $categoryProducts->first()->category; @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cat-{{ $category->id }}-tab" data-bs-toggle="pill" data-bs-target="#cat-{{ $category->id }}" type="button" role="tab">
                            {{ $category->name }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Products Grid -->
            <div class="tab-content">
                <!-- All Products Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="row g-4">
                        @foreach($products->take(12) as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card product-card h-100 shadow-sm">
                                <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-decoration-none">
                                    <div class="product-image" style="height: 200px; overflow: hidden;">
                                        @if($product->image)
                                            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary" style="width: 100%; height: 100%;"></div>
                                        @endif
                                    </div>
                                </a>
                                <div class="card-body">
                                    <small class="text-muted">{{ $product->category->name }}</small>
                                    <h6 class="card-title mt-1">
                                        <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-dark text-decoration-none">
                                            {{ $product->name }}
                                        </a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="h6 mb-0 text-primary">₹{{ number_format($product->price) }}</span>
                                            @if($product->package_price)
                                                <br><small class="text-success">Combo: ₹{{ number_format($product->package_price) }}</small>
                                            @endif
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary add-to-combo" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-price="{{ $product->price }}" data-package-price="{{ $product->package_price ?? $product->price }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Category-wise Tabs -->
                @foreach($products->groupBy('category_id') as $categoryId => $categoryProducts)
                    @php $category = $categoryProducts->first()->category; @endphp
                    <div class="tab-pane fade" id="cat-{{ $category->id }}" role="tabpanel">
                        <div class="row g-4">
                            @foreach($categoryProducts as $product)
                            <div class="col-md-3">
                                <div class="card h-100 shadow-sm product-card">
                                    <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-decoration-none">
                                        @if($product->image)
                                            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary" style="height: 200px;"></div>
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-dark text-decoration-none">
                                                {{ $product->name }}
                                            </a>
                                        </h6>
                                        <p class="text-muted small mb-2">{{ $product->category->name }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="fw-bold text-primary">₹{{ number_format($product->price) }}</span>
                                                @if($product->package_price)
                                                    <br><small class="text-success">Combo: ₹{{ number_format($product->package_price) }}</small>
                                                @endif
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary add-to-combo" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-price="{{ $product->price }}" data-package-price="{{ $product->package_price ?? $product->price }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Why Choose Us?</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h5>Quality Assured</h5>
                    <p class="text-muted">Premium quality furniture with warranty</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-truck fa-3x text-primary"></i>
                    </div>
                    <h5>Free Delivery</h5>
                    <p class="text-muted">Free delivery and installation</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-sliders-h fa-3x text-primary"></i>
                    </div>
                    <h5>Customizable</h5>
                    <p class="text-muted">Add or remove items as needed</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-tags fa-3x text-primary"></i>
                    </div>
                    <h5>Best Prices</h5>
                    <p class="text-muted">Competitive pricing guaranteed</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
        }
        .package-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }
        .product-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .nav-pills .nav-link {
            color: #666;
            margin: 0 5px;
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
        .combo-item {
            padding: 8px;
            background: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endsection
