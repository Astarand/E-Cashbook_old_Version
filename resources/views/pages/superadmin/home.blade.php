@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
										<i class="fas fa-dollar-sign"></i>
										</span>
                                <div class="dash-count">
                                    <div class="dash-title">Revenue</div>
                                    <div class="dash-counts">
                                        <p>1,642</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>1.15%</span> since last Month</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
										<i class="fas fa-users"></i>
										</span>
                                <div class="dash-count">
                                    <div class="dash-title">Trail User</div>
                                    <div class="dash-counts">
                                        <p>3,642</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>2.37%</span> since last Month</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-3 col-12">
                    <div class="card pt-3 pb-2">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-4">
                                    <a href="#"><i class="fa-solid fa-people-group"></i></a>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title"><a href="#">Employees</a></div>
                                    <div class="dash-counts">
                                        <p> <strong>Total Employee :</strong> &nbsp;<span class="text-info"> {{ isset($employees[0]->totalEmp)?$employees[0]->totalEmp:0 }}</span></p>
                                        <p> <strong>Today Present :</strong> &nbsp;<span class="text-success"> {{ isset($employees[0]->totalPresent)?$employees[0]->totalPresent:0 }}</span></p>
                                        <p> <strong>Today Absent :</strong> &nbsp;<span class="text-danger"> {{ isset($employees[0]->totalAbsent)?$employees[0]->totalAbsent:0 }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon bg-3">
										<i class="fas fa-file-alt"></i>
										</span>
                                <div class="dash-count">
                                    <div class="dash-title">Query Generate</div>
                                    <div class="dash-counts">
                                        <p>1,041</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-center">
                                <div class="col">
                                    <h5 class="card-title">Onboarding CA</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('/caportal') }}" class="btn-right btn btn-sm btn-outline-primary">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>CA Name</th>
                                        <th>City</th>
                                        <th>State </th>
                                        <th class="text-right">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									@foreach ($onboardCa as $val)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($val->created_at)) }}</td>
                                        <td>{{ $val->comp_name }}</td>
                                        <td>{{ $val->city }}</td>
                                        <td>{{ $val->state }}</td>
                                        @if ($val->status==0)  
											<td><span class="badge badge-pill bg-danger-light">Deactive</span></td>
										@else
											<td><span class="badge badge-pill bg-success-light">Active</span></td>
										@endif
                                    </tr>
									@endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-center">
                                <div class="col">
                                    <h5 class="card-title">Onboarding Customer</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('/customerportal') }}" class="btn-right btn btn-sm btn-outline-primary">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Ccompany Name</th>
                                        <th>City</th>
                                        <th>State </th>
                                        <th class="text-right">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($onboardCust as $val)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($val->created_at)) }}</td>
                                        <td>{{ $val->comp_name }}</td>
                                        <td>{{ $val->city }}</td>
                                        <td>{{ $val->state }}</td>
                                        @if ($val->status==0)  
											<td><span class="badge badge-pill bg-danger-light">Deactive</span></td>
										@else
											<td><span class="badge badge-pill bg-success-light">Active</span></td>
										@endif
                                    </tr>
									@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-7 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Package Sales Analytics</h5>
                                <div class="dropdown main">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Daily
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Daily</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="s-col-stacked"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Package Analytics</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="s-line-area"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-center">
                                <div class="col">
                                    <h5 class="card-title">Ticket Raised</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="invoices.html" class="btn-right btn btn-sm btn-outline-primary">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Ticket No</th>
                                        <th>Company Name </th>
                                        <th>CA Name </th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>23 Nov 2020</td>
                                        <td>220</td>
                                        <td>XYZ Pvt.Ltd</td>
                                        <td>Rishi Basu</td>
                                        <td><span class="badge bg-danger-light">Ongoing</span></td>
                                        <td >
                                            <a href="#" class="text-center"><i class="fa-solid fa-inbox"></i></a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                    <a class="dropdown-item" href="invoice-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                    <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Mark As Complete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                        <tr>
                                        <td>23 Nov 2020</td>
                                        <td>220</td>
                                        <td>XYZ Pvt.Ltd</td>
                                        <td>Rishi Basu</td>
                                        <td><span class="badge bg-danger-light">Ongoing</span></td>
                                        <td >
                                            <a href="#" class="text-center"><i class="fa-solid fa-inbox"></i></a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                    <a class="dropdown-item" href="invoice-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                    <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Mark As Complete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                        <tr>
                                        <td>23 Nov 2020</td>
                                        <td>220</td>
                                        <td>XYZ Pvt.Ltd</td>
                                        <td>Rishi Basu</td>
                                        <td><span class="badge bg-danger-light">Ongoing</span></td>
                                        <td >
                                            <a href="#" class="text-center"><i class="fa-solid fa-inbox"></i></a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                    <a class="dropdown-item" href="invoice-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                    <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Mark As Complete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                        <tr>
                                        <td>23 Nov 2020</td>
                                        <td>220</td>
                                        <td>XYZ Pvt.Ltd</td>
                                        <td>Rishi Basu</td>
                                        <td><span class="badge bg-danger-light">Ongoing</span></td>
                                        <td >
                                            <a href="#" class="text-center"><i class="fa-solid fa-inbox"></i></a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                    <a class="dropdown-item" href="invoice-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                    <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Mark As Complete</a>
                                                </div>
                                            </div>
                                        </td>

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
@endsection
