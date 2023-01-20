@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">{{$sales}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-gem"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Products</span>
                            <span class="info-box-number">{{$products}}</span>
                        </div>

                    </div>

                </div>

                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-home"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Stores</span>
                            <span class="info-box-number"> {{$stores}} </span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">{{$users}}</span>
                        </div>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Latest Sales Income</h4>
                          <canvas id="latest_sales_income"></canvas>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Expenses</h4>
                          <canvas id="expenses_chart"></canvas>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Products</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                    <th>More</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($bestSellings as $product)
                                <tr>
                                    <td>
                                        <img src="{{asset('storage/'.json_decode(json_decode($product->images))[0])}}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                        {{$product->product_name}}
                                    </td>
                                    <td>{{number_format($product->retail_price,0,'.',',') }} Rwf</td>
                                    <td>

                                        {{$product->sold }} Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data yet</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Net profit</span>
                            <span class="info-box-number">{{$netProfit}} Rwf</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-coins"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Gross profit</span>
                            <span class="info-box-number">{{$grossProfit}} Rwf</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-tasks"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Expenses</span>
                            <span class="info-box-number">{{$expenses}} Rwf</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total revenue</span>
                            <span class="info-box-number">{{$revenue}} Rwf</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
         $(document).ready(function(){
            var salesUrl = "{{url('dashboard/sales/chart')}}";
            var dateTime = new Array();
            var salesData = new Array();
            $.get(salesUrl, function(response){
                response.forEach(function(data){
                    dateTime.push(data.recorded_time);
                    salesData.push(data.total_amount);
                });
                var salesChart = document.getElementById("latest_sales_income").getContext('2d');

                var ecgDiagram = new Chart(salesChart, {
                    type: 'bar',
                    data: {
                        labels:dateTime,
                        datasets: [{
                            label: 'Sales',
                            data: salesData,
                            borderWidth: 3,
                            borderColor: 'rgb(0, 127, 212)',
                            fill:false,
                            tension: 0.3,
                            pointRadius: 0
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


            var expensesUrl = "{{url('dashboard/expenses/chart')}}";
            var dateTime = new Array();
            var expensesData = new Array();
            $.get(expensesUrl, function(response){
                response.forEach(function(data){
                    dateTime.push(data.created_at);
                    expensesData.push(data.amount);
                });
                var expensesChart = document.getElementById("expenses_chart").getContext('2d');

                var ecgDiagram = new Chart(expensesChart, {
                    type: 'line',
                    data: {
                        labels:dateTime,
                        datasets: [{
                            label: 'Expenses',
                            data: expensesData,
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
        });
    
    </script>
@endpush