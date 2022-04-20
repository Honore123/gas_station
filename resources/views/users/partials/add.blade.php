<div class="modal fade" id="add-user-modal">
    <div class="modal-dialog">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Names</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group row">
                        <label for="" >Email</label>
                        <input type="email" class="form-control" name="email" placeholder="firstname@nzizacrafts.rw">
                    </div>
                    <div class="form-group row">
                        <label for="" >Phone</label>
                        <input type="number" class="form-control" name="phone">
                    </div>
                    <div class="form-group row">
                        <label for="">Role</label>
                        <select name="role" class="form-control">
                            <option value="">~~SELECT ROLE~~</option>
                            @forelse($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @empty
                                <option value="" disabled>No roles</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" >Store</label>
                        <select name="storeSeller" class="form-control">
                            <option value="">~~SELECT STORE~~</option>
                            @forelse($stores as $store)
                                <option value="{{$store->id}}">{{$store->location}}</option>
                            @empty
                                <option value="" disabled>No store</option>
                            @endforelse
                        </select>
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
