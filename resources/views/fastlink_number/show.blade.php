<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">  Review Details
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>MSISDN:</td>
                            <td><strong>{{$fastlink_number->msisdn}}</strong></td>
                        </tr>
                        <tr>
                            <td>Fastlink Serial Number:</td>
                            <td><strong>{{$fastlink_number->serial_number}}</strong></td>
                        </tr>
                        <tr>
                            <td>Batch:</td>
                            <td><strong>{{$fastlink_number->batch}}</strong></td>
                        </tr>
                        <tr>
                            <td>Date Recieved:</td>
                            <td><strong>{{date_format($fastlink_number->date_received, 'jS M Y')}} </strong></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td><strong>{{$fastlink_number->status}}</strong></td>
                        </tr>
                        <tr>
                            <td>Remarks:</td>
                            <td><strong>{{$fastlink_number->remarks}}</strong></td>
                        </tr>

                        <tr>
                            <td>Availability:</td>
                            <td><strong>{{$fastlink_number->availability}}</strong></td>
                        </tr>

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