<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit POS Information</div>
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

                    <form action="{{ route('pos_device.update',$pos_device->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">IMEI: </label>
                                <input type="text" value="{{ $pos_device->imei}}" class="form-control" id="imei"
                                    name="imei">
                            </div>
                            <div class="col-sm-6">
                                <label for="title">POS Serial Number: </label>
                                <input type="text" value="{{ $pos_device->serial_number }}" class="form-control"
                                    id="serial_number" name="serial_number" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">POS Brand: </label>
                                <input type="text" value="{{$pos_device->brand }}" class="form-control" id="brand"
                                    name="brand" />
                            </div>
                            <div class="col-sm-6">
                                <label for="title">POS Model: </label>
                                <input type="text" value="{{ $pos_device->model }}" class="form-control" id="model"
                                    name="model" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Carton Number: </label>
                                <input type="text" value="{{ $pos_device->carton_no }}" class="form-control"
                                    id="carton_no" name="carton_no" />
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Batch: </label>
                                <input type="text" value="{{ $pos_device->batch }}" class="form-control" id="batch"
                                    name="batch" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Date Received: </label>
                                <input type="text" value="{{date_format($pos_device->date_received, 'Y-m-d')}}" class="form-control"
                                    id="date-picker" name="date_received" />
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Remarks: </label>
                                <input type="text" value="{{ $pos_device->remarks }}" class="form-control" id="remarks"
                                    name="remarks" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="description"> <strong>Status:</strong> </label>
                                <select class="btn btn-light" name="status">
                                    <option value="new" {{ $pos_device->status == 'new' ? 'selected' : '' }}> New
                                    </option>
                                    <option value="used" {{ $pos_device->status == 'used'     ? 'selected' : '' }}>
                                        Used
                                    </option>
                                    <option value="damaged"
                                        {{ $pos_device->status == 'damaged'     ? 'selected' : '' }}> Damaged
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label> <strong>Availability:</strong> </label>
                                <select class="btn btn-light" name="availability">
                                    <option value="instock"
                                        {{ $pos_device->availability == 'instock' ? 'selected' : '' }}> Instock
                                    </option>
                                    <option value="sub_distributors"
                                        {{ $pos_device->availability == 'sub_distributors'     ? 'selected' : '' }}>
                                        Sub Distributors
                                    </option>
                                    <option value="dealer"
                                        {{ $pos_device->availability == 'dealer'     ? 'selected' : '' }}> Dealer
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                    <label> Availability: </label><br />
                    <label class="radio-inline"><input type="radio" name="availability" value="instock"
                            {{ (isset($pos_device->availability) && $pos_device->availability == 'instock') ? "instock" : "" }}>Instock</label>
                    <label class="radio-inline"><input type="radio" name="availability" value="sub_distributors"
                            {{ (isset($pos_device->availability) && $pos_device->availability == 'sub_distributors') ? "sub_distributors" : "" }}>
                            Sub Distributors</label>
                        <label class="radio-inline"><input type="radio" name="availability" value="dealer"
                            {{ (isset($pos_device->availability) && $pos_device->availability == 'dealer') ? "dealer" : "" }}>
                        Dealer</label>
                     </div> -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <span aria-hidden="true">Close</span>
                                    </button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
