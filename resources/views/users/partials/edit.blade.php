<div class="modal fade" id="edit-user-modal">
    <div class="modal-dialog">
        <form action="{{route('users.update')}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" id="user-id" name="userId">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Names</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="form-group row">
                        <label for="" >Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" placeholder="firstname@nzizacrafts.rw">
                    </div>
                    <div class="form-group row">
                        <label for="" >Phone</label>
                        <input type="number" class="form-control" id="edit-phone" name="phone">
                    </div>
                    <div class="form-group row">
                        <label for="">Role</label>
                        <select name="role" class="form-control" id="edit-role">
                            <option value="">~~SELECT ROLE~~</option>
                            <option value="">Seller</option>
                            <option value="">Administrator</option>
                        </select>
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
