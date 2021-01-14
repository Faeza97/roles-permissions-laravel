<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Review Details</div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td>Sub Distributor:</td>
                                <td>
                                    @foreach($users as $user)
                                    @if($requisition->sub_distributors_id == $user->id)
                                    <strong> {{$user->name}}</strong>
                                    @endif
                                    @endforeach
                                </td>
                                <td>Sales Rep:</td>
                                <td>
                                    @foreach($users as $user)
                                    @if($requisition->sales_rep_id == $user->id)
                                    <strong> {{$user->name}}</strong>
                                    @endif
                                    @endforeach
                                </td>
                            </tr>

                            <tr>
                                <td>Dealer:</td>
                                <td>
                                    @foreach($users as $user)
                                    @if($requisition->dealer_id == $user->id)
                                    <strong> {{$user->name}}</strong>
                                    @endif
                                    @endforeach
                                </td>

                                <td>Type:</td>
                                <td><strong>{{$requisition->type}}</strong></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td><strong>{{$requisition->status}}</strong></td>
                                <td>Remarks:</td>
                                <td><strong>{{$requisition->remarks}}</strong></td>
                            </tr>
                            <tr>
                                <td>Approved by:</td>
                                <td><strong>{{$requisition->approve_by}}</strong></td>
                                <td>Account document:</td>
                                <td>
                                    <strong>{{$requisition->acc_document}} </strong>
                                <!-- <a class="btn-success" href="{{ $requisition->acc_document }}" target="_blank"> Open </a> -->
                                </td>
                            </tr>
                            <tr>
                                <td>Fastlink MSISDN:</td>
                                <td>
                                    @foreach($fastlink_numbers as $fastlink_number)
                                    @if($requisition->fastlink_numbers_id == $fastlink_number->id)
                                    <strong> {{ $fastlink_number->msisdn  }}</strong>
                                    @endif
                                    @endforeach
                                </td>
                                <td>POS S/N:</td>
                                <td>
                                @foreach($pos_devices as $pos_device)
                                    @if($requisition->pos_devices_id == $pos_device->id)
                                    <strong> {{ $pos_device->serial_number }}</strong>
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <span aria-hidden="true">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
