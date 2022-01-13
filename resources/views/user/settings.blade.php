@extends('layouts.user')

@section('main')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">User Settings</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">User Settings</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.password') }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Old Password</label>
                        <div class="col-lg-9">
                            @error('old_password')
                                <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                            @enderror
                            <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}">
                        </div>
                    </div>                                    
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">New Password</label>
                        <div class="col-lg-9">
                            @error('new_password')
                                <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                            @enderror
                            <input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Confirm Password</label>
                        <div class="col-lg-9">
                            @error('confirm_password')
                                <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                            @enderror
                            <input type="password" class="form-control" name="confirm_password" value="{{ old('confirm_password') }}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
</div>
@endsection