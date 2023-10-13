@extends('admin.layouts.common')

@section('title','Change Role Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="my-2 mb-4 fw-bold text-dark" style="cursor:pointer" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Back</div>
                        <div class="card-title mb-5">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <form action="{{ route('admin-changeAdmin',$data->id) }}" method="post">
                            @csrf
                            <div class="row pb-2">
                                <div class="col-3 offset-1">
                                    @if ($data->image == NULL)
                                        <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                    @else
                                        <img src="{{ asset('storage/'.$data->image) }}" class="rounded-circle"/>
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <h4>Do you really want to change {{ $data->name }}'s role to Admin?</h4>
                                    <div class="mt-3 pt-3 d-flex">
                                        <input type="hidden" name="role" value="admin">
                                        <div class="bg-primary text-light p-3 rounded-5 shadow"><i class="fa-solid fa-user-tie"></i> {{ $data->role }}</div>
                                        <div class="ms-5 me-5 pt-2"><i class="fa-solid fa-right-long text-dark fs-1"></i></div>
                                        <div class="bg-warning text-light p-3 rounded-5 shadow"><i class="fa-solid fa-user"></i> Admin</div>
                                    </div>
                                    <div class="mt-3" style="margin-left: -24px"><button type="submit" class="p-3 shadow-sm w-100 btn btn-info rounded-pill">Change role to Admin</button></div>
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
