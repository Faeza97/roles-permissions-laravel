@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Search form -->
    <form action="{{ route('requisition.index') }}" method="GET" role="search">
        @csrf
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="title">Distributor: </label>
                <select name="sub_distributors_id" class="form-control">
                    <option selected disabled hidden>Choose </option>
                    @foreach($users as $user)
                    @if($user->type === 'Distributor')
                    <option value="{{ $user->id }}"> {{ $user->name  }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <label for="title">Sales Rep: </label>
                <select name="sales_rep_id" class="form-control">
                    <option selected disabled hidden>Choose </option>
                    @foreach($users as $user)
                    @if($user->type === 'SalesRep')
                    <option value="{{ $user->id }}"> {{ $user->name  }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <label for="title">Dealer :</label>
                <select name="dealer_id" class="form-control">
                    <option selected disabled hidden>Choose </option>
                    @foreach($users as $user)
                    @if($user->type === 'Dealer')
                    <option value="{{ $user->id }}"> {{ $user->name  }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <!-- <div class="col-sm-2">
                <label for="title">Type </label>
                <select class="form-control" type="search" name="type">
                    <option selected disabled hidden>Choose </option>
                    <option>New</option>
                    <option>Replacement</option>
                </select>
            </div> -->
            <div class="col-sm-3">
                <label for="title">Status: </label>
                <select class="form-control" type="search" name="status">
                    <option selected disabled hidden>Choose </option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Approved</option>
                    <option>Delivered</option>
                    <option>Hold</option>
                    <option>Rejected</option>
                    <option>Canceled</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Created at: </label>
                <div class="input-group">
                    <input class="form-control" id="datepicker" name="created_at" type="text" placeholder="yyyy-mm-dd">
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
                <div class="card-header">FastPay: Request Info</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{ route('requisition.create') }}" class="btn btn-info text-light">
                                <i class="fas fa-plus-circle"></i> Bulk Request Form</a>
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
                    <table class="table table-bordered table-responsive-lg table-hover" id="requestList">
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>Distributor</th>
                            <th>SalesRep</th>
                            <th>Dealer</th>
                            <th>Type</th>
                            <!-- <th>Created at</th> -->
                            <th>Account</th>
                            <th width="190px">Document</th>
                            <th width="170px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requisitions as $requisition)
                            <tr>
                                <th scope="row">{{$requisition->id}}</th>
                                <td>
                                    @foreach($users as $user)
                                    @if($requisition->sub_distributors_id == $user->id)
                                    {{$user->name }}
                                    @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach($users as $user)
                                    @if($requisition->sales_rep_id == $user->id)
                                    {{$user->name}}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($users as $user)
                                    @if($requisition->dealer_id == $user->id)
                                    {{$user->name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <!-- {{$requisition->type}} -->
                                    @if($requisition->type =='New')
                                    <label class="badge badge-info">New</label>
                                    @elseif($requisition->type =='Replacement')
                                    <label class="badge badge-warning">Replacement</label>
                                    @endif
                                </td>

                                <!-- <td>{{ date_format($requisition->created_at, 'jS M Y') }}</td>  -->
                                <td>
                                    <div class="col-md-6">
                                        <a style="display:inline-block; text-decoration:none; margin-right:10px;"
                                            class="text-secondary" data-toggle="modal" id="mediumButton"
                                            data-target="#mediumModal" title="verify"
                                            data-attr="{{ route('upload' , $requisition->id)  }}">
                                            @if (!empty($requisition->acc_document))
                                            <label class="badge badge-pill badge-success">
                                                <i class="fas fa-check-circle"></i> Verified
                                            </label>
                                            @else
                                            <label class="badge badge-pill badge-secondary">
                                                <i class="fas fa-times-circle"></i> Verify</label>
                                            @endif
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <a href="{{ $requisition->acc_document }}" title="download" download>
                                        Download
                                        </a>
                                        │
                                        @if (!empty($requisition->fastlink_numbers_id && $requisition->pos_devices_id))
                                        <a href="{{ route('requisition.pdfTemplate', $requisition->id) }}" title="print"
                                            target="_blank">
                                           Print
                                        </a>
                                        @else
                                         <a href="#" class="disabled"> Print</a>
                                         @endif
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('requisition.destroy',$requisition->id) }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <a data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                            data-attr="{{ route('requisition.assign', $requisition->id) }}"
                                            title="assign">
                                            <i class="fas fa-user-tag ml-3" title="assign"></i>
                                        </a>
                                        <a data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                            data-attr="{{ route('requisition.show', $requisition->id) }}" title="show">
                                            <i class="fas fa-eye ml-3 text-success"></i>
                                        </a>
                                        <a class="text-secondary" data-toggle="modal" id="mediumButton"
                                            data-target="#mediumModal" title="edit"
                                            data-attr="{{ route('requisition.edit', $requisition->id) }}">
                                            <i class="fas fa-edit ml-3 text-gray-300"></i>
                                        </a>
                                        <button type="submit" onclick="return confirm('Are You Sure to delete this?')"
                                            title="delete"
                                            style="border: none;  outline: none; background-color:transparent;">
                                            <i class="fas fa-trash ml-1 text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
             {{ $requisitions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- medium modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body" id="mediumBody">
                <form id="modal-form" method="get">
                    <div>
                        <!-- the result of displayed apply here -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
