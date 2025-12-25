@extends('adminlte::page')

@section('title', 'Theme Settings')

@section('content_header')
    <h1>Theme Settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customize Theme Colors</h3>
                </div>
                <form action="{{ route('admin.settings.theme.update') }}" method="POST">
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
                                    <label for="primary_color">Primary Color</label>
                                    <div class="input-group">
                                        <input type="color" name="primary_color" id="primary_color" class="form-control @error('primary_color') is-invalid @enderror" value="{{ old('primary_color', $settings->primary_color) }}">
                                        <input type="text" class="form-control" value="{{ old('primary_color', $settings->primary_color) }}" readonly>
                                    </div>
                                    <small class="text-muted">Used for buttons, links, and primary actions</small>
                                    @error('primary_color')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="secondary_color">Secondary Color</label>
                                    <div class="input-group">
                                        <input type="color" name="secondary_color" id="secondary_color" class="form-control @error('secondary_color') is-invalid @enderror" value="{{ old('secondary_color', $settings->secondary_color) }}">
                                        <input type="text" class="form-control" value="{{ old('secondary_color', $settings->secondary_color) }}" readonly>
                                    </div>
                                    <small class="text-muted">Used for secondary elements and accents</small>
                                    @error('secondary_color')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="accent_color">Accent Color</label>
                                    <div class="input-group">
                                        <input type="color" name="accent_color" id="accent_color" class="form-control @error('accent_color') is-invalid @enderror" value="{{ old('accent_color', $settings->accent_color) }}">
                                        <input type="text" class="form-control" value="{{ old('accent_color', $settings->accent_color) }}" readonly>
                                    </div>
                                    <small class="text-muted">Used for highlights and special elements</small>
                                    @error('accent_color')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text_color">Text Color</label>
                                    <div class="input-group">
                                        <input type="color" name="text_color" id="text_color" class="form-control @error('text_color') is-invalid @enderror" value="{{ old('text_color', $settings->text_color) }}">
                                        <input type="text" class="form-control" value="{{ old('text_color', $settings->text_color) }}" readonly>
                                    </div>
                                    <small class="text-muted">Main text color</small>
                                    @error('text_color')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="background_color">Background Color</label>
                            <div class="input-group col-md-6">
                                <input type="color" name="background_color" id="background_color" class="form-control @error('background_color') is-invalid @enderror" value="{{ old('background_color', $settings->background_color) }}">
                                <input type="text" class="form-control" value="{{ old('background_color', $settings->background_color) }}" readonly>
                            </div>
                            <small class="text-muted">Page background color</small>
                            @error('background_color')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                        <h5>Preset Themes</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-block btn-outline-primary preset-theme" data-primary="#4F46E5" data-secondary="#10B981" data-accent="#F59E0B" data-text="#1F2937" data-bg="#F9FAFB">
                                    Modern Blue
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-block btn-outline-warning preset-theme" data-primary="#D4AF37" data-secondary="#1F2937" data-accent="#FFFFFF" data-text="#1F2937" data-bg="#F5F5DC">
                                    Luxury Gold
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-block btn-outline-purple preset-theme" data-primary="#7C3AED" data-secondary="#EC4899" data-accent="#FBBF24" data-text="#1F2937" data-bg="#FAF5FF">
                                    Royal Purple
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-block btn-outline-success preset-theme" data-primary="#059669" data-secondary="#0EA5E9" data-accent="#F97316" data-text="#1F2937" data-bg="#F0FDF4">
                                    Fresh Green
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Theme
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Live Preview</h3>
                </div>
                <div class="card-body" id="preview-area">
                    <button class="btn btn-lg btn-block mb-3" id="preview-primary">Primary Button</button>
                    <button class="btn btn-lg btn-block mb-3" id="preview-secondary">Secondary Button</button>
                    <div class="card mb-3" id="preview-card">
                        <div class="card-body">
                            <h5>Sample Card</h5>
                            <p id="preview-text">This is sample text to show how your theme colors will look.</p>
                            <span class="badge badge-lg" id="preview-badge">Accent Badge</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
// Update preview when colors change
$('input[type="color"]').on('change', function() {
    const name = $(this).attr('name');
    const value = $(this).val();
    
    // Update text input
    $(this).next('input[type="text"]').val(value);
    
    // Update preview
    updatePreview();
});

// Preset theme buttons
$('.preset-theme').on('click', function() {
    $('#primary_color').val($(this).data('primary')).trigger('change');
    $('#secondary_color').val($(this).data('secondary')).trigger('change');
    $('#accent_color').val($(this).data('accent')).trigger('change');
    $('#text_color').val($(this).data('text')).trigger('change');
    $('#background_color').val($(this).data('bg')).trigger('change');
});

function updatePreview() {
    const primary = $('#primary_color').val();
    const secondary = $('#secondary_color').val();
    const accent = $('#accent_color').val();
    const text = $('#text_color').val();
    const bg = $('#background_color').val();
    
    $('#preview-primary').css('background-color', primary).css('border-color', primary).css('color', '#fff');
    $('#preview-secondary').css('background-color', secondary).css('border-color', secondary).css('color', '#fff');
    $('#preview-badge').css('background-color', accent).css('color', '#fff');
    $('#preview-text').css('color', text);
    $('#preview-area').css('background-color', bg);
}

// Initial preview
updatePreview();
</script>
@stop
