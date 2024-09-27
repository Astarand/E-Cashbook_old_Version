@extends('layouts.default')
@section('content')
<div class="page-wrapper">
				<div class="content container-fluid">
					<div class="page-header">
						<div class="content-page-header">
							<h5>My Subscription Plans</h5>
							<div class="list-btn">
								<ul class="filter-list">
									<li>
										<a class="btn btn-primary" href="{{ url('/subscriber-plans') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Buy Subscription</a>
									</li>
								</ul>
							</div>
							<div class="list-btn">
								<ul class="filter-list">
									<li>
										<a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
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
					<div class="row">
						<div class="col-sm-12">
							<div class="card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Provider Name</th>
													<th>Package Name</th>
													<th>Subscription Type</th>
													<th>Amount</th>
													<th>service</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Status</th>
													<th>Transaction Id</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												@foreach ($subData as $val)
												<tr>
													<td><?php echo $i++; ?></td>
													<td>
														<h2 class="table-avatar">
															<a href="javascript:void(0);" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{asset('/public/uploads/profile/'.$val->comp_logo)}}" alt=""></a>
															<a href="javascript:void(0);">{{ $val->name }} </a>
														</h2>
													</td>
													<td>{{ $val->plan_name }}</td>
													<td><span class="badge badge-pill bg-success-light">{{ $val->plan_type }}</span></td>
													<td>₹{{ $val->paid_amount }}</td>
													<td>{{ $val->service }}</td>
													<td>{{ date('d-m-Y', strtotime($val->start_at)) }}</td>
													<td>{{ date('d-m-Y', strtotime($val->end_at)) }}</td>
													<td>
													@if ($val->payment_status=="SUCCESS")  
														<span class="badge badge-pill bg-success-light">{{$val->payment_status}}</span>
													@else
														<span class="badge badge-pill bg-danger-light">{{$val->payment_status}}</span>
													@endif
													</td>
													<td>{{ $val->transaction_id }}</td>													

												</tr>
												@endforeach
												
											</tbody>
										</table>
										<div class="d-flex justify-content-center">
											<?php echo $subData_pagination->links() ?>
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
										Customer
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
														<span><img src="assets/img/icons/search.svg" alt="img"></span>
													</div>
													<div class="selectBox-cont">
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Brian Johnson
														</label>
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Russell Copeland
														</label>
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Greg Lynch
														</label>
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> John Blair
														</label>
														<div class="view-content">
															<div class="viewall-One">
																<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Barbara Moore
																</label>
																<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Hendry Evan
																</label>
																<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Richard Miles
																</label>
															</div>
															<div class="view-all">
																<a href="javascript:void(0);" class="viewall-button-One"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion" id="accordionMain2">
								<div class="card-header-new" id="headingTwo">
									<h6 class="filter-title">
										<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
										Select Date
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
										</a>
									</h6>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
									<div class="card-body-chat">
										<div class="form-group">
											<label class="form-control-label">From</label>
											<div class="cal-icon">
												<input type="email" class="form-control datetimepicker" placeholder="DD-MM-YYYY">
											</div>
										</div>
										<div class="form-group">
											<label class="form-control-label">To</label>
											<div class="cal-icon">
												<input type="email" class="form-control datetimepicker" placeholder="DD-MM-YYYY">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion" id="accordionMain3">
								<div class="card-header-new" id="headingThree">
									<h6 class="filter-title">
										<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
										By Status
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
										</a>
									</h6>
								</div>
								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
									<div class="card-body-chat">
										<div id="checkBoxes2">
											<div class="form-custom">
												<input type="text" class="form-control" id="member_search2" placeholder="Search here">
												<span><img src="assets/img/icons/search.svg" alt="img"></span>
											</div>
											<div class="selectBox-cont">
												<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> All Invoices
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Paid
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Overdue
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Draft
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Recurring
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Cancelled
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion accordion-last" id="accordionMain4">
								<div class="card-header-new" id="headingFour">
									<h6 class="filter-title">
										<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
										Category
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
										</a>
									</h6>
								</div>
								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample4">
									<div class="card-body-chat">
										<div id="checkBoxes3">
											<div class="selectBox-cont">
												<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Advertising
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Food
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Repairs
												</label>
												<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Software
												</label>
												<div class="view-content">
													<div class="viewall-Two">
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Stationary
														</label>
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Medical
														</label>
														<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Designing
														</label>
													</div>
													<div class="view-all">
														<a href="javascript:void(0);" class="viewall-button-Two"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
							<span><img src="assets/img/icons/chart.svg" class="me-2" alt="Generate report"></span>Generate report
							</button>
						</form>
					</div>
				</div>
			</div>

@endsection
