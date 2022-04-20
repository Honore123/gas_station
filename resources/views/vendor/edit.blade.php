@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="{{route('vendor.index')}}">Vendor</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Vendor Information</h5>
                            <div class="card-tools">
                                <a href="{{route('vendor.index')}}" class="btn btn-info rounded-0">
                                    Go Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('vendor.update',$vendor->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Names</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="names" name="names" value="{{$vendor->names}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{$vendor->phone_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" value="{{$vendor->email}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Location</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="location" name="location" value="{{$vendor->location}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Vendor ID</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="vendor_id" name="vendor_id" value="{{$vendor->vendor_id}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">
                                                    {{$vendor->description}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-2">
                                    <div class="col-md-11 text-right">
                                        <button class="btn btn-outline-info btn-flat">
                                            Update Vendor
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
