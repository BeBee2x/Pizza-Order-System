@extends('admin.layouts.common')

@section('title','Product Update Page')

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
                            <h3 class="text-center">Edit Your Pizza</h3>
                        </div>
                        <form action="{{ route('product-update') }}" enctype="multipart/form-data" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-12 offset-3">
                                    <div class="w-100 ps-2">
                                        <img src="{{ asset('storage/'.$pizza_data->image) }}" class="img-thumbnail w-50"/>
                                    </div>
                            </div>
                            <div>
                                <input type="file" name="pizzaImage" class="form-control form-control-lg mt-3 @error('pizzaImage') is-invalid @enderror">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="pizzaId" value="{{ $pizza_data->id }}">
                                <div class="row mt-5 text-center">
                                    <div class="col-3">
                                        <i class="fa-solid fa-pizza-slice text-warning"></i> Pizza Name
                                        <input type="text" name="pizzaName" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza_data->name)}}">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-solid fa-money-bill-1-wave text-success"></i> Price
                                        <input type="text" name="pizzaPrice" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza_data->price)}}">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-solid fa-clock text-danger"></i> Waiting Time
                                        <input type="number" name="pizzaWaitingTime" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza_data->waiting_time)}}">
                                        @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-solid fa-eye text-info"></i> ViewCount
                                        <input type="number" name="pizzaViewCount" disabled class="form-control @error('pizzaViewCount') is-invalid @enderror" value="{{ old('pizzaViewCount',$pizza_data->view_count)}}">
                                        @error('pizzzViewCount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row ps-4 mt-3">
                                    <label for="pizzaCategory"><i class="fa-solid fa-clipboard-list text-danger"></i> Category</label>
                                    <select name="pizzaCategory" class="form-select @error('pizzaCategory') is-invalid @enderror">
                                        <option value="">Choose Pizza Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" @if ($pizza_data->category_id==$item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12 ps-4 mt-2 pt-3">
                                        <label for="description" class="fw-normal ps-3"><i class="fa-solid fa-file-lines text-info"></i></i> Description</label>
                                        <textarea name="description" name="description" cols="90" rows="3" class="form-control shadow-sm @error('description') is-invalid @enderror">{{ old('description',$pizza_data->description) }}</textarea>
                                        @error('description')
                                            {{ $message }}
                                        @enderror
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
