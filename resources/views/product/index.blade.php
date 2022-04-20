@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                            <h5 class="card-title">All Products</h5>
                            <div class="card-tools">
                                <button class="btn btn-outline-info rounded-0" data-toggle="modal" data-target="#filter-modal">
                                    Filter
                                </button>
                                @can('products.add')
                                @include('product.partials.filter')
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#upload-modal">
                                    Upload
                                </button>
                                @include('product.partials.upload')
                                <a href="{{route('product.add')}}" class="btn btn-info rounded-0">
                                    New Product
                                </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="products-table">
                                    <thead>
                                    <th>#</th>
                                    <th>Barcode</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Purchase</th>
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
                    document.getElementById('delete-product-'+ id).submit();
                }
            });
        }
        $('#products-table').DataTable({
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
                "url": "{{route('product.index')}}",
                "type": 'GET',
            },
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false,searchable: false,"className":"text-middle"},
                { "data": 'barcode', "name": 'barcode',"className":"text-middle"},
                { "data": 'image', "name": 'image', searchable:false},
                { "data": 'product_name', "name": 'product_name',"className":"text-middle"},
                { "data": 'category.category_name', "name": 'category.category_name',"className":"text-middle"},
                {"data":"quantity", "name":"quantity","className":"text-middle"},
                {"data":"unit", "name":"unit","className":"text-middle"},
                {"data":"retail_price", "name":"retail_price","className":"text-middle"},
                {"data":"purchase_price", "name":"purchase_price","className":"text-middle"},
                {"data":"description", "name":"description","className":"text-middle"},
                {"data": 'action', "name": 'action', orderable:false, searchable:false,"className":"text-middle"},
            ],
            dom:'Bfrtip',
            "deferRender":true,
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Choose Columns',
                    className: 'btn btn-success btn-flat text-white pull-right mr-2'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    className: 'btn btn-success btn-flat text-white pull-right mr-2'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title:"Nziza Crafts Product",
                    className: 'btn btn-success btn-flat text-white pull-right',
                    exportOptions: {
                        stripHtml: false,
                        columns:':visible'
                    }
                }
            ],
        })
    </script>
@endpush
