<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('fastlink_number.index')}}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header"> Add a FastLink Number</div>

                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">MSISDN: </label>
                                <input type="text" value="{{ $fastlink_number->msisdn ?? '' }}" class="form-control"
                                    placeholder="The msisdn" id="msisdn" name="msisdn">
                            </div>
                            <div class="col-sm-6">
                                <label for="title"> Serial Number: </label>
                                <input type="text" value="{{ $fastlink_number->serial_number ?? '' }}"
                                    placeholder="The serial number" class="form-control" id="serial_number"
                                    name="serial_number" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Batch: </label>
                                <input type="text" value="{{ $fastlink_number->batch ?? '' }}" class="form-control"
                                    placeholder="The batch" id="batch" name="batch" />
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Remarks: </label>
                                <input type="text" value="{{ $fastlink_number->remarks ?? '' }}" class="form-control"
                                    placeholder="additional info" id="remarks" name="remarks" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Date Received: </label>
                                <input type="text" value="{{ $fastlink_number->date_received ?? '' }}" id="date-picker"
                                    placeholder="yyyy-mm-dd" class="form-control" id="date_received"
                                    name="date_received" />
                            </div>
                            <div class="col-sm-6">
                                <label for="description"> Status: </label><br />
                                <label class="radio-inline"><input type="radio" name="status" value="new"
                                        {{ (isset($fastlink_number->status) && $fastlink_number->status == 'new') ? "new" : ""}}>
                                    New</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="status" value="used"
                                        {{ (isset($fastlink_number->status) && $fastlink_number->status == 'used') ? "used" : "" }}>
                                    Used</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="status" value="damaged"
                                        {{ (isset($fastlink_number->status) && $fastlink_number->status == 'damaged') ? "damaged" : "" }}>
                                    Damaged</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <strong> <label for="availability"> Availability:
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                <label class="radio-inline"><input type="radio" name="availability" value="instock"
                                        {{ (isset($pos_device->availability) && $pos_device->availability == 'instock') ? "instock" : ""}}>
                                    Instock</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="availability"
                                        value="sub_distributors"
                                        {{ (isset($pos_device->availability) && $pos_device->availability == 'sub_distributors') ? "sub_distributors" : "" }}>
                                    Sub distributors</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="availability" value="dealer"
                                        {{ (isset($pos_device->availability) && $pos_device->availability == 'dealer') ? "dealer" : "" }}>
                                    Dealer</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <span aria-hidden="true">Close</span>
                                </button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
