@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    @if(!$errors->isEmpty())
    <div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert"">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h1 class="mt-5 mb-4">Reset Password</h1>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Reset Password</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        @method('put')
                         <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection