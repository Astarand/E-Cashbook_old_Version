@extends('layouts.default')
@section('content')


	<div class="page-wrapper">
        <div class="content container-fluid">
			@if (Auth::user())
				
            <div class="row">
				@if (Auth::user()->u_type==2)
                <div class="col-xl-12 col-sm-12 col-12">
                    <div class="list-btn mb-4">
                        <ul class="filter-list justify-content-end">
                            <li>
                                <a class="btn btn-primary" href="{{ url('/charterd') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Assign your CA Firm</a>
                            </li>
                            <li>
                                <a class="btn btn-import" href="{{ url('/add-sales-invoice') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Sales</a>
                            </li>
                            <li>
                                <a class="btn btn-primary" href="{{ url('/add-purchase-invoice') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Purches</a>
                            </li>
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
                                    <select name="select_financial_year" id="select_financial_year"  class="form-select" style="width: 100%;">
                                        <option disabled selected>Select Financial Year</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
				@endif
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-1">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="row d-flex justify-content-between align-center">
                                                <div class="col-7">
                                                    <div class="dash-title">Total Receivables <a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="List-View" data-bs-original-title="Current and Overdue amount that you're yet to receive from customer"> <span><i class="fa-regular fa-circle-question me-1"></i></span></a></div>
                                                    <div class="dash-counts mt-1">
                                                        <p> Total Unpaid Invoices<br> <i class="fa-solid fa-indian-rupee-sign"></i> <span id="total_unpaid"></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <select class="select form-select" id="total_receivales">
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
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-5" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    
                                        <div class="row">
                                            <div class="col-6 mt-2 text-center" style="border-right:1px solid #ddd;">
                                                <p class="text-muted"><span class="text-success me-1">Current</span></p>
                                                <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="receivables_current"></span></h6>
                                            </div>
                                            <div class="col-6 mt-2 text-center">
                                                <p class="text-muted"><span class="text-danger me-1">Overdue</span></p>
                                                <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="receivables_overdue"></span></h6>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-2">
                                            <i class="fa-solid fa-receipt"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="row d-flex justify-content-between align-center">
                                                <div class="col-7">
                                                    <div class="dash-title">Total Payables <a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="List-View" data-bs-original-title="Current and Overdue amount that you're yet to pay your vendors"> <span><i class="fa-regular fa-circle-question me-1"></i></span></a></div>
                                                    <div class="dash-counts mt-1">
                                                        <p> Total Unpaid Bills<br> <i class="fa-solid fa-indian-rupee-sign"></i> <span id="total_unpaid_Payables"></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <select class="select form-select" id="total_payables" name="total_payables">
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
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-6" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                        <div class="row">
                                            <div class="col-6 mt-2 text-center" style="border-right:1px solid #ddd;">
                                                <p class="text-muted"><span class="text-success me-1">Current</span></p>
                                                <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="Payables_current"></span></h6>
                                            </div>
                                            <div class="col-6 mt-2 text-center">
                                                <p class="text-muted"><span class="text-danger me-1">Overdue</span></p>
                                                <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="Payables_overdue"></span></h6>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Turnover By Month</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="s-line"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Income And Expenses</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-end flex-wrap flex-md-nowrap">
                                    <div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                                        <div>
                                            <span>Total Receipts</span>
                                            <p class="h3 text-success me-5" id="total_rec"><i class="fa-solid fa-indian-rupee-sign me-1"></i>0/-</p>
                                        </div>
                                        <div>
                                            <span>Total Expenses</span>
                                            <p class="h3 text-danger me-5" id="total_exp"><i class="fa-solid fa-indian-rupee-sign me-1"></i>0/-</p>
                                        </div>
                                    </div>
                            </div>
                            <div id="sales_chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-6 col-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-4">
                                        <i class="fa-solid fa-people-group"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="row d-flex justify-content-between align-center">
                                            <div class="col-8">
                                                <div class="dash-title">Account Details</div>
                                            </div>
                                            
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <select class="select form-select" name="cust_bank_id" id="cust_bank_id">
                                                        <option>Select Bank</option>
                                                        @foreach($allBanks as $index => $bank)
                                                            <option value="{{ $bank->id }}" {{ $index == 0 ? 'selected' : '' }}>
                                                                {{ $bank->bank_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="dash-counts mt-1">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="mb-1">Bank Name: <span id="bank_name" class="text-primary me-1"></span></p>
                                                    <p class="mb-1">A/C Number: <span id="bank_ac_no" class="text-primary me-1"></span></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="mb-1">A/C Holder Name: <span id="accholder_name" class="text-primary me-1"></span></p>
                                                    <p class="mb-1">IFSC Code: <span id="ifsc_code" class="text-primary me-1"></span></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="mb-1">Branch Name: <span id="bank_branch" class="text-primary me-1"></span></p>
                                                    <p class="mb-1">Swift Code: <span id="swift_code" class="text-primary me-1"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="row">
                                    <div class="col-3 mt-1 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-primary me-1">Total Balance</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="total_balance"></span></h6>
                                    </div>
                                    <div class="col-3 mt-1 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-success me-1">Total Received</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="total_received"></span></h6>
                                    </div>
                                    <div class="col-3 mt-1 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-danger me-1">Total Payable</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="total_expenses"></span></h6>
                                    </div>
                                    <div class="col-3 mt-1 text-center">
                                        <p class="text-muted"><span class="text-warning me-1">Total Loan Balance</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i><span id="total_lone"></span> </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header" style="margin-bottom:5px;">
                                    <div class="dash-count">
                                        <div class="dash-title">Statutory Status</div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-table">
                                        <div class="card-body">
                                            <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                                                <table class="table table-center table-hover datatable Statutory_table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Compliance / Statutory</th>
                                                            <th>Due Date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="statutoryTableBody">
                                                        
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
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body py-3">
                                    <div class="dash-widget-header py-4">
                                        <span class="dash-widget-icon bg-3">
                                            <i class="fa-solid fa-percent"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="row d-flex justify-content-between align-center">
                                                <div class="col-7">
                                                    <div class="dash-title">Gst Summary</div>
                                                    <div class="dash-counts mt-1">
                                                        <a href="#"> Refresh <i class="fa-solid fa-rotate"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <select class="select form-select">
                                                            <option>January</option>
                                                            <option>February</option>
                                                            <option>March</option>
                                                            <option>April</option>
                                                            <option>May</option>
                                                            <option>June</option>
                                                            <option>July</option>
                                                            <option selected="">August</option>
                                                            <option>Septmber</option>
                                                            <option>October</option>
                                                            <option>November</option>
                                                            <option>December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="progress progress-sm mt-2">
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-1 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-success me-1">Receivables</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>0.00</h6>
                                    </div>
                                    <div class="col-6 mt-1 text-center">
                                        <p class="text-muted"><span class="text-danger me-1">Payables</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>0.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body py-5">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-1">
                                        <i class="fa-solid fa-people-group"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Customers</div>
                                        <div class="dash-counts">
                                            <p id="customer_no">20</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar bg-5" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-2 mb-1"><span class="text-success me-1"><span id="Last_per"></span></span> since last week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-4">
                                        <i class="fa-solid fa-people-group"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Employee Attendance Details</div>
                                        <div class="dash-counts mt-3 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="mb-1">Date: <span class="text-primary me-1"></span></p>
                                                    <p class="mb-1">Company Name: <span class="text-primary me-1"></span></p>
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
                </div>
            </div>
			@endif
		</div>
    </div>

		
		
@stop	
		
		
		
		
   
