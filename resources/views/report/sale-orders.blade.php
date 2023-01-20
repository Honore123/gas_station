@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sale Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales report</li>
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
                                <h5 class="card-title">Sale Orders Report {{date('d/m/Y',strtotime(request('start')))}} - {{date('d/m/Y',strtotime(request('end')))}}</h5>
                                <div class="card-tools">
                                    <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#period-modal">
                                        Choose Period
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
{{--                                <form action="">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6 offset-md-6">--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label for="" class="col-sm-2 col-form-label">Date</label>--}}
{{--                                                <div class="col-sm-8">--}}
{{--                                                    <input type="date" class="form-control" id="orderDate" name="orderDate">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card-body pl-0">
                                                <h4 class="card-title">Visualization graph</h4>
                                                <canvas id="sales_orders_chart"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="display-5">Total Revenue</label>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Total amount: </td>
                                                        <td>{{$revenue}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12  py-2 my-4 table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="sale-report-table">
                                                <thead>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Total Amount</th>
                                                </thead>
                                                <tbody>
                                                @for($i=0; $i<6; $i++)
                                                    <tr>
                                                        <td class="text-middle">{{$i+1}}</td>
                                                        <td class="text-middle">NCO34</td>
                                                        <td class="text-middle">12/06/2021</td>
                                                        <td class="text-middle">John Doe</td>
                                                        <td class="text-middle">+2585522522</td>
                                                        <td class="text-middle">john@gmail.com</td>
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
        $('#sale-report-table').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'responsive': false,
            "aLengthMenu": [[6, 20, 50, 75, -1], [6, 25, 50, 75, "All"]],
            "iDisplayLength": 6,
            "processing":true,
            "serverSide":false,
            "ajax": {
                "url": "{{route('sales.ajax')}}?start={{ request('start') }}&end={{ request('end') }}",
                "type": 'GET',
            },
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false,searchable: false,"className":"text-center"},
                { "data": 'order_id', "name":'order_id'},
                { "data": 'date', "name":'created_at', "defaultContent":"-" },
                { "data": 'customer.names', "name": 'customer.names'},
                { "data": 'customer.phone_number', "name": 'customer.phone_number'},
                { "data": 'customer.email', "name": 'customer.email'},
                { "data": 'total_amount', "name": 'total_amount'},
            ],
        })
        $(document).ready(function(){
            setInterval(() => {
                var start = '{{request('start')}}'
            var end = '{{request('end')}}'
            if(start != '' || end != ''){
                var url = "{{url('report/saleOrder/chart/'.request('start').'/'.request('end'))}}";
        var dateTime = new Array();
        var salesData = new Array();
            $.get(url, function(response){
                response.forEach(function(data){
                    dateTime.push(data.created_at);
                    salesData.push(data.total_amount);
                });
                var salesChart = document.getElementById("sales_orders_chart").getContext('2d');

                var salesDiagram = new Chart(salesChart, {
                    type: 'line',
                    data: {
                        labels:dateTime,
                        datasets: [{
                            label: 'Sales',
                            data: salesData,
                            borderWidth: 3,
                            borderColor: 'rgb(0, 127, 212)',
                            fill:false,
                            tension: 0.3,
                        }]
                    },
                    options: {
                        animation:{
                            duration: 0
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    userCallback: function(value, index, values) {
                                        value = value.toString();
                                        value = value.split(/(?=(?:...)*$)/);
                                        value = value.join(',');
                                        return value;
                                    }
                                }
                            }],

                            xAxes: [{
                                gridLines: {
                                    color: '#f2f3f8'
                                },
                                ticks: {
                                    display: false //this will remove only the label
                                }
                            }]
                        },
                    }
                });
            });
            }
            }, 1000);
        });

    </script>
@endpush
