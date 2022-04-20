<button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
<div class="dropdown-menu">
    <a href="{{route('product.edit',$id)}}" class="dropdown-item">Edit</a>
    <a href="" class="dropdown-item">Options</a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item" onclick="deleteAlert('{{$id}}','{{$product_name}}')">Remove</a>
    <form action="{{route('product.destroy',$id)}}" method="post" id="delete-product-{{$id}}">
        @method('DELETE')
        @csrf
    </form>
</div>
