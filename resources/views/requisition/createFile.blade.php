<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Verification: Upload Document</div>
                <div class="card-body">
                    <form action="{{ route('storefile' , $requisition->id) }}" id="FileUploadForm">
                        @csrf
                        <div id="successAlert"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="title"> Account Status: </label>
                                <select class="form-control" name="acc_status" id="acc_status">
                                    <option value="0" {{ $requisition->acc_status == 0 ? 'selected' : '' }}> Inactive
                                    </option>
                                    <option value="1" {{ $requisition->acc_status == 1     ? 'selected' : '' }}> Active
                                    </option>
                                    <span for="" class="text-danger font-weight-bold" id="accstatus"></span>
                                </select>
                            </div>
                            <div class="col-sm-12 pt-4">
                                <label for="title"> Account document File: </label>
                                <div>
                                    @if (!empty($requisition->acc_document))
                                    <label id="smthgFound" class="badge-success">
                                        {{ $requisition->acc_document }}
                                    </label>
                                    @else
                                    <label id="nothingFound" class="badge-danger">
                                        Nothing uploaded </label>
                                    @endif
                                </div>
                                <input type="file" name="acc_document" class="form-control" id="acc_document" />
                                <span class="text-danger font-weight-bold" for="" id="accdocument"></span>
                            </div>
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
                                    <input type="submit" id="submitUpload" value="Upload document"
                                        class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
