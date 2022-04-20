<button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
<div class="dropdown-menu">

    <a href="{{route('customer.edit',$id)}}" class="dropdown-item">Edit</a>
    <a href="{{route('sale-order.add')}}" class="dropdown-item">Place Order</a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item" onclick="deleteAlert('{{$id}}','{{$names}}')">Remove</a>
    <form action="{{route('customer.destroy',$id)}}" method="post" id="delete-customer-{{$id}}">
        @method('DELETE')
        @csrf
    </form>
</div>
