@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase Orders</li>
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
                            <h5 class="card-title">All Purchase Orders</h5>
                            <div class="card-tools">
                                <button class="btn btn-outline-info rounded-0" data-toggle="modal" data-target="#filter-purchase-order-modal">
                                    Filter
                                </button>
                                @include('purchase-order.partials.filter')
                                <button class="btn btn-info dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">New Order</button>
                                <div class="dropdown-menu">
                                    <a href="{{route('purchase-order.add')}}" class="dropdown-item">Make Order</a>
                                    <a href="" class="dropdown-item">Auto Generate</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="purchase-order-table">
                                <thead>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Vendor Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Total Amount</th>
                                <th>Remaining Amount</th>
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
        $('#purchase-order-table').DataTable({
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
                "url": "{{route('purchase-order.index')}}",
                "type": 'GET',
            },
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false,searchable: false,"className":"text-center"},
                { "data": 'order_id', "name": 'order_id'},
                { "data": 'vendor.names', "name": 'vendor.names'},
                { "data": 'vendor.phone_number', "name": 'vendor.phone_number'},
                { "data": 'vendor.email', "name": 'vendor.email'},
                { "data": 'order_status', "name": 'order_status'},
                {"data":"total_amount", "name":"total_amount"},
                {"data":"remaining_amount", "name":"remaining_amount"},
                {"data": 'action', "name": 'action', orderable:false, searchable:false},
            ],
        })
    </script>
@endpush
