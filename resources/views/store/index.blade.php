@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stores & Kiosks</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Stores & Kiosks</li>
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
                            <h5 class="card-title">All Stores</h5>
                            <div class="card-tools">
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#add-store-modal">
                                    New Store
                                </button>
                                @include('store.partials.add')
                                @include('store.partials.edit')
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <th>#</th>
                                <th>Location</th>
                                <th>Seller</th>
                                <th>Phone</th>
                                <th>Description</th>
                                <th>Option</th>
                                </thead>
                                <tbody>
                                @forelse($stores as $store)
                                    <tr>
                                        <td class="text-middle">{{$loop->iteration++}}</td>
                                        <td class="text-middle">{{$store->location}}</td>
                                        <td class="text-middle">{{$store->seller->name}}</td>
                                        <td class="text-middle">{{$store->store_phone}}</td>
                                        <td class="text-middle">{{$store->description}}</td>
                                        <td class="text-middle">
                                            <button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
                                            <div class="dropdown-menu">
                                                <a href="#" onclick="editStore('{{$store->id}}')" class="dropdown-item">Edit</a>
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#assign-seller-modal-{{$store->id}}">Assign Seller</a href="#">
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"  onclick="deleteAlert('{{$store->id}}','{{$store->location}}')">Remove</a>
                                            </div>
                                            <form action="{{route('store.destroy',$store->id)}}" method="post" id="delete-store-{{$store->id}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @include('store.partials.assign-seller')
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No store yet</td>
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
@push('scripts')
    <script>
        function deleteAlert(id, location){
            swal.fire( {
                title:'Confirmation',
                text:'Do you want to delete ' + location + ' store',
                icon: 'info',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-store-'+ id).submit();
                }
            });
        }

        function editStore(id) {
            $.ajax({
                method: 'get',
                url:'/settings/store/edit/'+id,
                success: function (response) {
                    $('#store_id').val(response.id)
                    $('#edit-location').val(response.location)
                    $('#edit-phone').val(response.store_phone)
                    $('#edit-description').val(response.description)
                    $('#edit-seller').val(response.seller)
                    $('#edit-store-modal').modal('show')
                }
            })
        }

    </script>
@endpush
