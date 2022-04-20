@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Summarized Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Summarized Report</li>
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
                            <h5 class="card-title">Summarized Report {{date('d/m/Y',strtotime(request('start')))}} - {{date('d/m/Y',strtotime(request('end')))}}</h5>
                            <div class="card-tools">
                                <button class="btn btn-outline-info rounded-0">
                                    Download PDF
                                </button>
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#period-modal">
                                    Choose Period
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <th>#</th>
                                <th>Action</th>
                                <th>Amount</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-middle">1</td>
                                        <td class="text-middle">Purchase of Sale Orders</td>
                                        <td class="text-middle">{{$purchase}} Rwf</td>
                                    </tr>
                                    <tr>
                                        <td class="text-middle">2</td>
                                        <td class="text-middle">Sales Orders</td>
                                        <td class="text-middle">{{$revenue}} Rwf</td>
                                    </tr>
                                    <tr>
                                        <td class="text-middle">3</td>
                                        <td class="text-middle">Gross Profit</td>
                                        <td class="text-middle">{{$grossProfit}} Rwf</td>
                                    </tr>
                                    <tr>
                                        <td class="text-middle">4</td>
                                        <td class="text-middle">Expenses</td>
                                        <td class="text-middle">{{$expenses}} Rwf</td>
                                    </tr>
                                    <tr>
                                        <td class="text-middle">5</td>
                                        <td class="text-middle">Net Profit</td>
                                        <td class="text-middle">{{$netProfit}} Rwf</td>
                                    </tr>
                                </tbody>
                            </table>
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
