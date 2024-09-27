@extends('layouts.default')

@section('content')

<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header"> 
                <div class="content-page-header">
                    <h4>Add CA</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!--<form action="#">-->
                        
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#firmlist" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">CA Firm List</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#assignsection" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Set CA Permission</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="firmlist" role="tabpanel">
                                        
                                       
										<form action="javascript:void(0);" name="frmAssignOurCA" id="frmAssignOurCA" method="post">
										<input type="hidden" name="id" id="caId" value="">
										@csrf
										<div class="message-container"></div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Name of CA</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter CA Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>CA Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email Address">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address Line 1</label>
                                                    <input type="text" id="addr_one" name="addr_one" class="form-control" placeholder="Enter Address Line 1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address Line 2</label>
                                                    <input type="text" id="addr_two" name="addr_two" class="form-control" placeholder="Enter Address Line 2">
                                                </div>
                                            </div>
											<div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <!--<input type="text" id="ca_state" name="ca_state" class="form-control" placeholder="Enter State">-->
													<select class="form-control select-style" name="ca_state" id="state" onChange="changeState(this);">
														<option value="">Select State</option>
														@foreach($states as $k=>$state)
															<option value="{{ $state->id }}">{{ $state->name }}</option>
														@endforeach
													</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <!--<input type="text" id="ca_city" name="ca_city" class="form-control" placeholder="Enter City">-->
													<select class="form-control select-style" name="ca_city" id="city">
														<option value="">Select City</option>
													</select>
                                                </div>
                                            </div>                                            
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-end">
                                            <button type="submit" class="btn customer-btn-save">Add CA</button>
                                        </div>
										</form>
                                    </div>
                                    <div class="tab-pane" id="assignsection" role="tabpanel">
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
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>

@endsection