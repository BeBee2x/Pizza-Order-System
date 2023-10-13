@extends('admin.layouts.common')

@section('title','Order List')

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
                        <div class="bg-light rounded shadow-sm p-4">
                            <div class="fs-5 fw-bold">Order Code -{{ $orderList[0]->order_code }}</div>
                            <p>Order Person : {{ $orderList[0]->user_name }}</p>
                            <p>Order Date : {{ $orderList[0]->created_at->format('j-F-Y') }}</p>
                            <p>Total Amount <span class="text-warning">(included delivery charges)</span> : {{ $total_price+3000 }}</p>
                        </div>
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
                @if(count($orderList)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="orders">
                            @foreach ($orderList as $item )
                            <tr class="tr-shadow">
                                <input type="hidden" id="orderId" value="{{ $item->id }}">
                                <td>{{ $item->id }}</td>
                                <td class="col-2"><img src="{{ asset('storage/'.$item->product_image) }}" class="img-thumbnail"></td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->total }} kyats</td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                        </tbody>
                    </table>
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
