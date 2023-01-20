@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Activity Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Logs</li>
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
                            <h5 class="card-title">All Logs</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Subject</th>
                                <th>Date</th>
                                </thead>
                                <tbody>
                                @forelse($activities as $activity)
                                    <tr>
                                        <td class="text-middle">{{$loop->iteration++}}</td>
                                        <td class="text-middle">{{$activity->causer_id ==  null ? "Device" : $activity->causer->name}}</td>
                                        <td class="text-middle">{{$activity->description}}</td>
                                        <td class="text-middle">{{$activity->subject->names ?$activity->subject->names: $activity->subject->description }}</td>
                                        <td class="text-middle">{{date('d/m/Y,  H:i', strtotime($activity->created_at))}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No activity yet</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
