@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <h5 class="card-title">All Users</h5>
                            <div class="card-tools">
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#add-user-modal">
                                    New User
                                </button>
                                @include('users.partials.add')
                                @include('users.partials.edit')
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <th>#</th>
                                    <th>Names</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Store</th>
                                    <th>Option</th>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="text-middle">{{$loop->iteration++}}</td>
                                            <td class="text-middle">{{$user->name}}</td>
                                            <td class="text-middle">{{$user->phone ? $user->phone : 'No phone'}}</td>
                                            <td class="text-middle">{{$user->role}}</td>
                                            <td class="text-middle">{{isset($user->store->location) ? $user->store->location : 'No store'}}</td>
                                            <td class="text-middle">
                                                <button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
                                                <div class="dropdown-menu">
                                                    <a href="#" class="dropdown-item" onclick="editUser('{{$user->id}}')">Edit</a>
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#assign-store-modal-{{$user->id}}">Assign Store</button>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item" onclick="deleteAlert('{{$user->id}}','{{$user->name}}')">Remove</a>
                                                </div>
                                                @include('users.partials.assign-store')
                                                <form action="{{route('user.destroy',$user->id)}}" method="post" id="delete-user-{{$user->id}}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No user</td>
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
    </div>
@endsection
@push('scripts')
    <script>
        function deleteAlert(id, name){
            swal.fire( {
                title:'Confirmation',
                text:'Do you want to delete ' + name + ' user',
                icon: 'info',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-user-'+ id).submit();
                }
            });
        }

        function editUser(id) {
            $.ajax({
                method: 'get',
                url: '/settings/users/edit/' +id,
                success: function (response) {
                    $('#user-id').val(response.id)
                    $('#edit-name').val(response.name)
                    $('#edit-email').val(response.email)
                    $('#edit-phone').val(response.phone)
                    $('#edit-user-modal').modal('show')
                }
            })
        }
    </script>
@endpush
