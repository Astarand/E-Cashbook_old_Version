@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-sm-12 col-12">
                        <div class="list-btn mb-4">
                        @if (Auth::user()->u_type == 2)
                            <ul class="filter-list justify-content-end">
                                <li>
                                    <a class="btn btn-primary" href="{{ url('/addbank') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add New Bank Account</a>
                                </li>
								<li>
                                    <a class="btn btn-primary" href="{{ url('/bank-statement-upload') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Uplaod Statement</a>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    @foreach ($banks as $val)
                    <div class="col-xl-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-2" style="background-color:transparent"><i class="fa-solid fa-building-columns"></i></span>
                                    <div class="dash-count">
                                        <div class="dash-title"><a href="{{ url('/bank-statement/'.base64_encode($val->id)) }}">{{ $val->bank_name }} - Add & Show Transaction</a></div>
                                        <div class="dash-counts mt-1">
                                            <div class="row">
                                                <div class="col-12 pt-1"><p> <strong>Account Holder:</strong>{{ $val->accholder_name }} </p></div>
                                                <div class="col-12 pt-1"><p> <strong>Account Number:</strong>{{ $val->bank_ac_no }}</p></div>
                                                <div class="col-12 py-1"><p> <strong>UPI ID:</strong>{{ $val->upi_id }}</p></div>
                                                <div class="col-6"><p> <strong>Account Type:</strong> Current</p></div>
                                                <div class="col-6"><p> <strong>IDFC Code:</strong>{{ $val->ifsc_code }}</p></div>
                                                <div class="col-6"><p><strong>Branch:</strong>{{ $val->bank_branch }}</p></div>
                                                <div class="col-6"><p> <strong>Swift Code:</strong>{{ $val->swift_code }}</p></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-2" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="row">
                                    <div class="col-4 mt-2 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="me-1">Current Balance</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ $val->curr_bal }}</h6>
                                    </div>
                                    <div class="col-4 mt-2 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-success me-1">Credit</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ $val->availableLimit }}</h6>
                                    </div>
                                    <div class="col-4 mt-2 text-center">
                                        <p class="text-muted"><span class="text-danger me-1">Dabit</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ $val->outstanding }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>



@stop






