@extends('front.master')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="alert alert-{{ session('type') }}">
                {{ session('msg') }}
            </div>
        </div>
    </div>
</div>
@endsection
