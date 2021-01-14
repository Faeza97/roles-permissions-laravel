<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('pos_device.index')}}" method="POST" id="pos_create">
                @csrf

                <div class="card">
                    <div class="card-header">Add a POS Device info </div>

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
                                <label for="imei">IMEI: </label>
                                <input type="text" value="{{ $pos_device->imei ?? '' }}" class="form-control" id="imei"
                                    placeholder="The imei" name="imei">
                            </div>
                            <div class="col-sm-6">
                                <label for="serial_number">POS Serial Number:: </label>
                                <input type="text" value="{{ $pos_device->serial_number ?? '' }}" class="form-control"
                                    placeholder="The serial number" id="serial_number" name="serial_number" />
                                <span id="serial" style="color:red"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="brand">Brand: </label>
                                <input type="text" value="{{$pos_device->brand ?? '' }}" class="form-control" id="brand"
                                    placeholder="The brand" name="brand" />
                            </div>
                            <div class="col-sm-6">
                                <label for="model"> Model: </label>
                                <input type="text" value="{{ $pos_device->model ?? '' }}" class="form-control"
                                    placeholder="The model" id="model" name="model" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="carton_no">Carton Number: </label>
                                <input type="text" value="{{ $pos_device->carton_no ?? '' }}" class="form-control"
                                    placeholder="The carton number" id="carton_no" name="carton_no" />
                            </div>
                            <div class="col-sm-6">
                                <label for="batch">Batch: </label>
                                <input type="text" value="{{ $pos_device->batch ?? '' }}" class="form-control"
                                    placeholder="The batch" id="batch" name="batch" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="date-picker">Date Received: </label>
                                <input type="text" value="{{ $pos_device->date_received ?? '' }}" class="form-control"
                                    placeholder="yyyy-mm-dd" id="date-picker" name="date_received" />
                            </div>
                            <div class="col-sm-6">
                                <label for="remarks">Remarks: </label>
                                <input type="text" value="{{ $pos_device->remarks ?? '' }}" class="form-control"
                                    placeholder="Additional info" id="remarks" name="remarks" />
                            </div>
                        </div>
                            <div class="form-group">
                                <strong> <label for="status"> Status: </label>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                <label class="radio-inline"><input type="radio" name="status" value="New"
                                        {{ (isset($pos_device->status) && $pos_device->status == 'New') ? "New" : ""}}>
                                    New</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="status" value="Used"
                                        {{ (isset($pos_device->status) && $pos_device->status == 'Used') ? "Used" : "" }}>
                                    Used</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="status" value="Damaged"
                                        {{ (isset($pos_device->status) && $pos_device->status == 'Damaged') ? "Damaged" : "" }}>
                                    Damaged</label>
                            </div>
                            <div class="form-group">
                                <strong> <label for="availability"> Availability: </label>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                <label class="radio-inline"><input type="radio" name="availability" value="instock"
                                        {{ (isset($pos_device->availability) && $pos_device->availability == 'instock') ? "instock" : ""}}>
                                    Instock</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="availability" value="sub_distributors"
                                        {{ (isset($pos_device->availability) && $pos_device->availability == 'sub_distributors') ? "sub_distributors" : "" }}>
                                   Sub distributors</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline"><input type="radio" name="availability" value="dealer"
                                        {{ (isset($pos_device->availability) && $pos_device->availability == 'dealer') ? "dealer" : "" }}>
                                    Dealer</label>
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
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
