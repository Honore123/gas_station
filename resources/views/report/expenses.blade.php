@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Expenses Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expenses Report</li>
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
                                <h5 class="card-title">Expenses Report {{date('d/m/Y',strtotime(request('start')))}} - {{date('d/m/Y',strtotime(request('end')))}}</h5>
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
                                    @forelse($expenses as $expense)
                                    <tr>
                                        <td class="text-middle">{{$loop->iteration++}}</td>
                                        <td class="text-middle">{{$expense->description}}</td>
                                        <td class="text-middle">{{number_format($expense->amount,0,'.',',')}} Rwf</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No data yet</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="2" class="text-bold text-center">Total</td>
                                        <td class="text-bold">{{number_format($expenses->sum('amount'),0,'.',',')}} Rwf</td>
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
