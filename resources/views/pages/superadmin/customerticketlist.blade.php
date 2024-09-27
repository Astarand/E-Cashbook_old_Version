@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Inbox</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="inbox-menu">
                                <li class="active">
                                    <a href="#"><i class="fe fe-mail"></i>All Tickets <span class="mail-count">(5)</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class=" fas fa-download"></i>New Tickets</a>
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-paper-plane"></i>Ongoing Tickets</a>
                                </li>
                                <li>
                                    <a href="#" class="pb-0 mb-0"><i class="far fa-star"></i> Solved Tickets</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div class="email-header">
                                <div class="row">
                                    <div class="col top-action-left">
                                        <div class="float-left">
                                            <div class="btn-group dropdown-action mail-search">
                                                <input type="text" placeholder="Search Messages" class="form-control search-message">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto top-action-right">
                                        <div class="text-end">
                                            <button type="button" title="Refresh" data-toggle="tooltip" class="btn btn-white-outline d-none d-md-inline-block"><i class="fas fa-sync-alt"></i></button>
                                            <div class="btn-group">
                                                <a class="btn btn-white-outline"><i class="fas fa-angle-left"></i></a>
                                                <a class="btn btn-white-outline"><i class="fas fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-muted d-none d-md-inline-block">Showing 10 of 112 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="email-content">
                                <div class="table-responsive">
                                    <table class="table table-inbox table-hover">
                                        <thead>
                                        <tr>
                                            <th colspan="6" class="py-3">
                                                <input type="checkbox" class="checkbox-all">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="unread clickable-row">
                                            <td>
                                                <input type="checkbox" class="checkmail">
                                            </td>
                                            <td><span class="mail-important"><i class="fas fa-star starred"></i></span></td>
                                            <td class="name"><a href="{{ url('/ticket') }}">John Doe</a></td>
                                            <td class="subject"><a href="{{ url('/ticket') }}">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></td>
                                            <td><i class="fas fa-paperclip"></i></td>
                                            <td class="mail-date">13:14</td>
                                        </tr>
                                        <tr class="unread clickable-row">
                                            <td>
                                                <input type="checkbox" class="checkmail">
                                            </td>
                                            <td><span class="mail-important"><i class="far fa-star"></i></span></td>
                                            <td class="name"><a href="{{ url('/ticket') }}">Envato Account</a></td>
                                            <td class="subject"><a href="{{ url('/ticket') }}">Important account security update from Envato</a></td>
                                            <td></td>
                                            <td class="mail-date">8:42</td>
                                        </tr>
                                        <tr class="clickable-row">
                                            <td>
                                                <input type="checkbox" class="checkmail">
                                            </td>
                                            <td><span class="mail-important"><i class="far fa-star"></i></span></td>
                                            <td class="name"><a href="{{ url('/ticket') }}">Twitter</a></td>
                                            <td class="subject"><a href="{{ url('/ticket') }}">HRMS Bootstrap Admin Template</a></td>
                                            <td></td>
                                            <td class="mail-date">30 Nov</td>
                                        </tr>
                                        <tr class="clickable-row">
                                            <td>
                                                <input type="checkbox" class="checkmail">
                                            </td>
                                            <td><span class="mail-important"><i class="far fa-star"></i></span></td>
                                            <td class="name"><a href="{{ url('/ticket') }}">John Smith</a></td>
                                            <td class="subject"><a href="{{ url('/ticket') }}">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></td>
                                            <td></td>
                                            <td class="mail-date">21 Aug</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="edit_ticket" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Edit Ticket</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="align-center" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" value="Support for theme" placeholder="Enter Subject" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Assigned Name</label>
                                <input type="text" class="form-control" value="Richard" placeholder="Enter Assigned Name">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Assigned Date</label>
                                <div class="cal-icon cal-icon-info">
                                    <input type="text" class="datetimepicker form-control" value="17 Dec 2022" placeholder="Select Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Created Date</label>
                                <div class="cal-icon cal-icon-info">
                                    <input type="text" class="datetimepicker form-control" value="19 Dec 2022" placeholder="Select Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Due Date</label>
                                <div class="cal-icon cal-icon-info">
                                    <input type="text" class="datetimepicker form-control" value="16 Jan 2023" placeholder="Select Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Assignee Name</label>
                                <input type="text" class="form-control" value="John Smith" placeholder="Enter Assignee Name">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Priority</label>
                                <select class="form-select">
                                    <option>Select Priority</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                    <option>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="form-select">
                                    <option>Select Status</option>
                                    <option>Open</option>
                                    <option>Resolved</option>
                                    <option>Pending</option>
                                    <option>Closed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</a>
                    <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Update</a>
                </div>
            </div>
        </div>
    </div>
@endsection
