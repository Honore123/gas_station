<div class="modal fade" id="add-product-modal">
    <div class="modal-dialog modal-xl">
        <form action="{{route('sale-order.store')}}" method="post">
            @csrf
            <input type="hidden" id="customer-order-id" name="customerOrderId" {{isset($customerOrder->id) ? 'value='.$customerOrder->id.'':''}}>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" class="col-md-1 text-left">Category</label>
                        <select name="category" id="category" class="form-control col-md-4">
                            <option value="">~~SELECT CATEGORY~~</option>
                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @empty
                                <option value="" disabled>No Category</option>
                            @endforelse
                        </select>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody id="product-table">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button class="btn btn-info btn-flat">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
