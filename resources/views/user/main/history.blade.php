@extends('user.layouts.master')

@section('title','My History Page')

@section('history','active')

@section('content')
 <!-- Cart Start -->
 <div class="container-fluid">
    <div class="row px-xl-5 d-flex justify-content-center">
        <div class="col-lg-10 table-responsive mb-5">
            @if (count($order)!=0)
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="dataTable">
                        @foreach ($order as $item)
                        <tr>
                            <td class="align-middle">{{ $item->created_at->format('j-F-Y') }}</td>
                            <td class="align-middle">{{ $item->order_code }}</td>
                            <td class="align-middle">{{ $item->total_price }} ks</td>
                            <td class="align-middle">
                                @if ($item->status==0)
                                    <button class="btn text-white btn-warning shadow-sm btn-sm rounded-pill"><i class="fa-solid fa-clock"></i> Pending...</button>
                                @elseif($item->status==1)
                                    <button class="btn text-white btn-success shadow-sm btn-sm rounded-pill"><i class="fa-solid fa-check-double"></i> Done</button>
                                @elseif($item->status==2)
                                    <button class="btn text-white btn-danger shadow-sm btn-sm rounded-pill"><i class="fa-solid fa-trash-can"></i> Rejected</button>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $order->links() }}
            </div>
                @else
                    <div class="fw-bold d-flex justify-content-center mt-5 pt-5 fs-4">There is no orders in your history!</div>
                @endif
        </div>
    </div>
</div>

@endsection

@section('footer','d-none')
