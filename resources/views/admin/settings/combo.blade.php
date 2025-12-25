@extends('adminlte::page')

@section('title', 'Combo Settings')

@section('content_header')
    <h1>Combo Settings</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Configure Combo Builder</h3>
        </div>
        <form action="{{ route('admin.settings.combo.update') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="max_combo_items">Maximum Combo Items <span class="text-danger">*</span></label>
                    <input type="number" 
                           name="max_combo_items" 
                           id="max_combo_items" 
                           class="form-control @error('max_combo_items') is-invalid @enderror" 
                           value="{{ old('max_combo_items', $maxComboItems) }}" 
                           min="2" 
                           max="10" 
                           required>
                    <small class="form-text text-muted">
                        Set the maximum number of items customers can add to a combo (2-10 items)
                    </small>
                    @error('max_combo_items')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Note:</strong> This setting controls how many products customers can select when building a custom combo on the frontend.
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
