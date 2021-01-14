<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Review Details</div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>IMEI:</td>
                            <td><strong>{{$pos_device->imei}}</strong></td>

                            <td>POS Serial Number:</td>
                            <td><strong>{{$pos_device->serial_number}}</strong></td>
                        </tr>
                        <tr>
                            <td>Model:</td>
                            <td><strong>{{$pos_device->model}}</strong></td>

                            <td>Brand:</td>
                            <td><strong>{{$pos_device->brand}}</strong></td>
                        </tr>
                        <tr>
                            <td>Carton Number:</td>
                            <td><strong>{{$pos_device->carton_no}}</strong></td>
                            <td>Batch:</td>
                            <td><strong>{{$pos_device->batch}}</strong></td>
                        </tr>
                        <tr>
                            <td>Date Recieved:</td>
                            <td><strong>{{date_format($pos_device->date_received, 'jS M Y')}} </strong></td>
                            <td>Status:</td>
                            <td><strong>{{$pos_device->status}}</strong></td>
                        </tr>
                        <tr>
                            <td>Remarks:</td>
                            <td><strong>{{$pos_device->remarks}}</strong></td>
                            <td>Availability:</td>
                            <td><strong>{{$pos_device->availability}}</strong></td>
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