@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Left Column: Package Details & Customization -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                @if($package->image)
                    <img src="{{ $package->image }}" alt="{{ $package->name }}" style="height: 400px; width: 100%; object-fit: cover;">
                @else
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 400px; display: flex; align-items: center; justify-content: center;">
                        <h1 class="text-white text-center px-4">{{ $package->name }}</h1>
                    </div>
                @endif
                <div class="card-body">
                    <h1 class="fw-bold">{{ $package->name }}</h1>
                    <p class="text-muted">{{ $package->description }}</p>
                    <hr>
                    
                    <h4 class="mb-4"><i class="fas fa-check-circle text-success me-2"></i>Included Items (Default)</h4>
                    <div class="row" id="default-items-container">
                        @php
                            $defaultByCategory = $defaultItems->groupBy('product.category.name');
                        @endphp
                        @foreach($defaultByCategory as $categoryName => $items)
                            <div class="col-12 mb-3">
                                <h5 class="text-primary"><i class="fas fa-tag me-2"></i>{{ $categoryName }}</h5>
                            </div>
                            @foreach($items as $item)
                            <div class="col-md-6 mb-3 item-card" data-id="{{ $item->id }}" data-price="{{ $item->product->price }}" data-type="default" data-category="{{ $item->product->category_id }}">
                                <div class="card h-100 border-primary">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                                            <small class="text-muted">{{ $item->product->category->name }}</small>
                                            <div class="text-primary fw-bold mt-1">₹{{ number_format($item->product->price) }}</div>
                                        </div>
                                        <button class="btn btn-outline-danger btn-sm remove-item-btn" onclick="toggleItem(this)">
                                            <i class="fas fa-times"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                    </div>

                    <h4 class="mb-4 mt-5"><i class="fas fa-plus-circle text-primary me-2"></i>Add More Items (Optional)</h4>
                    <div class="row" id="optional-items-container">
                        @php
                            $optionalByCategory = $optionalItems->groupBy('product.category.name');
                        @endphp
                        @foreach($optionalByCategory as $categoryName => $items)
                            <div class="col-12 mb-3">
                                <h5 class="text-info"><i class="fas fa-tag me-2"></i>{{ $categoryName }}</h5>
                            </div>
                            @foreach($items as $item)
                            <div class="col-md-6 mb-3 item-card" data-id="{{ $item->id }}" data-price="{{ $item->product->package_price ?? $item->product->price }}" data-type="optional" data-category="{{ $item->product->category_id }}">
                                <div class="card h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                                            <small class="text-muted">{{ $item->product->category->name }}</small>
                                            <div class="text-primary fw-bold mt-1">
                                                ₹{{ number_format($item->product->package_price ?? $item->product->price) }}
                                                @if($item->product->package_price < $item->product->price)
                                                    <small class="text-muted text-decoration-line-through ms-1">₹{{ number_format($item->product->price) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm add-item-btn" onclick="toggleItem(this)">
                                            <i class="fas fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Price Summary Sticky -->
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 100px;">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calculator me-2"></i>Price Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Base Package Price:</span>
                        <span class="fw-bold">₹{{ number_format($package->base_price) }}</span>
                    </div>
                    <hr>
                    <div id="price-breakdown">
                        <!-- Dynamic content -->
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 mb-0">Total Price:</span>
                        <span class="h4 mb-0 text-primary fw-bold" id="total-price">₹{{ number_format($package->base_price) }}</span>
                    </div>

                    <form action="{{ route('frontend.booking.create', $package->slug) }}" method="GET" id="booking-form">
                        <input type="hidden" name="customized_items" id="customized-items-input">
                        <input type="hidden" name="final_price" id="final-price-input">
                        
                        <button type="submit" class="btn btn-success btn-lg w-100 mb-2">
                            <i class="fas fa-check-circle me-2"></i>Book Now
                        </button>
                    </form>
                    <button class="btn btn-outline-secondary w-100">
                        <i class="fas fa-file-pdf me-2"></i>Download Quote
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const basePrice = {{ $package->base_price }};
    let currentPrice = basePrice;
    let removedItems = [];
    let addedItems = [];
    
    // Initial state: all default items are "included"
    // We track modifications relative to the base package.

    function toggleItem(btn) {
        const card = $(btn).closest('.item-card');
        const id = card.data('id');
        const price = parseFloat(card.data('price'));
        const type = card.data('type');
        const isSelected = $(btn).hasClass('btn-outline-danger'); // Currently selected/included

        if (type === 'default') {
            if (isSelected) {
                // Remove default item
                $(btn).removeClass('btn-outline-danger').addClass('btn-outline-secondary').html('<i class="fas fa-undo"></i> Restore');
                card.find('.card').removeClass('border-primary').addClass('bg-light text-muted');
                currentPrice -= price;
                removedItems.push(id);
            } else {
                // Restore default item
                $(btn).removeClass('btn-outline-secondary').addClass('btn-outline-danger').html('<i class="fas fa-times"></i> Remove');
                card.find('.card').addClass('border-primary').removeClass('bg-light text-muted');
                currentPrice += price;
                removedItems = removedItems.filter(itemId => itemId !== id);
            }
        } else {
            // Optional item
            if (isSelected) {
                // Remove added optional item
                $(btn).removeClass('btn-outline-danger').addClass('btn-outline-primary').html('<i class="fas fa-plus"></i> Add');
                card.find('.card').removeClass('border-success bg-light');
                currentPrice -= price;
                addedItems = addedItems.filter(itemId => itemId !== id);
            } else {
                // Add optional item
                $(btn).removeClass('btn-outline-primary').addClass('btn-outline-danger').html('<i class="fas fa-minus"></i> Remove');
                card.find('.card').addClass('border-success bg-light');
                currentPrice += price;
                addedItems.push(id);
            }
        }

        updatePriceSummary();
    }

    function updatePriceSummary() {
        $('#total-price').text('₹' + currentPrice.toLocaleString('en-IN'));
        
        let breakdownHtml = '';
        if (removedItems.length > 0) {
            breakdownHtml += `<div class="text-danger mb-1"><small>Removed Items: -₹${calculateTotal(removedItems).toLocaleString('en-IN')}</small></div>`;
        }
        if (addedItems.length > 0) {
            breakdownHtml += `<div class="text-success mb-1"><small>Added Items: +₹${calculateTotal(addedItems).toLocaleString('en-IN')}</small></div>`;
        }
        $('#price-breakdown').html(breakdownHtml);

        // Update form inputs
        const customization = {
            removed: removedItems,
            added: addedItems
        };
        $('#customized-items-input').val(JSON.stringify(customization));
        $('#final-price-input').val(currentPrice);
    }

    function calculateTotal(itemIds) {
        let total = 0;
        $('.item-card').each(function() {
            const id = $(this).data('id');
            if (itemIds.includes(id)) {
                total += parseFloat($(this).data('price'));
            }
        });
        return total;
    }

    // Initialize
    updatePriceSummary();
</script>
@endsection
