@extends('user.layouts.master')

@section('contact','active')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-6 bg-light shadow rounded-4 p-3">
            <div class="my-2 mb-4 fw-bold text-dark" style="cursor:pointer" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Back</div>
            <form action="{{ route('user-sendContactMessage') }}" method="post">
                @csrf
                <h3>Contact Form</h3>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ Auth::user()->name }}">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Your email" value="{{ Auth::user()->email }}">
                <label for="message">Message</label>
                <textarea name="message" cols="30" rows="10" class="form-control" placeholder="Your message"></textarea>
                <button class="btn btn-dark float-end px-4 m-3"><i class="fa-solid fa-paper-plane"></i> Send</button>
            </form>
        </div>
    </div>
</div>
@endsection
