@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h3 class="font-weight-light my-1">Admin Login</h3>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus />
                            <label for="inputEmail">Email address</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Password" required />
                            <label for="inputPassword">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button type="submit" class="btn btn-dark btn-lg w-100">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer py-3">
                    <div class="text-center mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text-dark">Back to Home</a>
                    </div>
                    <hr>
                    <div class="small text-muted">
                        <strong>Test Credentials:</strong><br>
                        <span class="badge bg-dark">Admin</span> admin@dahejsaman.com / password123
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
