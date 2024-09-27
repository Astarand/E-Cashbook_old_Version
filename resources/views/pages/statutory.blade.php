@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="row">
				@if (Auth::user()->u_type == 1)
				<div class="col-sm-12 pb-4 d-flex justify-content-end">
					<a class="btn btn-primary" href="{{ url('/addstatutory') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Compliances / Statutory</a>
				</div>
				@endif
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>    
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Document</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Message By CA</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php $i = 1; ?>
										@foreach ($statutory as $val)
                                        <tr>
										<td>{{ $i++ }}</td>
										<td>{{ $val->comp_name }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a></a>
                                                <a href="#">{{ $val->statutory_doc }} <span></span></a>
                                            </h2>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($val->statutory_due_date)) }}</td>
                                        <td>
											@if ( $val->status ==0 )
												<span class="badge badge-pill bg-danger-light">Pending</span>
											@elseif ( $val->status ==1 )
												<span class="badge badge-pill bg-success-light">Complete</span>
											@elseif ( $val->status ==2 )
												<span class="badge badge-pill bg-warning-light text-warning">On-going</span>
											@endif
										</td>
                                        <td>{{ $val->statutory_msg }}</td>
                                        <td class="d-flex align-items-center">
											
											<a  href="{{ url('/chat-response/'.base64_encode(Auth::user()->id).'/'.base64_encode($val->compId).'/'.base64_encode($val->id)) }}"   class="btn btn-outline-success relative" >
												<span data-toggle="tooltip" data-placement="top" title="Message"><i class="fa fa-envelope " ></i></span><span class="mcCircle">{{ count($val->messages) }}</span>
											</a>
											@if (Auth::user()->u_type == 1)
                                            <a href="{{ url('/editstatutory/'.base64_encode($val->id)) }}" class="btn btn-greys me-2"><i class="fa fa-edit me-1"></i> Edit</a>
											@endif
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/viewstatutory/'.base64_encode($val->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
									
									@endforeach
                                        
                                    </tbody>
                                </table>
								<div class="d-flex justify-content-center">
									<?php echo $statutory_pagination->links() ?>
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

@endsection
