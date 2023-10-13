@extends('admin.layouts.common')

@section('title','Order List')

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
                            <h2 class="title-1">Order List</h2>
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
                        <form action="{{ route('order-searchByStatus') }}" method="post" class="d-inline-block">
                            @csrf
                            <div class="d-inline-block">
                                <div>Filter By Status</div>
                            <select id="orderSearch" name="status" class="form-select">
                                <option value="">All</option>
                                <option value="0">Pending</option>
                                <option value="1">Done</option>
                                <option value="2">Rejected</option>
                            </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Search <i class="fa-solid fa-magnifying-glass"></i></button>
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
                @if(count($order)!=0)
                    <h4 class="text-muted mb-3"><i class="fa-solid fa-list"></i> Total - {{ count($order) }}</h4>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Order Code</th>
                                <th>Order Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="orders">
                            @foreach ($order as $item )
                            <tr class="tr-shadow">
                                <input type="hidden" id="orderId" value="{{ $item->id }}">
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->order_code }}</td>
                                <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                <td>{{ $item->total_price }} kyats</td>
                                <td>
                                    <select name="status" class="form-select statusChange">
                                        <option value="0" @if($item->status == 0) selected @endif>Pending..</option>
                                        <option value="1" @if($item->status == 1) selected @endif>Done</option>
                                        <option value="2" @if($item->status == 2) selected @endif>Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('order-details',$item->order_code) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
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

@section('jquery')

<script>
    $(document).ready(function(){
        $('.statusChange').change(function(){
            $value = $(this).val();
            $parentNode = $(this).parents("tr");
            $id = $parentNode.find('#orderId').val();
            $data = { 'status' : $value , 'id' : $id }
            $.ajax({
                type : 'get' ,
                url : '/order/statusChange' ,
                data : $data ,
                dataType : 'json' ,
            });
        });
    });
</script>

@endsection
