@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>CA Details</h5>
                </div>
            </div>
            <div class="card customer-details-group">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
											<span class="customer-widget-img d-inline-flex">
											<img class="rounded-circle" src="{{asset('/public/uploads/profile/'.$users->comp_logo)}}" alt="">
											</span>
                                    <div class="customer-details-cont">
                                        <h6>{{ $users->comp_name }}</h6>
                                        <p></p>
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
                                        <p><a href="mailto:{{ $users->comp_email }}">{{ $users->comp_email }}</a></p>
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
                                        <p>{{ $users->comp_phone }}</p>
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
                                        <p>{{ $users->comp_name }}</p>
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
                                        <p class="customer-mail">{{ $users->comp_website }}</p>
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
                                        <h6>Company Address</h6>
                                        <p>{{ $users->state.",".$users->city }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-users"></i>
											</span>
                                    <div class="customer-details-cont">
                                        <h6>Customer Count</h6>
                                        <p>{{$users->customerNo}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-award"></i>
											</span>
                                    <div class="customer-details-cont">
                                        <h6>Specialized On</h6>
                                        <p>{{$users->ca_spec}}</p>
                                    </div>
                                </div>
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
                                        <th>Company Name</th>
                                        <th>Phone</th>
                                        <th>Assigned From</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php $i = 1; ?>
										@foreach ($customers as $customer)
                                        <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('/client-view/'.base64_encode($customer->id)) }}" class="avatar avatar-md me-2"><img class="avatar-img rounded-circle" src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}" alt="User Image"></a>
                                                <a href="{{ url('/client-view/'.base64_encode($customer->id)) }}">{{ ($customer->comp_name!="")?$customer->comp_name:$customer->name }} <span><span class="__cf_email__">{{$customer->email}}</span></span></a>
                                            </h2>
                                        </td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{ date("d M Y",strtotime($customer->created_at)) }}</td>
                                        <td><span class="badge badge-pill bg-success-light">Active</span></td>
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
														@if ($customer->ca_current_status==1)
                                                        <li>
                                                            <a data-id="{{$customer->id}}" data-stat="2" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Un-Assign</a>
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
