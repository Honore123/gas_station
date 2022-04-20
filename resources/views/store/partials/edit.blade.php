<div class="modal fade" id="edit-store-modal">
    <div class="modal-dialog">
        <form action="{{route('store.update')}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="store" id="store_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Store</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Location</label>
                        <input type="text" class="form-control" id="edit-location" name="location">
                    </div>
                    <div class="form-group row">
                        <label for="" >Store's Phone</label>
                        <input type="number" class="form-control" id="edit-phone" name="store_phone">
                    </div>
                    <div class="form-group row">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="edit-description" cols="30" rows="5">

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
