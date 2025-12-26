@extends('layouts.frontend')

@section('css')
<style>
    /* Modern Packages Page Styling */
    .packages-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .packages-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }
    
    .packages-hero p {
        font-size: 1.25rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }
    
    .modern-package-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        border: 1px solid #E5E7EB;
        position: relative;
    }
    
    .modern-package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.15);
        border-color: var(--primary-color);
    }
    
    .package-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: linear-gradient(135deg, #F59E0B, #EF4444);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 10;
    }
    
    .package-image {
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    
    .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    
    .modern-package-card:hover .package-image img {
        transform: scale(1.08);
    }
    
    .package-content {
        padding: 2rem;
    }
    
    .package-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    .package-desc {
        font-size: 0.9375rem;
        color: #6B7280;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    
    .package-price-box {
        background: linear-gradient(135deg, #F9FAFB 0%, #FFFFFF 100%);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }
    
    .package-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--accent-color);
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .package-price-label {
        font-size: 0.875rem;
        color: #6B7280;
    }
    
    .package-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .feature-badge {
        background: #F3F4F6;
        color: #374151;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .feature-badge i {
        color: var(--primary-color);
    }
    
    .package-cta-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    
    .package-cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        color: white;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .packages-hero h1 {
            font-size: 2rem;
        }
        
        .packages-hero p {
            font-size: 1rem;
        }
        
        .packages-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .package-title {
            font-size: 1.5rem;
        }
        
        .package-price {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="packages-hero">
        <div class="container">
            <h1>Our Marriage Packages</h1>
            <p>Choose from our expertly curated packages or customize to match your needs perfectly</p>
        </div>
    </div>

    {{-- Packages Grid --}}
    <div class="container pb-5">
        <div class="packages-grid">
            @foreach($packages as $package)
            <div class="modern-package-card">
                @if($package->is_featured || $loop->index < 2)
                    <span class="package-badge">Popular</span>
                @endif
                
                <div class="package-image">
                    @if($package->image)
                        <img src="{{ Str::startsWith($package->image, ['http://', 'https://']) ? $package->image : asset('storage/' . $package->image) }}" 
                             alt="{{ $package->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80" 
                             alt="{{ $package->name }}">
                    @endif
                </div>
                
                <div class="package-content">
                    <h3 class="package-title">{{ $package->name }}</h3>
                    <p class="package-desc">{{ Str::limit($package->description, 120) }}</p>
                    
                    <div class="package-price-box">
                        <span class="package-price">₹{{ number_format($package->price ?? $package->base_price ?? 0) }}</span>
                        <span class="package-price-label">Starting Price</span>
                    </div>
                    
                    <div class="package-features">
                        <span class="feature-badge">
                            <i class="fas fa-box"></i>
                            {{ $package->items()->count() ?? $package->items_count ?? 0 }} Items
                        </span>
                        <span class="feature-badge">
                            <i class="fas fa-truck"></i>
                            Free Delivery
                        </span>
                        <span class="feature-badge">
                            <i class="fas fa-tools"></i>
                            Free Installation
                        </span>
                        <span class="feature-badge">
                            <i class="fas fa-shield-alt"></i>
                            Warranty
                        </span>
                    </div>
                    
                    <a href="{{ route('frontend.packages.show', $package->slug) }}" class="package-cta-btn">
                        View Details & Customize <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        @if($packages->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $packages->links() }}
        </div>
        @endif
    </div>
@endsection
