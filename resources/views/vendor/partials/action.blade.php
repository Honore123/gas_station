<button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
<div class="dropdown-menu">
    <a href="{{route('vendor.edit',$id)}}" class="dropdown-item">Edit</a>
    <a href="#" class="dropdown-item">Products</a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item" onclick="deleteAlert('{{$id}}','{{$names}}')">Remove</a>
    <form action="{{route('vendor.destroy',$id)}}" method="post" id="delete-vendor-{{$id}}">
        @method('DELETE')
        @csrf
    </form>
</div>
