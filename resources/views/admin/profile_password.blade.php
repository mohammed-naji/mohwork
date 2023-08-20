@extends('admin.app')


@section('content')



<div class="col-12">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="fas fa-user"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Update your password
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            @if (session('msg'))
                <div class="alert alert-{{ session('type') }}">
                    {{ session('msg') }}
                </div>
            @endif
            <form action="{{ route('admin.profile_password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Old Password</label>
                    <input type="password" name="old_password" class="form-control" />
                    @error('old_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" />
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" />
                </div>

                <button class="btn btn-success"><i class="fas fa-save"></i> Update</button>
            </form>

        </div>
    </div>
</div>

@endsection
