@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Sale Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="{{route('customer.index')}}">Customers</a></li>
                        <li class="breadcrumb-item">New</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">John Doe's Order</h5>
                            <div class="card-tools">
                                <a href="{{route('customer.index')}}" class="btn btn-info rounded-0">
                                    Go Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Names</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="John Doe" name="names" id="names">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="phone" name="phone" value="+250780850976">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" value="imanishimwehono@gmail.com">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Order ID</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="saleOrderId" name="saleOrderId">
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
                                        @include('purchase-order.partials.product')
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
                                            <th>Payment Method</th>
                                            <th>Option</th>
                                            </thead>
                                            <tbody>
                                            @for($i=0; $i<6; $i++)
                                                <tr>
                                                    <td class="text-middle">{{$i+1}}</td>
                                                    <td class="text-middle">NC34</td>
                                                    <td class="text-middle"><img src="{{asset('images/user2-160x160.jpg')}}" width="100" alt="image"></td>
                                                    <td class="text-middle">+Heart Earrings</td>
                                                    <td class="text-middle">Earrings</td>
                                                    <td class="text-middle">20</td>
                                                    <td class="text-middle">Pieces</td>
                                                    <td class="text-middle">5,000 Rwf</td>
                                                    <td class="text-middle">100,000 Rwf</td>
                                                    <td class="text-middle">
                                                        <button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
                                                        <div class="dropdown-menu">
                                                            <a href="" class="dropdown-item">Edit Qty</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="" class="dropdown-item">Remove</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                            <tr>
                                                <td class="text-center text-bold" colspan="8">Total</td>
                                                <td class="text-bold" colspan="2">100,000 Rwf</td>
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
