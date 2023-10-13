@extends('admin.layouts.common')

@section('title','Account Center Edit Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <h3 class="text-center title-2">Edit Your Account info</h3>
                        </div>
                        <form action="{{ route('admin-accountInfoUpdate',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-3 offset-1">
                                    @if (Auth::user()->image == NULL)
                                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle"/>
                                    @endif
                                    <input type="file" class="form-control shadow-sm mt-3" name="image" >
                                </div>
                                <div class="col-6 pt-2 offset-1">
                                        <div class="form-group row">
                                            <div class="col">
                                                <div class="my-4">
                                                    <label for="name" class="control-label mb-1"><i class="fa-solid fa-signature text-primary"></i> Name</label>
                                                    <input type="text" name="name" value="{{ old('name',Auth::user()->name) }}" class="form-control shadow-sm @error('name') is-invalid @enderror">
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="my-4">
                                                    <label for="email" class="control-label mb-1"><i class="fa-solid fa-envelope text-warning"></i> Email</label>
                                                    <input type="text" name="email" value="{{ old('email',Auth::user()->email) }}" class="form-control shadow-sm @error('email') is-invalid @enderror">
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <div class="my-4">
                                                    <label for="phone" class="control-label mb-1"><i class="fa-solid fa-phone text-success"></i> Phone</label>
                                                    <input type="text" name="phone" value="{{ old('phone',Auth::user()->phone) }}" class="form-control shadow-sm @error('phone') is-invalid @enderror">
                                                </div>
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="my-4">
                                                    <label for="address" class="control-label mb-1"><i class="fa-solid fa-location-dot text-danger"></i> Address</label>
                                                    <input type="text" name="address" value="{{ old('address',Auth::user()->address) }}" class="form-control shadow-sm @error('address') is-invalid @enderror">
                                                </div>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div style="margin-left:-190px" class="mt-5">
                                            <button type="submit" class="btn btn-info btn-lg col-12 w-75">Update Info <i class="fa-solid fa-circle-up ms-1"></i></button>
                                        </div>
                                </div>
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
