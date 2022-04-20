<div class="modal fade" id="add-store-modal">
    <div class="modal-dialog">
        <form action="{{route('store.add')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Store</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Location</label>
                        <input type="text" class="form-control" name="location">
                    </div>
                    <div class="form-group row">
                        <label for="" >Store's Phone</label>
                        <input type="number" class="form-control" name="store_phone">
                    </div>
                    <div class="form-group row">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="5">

                        </textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" >Seller</label>
                        <select name="store_seller" class="form-control">
                            <option value="">~~SELECT SELLER~~</option>
                            @forelse($sellers as $seller)
                                 <option value="{{$seller->id}}">{{$seller->name}}</option>
                            @empty
                                <option value="" disabled>No Sellers</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
