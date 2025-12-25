@extends('adminlte::page')

@section('title', 'Edit Popup')

@section('content_header')
    <h1>Edit Popup</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admin.popups.update', $popup->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $popup->title }}" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" class="form-control" rows="3">{{ $popup->message }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Popup Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Upload new image (JPG, PNG, WEBP) - Leave empty to keep current</small>
                    @if($popup->image)
                        <div class="mt-2">
                            <img src="{{ $popup->image }}" alt="Current Image" style="max-width: 300px; height: auto;">
                        </div>
                    @endif
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Display Duration (seconds)</label>
                            <input type="number" name="display_duration" class="form-control" value="{{ $popup->display_duration }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Display Interval (seconds)</label>
                            <input type="number" name="display_interval" class="form-control" value="{{ $popup->display_interval }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Link to Package (Optional)</label>
                    <select name="package_id" class="form-control">
                        <option value="">Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ $popup->package_id == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" {{ $popup->status ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Active</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Popup</button>
            </div>
        </form>
    </div>
@stop
