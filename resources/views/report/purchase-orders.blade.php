@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('report.partials.period')
    @if(request()->filled(['start','end']))
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Purchase Order Report {{date('d/m/Y',strtotime(request('start')))}} - {{date('d/m/Y',strtotime(request('end')))}}</h5>
                            <div class="card-tools">
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#period-modal">
                                    Choose Period
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Vendor</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="Kyle Jewelry" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="phone" name="phone" value="2521211" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" value="kyle@jewelry.com" disabled>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="orderDate" name="orderDate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  py-2 my-4 table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Vendor Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Total Price</th>
                                            </thead>
                                            <tbody>
                                            @for($i=0; $i<6; $i++)
                                                <tr>
                                                    <td class="text-middle">{{$i+1}}</td>
                                                    <td class="text-middle">NCP34</td>
                                                    <td class="text-middle">12/06/2021</td>
                                                    <td class="text-middle">Kyle Jewelry</td>
                                                    <td class="text-middle">+2508520020</td>
                                                    <td class="text-middle">kyle@jewelry.com</td>
                                                    <td class="text-middle">100,000 Rwf</td>
                                                </tr>
                                            @endfor
                                            <tr>
                                                <td class="text-center text-bold" colspan="6">Total</td>
                                                <td class="text-bold" colspan="1">100,000 Rwf</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="row mt-2 mb-2">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-outline-info btn-flat">
                                            Download PDF
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
    @endif
@endsection
@push('scripts')
    <script>
        $(function () {
            var start = '{{request('start')}}'
            var end = '{{request('end')}}'
            if (start == '' || end == ''){
                $('#period-modal').modal({
                    backdrop:'static',
                    keyboard: false,
                    show: true,
                })
            }
        })
    </script>
@endpush
