@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Search form -->
    <form action="{{ route('pos_device.index') }}" method="GET" role="search">
        @csrf
        <div class="form-group row">
            <div class="col-sm-3">
                <label>POS S/N: </label>
                <input class="form-control" name="serial_number" type="number" placeholder="POS Serial Number">
            </div>
            <div class="col-sm-3">
                <label>Status: </label>
                <select class="form-control" type="search" name="status">
                    <option selected disabled hidden>Choose </option>
                    <option>New</option>
                    <option>Used</option>
                    <option>Damaged</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Availability: </label>
                <select class="form-control" type="search" name="availability">
                    <option selected disabled hidden>Choose </option>
                    <option>Instock</option>
                    <option>Dealer</option>
                    <option>Sub_distributors</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Date Received: </label>
                <div class="input-group">
                    <input class="form-control" id="datepicker" name="date_received" type="text"
                        placeholder="yyyy-mm-dd">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pt-3 text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Clear</button>
            </div>
        </div>
    </form>

    <div class="row justify-content">
        <div class="col">
            <div class="card">
                <div class="card-header">FastPay: POS Device Contract List</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a class="btn btn-info text-light" data-toggle="modal" id="mediumButton"
                                data-target="#mediumModal" data-attr="{{ route('pos_device.create') }}"
                                title="Create a pos device info"> <i class="fas fa-plus-circle"></i>Fill out POS Device
                                Info
                            </a>
                              <a class="btn btn-info text-light" data-toggle="modal" id="mediumButton"
                                data-target="#mediumModal" data-attr="{{ route('pos_device.createBulk') }}"
                                title="add a bulk of pos device"><i class="fa fa-upload" aria-hidden="true"></i>
                                Bulk Upload
                            </a>
                        </div>
                    </div>
                    <hr>
                    @if ($message = Session::get('status'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <table class="table table-bordered table-responsive-lg table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <!-- POS Information  -->
                                <th>#</th>
                                <th scope="col">IMEI</th>
                                <th>POS S/N</th>
                                <th scope="col">Batch</th>
                                <th scope="col">Status</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Date Received</th>
                                <th scope="col">Created At</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pos_devices as $pos_device)
                            <tr>
                                <th scope="row">{{$pos_device->id}}</th>
                                <td>{{$pos_device->imei}}</td>
                                <td>{{$pos_device->serial_number}}</td>
                                <td>{{$pos_device->batch}}</td>
                                <td>
                                    @if($pos_device->status =='New')
                                    <label class="badge badge-success">New</label>
                                    @elseif($pos_device->status =='Used')
                                    <label class="badge badge-danger">Used</label>
                                    @else
                                    <label class="badge badge-warning">Damaged</label>
                                    @endif
                                </td>
                                <td>
                                    @if($pos_device->availability =='instock')
                                    <label class="btn-outline-dark"> Instock </label>
                                    @elseif($pos_device->availability =='dealer')
                                    <label class="btn-outline-primary"> Dealer </label>
                                    @else
                                    <label class="btn-outline-secondary"> Sub_distributors </label>
                                    @endif
                                </td>
                                <td>{{date_format($pos_device->date_received, 'jS M Y')}}</td>
                                <td>{{ date_format($pos_device->created_at, 'jS M Y') }}</td>
                                <td>
                                    <form action="{{ route('pos_device.destroy', $pos_device->id) }}" method="POST">

                                        <a data-toggle=" modal" id="mediumButton" data-target="#mediumModal"
                                            data-attr="{{ route('pos_device.show', $pos_device->id) }}" title="show">
                                            <i class="fas fa-eye ml-3 fa-lg text-success"></i>
                                        </a>
                                        <a class="text-secondary" data-toggle="modal" id="mediumButton"
                                            data-target="#mediumModal"
                                            data-attr="{{ route('pos_device.edit', $pos_device->id) }}">
                                            <i class="fas fa-edit ml-3 fa-lg text-gray-300"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are You Sure to delete this?')"
                                            title="delete"
                                            style="border: none; outline: none; background-color:transparent;">
                                            <i class="fas fa-trash ml-1 fa-lg text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{ $pos_devices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!--  modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body" id="mediumBody">
                <div>
                    <!-- the result  here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
