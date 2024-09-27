@extends('layouts.default')

@section('content')

		@if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Our CA</h5>
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
							<li>
                                <a class="btn btn-primary" href="{{ url('/add-ca') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Our CA</a>
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
                <div class="col-sm-12">
                    <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
								
                                <tr>
                                    <th>#</th>
                                    <th>CA Name</th>
                                    <th>CA Phone</th>
                                    <th>CA Email </th>
									<th>CA State/City/Pin </th>
                                    <th>CA Address</th>
                                    <th>Created</th>
                                    <th>Assign Status</th>
                                    <th>Login Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $i = 1; ?>
								@foreach ($ca_details as $ca_detail)
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a></a>
                                            <a href="javascript:void(0);">{{ $ca_detail->name }} </a>
                                        </h2>
                                    </td>
                                    <td>{{ $ca_detail->phone }}</td>
                                    <td>{{ $ca_detail->email }}</td>
                                    <td>{{ $ca_detail->ca_state }}/{{ $ca_detail->ca_city }}/{{ $ca_detail->pincode}}</td>
                                    <td>{{ $ca_detail->addr_one }}</td>
                                    <td>{{ date('d-m-Y', strtotime($ca_detail->created_at)) }}</td>
									<td>										
										@if ($ca_detail->isCaActive==0)  
											<span class="badge badge-pill bg-danger-light">Un-Assigned</span>
										@else
											<span class="badge badge-pill bg-success-light">Assigned</span>
										@endif
									</td>
									@if ($ca_detail->status==0)  
										<td><span class="badge badge-pill bg-danger-light">InActive</span></td>
									@else
										<td><span class="badge badge-pill bg-success-light">Active</span></td>
									@endif
                                    <td class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> </a>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/edit-ca/'.base64_encode($ca_detail->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                </li>
												@if ($ca_detail->status==0)
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="1" class="dropdown-item show_status" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Active</a>
                                                </li>
												@else
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="0" class="dropdown-item show_status" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>InActive</a>
                                                </li>
												@endif
                                            </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
							<div class="d-flex justify-content-center">
								<?php echo $ca_pagination->links() ?>
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
                        <button type="reset" data-bs-dismiss="modal" id="del_cust" data-id=""  class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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

@endsection