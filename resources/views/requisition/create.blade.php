@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Bulk Request Form</div>
                <div class="card-body">
                    <form action="{{ route('requisition.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <div class="dynamicDiv" id="dynamicDiv">
                            <table class="table table-bordered" id="dynamicTable">
                                <thead>
                                    <tr>
                                        <th>Distributor</th>
                                        <th>Sales Rep</th>
                                        <th>Dealer</th>
                                        <th width="180px">Type</th>
                                        <th width="180px">Status</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select id="dynamicRow" name="addmore[0][sub_distributors_id]"
                                                class="subdisid form-control">
                                                <option selected disabled hidden>Choose </option>
                                                @foreach($users as $user)
                                                @if($user->type === 'Distributor')
                                                <option value="{{ $user->id }}">
                                                    {{  $user->name . '  (' . $user->mobile_no . ') '  }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td> <select name="addmore[0][sales_rep_id]" class="sales_rep_id form-control">
                                                <option selected disabled hidden>Choose </option>
                                                @foreach($users as $user)
                                                @if($user->type === 'SalesRep')
                                                <option value="{{ $user->id }}">
                                                    {{  $user->name . '  (' . $user->mobile_no . ') ' }}</option>
                                                @endif
                                                @endforeach
                                            </select></td>
                                        <td> <select name="addmore[0][dealer_id]" class="dealer_id form-control">
                                                <option selected disabled hidden>Choose </option>
                                                @foreach($users as $user)
                                                @if($user->type === 'Dealer')
                                                <option value="{{ $user->id }}">
                                                    {{  $user->name . '  (' . $user->mobile_no . ') '  }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="type form-control" name="addmore[0][type]">
                                                <option value=" 0" selected disabled hidden>Select Type</option>
                                                <option value="1">New</option>
                                                <option value="2">Replacement</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="status form-control" name="addmore[0][status]">
                                                <option value="0" selected disabled hidden>Select Status</option>
                                                <option value="1">Pending</option>
                                                <option value="2">Processing</option>
                                                <option value="3">Approved</option>
                                                <option value="4">Delivered</option>
                                                <option value="5">Hold</option>
                                                <option value="6">Rejected</option>
                                                <option value="7">Canceled</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="addmore[0][remarks]" placeholder="comment"
                                                class="remarks form-control" /></td>
                                        <td><input type="button" name="add" value="+" id="add"
                                                class="btn btn-success add">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="dynamicDiv" id="dynamicDiv2"> </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{ route('requisition.index') }}" class="btn btn-danger pull-right">Back</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
