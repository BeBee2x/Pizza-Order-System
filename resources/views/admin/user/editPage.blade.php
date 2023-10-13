@extends('admin.layouts.common')

@section('title','User list Edit Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="my-2 mb-4 fw-bold text-dark" style="cursor:pointer" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Back</div>
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Edit User List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <form action="{{ route('admin-list') }}" class="d-inline-block" method="get">
                            @csrf
                            <div class="input-group">
                                <input type="search" name="searchKey" class="form-control shadow-sm rounded-start-5" placeholder="Type category to search..." value="{{ request('searchKey') }}">
                                <button type="submit" class="btn btn-dark">Search<i class="fa-solid fa-magnifying-glass ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (session('creation_status'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('creation_status') }} <i class="fa-solid fa-check ms-1"></i>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('delete_status'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('delete_status') }} <i class="fa-solid fa-trash-arrow-up ms-1 "></i>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('update_status'))
                <div class="col-4 offset-8">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('update_status') }} <i class="fa-solid fa-circle-arrow-up"></i>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                {{-- <h3 class="my-3 ms-2"><i class="fa-solid fa-list"></i> Total - {{ $categories->total() }}</h3> --}}
                {{-- @if (count($categories) != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr class="tr-shadow">
                                    <td class="col-3">
                                        <div>
                                            @if ($user->image == NULL)
                                                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                            @else
                                                <img src="{{ asset('storage/'.$user->image) }}" class="rounded-circle"/>
                                            @endif
                                            <input type="file" name="userImage" class="form-control form-control-sm mt-2 rounded shadow-sm">
                                        </div>
                                    </td>
                                    <td><input type="text" name="" class="form-control form-control-sm rounded shadow-sm" value="{{ $user->name }}"></td>
                                    <td class="col-3"><input type="text" name="" class="form-control form-control-sm rounded shadow-sm" value="{{ $user->email }}"></td>
                                    <td><input type="text" name="" class="form-control form-control-sm rounded shadow-sm" value="{{ $user->phone }}"></td>
                                    <td><input type="text" name="" class="form-control form-control-sm rounded shadow-sm" value="{{ $user->address }}"></td>
                                </tr>
                                <tr class="spacer"></tr>
                        </tbody>
                    </table>
                </div>
                {{-- @else
                   <h3 class="text-muted text-center mt-5 pt-5">Oopss! There is no Categories Here!</h3>
                @endif --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
