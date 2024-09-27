@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header ">
                    <h5>Ticket Overview</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-primary popup-toggle rounded-circle d-inline-flex p-2" href="javascript:void(0);"><i class="fe fe-edit" aria-hidden="true"></i></a>
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

            <div class="ticket-details-group">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="customer-details">
                            <div class="d-flex align-items-center">
										<span class="ticket-widget-img rounded-circle d-inline-flex">
										<img src="{{asset('public/assets/img/icons/ticket.svg')}}" alt="ticket">
										</span>
                                <div class="ticket-details-cont">
                                    <p>TK-105</p>
                                    <h6>New Support Ticket</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ticket-information">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="customer-details">
                            <div class="d-flex align-items-center">
										<span class="customer-widget-img d-inline-flex">
										<img class="rounded-circle" src="{{asset('public/assets/img/profiles/avatar-05.jpg')}}" alt>
										</span>
                                <div class="customer-details-cont">
                                    <h6>Requester</h6>
                                    <p>John Smith</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="customer-details">
                            <div class="d-flex align-items-center">
										<span class="customer-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-calendar"></i>
										</span>
                                <div class="customer-details-cont">
                                    <h6>Requested Date</h6>
                                    <p>30 Dec, 2022</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="customer-details border-0">
                            <div class="d-flex align-items-center">
										<span class="customer-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                <div class="customer-details-cont">
                                    <h6>Subject</h6>
                                    <p>Support Ticket</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="customer-details border-0">
                            <div class="d-flex align-items-center">
										<span class="customer-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-check-circle"></i>
										</span>
                                <div class="customer-details-cont">
                                    <h6>Status</h6>
                                    <p class="text-success">Solved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="comments">
                <div class="comments-head">
                    <h5>Conversation List</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="comments-details d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
										<span class="comments-widget-img rounded-circle d-inline-flex">
										<img class="avatar-img rounded-circle" src="{{asset('public/assets/img/profiles/avatar-01.jpg')}}" alt="User Image">
										</span>
                                <div class="comments-details-cont">
                                    <h6>Dennis</h6>
                                    <p>a week ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-describe">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt labore dolore magna aliqua. Ut enim minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat. Duis aute non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
                <div class="ticket-history ticket-information pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="comments-details d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
										<span class="comments-widget-img rounded-circle d-inline-flex">
										<img class="avatar-img rounded-circle" src="{{asset('public/assets/img/profiles/avatar-02.jpg')}}" alt="User Image">
										</span>
                                <div class="comments-details-cont">
                                    <h6>Alexandr</h6>
                                    <p>a week ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-describe">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt labore dolore magna aliqua. Ut enim minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat. Duis aute non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
                <div class="ticket-history ticket-information pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="comments-details d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
										<span class="comments-widget-img rounded-circle d-inline-flex">
										<img class="avatar-img rounded-circle" src="{{asset('public/assets/img/profiles/avatar-04.jpg')}}" alt="User Image">
										</span>
                                <div class="comments-details-cont">
                                    <h6>Doris Brown</h6>
                                    <p>a week ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-describe">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt labore dolore magna aliqua. Ut enim minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat. Duis aute non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
                <div class="ticket-history ticket-information pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="support-details d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
										<span class="support-widget-icon rounded-circle d-inline-flex">
										<i class="fe fe-file-text"></i>
										</span>
                                            <div class="support-details-cont">
                                                <h6>New Support Ticket</h6>
                                                <p>3.7MB</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn-action-icon me-2" href="javascript:void(0);" download><i class="fe fe-download"></i></a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                    </ul>
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
            <div class="comments">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Create New Conversation</label>
                            <div class="row">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-8 description-box">
                                    <div class="form-group" id="summernote_container">
                                        <textarea class="summernote form-control" placeholder="Type your message" rows="7"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <div class="form-group service-upload mb-0">
                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg') }}" alt="upload"></span>
                                            <h6 class="drop-browse align-center">
                                                Drop your files here or<span class="text-primary ms-1">browse</span
                                                >
                                            </h6>
                                            <p class="text-muted">Maximum size: 50MB</p>
                                            <input type="file" multiple id="image_sign">
                                            <div id="frames"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Ticket Details</h5>
                <div class="d-flex">
                    <div class="dropdown dropdown-action">
                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <ul>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit me-2"></i>Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye me-2"></i>View</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="sidebar-closes ms-3"><i class="fa-regular fa-circle-xmark"></i></a>
                </div>
            </div>
            <div class="sidebar-body">
                <form action="#" autocomplete="off">
                    <div class="form-group-item ticket-sidebar">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Ticket Status</label>
                                    <div class="task-priority-btn select-status justify-content-center table-project-subtitle">
                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="selecttext">
                                            <option class="selecttext" value="select">Status</option>
                                            <option class="greentext" value="apple">Done</option>
                                            <option class="bluetext" value="inprogress">In Progress</option>
                                            <option class="orangetext" value="pending">Waiting</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <a class="action-sets " href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span><i class="fa-solid fa-circle text-warning-light me-1"></i> Medium</span>
                                        <img src="{{asset('public/assets/img/icons/arrow-down.svg')}}" width="15" alt="img">
                                    </a>
                                    <ul class="dropdown-menu action-drop">
                                        <li>
                                            <a href="#" class="dropdown-item"><i class="fa-solid fa-circle danger-border me-2 text-danger-light"></i> High</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item"><i class="fa-solid fa-circle warning-border me-2 text-warning-light"></i> Medium</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item"><i class="fa-solid fa-circle info-border me-2 text-info"></i> Low</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
