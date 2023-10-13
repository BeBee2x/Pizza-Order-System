@extends('admin.layouts.common')

@section('title','Account Center Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <h3 class="text-center title-2">Account info</h3>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-1">
                                @if (Auth::user()->image == NULL)
                                    <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle"/>
                                @endif
                            </div>
                            <div class="col-6 pt-2 offset-1">
                                <form action="">
                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="my-4">
                                                <label for="categoryName" class="control-label mb-1"><i class="fa-solid fa-signature text-primary"></i> Name</label>
                                                <h4>{{ Auth::user()->name }}</h4>
                                            </div>
                                            <div class="my-4">
                                                <label for="categoryName" class="control-label mb-1"><i class="fa-solid fa-envelope text-warning"></i> Email</label>
                                                <h4>{{ Auth::user()->email }}</h4>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="my-4">
                                                <label for="categoryName" class="control-label mb-1"><i class="fa-solid fa-phone text-success"></i> Phone</label>
                                                <h4>{{ Auth::user()->phone }}</h4>
                                            </div>
                                            <div class="my-4">
                                                <label for="categoryName" class="control-label mb-1"><i class="fa-solid fa-location-dot text-danger"></i> Address</label>
                                                <h4>{{ Auth::user()->address }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                        <div style="margin-left:-190px" class="mt-4">
                                            <a href="{{ route('admin-accountInfoEditPage') }}" type="submit" class="text-light btn btn-info btn-lg col-12 w-75">Edit Info <i class="fa-solid fa-pen-to-square ms-1"></i></a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
