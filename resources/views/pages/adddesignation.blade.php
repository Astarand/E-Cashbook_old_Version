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
                <div class="card-body">
                    <div class="form-group-item">
                        <h5 class="form-title">Basic Details</h5>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Employee Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Phone Number<span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" placeholder="Enter Employee Contact Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Enter Employee Email">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Create Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Create Login Password">
                                        <span class="input-group-text" data-toggle="popover" data-placement="top" data-html="true">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Comfirm Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" id="passwordInput" class="form-control" placeholder="Create Login Password">
                                        <a href="#" class="input-group-text" id="showPasswordBtn">
                                            <i id="passwordIcon" class="fa fa-eye"></i>
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
                                                <select class="select form-select">
                                                    <option>Select Depertment</option>
                                                    <option>Sales</option>
                                                    <option>Operation</option>
                                                    <option>Accounts</option>
                                                    <option>HR</option>
                                                    <option>GR-4</option>
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
                                                <select class="select form-select">
                                                    <option>Select Designation</option>
                                                    <option>Excutive</option>
                                                    <option>Sr.Excutive</option>
                                                    <option>Manager</option>
                                                    <option>Secruity</option>
                                                    <option>Accountant</option>
                                                    <option>Sr.Accountant</option>
                                                    <option>Administration</option>
                                                    <option>HOD</option>
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
                                                                <input type="date" class="form-control" placeholder="Enter Employee DOB">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Gander<span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <select class="select form-select">
                                                                        <option>Select Gander</option>
                                                                        <option>Male</option>
                                                                        <option>Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Highest Qualification<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Highest Qualification">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="billing-btn mb-1">
                                                                <h5 class="form-title">Current Address</h5>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1</label>
                                                                <input type="text" class="form-control" placeholder="Enter Address 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2</label>
                                                                <input type="text" class="form-control" placeholder="Enter Address 2">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Country">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <input type="text" class="form-control" placeholder="Enter City">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>State</label>
                                                                        <input type="text" class="form-control" placeholder="Enter State">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pincode</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Pincode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="billing-btn mb-1">
                                                                <h5 class="form-title">Parmanent Address</h5>
                                                                <a href="#" class="btn btn-primary">Same as Current Address</a>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1</label>
                                                                <input type="text" class="form-control" placeholder="Enter Address 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2</label>
                                                                <input type="text" class="form-control" placeholder="Enter Address 2">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Country">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <input type="text" class="form-control" placeholder="Enter City">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>State</label>
                                                                        <input type="text" class="form-control" placeholder="Enter State">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pincode</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Pincode">
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
                                                                <input type="text" class="form-control" placeholder="Enter Employee Basic Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>HRA<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter HRA">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Convayance<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Convayance">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Special Bonus<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Special Bonus">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Providant Faund<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Providant Faund">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>ESI<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter ESI">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Loan<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Loan">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Professional Tax<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Professional Tax">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>TSD / IT<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter TSD /IT">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Total Deduction<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Total Deduction">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Total Addition<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Total Addition">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Net Salary<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Net Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Net Salary in Word<span class="text-danger"> *</span></label>
                                                                <input type="text" class="form-control" placeholder="Enter Net Salary in word">
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
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Customer
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Product / Services
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Vendor
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Project
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
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Sales Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Payment Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Proforma Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Online Order
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Sales Returns
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Recurring Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Credit Debit Note
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Invoice Template
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
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Purchases Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Payment Out
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Proforma Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Online purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Purchases Returns
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Recurring Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Credit Debit Note
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Invoice Template
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Fixed Asset</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Assets Details
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Assets Invoice
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Finance & Accounts</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Expanses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Payment
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
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Bank Accounts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Loan Accounts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Cash
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Statutory Fillings</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> ROC
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> GST
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> TDS
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> PF
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> ESIC
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
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Profit & Loss
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Cash FLow Statement
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Balance Statement
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Sales Order Details
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Receivable Details
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Invoice Details
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Expenses Details
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> GST Report
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Day Book
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Bill wise Profit
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Final Accounts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Outstanding Report
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Business Performance Ratio
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Inventory Report
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="ca"><span class="checkmark"></span> Project Analysis Report
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
                    <form action="product-list.html" class="text-end">
                        <button type="reset" class="btn btn-primary cancel me-2">
                        Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Add Employee
                        </button>
                    </form>
                </div>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        
                        <div class="form-group">
                        <label>Add New Depertment</label>
                        <input type="text" class="form-control" placeholder="Enter Depertment">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="product-list.html" class="text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Select Depertment</label>
                            <select class="select form-select">
                                <option>Select Depertment</option>
                                <option>Sales</option>
                                <option>Operation</option>
                                <option>Accounts</option>
                                <option>HR</option>
                                <option>GR-4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Add New Designation</label>
                        <input type="text" class="form-control" placeholder="Enter Designation category">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="product-list.html" class="text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection