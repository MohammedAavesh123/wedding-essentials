@extends('adminlte::page')

@section('title', 'Edit Package')

@section('content_header')
    <h1>Edit Package</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Package Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $package->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Base Price</label>
                            <input type="number" name="base_price" class="form-control" value="{{ $package->base_price }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $package->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="auto_calculate_price" name="auto_calculate_price" {{ $package->auto_calculate_price ? 'checked' : '' }}>
                                <label class="custom-control-label" for="auto_calculate_price">Auto Calculate Price</label>
                            </div>
                            <div class="custom-control custom-switch mt-2">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" {{ $package->is_featured ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">Featured Package</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Package Image URL</label>
                    <input type="url" name="image_url" class="form-control" value="{{ $package->image }}" placeholder="https://example.com/image.jpg">
                    <small class="text-muted">Enter image URL (e.g., from Unsplash, Imgur, etc.) - Vercel doesn't support file uploads</small>
                    @if($package->image)
                        <div class="mt-2">
                            <img src="{{ $package->image }}" alt="Package Image" style="max-width: 300px; height: auto;">
                        </div>
                    @endif
                </div>

                <hr>
                <h4>Package Items</h4>
                <table class="table table-bordered" id="items_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($package->items as $index => $item)
                        <tr>
                            <td>
                                <select name="items[{{ $index }}][product_id]" class="form-control product-select" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }} data-price="{{ $product->price }}">{{ $product->name }} (₹{{ $product->price }})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="items[{{ $index }}][quantity]" class="form-control" value="{{ $item->quantity }}" min="1" required>
                            </td>
                            <td>
                                <select name="items[{{ $index }}][type]" class="form-control">
                                    <option value="default" {{ $item->type == 'default' ? 'selected' : '' }}>Default (Included)</option>
                                    <option value="optional" {{ $item->type == 'optional' ? 'selected' : '' }}>Optional (Add-on)</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm mt-2" id="add_row">Add Item</button>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Package</button>
            </div>
        </form>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        let rowIdx = {{ $package->items->count() }};
        $('#add_row').click(function() {
            let html = `<tr>
                <td>
                    <select name="items[${rowIdx}][product_id]" class="form-control product-select" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} (₹{{ $product->price }})</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="items[${rowIdx}][quantity]" class="form-control" value="1" min="1" required>
                </td>
                <td>
                    <select name="items[${rowIdx}][type]" class="form-control">
                        <option value="default">Default (Included)</option>
                        <option value="optional">Optional (Add-on)</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                </td>
            </tr>`;
            $('#items_table tbody').append(html);
            rowIdx++;
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@stop
