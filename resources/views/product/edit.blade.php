@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="{{route('product.index')}}">Product</a></li>
                        <li class="breadcrumb-item">Edit</li>
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
                            <h5 class="card-title">Main Information</h5>
                            <div class="card-tools">
                                <a href="{{route('product.index')}}" class="btn btn-info rounded-0">
                                    Go Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('product.update', $product->id)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Category</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="category_id" id="category_id">
                                                    <option value="">~~SELECT CATEGORY~~</option>
                                                    @forelse($categories as $category)
                                                        @if($product->category_id === $category->id)
                                                            <option value="{{$category->id}}" selected>{{$category->category_name}}</option>
                                                        @else
                                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                        @endif
                                                    @empty
                                                        <option value="" disabled>No category</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Material</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="material_id" id="material_id">
                                                    <option value="">~~SELECT MATERIAL~~</option>
                                                    @forelse($materials as $material)
                                                        @if($product->material_id === $material->id)
                                                            <option value="{{$material->id}}" selected>{{$material->material_type}}</option>
                                                        @else
                                                            <option value="{{$material->id}}">{{$material->material_type}}</option>
                                                        @endif
                                                    @empty
                                                        <option value="" disabled>No Material</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="product_name" name="product_name" value="{{$product->product_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Unit</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="unit" id="unit">
                                                    <option value="">~~SELECT UNIT~~</option>
                                                    @for($i = 0; $i < 5; $i++)
                                                        <option value="{{$i + 1}}">Pieces</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Barcode</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="barcode" name="barcode" value="{{$product->barcode}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">
                                                    {{$product->description}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="actions" class="row">
                                    <div class="col-md-12 border-bottom border-top py-2 my-4">
                                        <h5>Product Images</h5>
                                    </div>
                                    @php
                                        $images = json_decode($product->images, true);
                                    @endphp
                                    @forelse($images as $image)
                                    <div class="col-md-3">
                                        <img src="{{asset('storage/products/images/'.$image)}}" class="img-fluid" alt="">
                                    </div>
                                    @empty
                                        <div class="col-md-12 text-center">
                                            <p>No Product Images</p>
                                        </div>
                                    @endforelse
                                    <div class="col-md-12 dropzone needsclick" id="image-dropzone">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 border-bottom border-top py-2 my-4">
                                        <h5>Price & Cost</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Retail Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="retail_price" name="retail_price" value="{{$product->retail_price}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Purchase Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="purchase_price" name="purchase_price" value="{{$product->purchase_price}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Vendor</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="vendor_id" id="vendor_id">
                                                    <option value="">~~SELECT VENDOR~~</option>
                                                    @forelse($vendors as $vendor)
                                                        @if($product->vendor_id === $vendor->id)
                                                            <option value="{{$vendor->id}}" selected>{{$vendor->names}}</option>
                                                        @else
                                                            <option value="{{$vendor->id}}">{{$vendor->names}}</option>
                                                        @endif
                                                    @empty
                                                        <option value="" disabled>No Vendor</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-2">
                                    <div class="col-md-11 text-right">
                                        <button type="submit" class="btn btn-outline-info btn-flat start">
                                            Update Product
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
@push('scripts')
    <script>
        var uploadedImageMap = {}
        Dropzone.options.imageDropzone = {
            url:'{{route('product.images')}}',
            maxFilesize: 2, //MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN':'{{csrf_token()}}'
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="image[]" value="'+response.name+'"/>')
                uploadedImageMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if(typeof file.file_name !== 'undefined'){
                    name = file.file_name
                } else {
                    name = uploadedImageMap[file.name]
                }
                $.ajax({
                    method:'delete',
                    url:'{{route('product.image-delete')}}',
                    data:{image: name},
                    headers: {'X-CSRF-TOKEN':'{{csrf_token()}}'},
                    success: function (response) {
                        if (response.status === true) {
                            $('form').find('input[name="image[]"][value="' + name + '"]').remove()
                        }
                    }
                })
            },
            init: function () {
                    @if(isset($product) && $product->image)
                var files = {!! json_encode($product->image) !!}
                    for(var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this,file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image[]" value="'+file.file_name+'"/>')
                }
                @endif
            }
        }
    </script>
@endpush
