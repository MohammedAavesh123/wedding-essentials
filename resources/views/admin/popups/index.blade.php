@extends('adminlte::page')

@section('title', 'Popup Notifications')

@section('content_header')
    <h1>Popups <a href="{{ route('admin.popups.create') }}" class="btn btn-primary float-right">Add New</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Duration (s)</th>
                        <th>Interval (s)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popups as $popup)
                    <tr>
                        <td>{{ $popup->title }}</td>
                        <td>{{ $popup->display_duration }}</td>
                        <td>{{ $popup->display_interval }}</td>
                        <td>
                            <span class="badge badge-{{ $popup->status ? 'success' : 'danger' }}">
                                {{ $popup->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.popups.edit', $popup->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.popups.destroy', $popup->id) }}" method="POST" style="display:inline;">
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
            {{ $popups->links() }}
        </div>
    </div>
@stop

@section('js')
    @include('admin.partials.delete-confirm')
@stop
