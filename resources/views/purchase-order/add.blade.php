@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Purchase Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="{{route('purchase-order.index')}}">P. Orders</a></li>
                        <li class="breadcrumb-item">New</li>
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
                    @include('purchase-order.partials.product')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order Information</h5>
                            <div class="card-tools">
                                <a href="{{route('purchase-order.index')}}" class="btn btn-info rounded-0">
                                    Go Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Vendor</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="vendor" id="vendor">
                                                    <option value="">~~SELECT VENDOR~~</option>
                                                    @forelse($vendors as $vendor)
                                                        <option value="{{$vendor->id}}">{{$vendor->names}}</option>
                                                    @empty
                                                        <option value="" disabled>No vendor</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="phone" name="phone" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" readonly>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Order ID</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="order-id" name="order-id" value="{{$order_id}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Order Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="orderDate" name="orderDate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-outline-info btn-flat" data-toggle="modal" data-target="#add-product-modal">Add Product</button>

                                    </div>
                                    <div class="col-md-12  py-2 my-4">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <th>#</th>
                                            <th>Barcode</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Option</th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="10" class="text-center">No products</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center text-bold" colspan="8">Total</td>
                                                <td class="text-bold" colspan="2">0 Rwf</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="row mt-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Comment</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="comment" id="comment" cols="30" rows="5">

                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-outline-info btn-flat">
                                            Place Order
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#vendor').change(function () {
                if($(this).val() != '') {
                    var vendor = $(this).val();
                    var orderId = $('#order-id').val();
                    $.ajax({
                        method: 'GET',
                        url: "/purchaseOrder/vendor/" + vendor + '/' + orderId,
                        success: function (response) {
                            $('#phone').val(response.phone_number)
                            $('#email').val(response.email)
                            $('#vendor-order-id').val(response.vendor_order_id)
                        }
                    })
                }
            })
            $('#category').change(function () {
                if($(this).val() != '') {
                    var category = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: "/purchaseOrder/product/" + category,
                        success: function (response) {
                            $('#product-table').html(response);
                        }
                    })
                }
            })

        })
    </script>
@endpush
