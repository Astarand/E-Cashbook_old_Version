@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
			@if (Auth::user()->u_type==1 && Auth::user()->isCaActive == 0)
			<div class="row">
                <div class="col text-center">
					<button type="button" class="btn btn-danger text-center"> 
						Your account has been un-assigned.Please contact site admin.
					</button> 
				</div>
			</div>
			@endif
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12">
                    <div class="list-btn mb-4">
                        <ul class="filter-list justify-content-end">
                            <li>
                                {{-- <div class="btn-group" role="group">
                                    <button id="btngroupverticaldrop2" type="button" class="btn btn-import dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Financial Year
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btngroupverticaldrop2" style="width:100%">
                                        <a class="dropdown-item" href="#">FY 2023-2024</a>
                                        <a class="dropdown-item" href="#">FY 2022-2023</a>
                                    </div>
                                </div> --}}

                                <div class="btn-group" role="group" type="button"> 
                                    <select name="select_ca_financial_year" id="select_ca_financial_year"  class="form-select" style="width: 100%;">
                                        <option disabled selected>Select Financial Year</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-xl-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-3">
                                    <a href="#"><i class="fa-solid fa-file-alt"></i></a>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Customer Payment Status</div>
                                    <div class="dash-counts">
                                        <p> <strong>Total Payments:</strong> &nbsp;<span class="text-success"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalAmount)?$custPayment[0]->totalAmount:0 }}</span></p>
                                        <p> <strong>Total Pending:</strong> &nbsp;<span class="text-warning"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalAdvance)?$custPayment[0]->totalAdvance:0 }}</span></p>
                                        <p> <strong>Overdue :</strong> &nbsp;<span class="text-danger"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalDue)?$custPayment[0]->totalDue:0 }}</span></p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-4">
                                    <i class="fa-solid fa-people-group"></i>
                                </span>
                                <div class="dash-count">
                                    
                                    <div class="dash-counts mt-3 mb-2">
                                        <div class="row d-flex justify-content-between align-center">
                                            <div class="col-7">
                                                <div class="dash-title">Today's Employee Attendance Details</div>
                                            </div>
                                            <div class="col-5">
                                                <h6 class="mb-1">Date: <span class="text-primary me-1"></span></h6>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-1 text-center" style="border-right:1px solid #ddd;">
                                    <p class="text-muted"><span class="text-primary me-1">Total Employee</span></p>
                                    <h6 class="text-muted mt-1 mb-0">0</h6>
                                </div>
                                <div class="col-3 mt-1 text-center" style="border-right:1px solid #ddd;">
                                    <p class="text-muted"><span class="text-success me-1">Present</span></p>
                                    <h6 class="text-muted mt-1 mb-0">0</h6>
                                </div>
                                <div class="col-3 mt-1 text-center" style="border-right:1px solid #ddd;">
                                    <p class="text-muted"><span class="text-danger me-1">Absent</span></p>
                                    <h6 class="text-muted mt-1 mb-0">0</h6>
                                </div>
                                <div class="col-2 mt-1 text-center">
                                    <p class="text-muted"><span class="text-warning me-1">Late</span></p>
                                    <h6 class="text-muted mt-1 mb-0">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-2">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="row d-flex justify-content-between align-center">
                                        <div class="col-7">
                                            <div class="dash-title">Monthwise Payment Status</div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <select class="select form-select" id="month_payment_status">
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-1 text-center" style="border-right:1px solid #ddd;">
                                    <p class="text-muted"><span class="text-primary me-1">Total Govt. Fees Paid</span></p>
                                    <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="govt_fees"></span></h6>
                                </div>
                                <div class="col-4 mt-1 text-center" style="border-right:1px solid #ddd;">
                                    <p class="text-muted"><span class="text-success me-1">Total Amount Received</span></p>
                                    <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="month_total_received"></span></h6>
                                </div>
                                <div class="col-4 mt-1 text-center">
                                    <p class="text-muted"><span class="text-warning me-1">Total Payment Due</span></p>
                                    <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="due_payment"></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Customer Payment Status</h5>
                                <div class="dropdown main">
                                    <div class="form-group">
                                        <select class="select form-select" id="customer_payment_status">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <span>Total Earning</span>
                                    <p class="h3 text-primary me-5"><span id="total_earning"></span></p>
                                </div>
                                <div class="col-3">
                                    <span>Received</span>
                                    <p class="h3 text-success me-5"><span id="total_received"></span></p>
                                </div>
                                <div class="col-3">
                                    <span>Pending</span>
                                    <p class="h3 text-danger me-5"><span id="total_pending"></span></p>
                                </div>
                                <div class="col-3">
                                    <span>Overdue</span>
                                    <p class="h3 text-dark me-5"><span id="total_overdue"></span></p>
                                </div>
                            </div>
                            <div id="radial-chart"></div>
                        </div>
                    </div>
                </div>
                 
                <div class="col-xl-7 d-flex">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Task wise Clients</h5>
                                <div class="dropdown main">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="s-bar"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Task Status</h5>
                                <div class="dropdown main">
                                    <div class="form-group">
                                        <select class="select form-select" id="task_status_month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                <div class="w-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                                    <div class="col-2">
                                        <span>Total Task</span>
                                        <p class="h3 text-primary me-5"><span id="total_task"></span></p>
                                    </div>
                                    <div class="col-2">
                                        <span>Completed Task</span>
                                        <p class="h3 text-success me-5"><span id="comp_task"></span></p>
                                    </div>
                                    <div class="col-2">
                                        <span>Pending Task</span>
                                        <p class="h3 text-warning me-5"><span id="pending_task"></span></p>
                                    </div>

                                    <div class="col-2">
                                        <span>Overdue Task</span>
                                        <p class="h3 text-danger me-5"><span id="overdue_task"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <div class="progress progress-md rounded-pill mb-3">
                                        <div id="comp_task_bar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div id="pending_task_bar" class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div id="overdue_task_bar" class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <i class="fas fa-circle text-success me-1"></i> Completed Task
                                        </div>
                                        <div class="col-3">
                                            <i class="fas fa-circle text-warning me-1"></i> Pending Task
                                        </div>
                                        <div class="col-3">
                                            <i class="fas fa-circle text-danger me-1"></i> Overdue Task
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover" id="task_staus_table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Task Type</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Monthwise Onboard Clients Details</h5>
                                <div class="dropdown main">
                                    <div class="form-group">
                                        <select class="select form-select" id="onboard_client_month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="invoice_chart"></div>
                            <div class="text-center text-muted">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Total Assign</p>
                                            <h5><span id="total_assign"></span></h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i>Request Assign</p>
                                            <h5><span id="request_assign"></span></h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i>Own Assign</p>
                                            <h5><span id="own_assign"></span></h5>
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

@stop





