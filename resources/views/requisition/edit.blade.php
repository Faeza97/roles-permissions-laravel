<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit The Request Form</div>
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

                    <form action="{{ route('requisition.update',$requisition->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Sub Distributor: </label>

                                <select class="form-control" id="sub_distributors_id" name="sub_distributors_id" required>
                                    <option></option>
                                    @foreach($users as $user)
                                    @if($user->type === 'Distributor')
                                    <option value=" {{  $user->id }}" @if($requisition->
                                        sub_distributors_id==$user->id) selected @endif>
                                        {{ $user->name . '  (' . $user->mobile_no . ') '  }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Sales Rep: </label>
                                <select class="form-control" id="sales_rep_id" name="sales_rep_id" required>
                                    <option></option>
                                    @foreach($users as $user)
                                    @if($user->type === 'SalesRep')
                                    <option value="{{  $user->id }}" @if($requisition->
                                        sales_rep_id==$user->id) selected @endif>
                                        {{   $user->name . '  (' . $user->mobile_no . ') ' }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Dealer: </label>
                                <select class="form-control" id="dealer_id" name="dealer_id" required>
                                    <option></option>
                                    @foreach($users as $user)
                                    @if($user->type === 'Dealer')
                                    <option value="{{ $user->id }}" @if($requisition->
                                        dealer_id==$user->id) selected @endif>
                                        {{  $user->name . '  (' . $user->mobile_no . ') ' }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="title">Remarks: </label>
                                <input type="text" value="{{ $requisition->remarks }}" class="form-control" id="remarks"
                                    name="remarks" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="description"> <strong>Type:</strong> </label>
                                <select class="btn btn-light" name="type">
                                    <option value="New" {{ $requisition->type == 'new' ? 'selected' : '' }}> New
                                    </option>
                                    <option value="Replacement"
                                        {{ $requisition->type == 'Replacement'     ? 'selected' : '' }}>
                                        Replacement
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label> <strong>Status:</strong> </label>
                                <select class="btn btn-light" name="status">
                                    <option value="Pending" {{ $requisition->status == 'Pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="Processing"
                                        {{ $requisition->status == 'Processing' ? 'selected' : '' }}> Processing
                                    </option>
                                    <option value="Pending" {{ $requisition->status == 'Approved' ? 'selected' : '' }}>
                                        Approved
                                    </option>
                                    <option value="Delivered"
                                        {{ $requisition->status == 'Delivered' ? 'selected' : '' }}> Delivered
                                    </option>
                                    <option value="Hold" {{ $requisition->status == 'Hold' ? 'selected' : '' }}> Hold
                                    </option>
                                    <option value="Rejected" {{ $requisition->status == 'Rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>
                                    <option value="Canceled" {{ $requisition->status == 'Canceled' ? 'selected' : '' }}>
                                        Canceled
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
                                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
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
