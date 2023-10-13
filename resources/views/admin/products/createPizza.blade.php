@extends('admin.layouts.common')

@section('title','Category Pizza Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product-list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product-create') }}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                <select name="pizzaCategory" class="form-select @error('pizzaCategory') is-invalid @enderror">
                                    <option value="">Choose your category</option>
                                    @foreach ($categories as $item )
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="pizzaName" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name..." value="{{ old('pizzaName') }}">
                                @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Description for Pizza...">{{ old('description') }}</textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pizzaImage" class="control-label mb-1">Image</label>
                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pizzaWaitingTime" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Waiting Time..." value="{{ old('pizzaWaitingTime') }}">
                                @error('pizzaWaitingTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price..." value="{{ old('pizzaPrice') }}">
                                @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
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
