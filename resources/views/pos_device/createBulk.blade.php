<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bulk Upload POS Device</div>
                <div class="card-body">
                    <form action="{{ route('pos_device.importPos') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="title">Upload File: </label>
                                <input type="file" name="file" class="form-control" id="" />
                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                    Make sure your file is Microsoft Excel Worksheet (.xlsx)
                                </small> </div>
                        </div>
                        <div class="card-footer">
                            <div id="response"> </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <span aria-hidden="true">Close</span>
                                    </button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <input type="submit" id="submitUpload" value="Upload" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
