<div class="modal fade" id="period-modal">
    <div class="modal-dialog">
        <form action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Choose Period</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-5">
{{--                    <div class="form-group row">--}}
{{--                        <label for="" >Store</label>--}}
{{--                        <select name="store" class="form-control" >--}}
{{--                            <option value="">~~SELECT STORE~~</option>--}}
{{--                            <option value="All Stores">All Stores</option>--}}
{{--                            <option value="Kigali Height">Kigali Height</option>--}}
{{--                            <option value="UTC">UTC</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="form-group row">
                        <label for="" >From</label>
                        <input type="date" class="form-control" name="start">
                    </div>
                    <div class="form-group row">
                        <label for="">To</label>
                        <input type="date" class="form-control" name="end">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Fetch</button>
                </div>
            </div>
        </form>
    </div>
</div>
