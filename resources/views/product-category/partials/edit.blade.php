<div class="modal fade" id="edit-store-modal">
    <div class="modal-dialog">
        <form action="{{route('category.update')}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="category" id="category_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Name</label>
                        <input type="text" class="form-control" id="edit-name" name="category_name">
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
