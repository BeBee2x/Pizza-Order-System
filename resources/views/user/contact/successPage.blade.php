@extends('user.layouts.master')

@section('contact','active')

@section('footer','d-none')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-5 pt-5">
        <div class="col-6 bg-light shadow rounded-4 p-3">
            <a href="{{ route('user-home') }}" class="fw-bold text-dark text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <h3 class="mt-4">Thanks for your message! <i class="fa-solid fa-paper-plane"></i></h3>
            <p class="my-4">Your message has been sent to admin team.</p>
            <div class="float-end">Enjoy your shopping <i class="fa-solid fa-heart"></i></div>
        </div>
    </div>
</div>
@endsection
