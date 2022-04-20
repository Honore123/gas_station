@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customers</li>
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
                            <h5 class="card-title">All Customers</h5>
                            <div class="card-tools">
                                <button class="btn btn-outline-info rounded-0" data-toggle="modal" data-target="#filter-customer-modal">
                                    Filter
                                </button>
                                @can('customers.add')
                                @include('customer.partials.filter')
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#upload-customer-modal">
                                    Upload
                                </button>
                                @include('customer.partials.upload')
                                <a href="{{route('customer.add')}}" class="btn btn-info rounded-0">
                                    New Customer
                                </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="customers-table">
                                    <thead>
                                    <th>#</th>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th>Description</th>
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
    </div>
@endsection
@push('scripts')
    <script>
        function deleteAlert(id, name){
            swal.fire( {
                title:'Confirmation',
                text:'Do you want to delete ' + name,
                icon: 'info',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-customer-'+ id).submit();
                }
            });
        }
        $('#customers-table').DataTable({
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
                "url": "{{route('customer.index')}}",
                "type": 'GET',
            },
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false,searchable: false,"className":"text-center"},
                { "data": 'customer_id', "name": 'customer_id'},
                { "data": 'names', "name": 'names'},
                { "data": 'phone_number', "name": 'phone_number'},
                { "data": 'email', "name": 'email'},
                {"data":"location", "name":"location"},
                {"data":"description", "name":"description"},
                {"data": 'action', "name": 'action', orderable:false, searchable:false},
            ],
        })
    </script>
@endpush
