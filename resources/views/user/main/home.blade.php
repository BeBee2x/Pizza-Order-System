@extends('user.layouts.master')

@section('title','Home Page')

@section('home','active')

@section('content')

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="position-relative text-uppercase mb-3"><span class="pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <h5 class="pb-3 text-warning">Categories</h5>
                @foreach ($categories as $item)
                    <a href="{{ route('user-filter',$item->id) }}" class="text-decoration-none">
                        <div class="my-2 text-dark">{{ $item->name }}</div>
                    </a>
                @endforeach
            </div>
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            {{-- <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button> --}}
                                {{-- <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div> --}}
                                <select name="sorting" id="sortingOption" class="form-select">
                                    <option value="">Choose Option...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="my_list">
                    @if (count($pizza_data)!=0)
                        @foreach ($pizza_data as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="pizza_list">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$item->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <input type="hidden" value="{{ $item->id }}" id="productId">
                                    <a class="btn btn-outline-dark btn-square viewBtn" href="{{ route('user-pizzaDetails',$item->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $item->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $item->price }} kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center mt-5 text-muted">Oops! There is no Pizza</div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

@section('jquery')
    <script>
        $(document).ready(function(){
            // $.ajax({
            //     type : 'get',
            //     url : 'http://127.0.0.1:8000/user/ajax/pizzalist',
            //     dataType : 'json',
            //     success : function(response){
            //         console.log(response);
            //     }
            // })

            $('.viewBtn').click(function(){
                $parentNode = $(this).parents('#pizza_list');
                $id = Number($parentNode.find('#productId').val());
                $id = Number($parentNode.find('#productId').val());
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/viewCount',
                    data : { 'product_id' : $id },
                    dataType : 'json',
                    success : function(response){

                    }
                });
            })

            $('#sortingOption').change(function(){
                var eventOption = $('#sortingOption').val();
                if(eventOption=='asc'){
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizzalist',
                        data : { 'status' : 'asc' },
                        dataType : 'json',
                        success : function(response){
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="pizza_list">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <input type="hidden" value="${response[$i].id}" id="productId">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#my_list').html($list);
                        }
                    })
                }else if(eventOption=='desc'){
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizzalist',
                        data : { 'status' : 'desc' },
                        dataType : 'json',
                        success : function(response){
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="pizza_list">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#my_list').html($list);
                        }
                    })
                }
            })

        });
    </script>
@endsection
