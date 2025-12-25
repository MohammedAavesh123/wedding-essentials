@extends('adminlte::page')

@section('title', 'Add Category')

@section('content_header')
    <h1>Add Category</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Select Icon</label>
                    @include('admin.partials.icon-picker', ['selectedIcon' => 'fa-couch'])
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                        <label class="custom-control-label" for="status">Active</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
@stop

@section('css')
<style>
.icon-option {
    display: block;
    text-align: center;
    padding: 15px 10px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
}
.icon-option:hover {
    border-color: #007bff;
    background: #f8f9fa;
    transform: translateY(-2px);
}
.icon-radio:checked + .icon-option {
    border-color: #007bff;
    background: #e7f3ff;
    box-shadow: 0 0 10px rgba(0,123,255,0.3);
}
.icon-option i {
    color: #6c757d;
}
.icon-radio:checked + .icon-option i {
    color: #007bff;
}
</style>
@stop
