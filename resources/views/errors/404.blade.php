@extends('front.master')

@section('content')

<div class="container text-center first-letter py-5 my-5">
    <img src="{{ asset('images/404-error.png') }}" alt="">
    <h1 class="mb-4 display-2">Page Not Found</h1>
    <a class="btn" href="{{ url('/') }}">Homepage</a>
</div>

@endsection
