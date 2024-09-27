@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Cash Management</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Share"><i class="fa-brands fa-whatsapp"></i></span> </a>
                            </li>
                            <li>
                                <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                    <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="d-block">
                                            <li>
                                                <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-pdf me-2"></i>PDF</a>
                                            </li>
                                            <li>
                                                <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-text me-2"></i>Excel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="filter_inputs" class="card filter-card">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-2" style="background-color:transparent"><i class="fa-solid fa-wallet"></i></span>
                                <div class="dash-count">
                                    <div class="dash-title"><h4>Cash In Hand
									@if (Auth::user()->u_type == 2)
									<a class="active btn-filters" data-bs-toggle="modal" data-bs-target="#update"> <span><i class="fe fe-edit me-1"></i></span></a>
									@endif
									</h4></div>
                                </div>
								(As on {{$cashInHandDate}})
								
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-2" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2 text-center">
                                    <p class="text-muted"><span class="me-1">Total Cash in Hand</span> </p>
                                    <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ $cashInHand }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-2" style="background-color:transparent"><i class="fa-solid fa-wallet"></i></span>
                                <div class="dash-count">
                                    <div class="dash-title"><h4>Cash Details</h4></div>
                                </div>
								(As on {{$cashAsOnDate}})
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-2" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-2 text-center" style="border-right:1px solid #ddd;">
                                    <p class="text-muted"><span class="text-success me-1">Credit</span></p>
                                    <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ $totalCredit }}</h6>
                                </div>
                                <div class="col-6 mt-2 text-center">
                                    <p class="text-muted"><span class="text-danger me-1">Debit</span></p>
                                    <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ $totalDebit }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="align-items-center">Credit / Outward</h5>
                                </div>
                                <div class="col-6 pb-4 d-flex justify-content-end">
                                    <div class="list-btn">
										@if (Auth::user()->u_type == 2)
                                       {{-- <ul class="filter-list">
                                            <li>
                                                <a class="btn btn-primary" href="add-cash-credit"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Credit</a>
                                            </li>
                                        </ul>--}}
										@endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card-table">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Particulars</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
													<?php $i = 1; ?>
													@foreach ($cash_credit as $val)
                                                    <tr class="bg-success-light">
                                                        <td><?php echo $i++; ?></td>
                                                        <td>{{ date("d M y",strtotime($val->cd_date)) }}</td>
                                                        <td>{{ $val->particulars }}</td>
                                                        <td><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; {{ $val->cd_amount }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <a href="javascript:void(0);" data-id="{{$val->id}}" data-type="credit" onClick="tally_credit_debit(this);" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i> Tally</a>
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
																
																	@if ( (Auth::user()->u_type == 2 || Auth::user()->u_type == 3))
                                                                    <ul>
																		<li>
                                                                            <a class="dropdown-item" href="{{ url('/view-cash-credit/'.base64_encode($val->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                                        </li>
                                                                       <!-- <li>
                                                                            <a class="dropdown-item" href="{{ url('/edit-cash-credit/'.base64_encode($val->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item cashCreditDelete" href="javascript:void(0);" data-id="{{$val->id}}" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                                        </li>-->
                                                                    </ul>
																	@endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
													@endforeach
                                                    </tbody>
                                                </table>
												<div class="d-flex justify-content-center">
												<?php echo $cash_credit_pagination->links() ?>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="align-items-center">Debit / Inward</h5>
                                </div>
                                <div class="col-6 pb-4 d-flex justify-content-end">
                                    <div class="list-btn">
										@if (Auth::user()->u_type == 2)
                                       {{-- <ul class="filter-list">
                                            <li>
                                                <a class="btn btn-primary" href="add-cash-debit"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Debit</a>
                                            </li>
                                        </ul>--}}
										@endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card-table">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Particulars</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
													<?php $i = 1; ?>
													@foreach ($cash_debit as $val)
                                                    <tr class="bg-danger-light">
                                                        <td><?php echo $i++; ?></td>
                                                        <td>{{ date("d M y",strtotime($val->cd_date)) }}</td>
                                                        <td>{{ $val->particulars }}</td>
                                                        <td><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; {{ $val->cd_amount }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <a href="javascript:void(0);" data-id="{{$val->id}}" data-type="debit" onClick="tally_credit_debit(this);" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i> Tally</a>
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
																	@if ( (Auth::user()->u_type == 2 || Auth::user()->u_type == 3))
                                                                    <ul>
																		<li>
                                                                            <a class="dropdown-item" href="{{ url('/view-cash-debit/'.base64_encode($val->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                                        </li>
                                                                       <!-- <li>
                                                                            <a class="dropdown-item" href="{{ url('/edit-cash-debit/'.base64_encode($val->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item cashDebitDelete" href="javascript:void(0);" data-id="{{$val->id}}" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                                        </li>-->
                                                                    </ul>
																	@endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
													@endforeach
                                                    </tbody>
                                                </table>
												<div class="d-flex justify-content-center">
												<?php echo $cash_debit_pagination->links() ?>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Filter</h5>
                <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
            </div>
            <div class="sidebar-body">
                <form action="#" autocomplete="off">
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Customer Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Email Address
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Phone Number
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    By Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> All Status
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Activate
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Deactivate
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-buttons">
                        <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
                            Apply
                        </button>
                        <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Customer</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="reset" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="update" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0 align-center">
                        <h4 class="mb-0">Upload your Statement</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="align-center" aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form  action="javascript:void(0);" method="POST" name="addCashHandFrm" id="addCashHandFrm">
				@csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group mb-0 pb-0">
                                <label>Update Inhand Cash</label>
                                <input type="text" name="amount_in_hand" id="amount_in_hand" class="form-control" placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="message-container"></div>
				<div id="cashLoader" class="loader"></div>
                <div class="modal-footer add-tax-btns">
                    <button type="reset" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
	
		<div class="modal fade" id="DesPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span class="align-center" aria-hidden="true">&times;</span>
						</button>
                    </div>
                    <div class="modal-body" id="listOfNotes">
						<div class="row">
                        <div class="col-lg-12 col-md-12">
						<div id="tblgrid"></div>
						</div>
						</div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
@endsection






