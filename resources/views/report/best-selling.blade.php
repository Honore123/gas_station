@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Best Selling Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Best Selling report</li>
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
                                <h5 class="card-title">Best Selling Report {{date('d/m/Y',strtotime(request('start')))}} - {{date('d/m/Y',strtotime(request('end')))}}</h5>
                                <div class="card-tools">
                                    <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#period-modal">
                                        Choose Period
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6 offset-md-6">
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
                                                <th>Barcode</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Sold Qyt</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Total Amount</th>
                                                </thead>
                                                <tbody>
                                                @forelse($bestSelling as $product)
                                                    <tr>
                                                        <td class="text-middle">{{$loop->iteration++}}</td>
                                                        <td class="text-middle">{{$product->barcode}}</td>
                                                        <td><img src="{{asset('storage/'.json_decode(json_decode($product->images))[0])}}" width="100" alt="image"></td>
                                                        <td class="text-middle">{{$product->product_name}}</td>
                                                        <td class="text-middle">Earrings</td>
                                                        <td class="text-middle">{{$product->sold}}</td>
                                                        <td class="text-middle">Pieces</td>
                                                        <td class="text-middle">{{number_format($product->retail_price,0,'.',',') }} Rwf</td>
                                                        <td class="text-middle">{{number_format($product->money,0,'.',',')}} Rwf</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">No data yet</td>
                                                    </tr>
                                                @endforelse
                                                    <tr>
                                                        <td class="text-center text-bold" colspan="8">Total</td>
                                                        <td class="text-bold" colspan="1">{{number_format($total_amount,0,'.',',')}} Rwf</td>
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
