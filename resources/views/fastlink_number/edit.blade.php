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

                    <form action="{{ route('fastlink_number.update',$fastlink_number->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">MSISDN: </label>
                                <input type="text" value="{{ $fastlink_number->msisdn}}" class="form-control"
                                    id="msisdn" name="msisdn">
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Serial Number: </label>
                                <input type="text" value="{{ $fastlink_number->serial_number }}" class="form-control"
                                    id="serial_number" name="serial_number" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Batch: </label>
                                <input type="text" value="{{ $fastlink_number->batch }}" class="form-control" id="batch"
                                    name="batch" />
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Date Received: </label>
                                <input type="text" value="{{ date_format($fastlink_number->date_received, 'Y-m-d')  }}" class="form-control"
                                    id="date-picker" name="date_received" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Remarks: </label>
                            <input type="text" value="{{ $fastlink_number->remarks }}" class="form-control" id="remarks"
                                name="remarks" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label> <strong>Availability:</strong> </label>
                                <select class="btn btn-light" name="availability">
                                    <option value="instock"
                                        {{ $fastlink_number->availability == 'instock' ? 'selected' : '' }}> Instock
                                    </option>
                                    <option value="sub_distributors"
                                        {{ $fastlink_number->availability == 'sub_distributors'     ? 'selected' : '' }}>
                                        Sub Distributors
                                    </option>
                                    <option value="dealer"
                                        {{ $fastlink_number->availability == 'dealer'     ? 'selected' : '' }}> Dealer
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label> <strong>Status:</strong> </label>
                                <select class="btn btn-light" name="status">
                                    <option value="new" {{ $fastlink_number->status == 'new' ? 'selected' : '' }}> New
                                    </option>
                                    <option value="used" {{ $fastlink_number->status == 'used'     ? 'selected' : '' }}>
                                        Used
                                    </option>
                                    <option value="damaged"
                                        {{ $fastlink_number->status == 'damaged'     ? 'selected' : '' }}> Damaged
                                    </option>
                                </select>
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
