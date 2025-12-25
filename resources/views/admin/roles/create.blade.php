@extends('adminlte::page')

@section('title', 'Create New Role')

@section('content_header')
    <h1>Create New Role</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Role</h3>
        <div class="card-tools">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.roles.index') }}"> Back</a>
        </div>
    </div>
    
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>

            <div class="form-group">
                <label>Permission:</label>
                <div class="row">
                    @foreach($permissions as $value)
                        <div class="col-md-3">
                            <label>
                                <input type="checkbox" name="permission[]" value="{{ $value->name }}" class="name">
                                {{ $value->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop
