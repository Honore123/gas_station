<div class="modal fade" id="add-store-modal">
    <div class="modal-dialog">
        <form action="{{route('category.add')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Name</label>
                        <input type="text" class="form-control" name="category_name">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
