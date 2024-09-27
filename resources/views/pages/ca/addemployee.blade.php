@extends('layouts.default')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Add Employee</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<form action="javascript:void(0);" method="post" name="addEmployeeFrm" id="addEmployeeFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="empId" value="">
                @csrf
                <div class="card-body">
                    <div class="form-group-item">
                        <h5 class="form-title">Basic Details</h5>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Phone Number<span class="text-danger"> *</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Employee Contact Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Employee Email">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Create Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control pass-input" placeholder="Create Login Password">
                                        <span class="input-group-text" data-toggle="popover" data-placement="top" data-html="true">
                                            <i id="passwordIcon" class="fa fa-eye toggle-password"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Comfirm Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="conf_password" id="passwordInput" class="form-control pass-input-conf" placeholder="Create Login Password">
                                        <a href="#" class="input-group-text" id="showPasswordBtn">
                                            <i id="passwordIcon" class="fa fa-eye toggle-password-conf"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Depertment<span class="text-danger">*</span></label>
                                    <ul class="form-group-plus css-equal-heights">
                                        <li>
                                            <div class="form-group">
                                                <select class="select form-select" name="dept_id" id="dept_id" onchange="getDesignationOptions(this);" >
                                                    <option value="">Select Depertment</option>        
													@foreach($depts as $k=>$dept)
														<option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
													@endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn btn-primary form-plus-btn" href="#" data-bs-toggle="modal" data-bs-target="#depertment">
                                            <i class="fe fe-plus-circle"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Designation<span class="text-danger">*</span></label>
                                    <ul class="form-group-plus css-equal-heights">
                                        <li>
                                            <div class="form-group">
                                                <select class="select form-select" name="desig_id" id="desig_id" >
                                                    <option value="">Select Designation</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn btn-primary form-plus-btn" href="#" data-bs-toggle="modal" data-bs-target="#designation">
                                            <i class="fe fe-plus-circle"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <li class="nav-item">
                                                    <a href="#personal" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        <strong>Personal Details</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#salary" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        <strong>Salary Details</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#permission" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        <strong>Set Employee Permission</strong>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="personal">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Employee DOB<span class="text-danger"> *</span></label>
                                                                <input type="date" name="dob" id="dob" class="form-control" placeholder="Enter Employee DOB">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Gender<span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <select class="select form-select" name="gender" id="gender">
                                                                        <option value="">Select Gender</option>
                                                                        <option  value="Male">Male</option>
                                                                        <option  value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Highest Qualification<span class="text-danger"> *</span></label>
                                                                <input type="text" name="qualification" id="qualification" class="form-control" placeholder="Enter Highest Qualification">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="billing-btn mb-1">
                                                                <h5 class="form-title">Current Address</h5>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1<span class="text-danger"> *</span></label>
                                                                <input type="text" name="c_addr_lineone" id="cust_bill_addone" class="form-control" placeholder="Enter Address 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2</label>
                                                                <input type="text" name="c_addr_linetwo" id="cust_bill_addtwo" class="form-control" placeholder="Enter Address 2">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Country<span class="text-danger"> *</span></label>
                                                                        <select class="form-control select-style" name="c_emp_country" id="country" onChange="changeCountry(this);">
																			<option value="">Select Country</option>
																			@foreach($countries as $k=>$country)
																			<option value="{{ $country->id }}">{{ $country->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City<span class="text-danger"> *</span></label>
                                                                        <select class="form-control select-style" name="c_emp_city" id="city">
																			<option value="">Select City</option>
																			
																		</select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>State<span class="text-danger"> *</span></label>
                                                                        <select class="form-control select-style" name="c_emp_state" id="state" onChange="changeState(this);">
																			<option value="">Select State</option>
																			
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pincode<span class="text-danger"> *</span></label>
                                                                        <input type="text" name="c_emp_pincode" id="cust_bill_pin" class="form-control" placeholder="Enter Pincode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="billing-btn mb-1">
                                                                <h5 class="form-title">Parmanent Address</h5>
                                                                <a href="javascript:void(0);" class="btn btn-primary" onclick="copyBillAddr()">Same as Current Address</a>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1<span class="text-danger"> *</span></label>
                                                                <input type="text" name="p_addr_lineone" id="cust_ship_addone" class="form-control" placeholder="Enter Address 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2</label>
                                                                <input type="text" name="p_addr_linetwo" id="cust_ship_addtwo" class="form-control" placeholder="Enter Address 2">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Country<span class="text-danger"> *</span></label>
                                                                        <select class="form-control select-style" name="p_emp_country" id="country_ship" onChange="changeCountry_ship(this);">
																			<option value="">Select Country</option>
																			@foreach($countries as $k=>$country)
																			<option value="{{ $country->id }}">{{ $country->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City<span class="text-danger"> *</span></label>
                                                                        <select class="form-control select-style" name="p_emp_city" id="city_ship">
																			<option value="">Select City</option>
																			
																		</select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>State<span class="text-danger"> *</span></label>
                                                                        <select class="form-control select-style" name="p_emp_state" id="state_ship" onChange="changeState_ship(this);">
																			<option value="">Select State</option>
																			
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pincode<span class="text-danger"> *</span></label>
                                                                        <input type="text" name="p_emp_pincode" id="cust_ship_pin" class="form-control" placeholder="Enter Pincode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="salary">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Employee Basic Salary<span class="text-danger"> *</span></label>
                                                                <input type="text" name="basic_sal" id="basic_sal"  class="form-control" placeholder="Enter Employee Basic Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>HRA<span class="text-danger"></span></label>
                                                                <input type="text" name="hra" id="hra" value="0" class="form-control" placeholder="Enter HRA">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Convayance<span class="text-danger"> *</span></label>
                                                                <input type="text" name="convayance" value="0" id="convayance" class="form-control" placeholder="Enter Convayance">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Special Bonus<span class="text-danger"> *</span></label>
                                                                <input type="text" name="special_bonus" value="0" id="special_bonus" class="form-control" placeholder="Enter Special Bonus">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Providant Fund<span class="text-danger"></span></label>
                                                                <input type="text" name="provident_fund" value="0" id="provident_fund" class="form-control" placeholder="Enter Providant Faund">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>ESI<span class="text-danger"> *</span></label>
                                                                <input type="text" name="esi" id="esi" value="0" class="form-control" placeholder="Enter ESI">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Loan<span class="text-danger"></span></label>
                                                                <input type="text" name="loan" id="loan" value="0" class="form-control" placeholder="Enter Loan">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Professional Tax<span class="text-danger"></span></label>
                                                                <input type="text" name="ptax" id="ptax" value="0" class="form-control" placeholder="Enter Professional Tax">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>TSD / IT<span class="text-danger"></span></label>
                                                                <input type="text" name="tds" id="tds" value="0" class="form-control" placeholder="Enter TSD /IT">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Total Deduction<span class="text-danger"></span></label>
                                                                <input type="text" name="total_deduction" id="total_deduction" value="0" class="form-control" placeholder="Enter Total Deduction">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Total Addition<span class="text-danger"></span></label>
                                                                <input type="text" name="total_addition" id="total_addition" value="0" class="form-control" placeholder="Total Addition">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Net Salary<span class="text-danger"> *</span></label>
                                                                <input type="text" name="net_sal" id="net_sal" class="form-control" placeholder="Enter Net Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Net Salary in Word<span class="text-danger"> *</span></label>
                                                                <input type="text" name="net_sal_word" id="net_sal_word" class="form-control" placeholder="Enter Net Salary in word">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="permission">
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <div class="align-center">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Customer"><span class="checkmark"></span> Customer
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Product_Services"><span class="checkmark"></span> Product / Services
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Vendor"><span class="checkmark"></span> Vendor
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Project"><span class="checkmark"></span> Project
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Statutory_Fillings"><span class="checkmark"></span> Statutory Fillings
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Sales Permission</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Sales_Invoice"><span class="checkmark"></span> Sales Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Sales_Credit_Debit_Note"><span class="checkmark"></span> Credit Debit Note
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Purchases Permission</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Purchases_Invoice"><span class="checkmark"></span> Purchases Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Payment_Out"><span class="checkmark"></span> Payment Out
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Purchases_Credit_Debit_Note"><span class="checkmark"></span> Credit Debit Note
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Asset</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Assets_Details"><span class="checkmark"></span> Assets Details
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Assets_Voucher"><span class="checkmark"></span> Assets Voucher
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Cash & Bank</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Bank_Accounts"><span class="checkmark"></span> Bank Accounts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Loan_Accounts"><span class="checkmark"></span> Loan Accounts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Cash_Management"><span class="checkmark"></span> Cash Management
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Reports</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Profit_Loss"><span class="checkmark"></span> Profit & Loss
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Cash_FLow_Statement"><span class="checkmark"></span> Cash FLow Statement
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Balance_Statement"><span class="checkmark"></span> Balance Statement
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="GST_Report"><span class="checkmark"></span> GST Report
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Day_Book"><span class="checkmark"></span> Day Book
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Bill_wise_Profit"><span class="checkmark"></span> Bill wise Profit
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Outstanding_Report"><span class="checkmark"></span> Outstanding Report
                                                                        </label>
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
                            </div>
                        </div>
                    </div>
                   
					<div class="message-container"></div>
					<div id="addEmployeeLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
					   <a href="{{ url('/employee') }}" class="btn btn-primary cancel me-2">Cancel</a>
						<button type="submit" class="btn btn-primary">Add Employee</button>
					</div>
                    
                </div>
				</form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="depertment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add New Depertment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<form action="javascript:void(0);" method="post" name="addDepertmentFrm" id="addDepertmentFrm">
			@csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">

                        <div class="form-group">
                        <label>Add New Depertment</label>
                        <input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="Enter Depertment">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
				<div class="message-container"></div>
				<div id="addEmployeeLoader" class="loader"></div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="designation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add New Designation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<form action="javascript:void(0);" method="post" name="addDesignationFrm" id="addDesignationFrm">
			@csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Select Depertment</label>
                            <select class="select form-select" name="deptName" id="deptName">
                                <option value="">Select Depertment</option>
                                @foreach($depts as $k=>$dept)
									<option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
								@endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Add New Designation</label>
                        <input type="text" name="designation_name" id="designation_name" class="form-control" placeholder="Enter Designation category">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="message-container"></div>
				<div id="addEmployeeLoader" class="loader"></div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>


@endsection
