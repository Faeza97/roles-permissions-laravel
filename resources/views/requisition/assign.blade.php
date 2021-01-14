<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Assign The Request Form (FastlinkNumber and PosDevice)</div>
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

                    <form action="{{ route('requisition.storeAssign',$requisition->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="title">Fastlink Number ID: </label>
                                <select class="form-control" id="fastlink_numbers_id" name="fastlink_numbers_id" required>
                                    <option></option>
                                    @foreach($fastlink_numbers as $fastlink_number)
                                    @if(!empty ($fastlink_number->id))
                                    <option value="{{$fastlink_number->id }}" @if($requisition->
                                        fastlink_numbers_id==$fastlink_number->id) selected @endif>
                                      MSISDN:  {{ $fastlink_number->msisdn  . ' - S/N: (' . $fastlink_number->serial_number  . ') '  }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="title">POS ID: </label>
                                <select class="form-control" id="pos_devices_id" name="pos_devices_id" required>
                                    <option></option>
                                @foreach($pos_devices as $pos_device)
                                    @if(!empty ($pos_device->id))
                                    <option value="{{  $pos_device->id }}" @if($requisition->
                                        pos_devices_id==$pos_device->id) selected @endif>
                                       IMEI: {{ $pos_device->imei   . ' - S/N: (' . $pos_device->serial_number  . ') '  }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                    Inorder to be able to print the document, you have to assign Fastlink Number ID + POS ID first here.
                                </small>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <span aria-hidden="true">Close</span>
                                    </button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="update" class="btn btn-primary">Assign Changes</button>
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
