@extends('adminlte::page')

@section('title', 'Add Package')

@section('content_header')
    <h1>Add Package</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Package Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Base Price</label>
                            <input type="number" name="base_price" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="auto_calculate_price" name="auto_calculate_price" checked>
                                <label class="custom-control-label" for="auto_calculate_price">Auto Calculate Price</label>
                            </div>
                            <div class="custom-control custom-switch mt-2">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                <label class="custom-control-label" for="is_featured">Featured Package</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Package Image</label>
                    <input type="file" name="image" id="package_image" class="form-control" accept="image/*">
                    <small class="text-muted">Upload package image (JPG, PNG, WEBP). Image will be stored as base64.</small>
                    <div id="image_preview" class="mt-2" style="display:none;">
                        <img id="preview_img" src="" alt="Preview" style="max-width: 300px; height: auto;">
                    </div>
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
                        <tr>
                            <td>
                                <select name="items[0][product_id]" class="form-control product-select" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} (₹{{ $product->price }})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="items[0][quantity]" class="form-control" value="1" min="1" required>
                            </td>
                            <td>
                                <select name="items[0][type]" class="form-control">
                                    <option value="default">Default (Included)</option>
                                    <option value="optional">Optional (Add-on)</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm mt-2" id="add_row">Add Item</button>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Package</button>
            </div>
        </form>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        let rowIdx = 1;
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

        // Image preview and base64 conversion
        $('#package_image').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Image size should be less than 2MB');
                    $(this).val('');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#preview_img').attr('src', event.target.result);
                    $('#image_preview').show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#image_preview').hide();
            }
        });
    });
</script>
@stop
