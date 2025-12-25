@extends('adminlte::page')

@section('title', 'Packages')

@section('content_header')
    <h1>Packages <a href="{{ route('admin.packages.create') }}" class="btn btn-primary float-right">Add New</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Base Price</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->id }}</td>
                        <td>{{ $package->name }}</td>
                        <td>₹{{ number_format($package->base_price) }}</td>
                        <td>{{ $package->items_count }} Items</td>
                        <td>
                            <span class="badge badge-{{ $package->status ? 'success' : 'danger' }}">
                                {{ $package->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $packages->links() }}
        </div>
    </div>
@stop

@section('js')
    @include('admin.partials.delete-confirm')
@stop
