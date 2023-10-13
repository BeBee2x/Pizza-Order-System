@extends('admin.layouts.common')

@section('title','Pizza List')

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
                            <h2 class="title-1">Pizza List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <form action="{{ route('product-list') }}" class="d-inline-block" method="get">
                            @csrf
                            <div class="input-group">
                                <input type="search" name="searchKey" class="form-control shadow-sm rounded-start-5" placeholder="Type category to search..." value="{{ request('searchKey') }}">
                                <button type="submit" class="btn btn-dark">Search<i class="fa-solid fa-magnifying-glass ms-2"></i></button>
                            </div>
                        </form>
                        <a href="{{ route('product-createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
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
                @if(count($pizza_data)!=0)
                    <h4 class="text-muted mb-3"><i class="fa-solid fa-list"></i> Total - {{ $pizza_data->total() }}</h4>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Counts</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizza_data as $item )
                            <tr class="tr-shadow">
                                <td class="col-2"><img src="{{ asset('storage/'. $item->image) }}" class="img-thumbnail shadow-sm"></td>
                                <td class="col-3">{{ $item->name }}</td>
                                <td class="col-3">{{ $item->price }}</td>
                                <td class="col-3">{{ $item->category_name }}</td>
                                <td><i class="fa-solid fa-eye"></i> {{ $item->view_count }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('product-details',$item->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product-editPage',$item->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product-delete',$item->id) }}">
                                            <button class="item ms-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $pizza_data->links() }}
                    </div>
                </div>
                @else
                <h3 class="d-flex justify-content-center mt-5 pt-5">Oops! There is no Data</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
