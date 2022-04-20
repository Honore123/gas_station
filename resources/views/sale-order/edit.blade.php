@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Sale Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="{{route('sale-order.index')}}">S. Orders</a></li>
                        <li class="breadcrumb-item">Edit</li>
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
                    @include('sale-order.partials.product')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order Information</h5>
                            <div class="card-tools">
                                <a href="{{route('sale-order.index')}}" class="btn btn-info rounded-0">
                                    Go Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('sale-order.payment', $customerOrder->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Customer</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="vendor" name="vendor" value="{{$customerOrder->customer->names}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="phone" name="phone" value="{{$customerOrder->customer->phone_number}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" value="{{$customerOrder->customer->email}}" readonly>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Order ID</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="order-id" name="order-id" value="{{$customerOrder->order_id}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Order Date</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="orderDate" name="orderDate" value="{{date('d/m/Y', strtotime($customerOrder->created_at))}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        @if($customerOrder->order_status == 0)
                                            <button type="button" class="btn btn-outline-info btn-flat" data-toggle="modal" data-target="#add-product-modal">Add Product</button>
                                        @endif
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
                                            @if($customerOrder->order_status == 0)
                                                <th>Option</th>
                                            @endif
                                            </thead>
                                            <tbody>
                                            @forelse($sales as $sale)
                                                <tr>
                                                    <td class="text-middle">{{$loop->iteration}}</td>
                                                    <td class="text-middle">{{$sale->product->barcode}}</td>
                                                    <td class="text-middle"><img src="{{asset('storage/products/images/'.json_decode($sale->product->images,true)[0])}}" width="100" alt="image"></td>
                                                    <td class="text-middle">{{$sale->product->product_name}}</td>
                                                    <td class="text-middle">{{$sale->product->category_id}}</td>
                                                    <td class="text-middle">{{$sale->quantity}}</td>
                                                    <td class="text-middle">{{$sale->product->unit}}</td>
                                                    <td class="text-middle">{{ number_format($sale->product->purchase_price,0,'.',',') }} Rwf</td>
                                                    <td class="text-middle">{{number_format($sale->amount,0,'.',',') }} Rwf</td>
                                                    @if($customerOrder->order_status == 0)
                                                        <td class="text-middle">
                                                            <button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
                                                            <div class="dropdown-menu">
                                                                <a href="" class="dropdown-item">Edit Qty</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="" class="dropdown-item">Remove</a>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">No Products</td>
                                                </tr>
                                            @endforelse
                                            <tr>
                                                <td class="text-center text-bold" colspan="8">Total</td>
                                                <td class="text-bold" colspan="2">{{number_format($customerOrder->total_amount,0,'.',',')}} Rwf</td>
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
                                        @if($customerOrder->order_status == 0)
                                            <button class="btn btn-outline-info btn-flat">
                                                Approve Payment
                                            </button>
                                        @elseif($customerOrder->order_status == 1)
                                            <button class="btn btn-outline-danger btn-flat">
                                                Cancel Order
                                            </button>
                                        @endif
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
                        url: "/saleOrder/customer/" + vendor + '/' + orderId,
                        success: function (response) {
                            $('#phone').val(response.phone_number)
                            $('#email').val(response.email)
                            $('#customer-order-id').val(response.customer_order_id)
                        }
                    })
                }
            })
            $('#category').change(function () {
                if($(this).val() != '') {
                    var category = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: "/saleOrder/product/" + category,
                        success: function (response) {
                            $('#product-table').html(response);
                        }
                    })
                }
            })

        })
    </script>
@endpush
