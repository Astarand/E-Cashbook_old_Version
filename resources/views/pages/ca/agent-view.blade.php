@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Agent Details</h5>
                </div>
            </div>
            <div class="card customer-details-group">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-img d-inline-flex">
                                    <img class="rounded-circle" src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}" alt="">
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>{{ $agent->agent_name }}</h6>
                                        <p>{{ $agent->agent_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-mail"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Email Address</h6>
                                        <p>{{ $agent->agent_email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-phone"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Phone Number</h6>
                                        <p>{{ $agent->agent_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-airplay"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Company Name</h6>
                                        <p>{{ $agent->company_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-globe"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Website</h6>
                                        <p class="customer-mail">{{ $agent->company_website }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>WhatsApp</h6>
                                        <p class="customer-mail"><a href="https://wa.link/fg5kcb">{{ $agent->agent_whats_no }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-briefcase"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Address</h6>
                                        <p>{{ $agent->address_lineone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <th>Client ID</th>
                                        <th>Company Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php $i = 1; ?>
										@foreach ($customers as $customer)
										<tr>
											<td><?php echo $i++; ?></td>
											<td>{{ $customer->id }}</td>
											<td>
												<h2 class="table-avatar">
													<a></a>
													<a href="{{ url('/client-view/'.base64_encode($customer->id)) }}">{{ ($customer->comp_name!="")?$customer->comp_name:$customer->name }} <span><span class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">[email&#160;protected]</span></span></a>
												</h2>
											</td>
											<td>{{ $customer->phone }}</td>

											<td>
												@if ($customer->ca_current_status==0)
												<span class="badge badge-pill bg-primary-light">Requested</span>
												@elseif ($customer->ca_current_status==1)
												<span class="badge badge-pill bg-success-light">Active</span></td>
												@elseif ($customer->ca_current_status==2)
												<span class="badge badge-pill bg-danger-light">Deactive</span></td>
												@elseif ($customer->ca_current_status==3)
												<span class="badge badge-pill bg-danger-light">Rejected</span></td>
												@endif
												</td>
											<td class="d-flex align-items-center">
												<div class="dropdown dropdown-action">
													<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-end">
													<ul>
														<li>
															<a class="dropdown-item" href="{{ url('/editclient/'.base64_encode($customer->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
														</li>
														<!--<li>
															<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
														</li>-->
														<li>
															<a class="dropdown-item" href="{{ url('/client-view/'.base64_encode($customer->id)) }}"><i class="far fa-eye me-2"></i>View</a>
														</li>
														@if ($customer->ca_current_status==0 || $customer->ca_current_status==2)
														<li>
															<a data-id="{{$customer->id}}" data-stat="1" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
														</li>
														@elseif ($customer->ca_current_status==1)
														<li>
															<a data-id="{{$customer->id}}" data-stat="2" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
														</li>
														@endif
														@if ($customer->ca_current_status==0)
														<li>
															<a data-id="{{$customer->id}}" data-stat="3" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Reject</a>
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
									<?php echo $customers_pagination->links() ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Customer Details</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Delete</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
