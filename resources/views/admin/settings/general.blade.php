@extends('adminlte::page')

@section('title', 'General Settings')

@section('content_header')
    <h1>General Settings</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Website Configuration</h3>
        </div>
        <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="site_name">Site Name <span class="text-danger">*</span></label>
                            <input type="text" name="site_name" id="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $settings->site_name) }}" required>
                            @error('site_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_email">Contact Email</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email', $settings->contact_email) }}">
                            @error('contact_email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_phone">Contact Phone</label>
                            <input type="text" name="contact_phone" id="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" value="{{ old('contact_phone', $settings->contact_phone) }}">
                            @error('contact_phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="site_logo">Site Logo</label>
                            <div class="custom-file">
                                <input type="file" name="site_logo" id="site_logo" class="custom-file-input @error('site_logo') is-invalid @enderror" accept="image/*">
                                <label class="custom-file-label" for="site_logo">Choose file</label>
                            </div>
                            @if($settings->site_logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" style="max-height: 100px;">
                                </div>
                            @endif
                            @error('site_logo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $settings->address) }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <hr>
                <h5>Social Media Links</h5>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facebook_url">Facebook URL</label>
                            <input type="url" name="facebook_url" id="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/yourpage">
                            @error('facebook_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instagram_url">Instagram URL</label>
                            <input type="url" name="instagram_url" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/yourpage">
                            @error('instagram_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="twitter_url">Twitter URL</label>
                            <input type="url" name="twitter_url" id="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url', $settings->twitter_url) }}" placeholder="https://twitter.com/yourpage">
                            @error('twitter_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
@stop

@section('js')
<script>
// Custom file input label update
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);
});
</script>
@stop
