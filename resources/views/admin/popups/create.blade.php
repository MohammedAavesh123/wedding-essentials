@extends('adminlte::page')

@section('title', 'Add Popup')

@section('content_header')
    <h1>Add Popup</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" class="form-control" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Display Duration (seconds)</label>
                            <input type="number" name="display_duration" class="form-control" value="30" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Display Interval (seconds)</label>
                            <input type="number" name="display_interval" class="form-control" value="180" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Popup Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Upload popup image (JPG, PNG, WEBP)</small>
                </div>
                <div class="form-group">
                    <label>Link to Package (Optional)</label>
                    <select name="package_id" class="form-control">
                        <option value="">Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                        <label class="custom-control-label" for="status">Active</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Popup</button>
            </div>
        </form>
    </div>
@stop
