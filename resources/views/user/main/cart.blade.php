@extends('user.layouts.master')

@section('title','My Cart Page')

@section('cart','active')

@section('footer','d-none')

@section('content')
 <!-- Cart Start -->
 <div class="container-fluid mt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive">
            @if (count($cart_data)!=0)
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="dataTable">
                        @foreach ($cart_data as $item)
                        <tr>
                            <td class="align-middle"><img class="" src="{{ asset('storage/'.$item->pizza_image) }}" alt="" width="40px" ></td>
                            <td class="align-middle">{{ $item->pizza_name }}
                                <input type="hidden" id="productId" value="{{ $item->product_id }}">
                                <input type="hidden" id="userId" value="{{ $item->user_id }}">
                            </td>
                            <td class="align-middle">{{ $item->pizza_price }} ks</td>
                            <input type="hidden" id="price" value="{{ $item->pizza_price }}">
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm border-0 text-center" value="{{ $item->qty }}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $item->pizza_price*$item->qty }} ks</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="mt-3 float-end"><a href="{{ route('user-clearCart') }}" class="btn btn-danger rounded-pill">Cancel Cart <i class="fa-solid text-light fa-trash-can"></i></a></div>
                @else
                    <div class="fw-bold d-flex justify-content-center mt-5 pt-5 fs-4">There is no products in your cart!</div>
                @endif
        </div>
        @if (count($cart_data)!=0)
        <input type="hidden" id="total_price" value="{{ $total_price }}">
        @endif
        <div class="col-lg-4">
            <h5 class="position-relative text-uppercase mb-3"><span class="pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subtotal">@if(count($cart_data)!=0) {{ $total_price }} @else 0 @endif ks</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 ks</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="subtotal2">@if(count($cart_data)!=0) {{ $total_price+3000 }} @else 3000 @endif ks</h5>
                    </div>
                    <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('jquery')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').val());
                $qty = Number($parentNode.find('#qty').val());
                $total = $price*$qty;
                $parentNode.find("#total").html($total+" ks");
                $total_price = Number($('#total_price').val())+$price;
                showTotal();
            });
            $('.btn-minus').click(function(){
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find('#price').val();
                $qty = Number($parentNode.find('#qty').val());
                $total = $price*$qty;
                $parentNode.find("#total").html($total+" ks");
                $total_price = Number($('#total_price').val())-$price;
                showTotal();
            });
            $('.remove').click(function(){
                $parentNode = $(this).parents("tr");
                $priceForMinus = Number($parentNode.find('#total').html().replace("ks",""));
                $total_price = Number($('#total_price').val())-$priceForMinus;
                showTotal();
                $parentNode.remove();
            });
            $orderList = [];
            $('#orderBtn').click(function(){
                $random = Math.floor(Math.random()*10000);
                $('#dataTable tr').each(function(index,row){
                    $orderList.push({
                        'user_id' : $(row).find('#userId').val() ,
                        'product_id' : $(row).find('#productId').val() ,
                        'qty' : $(row).find('#qty').val() ,
                        'total' : Number($(row).find('#total').html().replace(' ks','')) ,
                        'order_code' : 'POS'+$(row).find('#userId').val()+$random
                    });
                });
                $.ajax({
                    type : 'get' ,
                    url  : '/user/ajax/order' ,
                    data : Object.assign({},$orderList) ,
                    dataType : 'json' ,
                    success : function(response){
                        if(response.status == 'true'){
                            window.location.href = "/user/home";
                        }
                    }
                });
            });
            function showTotal(){
                $('#total_price').val($total_price);
                $('#subtotal').html($total_price+" ks");
                $('#subtotal2').html($total_price+3000+" ks");
            }
        });
    </script>
@endsection
