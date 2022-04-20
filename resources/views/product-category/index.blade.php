@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.partials.notification')
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">All Categories</h5>
                            <div class="card-tools">
                                <button class="btn btn-info rounded-0" data-toggle="modal" data-target="#add-store-modal">
                                    New Category
                                </button>
                                @include('product-category.partials.add')
                                @include('product-category.partials.edit')
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Option</th>
                                </thead>
                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="text-middle">{{$loop->iteration++}}</td>
                                        <td class="text-middle">{{$category->category_name}}</td>
                                        <td class="text-middle">
                                            <button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
                                            <div class="dropdown-menu">
                                                <a href="#" onclick="editStore('{{$category->id}}')" class="dropdown-item">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"  onclick="deleteAlert('{{$category->id}}','{{$category->category_name}}')">Remove</a>
                                            </div>
                                            <form action="{{route('category.destroy',$category->id)}}" method="post" id="delete-store-{{$category->id}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No category yet</td>
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
        function deleteAlert(id, name){
            swal.fire( {
                title:'Confirmation',
                text:'Do you want to delete ' + name + ' category',
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
                url:'/settings/product_category/edit/'+id,
                success: function (response) {
                    $('#category_id').val(response.id)
                    $('#edit-name').val(response.category_name)
                    $('#edit-store-modal').modal('show')
                }
            })
        }

    </script>
@endpush
