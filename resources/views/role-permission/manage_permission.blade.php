@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles & Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles & Permissions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.partials.notification')
               @include('role-permission.partials.roles')
                <div class="col-md-8">
                    <div class="card no-border">
                        <div class="card-header with-border">
                            <h4 class="card-title">{{ $role_permission->name }}</h4>
                            <p class="text-gray">Choose permission below</p>
                        </div>
                        <div class="card-body">
                            <form action="{{route('permission.async', $role_permission->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    @foreach($permissions as $category => $permission)
                                        <div class="col-md-4">
                                            <h4 class="col-md-12">{{$category}}</h4>
                                            <div class="col-md-10 col-md-offset-1">
                                                @foreach($permission as $perm)
                                                    <div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="perms[]" value="{{$perm->name}}" class="icheck bg-orange-active" @if($perm->hasRole($role_permission->name))
                                                                checked @endif>
                                                                {{$perm->display_name}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class=" col-md-12 btn btn-info btn-flat" style="margin-top: 1em !important;margin-bottom: 1em !important;">Give permission</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
