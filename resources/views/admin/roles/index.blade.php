@extends('adminlte::page')

@section('title', 'Role Management')

@section('content_header')
    <h1>Role Management</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Roles</h3>
        <div class="card-tools">
            @can('manage roles')
            <a class="btn btn-success btn-sm" href="{{ route('admin.roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
          <tr>
             <th>No</th>
             <th>Name</th>
             <th width="280px">Action</th>
          </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <!-- <a class="btn btn-info btn-sm" href="{{ route('admin.roles.show',$role->id) }}">Show</a> -->
                    @can('manage roles')
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit',$role->id) }}">Edit</a>
                        
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
