<div class="modal fade" id="assign-store-modal-{{$user->id}}">
    <div class="modal-dialog">
        <form action="{{route('users.shop', $user->id)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Store</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
                    <div class="form-group row">
                        <label for="" >Store</label>
                        <select name="store" class="form-control">
                            <option value="">~~SELECT STORE~~</option>
                            @forelse($stores as $store)
                                <option value="{{$store->id}}">{{$store->location}}</option>
                            @empty
                                <option value="" disabled>No Store</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>
