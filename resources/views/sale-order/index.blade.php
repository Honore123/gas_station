@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sale Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sale Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.partials.notification')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">All Sale Orders</h5>
                            <div class="card-tools">
                                <button class="btn btn-outline-info rounded-0" data-toggle="modal" data-target="#filter-purchase-order-modal">
                                    Filter
                                </button>
                                @include('purchase-order.partials.filter')
                                <a href="{{route('sale-order.add')}}" class="btn btn-info btn-flat">New Order</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-hover" id="sale-order-table">
                                <thead>
                                <th>#</th>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Option</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#sale-order-table').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'responsive': false,
            "aLengthMenu": [[20, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 20,
            "processing":true,
            "serverSide":true,
            "ajax": {
                "url": "{{route('sale-order.index')}}",
                "type": 'GET',
            },
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false,searchable: false,"className":"text-center"},
                { "data": 'order_date', "name": 'order_date'},
                { "data": 'order_id', "name": 'order_id'},
                { "data": 'customer.names', "name": 'customer.names'},
                { "data": 'customer.phone_number', "name": 'customer.phone_number'},
                { "data": 'order_status', "name": 'order_status'},
                {"data":"total_amount", "name":"total_amount"},
                {"data":"payment_method", "name":"payment_method", "defaultContent":"Not set"},
                {"data": 'action', "name": 'action', orderable:false, searchable:false},
            ],
        })
    </script>
@endpush
