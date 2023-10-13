@extends('admin.layouts.common')

@section('title','Admin list')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $item )
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        <div class="m-3">
                                            @if ($item->image == NULL)
                                                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                            @else
                                                <img src="{{ asset('storage/'.$item->image) }}" class="rounded-circle"/>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        @if (Auth::user()->id!=$item->id)
                                        <a href="{{ route('admin-changeRolePage',$item->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                <i class="fa-solid fa-arrows-rotate fs-5"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin-delete',$item->id) }}">
                                            <button class="item ms-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete fs-4"></i>
                                            </button>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admin->links() }}
                    </div>
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
