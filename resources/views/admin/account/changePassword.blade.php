@extends('admin.layouts.common')

@section('title','Password Change Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin-changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror @if(session('oldPassword_status')) is-invalid @endif" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if (session('oldPassword_status'))
                                <div class="invalid-feedback">
                                    {{ session('oldPassword_status') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm your new Password...">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-up"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
