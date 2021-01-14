@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Search form -->
    <form action="{{ route('fastlink_number.index') }}" method="GET" role="search">
        @csrf
        <div class="form-group row">
            <div class="col-sm-3">
                <label for="title">Fastlink number S/N: </label>
                <input class="form-control" name="serial_number" type="number" placeholder="Fastlink Serial Number">
            </div>
            <div class="col-sm-3">
                <label for="title">Status: </label>
                <select class="form-control" type="search" name="status">
                    <option selected disabled hidden>Choose </option>
                    <option>New</option>
                    <option>Used</option>
                    <option>Damaged</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="title">Availability: </label>
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
                <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Clear</button> </div>
        </div>
    </form>
    <div class="row justify-content">
        <div class="col">
            <div class="card">
                <div class="card-header">FastPay: Fastlink Number List</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a class="btn btn-info text-light" data-toggle="modal" id="mediumButton"
                                data-target="#mediumModal" data-attr="{{ route('fastlink_number.create') }}"
                                title="Create a fastlink number"> <i class="fas fa-plus-circle"></i> Fill out the
                                Fastlink
                                Number Info
                            </a>
                                <a class="btn btn-info text-light" data-toggle="modal" id="mediumButton"
                                data-target="#mediumModal" data-attr="{{ route('fastlink_number.createBulk') }}"
                                title="Create a bulk of fastlink number"><i class="fa fa-upload" aria-hidden="true"></i>
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
                                <th scope="col"> MSISDN</th>
                                <th>  S/N</th>
                                <th scope="col">Status</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Date Received</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Created At</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fastlink_numbers as $fastlink_number)
                            <tr>
                                <th scope="row">{{$fastlink_number->id}}</th>
                                <td>{{$fastlink_number->msisdn}}</td>
                                <td>{{$fastlink_number->serial_number}}</td>
                                <td>
                                    @if($fastlink_number->status =='new')
                                    <label class="badge badge-success">New</label>
                                    @elseif($fastlink_number->status =='used')
                                    <label class="badge badge-danger">Used</label>
                                    @else
                                    <label class="badge badge-warning">Damaged</label>
                                    @endif
                                </td>

                                <td>
                                    @if($fastlink_number->availability =='instock')
                                    <label class="btn-outline-dark"> Instock </label>
                                    @elseif($fastlink_number->availability =='dealer')
                                    <label class="btn-outline-primary"> Dealer </label>
                                    @else
                                    <label class="btn-outline-secondary"> Sub Distributors </label>
                                    @endif
                                </td>
                                <td>{{date_format($fastlink_number->date_received, 'jS M Y')}}</td>
                                <td>{{$fastlink_number->remarks}}</td>
                                <td>{{date_format($fastlink_number->created_at, 'jS M Y')}}</td>

                                <td>
                                    <form action="{{ route('fastlink_number.destroy',$fastlink_number->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <a data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                            data-attr="{{ route('fastlink_number.show',$fastlink_number->id)}}"
                                            title="show">
                                            <i class="fas fa-eye ml-3 fa-lg text-success"></i>
                                        </a>
                                        <a class="text-secondary" data-toggle="modal" id="mediumButton"
                                            data-target="#mediumModal"
                                            data-attr="{{ route('fastlink_number.edit',$fastlink_number->id) }}">
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
                    {{ $fastlink_numbers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal -->
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
