@extends('admin.layouts.common')

@section('title','About Product Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-body">
                            <div class="my-2 mb-4 fw-bold text-dark" style="cursor:pointer" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Back</div>
                        <div class="card-title mb-4">
                            <h3 class="text-center">About This Pizza</h3>
                        </div>
                        <div class="row">
                            <div class="col-12 offset-3">
                                    <div class="w-100 ps-1">
                                        <img src="{{ asset('storage/'.$pizza_data->image) }}" class="img-thumbnail w-50"/>
                                    </div>
                            </div>
                            <form action="{{ route('product-editPage',$pizza_data->id) }}">
                                <div class="row mt-5 text-center">
                                    <div class="col-3">
                                        <i class="fa-solid fa-pizza-slice text-warning"></i> Pizza Name
                                        <h4>- {{ $pizza_data->name }}</h4>
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-solid fa-money-bill-1-wave text-success"></i> Price
                                        <h4>- {{ $pizza_data->price }} ks</h4>
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-solid fa-clock text-danger"></i> Waiting Time
                                        <h4>- {{ $pizza_data->waiting_time }} minutes</h4>
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-solid fa-eye text-info"></i> ViewCount
                                        <h4>- {{ $pizza_data->view_count }} viewers</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 ps-4 mt-2 pt-3">
                                        <label for="description" class="fw-normal ps-3"><i class="fa-solid fa-file-lines text-info"></i></i> Description</label>
                                        <textarea name="description" id="" cols="90" rows="3" class="form-control shadow-sm">{{ $pizza_data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-lg btn-info w-100 mt-4"><i class="fa-solid fa-file-pen"></i> Edit Pizza</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
