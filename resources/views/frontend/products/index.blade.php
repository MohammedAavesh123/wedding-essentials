@extends('layouts.frontend')

@section('css')
<style>
    /* Products Page Styling */
    .products-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .products-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }
    
    .products-hero p {
        font-size: 1.25rem;
        opacity: 0.95;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #E5E7EB;
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        border-color: var(--primary-color);
    }
    
    .product-image {
        height: 240px;
        overflow: hidden;
        position: relative;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.08);
    }
    
    .product-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 10;
    }
    
    .product-content {
        padding: 1.5rem;
    }
    
    .product-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .product-category {
        font-size: 0.8125rem;
        color: #6B7280;
        margin-bottom: 1rem;
    }
    
    .product-price-box {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .product-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--accent-color);
    }
    
    .product-original-price {
        font-size: 1rem;
        color: #9CA3AF;
        text-decoration: line-through;
    }
    
    .product-cta {
        width: 100%;
        padding: 10px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    
    .product-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        color: white;
    }
    
    .add-combo-btn {
        position: absolute;
        bottom: 12px;
        right: 12px;
        width: 44px;
        height: 44px;
        background: white;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .add-combo-btn:hover {
        background: var(--primary-color);
        color: white;
        transform: scale(1.1) rotate(90deg);
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .products-hero h1 {
            font-size: 2rem;
        }
        
        .products-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="products-hero">
        <div class="container">
            <h1>Browse Our Products</h1>
            <p>Explore our wide range of premium furniture and appliances</p>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="container pb-5">
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                @if($product->in_stock)
                    <span class="product-badge">In Stock</span>
                @endif
                
                <a href="{{ route('frontend.products.show', $product->slug) }}">
                    <div class="product-image">
                        <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&q=80' }}" 
                             alt="{{ $product->name }}">
                    </div>
                </a>
                
                <div class="product-content">
                    <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-decoration-none">
                        <h3 class="product-title">{{ $product->name }}</h3>
                    </a>
                    <p class="product-category">
                        <i class="fas fa-tag me-1"></i>{{ $product->category->name ?? 'Uncategorized' }}
                    </p>
                    
                    <div class="product-price-box">
                        <span class="product-price">₹{{ number_format($product->price) }}</span>
                        @if($product->package_price && $product->package_price < $product->price)
                            <span class="product-original-price">₹{{ number_format($product->package_price) }}</span>
                        @endif
                    </div>
                    
                    <a href="{{ route('frontend.products.show', $product->slug) }}" class="product-cta">
                        View Details <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                
                <button class="add-combo-btn add-to-combo" 
                        data-product-id="{{ $product->id }}"
                        data-product-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                        data-package-price="{{ $product->package_price ?? $product->price }}"
                        title="Add to Custom Combo">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
        @endif
    </div>
@endsection
