@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    /* Modern Hero Carousel */
    .hero-slide {
        min-height: 650px;
        display: flex;
        align-items: center;
        position: relative;
    }
    
    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.9) 0%, rgba(16, 185, 129, 0.8) 100%);
    }
    
    .hero-slide .container {
        position: relative;
        z-index: 10;
    }
    
    /* Modern Section Styling */
    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: #1F2937;
    }
    
    .section-subtitle {
        font-size: 1.125rem;
        color: #6B7280;
        margin-bottom: 3rem;
    }
    
    /* Amazon-Style Package Cards */
    .package-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .modern-package-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #E5E7EB;
        position: relative;
    }
    
    .modern-package-card:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        transform: translateY(-4px);
        border-color: var(--primary-color);
    }
    
    .package-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: linear-gradient(135deg, #F59E0B, #EF4444);
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 10;
    }
    
    .package-image-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
        background: #F3F4F6;
    }
    
    .package-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    
    .modern-package-card:hover .package-image-wrapper img {
        transform: scale(1.08);
    }
    
    .package-content {
        padding: 1.5rem;
    }
    
    .package-name {
        font-size: 1.375rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    
    .package-description {
        font-size: 0.875rem;
        color: #6B7280;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .package-price-section {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .package-price {
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent-color);
    }
    
    .package-price-label {
        font-size: 0.875rem;
        color: #6B7280;
    }
    
    .package-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }
    
    .feature-tag {
        background: #F3F4F6;
        color: #374151;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .package-cta {
        width: 100%;
        padding: 12px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .package-cta:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #F9FAFB 0%, #FFFFFF 100%);
        padding: 3rem 0;
        border-top: 1px solid #E5E7EB;
        border-bottom: 1px solid #E5E7EB;
    }
    
    .stat-item {
        text-align: center;
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--primary-color);
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 1rem;
        color: #6B7280;
        font-weight: 500;
    }
    
    /* Why Choose Section */
    .why-choose-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .feature-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }
    
    .feature-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.75rem;
    }
    
    .feature-description {
        font-size: 0.9375rem;
        color: #6B7280;
        line-height: 1.6;
    }
</style>
@endsection

@section('content')
    {{-- Modern Hero Carousel --}}
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <div class="hero-slide" style="background: url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&q=80') center/cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 text-white">
                                <h1 class="display-2 fw-bold mb-4 animate__animated animate__fadeInUp">
                                    {{ \App\Models\SiteSetting::get('site_name', 'Wedding Essentials') }} Collection
                                </h1>
                                <p class="lead mb-4 fs-4 animate__animated animate__fadeInUp animate__delay-1s">
                                    Everything you need for your new beginning. Premium quality furniture at unbeatable prices.
                                </p>
                                <div class="animate__animated animate__fadeInUp animate__delay-2s">
                                    <a href="{{ route('frontend.packages.index') }}" class="btn btn-warning btn-lg px-5 py-3 me-3 shadow-lg rounded-pill">
                                        <i class="fas fa-box-open me-2"></i>Explore Packages
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5 py-3 shadow-lg rounded-pill">
                                        <i class="fas fa-user-plus me-2"></i>Get Started
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Slide 2 --}}
            <div class="carousel-item">
                <div class="hero-slide" style="background: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?w=1920&q=80') center/cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 text-white">
                                <h1 class="display-2 fw-bold mb-4">Packages Starting ₹50,000</h1>
                                <p class="lead mb-4 fs-4">
                                    Customize your package. Add or remove items as per your needs. Real-time price updates!
                                </p>
                                <a href="{{ route('frontend.packages.index') }}" class="btn btn-warning btn-lg px-5 py-3 shadow-lg rounded-pill">
                                    <i class="fas fa-tags me-2"></i>View All Packages
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Slide 3 --}}
            <div class="carousel-item">
                <div class="hero-slide" style="background: url('https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=1920&q=80') center/cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 text-white">
                                <h1 class="display-2 fw-bold mb-4">Free Delivery & Installation</h1>
                                <p class="lead mb-4 fs-4">
                                    Hassle-free delivery and professional installation. Warranty included on all items.
                                </p>
                                <a href="{{ route('frontend.packages.index') }}" class="btn btn-warning btn-lg px-5 py-3 shadow-lg rounded-pill">
                                    <i class="fas fa-truck me-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Stats Section --}}
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ \App\Models\Product::count() }}+</div>
                        <div class="stat-label">Quality Products</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ \App\Models\Package::count() }}</div>
                        <div class="stat-label">Curated Packages</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Satisfaction Guaranteed</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Packages Section --}}
    <section class="py-5" style="background: #FFFFFF;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Curated Wedding Packages</h2>
                <p class="section-subtitle">Choose from our expertly curated packages or customize your own</p>
            </div>
            
            <div class="package-grid">
                @foreach(\App\Models\Package::take(6)->get() as $package)
                <div class="modern-package-card">
                    @if($loop->index < 2)
                        <span class="package-badge">Popular</span>
                    @endif
                    
                    <div class="package-image-wrapper">
                        <img src="{{ $package->image ? asset('storage/' . $package->image) : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80' }}" alt="{{ $package->name }}">
                    </div>
                    
                    <div class="package-content">
                        <h3 class="package-name">{{ $package->name }}</h3>
                        <p class="package-description">{{ Str::limit($package->description, 100) }}</p>
                        
                        <div class="package-price-section">
                            <span class="package-price">₹{{ number_format($package->price) }}</span>
                            <span class="package-price-label">Starting Price</span>
                        </div>
                        
                        <div class="package-features">
                            <span class="feature-tag"><i class="fas fa-box me-1"></i>{{ $package->items()->count() }} Items</span>
                            <span class="feature-tag"><i class="fas fa-truck me-1"></i>Free Delivery</span>
                            <span class="feature-tag"><i class="fas fa-tools me-1"></i>Free Installation</span>
                        </div>
                        
                        <a href="{{ route('frontend.packages.show', $package->slug) }}" class="package-cta">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('frontend.packages.index') }}" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill">
                    View All Packages <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Why Choose Us Section --}}
    <section class="py-5" style="background: linear-gradient(135deg, #F9FAFB 0%, #FFFFFF 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Why Choose Us?</h2>
                <p class="section-subtitle">We make your wedding furniture shopping hassle-free</p>
            </div>
            
            <div class="why-choose-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h5 class="feature-title">Quality Assured</h5>
                    <p class="feature-description">Premium quality furniture with warranty on all products</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h5 class="feature-title">Free Delivery</h5>
                    <p class="feature-description">Free delivery and professional installation across India</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <h5 class="feature-title">Fully Customizable</h5>
                    <p class="feature-description">Add or remove items from packages as per your needs</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h5 class="feature-title">Best Prices</h5>
                    <p class="feature-description">Competitive pricing with transparent cost breakdown</p>
                </div>
            </div>
        </div>
    </section>
@endsection
