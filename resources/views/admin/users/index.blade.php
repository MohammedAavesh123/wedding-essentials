@extends('adminlte::page')

@section('title', 'Admin Management')

@section('content_header')
    <h1>Admin Management</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Admins</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.users.create') }}"> Create New Admin</a>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                    <span class="badge badge-success">{{ $v }}</span>
                    @endforeach
                @endif
                </td>
                <td>
                    <!-- <a class="btn btn-info btn-sm" href="{{ route('admin.users.show',$user->id) }}">Show</a> -->
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit',$user->id) }}">Edit</a>
                    @if(auth('admin')->id() != $user->id)
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
