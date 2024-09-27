@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Customer Details</h5>
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
                                        <p><a href="mailto:{{ $users->comp_email }}" >{{ $users->comp_email }}</a></p>
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
											<i class="fe fe-user-check"></i>
											</span>
                                    <div class="customer-details-cont">
                                        <h6>Assign CA</h6>
                                        <p>{{ $users->assignCa }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-package"></i>
											</span>
                                    <div class="customer-details-cont">
                                        <h6>Active Package</h6>
                                        <p>Quertly</p>
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
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>Invoice No
                                        </th>
                                        <th>Category</th>
                                        <th>Created On</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Balance</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php $i = 1; ?>
									@foreach ($payments as $payment)
                                    <tr>
                                        <td>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a href="invoice-details.html" class="invoice-link">{{ $payment->pay_voucher_no }}</a>
                                        </td>
                                        <td>{{ $payment->payment_type }}</td>
                                        <td>{{ date("d M Y",strtotime($payment->created_at)) }}</td>
                                        <td>₹{{$payment->amount}}</td>
                                        <td>₹{{$payment->amount}}</td>
                                        <td>{{$payment->mode_of_payment}}</td>
                                        <td>₹{{$payment->amount}}</td>
                                        <td>{{ date("d M Y",strtotime('+30 days',strtotime($payment->created_at))) }}</td>
                                        <td><span class="badge bg-success-light">Paid</span></td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                    <ul>
                                                        <!--<li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>-->
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-download me-2"></i>Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="add-credit-notes.html"><i class="fe fe-file-text me-2"></i>Convert to Sales Return</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
									@endforeach
                                    <!--<tr>
                                        <td>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a href="invoice-details.html" class="invoice-link">#4988</a>
                                        </td>
                                        <td>Advertising</td>
                                        <td>16 Mar 2022</td>
                                        <td>$3,54,220</td>
                                        <td>$2,50,000</td>
                                        <td>Cheque</td>
                                        <td>$4,220</td>
                                        <td>16 Jan 2023</td>
                                        <td><span class="badge bg-warning-light text-warning">Overdue</span></td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-download me-2"></i>Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="add-credit-notes.html"><i class="fe fe-file-text me-2"></i>Convert to Sales Return</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a href="invoice-details.html" class="invoice-link">#4989</a>
                                        </td>
                                        <td>Marketing</td>
                                        <td>25 Feb 2023</td>
                                        <td>$1,54,220</td>
                                        <td>$1,50,000</td>
                                        <td>Cash</td>
                                        <td>$4,220</td>
                                        <td>16 Jan 2023</td>
                                        <td><span class="badge bg-danger-light text-danger">Cancelled</span></td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-download me-2"></i>Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="add-credit-notes.html"><i class="fe fe-file-text me-2"></i>Convert to Sales Return</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a href="invoice-details.html" class="invoice-link">#4990</a>
                                        </td>
                                        <td>Repairs</td>
                                        <td>25 Mar 2022</td>
                                        <td>$1,54,220</td>
                                        <td>$1,50,000</td>
                                        <td>Cash</td>
                                        <td>$4,220</td>
                                        <td>12 May 2023</td>
                                        <td><span class="badge bg-primary-light">Partially Paid</span></td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-download me-2"></i>Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="add-credit-notes.html"><i class="fe fe-file-text me-2"></i>Convert to Sales Return</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a href="invoice-details.html" class="invoice-link">#4991</a>
                                        </td>
                                        <td>Software</td>
                                        <td>12 May 2022</td>
                                        <td>$5,54,220</td>
                                        <td>$3,50,000</td>
                                        <td>Cheque</td>
                                        <td>$4,220</td>
                                        <td>18 May 2023</td>
                                        <td><span class="badge bg-light-gray text-secondary">Unpaid</span></td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-download me-2"></i>Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="add-credit-notes.html"><i class="fe fe-file-text me-2"></i>Convert to Sales Return</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="custom_check">
                                                <input type="checkbox" name="invoice">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a href="invoice-details.html" class="invoice-link">#4992</a>
                                        </td>
                                        <td>Stationary</td>
                                        <td>16 Nov 2022</td>
                                        <td>$5,54,220</td>
                                        <td>$6,50,000</td>
                                        <td>Cash</td>
                                        <td>$4,220</td>
                                        <td>25 Feb 2023</td>
                                        <td><span class="badge bg-light-gray text-primary">Draft</span></td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-download me-2"></i>Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="add-credit-notes.html"><i class="fe fe-file-text me-2"></i>Convert to Sales Return</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>-->
                                    </tbody>
                                </table>
								<div class="d-flex justify-content-center">
									<?php echo $payments_pagination->links() ?>
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
