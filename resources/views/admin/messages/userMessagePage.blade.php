@extends('admin.layouts.common')

@section('title','User Messages')

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
                            <h2 class="title-1">User Messages</h2>
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
                @if(count($messages)!=0)
                    <h4 class="text-muted mb-4"><i class="fa-solid fa-list"></i> Total - {{ count($messages) }}</h4>
                @foreach ($messages as $item)
                    <div class="bg-light shadow-sm p-4 rounded-5 d-flex justify-content-between align-items-center m-2">
                        <div>
                            <h3 class="mb-2">{{ $item->message }}</h3>
                            <p>- Message from {{ $item->name }}( {{ $item->email }})</p>
                        </div>
                        <div>
                            <i class="fa-solid fa-heart text-danger fs-2"></i>
                        </div>
                    </div>
                @endforeach
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
                url : 'http://127.0.0.1:8000/order/statusChange' ,
                data : $data ,
                dataType : 'json' ,
            });
        });
    });
</script>

@endsection
