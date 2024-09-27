@extends('layouts.default')

@section('content')

<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header"> 
                <div class="content-page-header">
                    <h4>Assign your CA firm / Professional Accountant?</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!--<form action="#">-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="align-center">
                                            <div class="form-control me-3">
                                                <label class="custom_radio me-3 mb-0">
                                                    <input type="radio" class="form-control" name="assign_ca_firm" value="ownca" checked><span class="checkmark"></span> Assign your own CA Firm/ Professional Accountant
                                                </label>
                                            </div>
                                            <div class="form-control">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="assign_ca_firm" value="ourca"><span class="checkmark"></span> Assign our CA Firm/ Professional Accountant
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="javascript:void(0)" id="firmlist-A" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">CA Firm / Professional Accountant List</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="javascript:void(0" id="assignsection-B" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Set CA / Professional Accountant Permission</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="firmlist" role="tabpanel">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group row py-2">
                                                <div class="col-lg-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input active" type="radio" name="choose_ca" id="nearestca" value="1" checked>
                                                        <label class="form-check-label" for="nearestca">Choose Your Nearest CA Firm / Professional Accountant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="choose_ca" id="topratedca" value="2">
                                                        <label class="form-check-label" for="topratedca">Choose our top rated CA Firm / Professional  Accountant</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="nearestSearchDiv">
											<div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>State <span class="text-danger"> *</span></label>
                                                    <!--<input type="text" name="ca_state" id="ca_state" class="form-control" placeholder="Enter Your State">-->
													<select class="form-control select-style" required id="state_ship" onChange="changeState_ship(this);">
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
                                                    <!--<input type="text" name="ca_city" id="ca_city" class="form-control" placeholder="Enter Your City">-->
													<select class="form-control select-style" id="city_ship">
														<option value="">Select City</option>
													</select>
                                                </div>
                                            </div>                                            
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" name="ca_pincode" id="ca_pincode" class="form-control" placeholder="Enter Your Pincode">
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" class="btn customer-btn-save" id="searchyourca">Search Your CA /Accountant</a>
												<div id="searchCaLoader" class="loader"></div>
                                            </div>
                                        </div>
                                        <div class="row mt-4"  id="searchca">
                                            
											
                                        </div>
										
										<div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h6 class="text-danger py-4">If You have no CA Firm / Professional Accountant in the above list then fill out the details for listing with us. <span><a href="javascript:void(0)" id="caFillOut">Click here </a>to register your CA / CA Firm / Accountant</span>*</h6>
                                            </div>
										</div>
										<form action="javascript:void(0);" name="frmAssignCA" id="frmAssignCA" method="post">
										@csrf
										<div class="message-container"></div>
                                        <div class="row">
                                            <!--<div class="col-lg-12 col-md-12 col-sm-12">
                                                <h6 class="text-danger py-4">*If You have no CA Firm in the above list the fill out the details for details for listing with us. <span><a href="#">Click here </a>to register your CA/ CA Firm</span>*</h6>
                                            </div>-->
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Name of CA <span class="text-danger"> *</span></label>
                                                    <input type="text" id="ca_name" required name="ca_name" class="form-control" placeholder="Enter CA Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>CA Email <span class="text-danger"> *</span></label>
                                                    <input type="email" required id="ca_email" name="ca_email" class="form-control" placeholder="Enter Email Address">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone Number <span class="text-danger"> *</span></label>
                                                    <input type="text" required id="ca_phone" name="ca_phone" class="form-control" placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address Line 1 <span class="text-danger"> *</span></label>
                                                    <input type="text" required id="ca_addr_one" name="ca_addr_one" class="form-control" placeholder="Enter Address Line 1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address Line 2</label>
                                                    <input type="text" id="ca_addr_two" name="ca_addr_two" class="form-control" placeholder="Enter Address Line 2">
                                                </div>
                                            </div>
											<div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>State <span class="text-danger"> *</span></label>
                                                    <!--<input type="text" id="ca_state" name="ca_state" class="form-control" placeholder="Enter State">-->
													<select class="form-control select-style" required name="ca_state" id="state" onChange="changeState(this);">
														<option value="">Select State</option>
														@foreach($states as $k=>$state)
															<option value="{{ $state->id }}">{{ $state->name }}</option>
														@endforeach
													</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>City <span class="text-danger"> *</span></label>
                                                    <!--<input type="text" id="ca_city" name="ca_city" class="form-control" placeholder="Enter City">-->
													<select class="form-control select-style" required name="ca_city" id="city">
														<option value="">Select City</option>
													</select>
                                                </div>
                                            </div>                                            
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" id="ca_pincode" name="ca_pincode" class="form-control" placeholder="Enter Pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-end">
                                            <button type="submit" id="nxtBtnAssign" class="btn customer-btn-save">Next</button>
                                        </div>
										
										</form>
                                    </div>
                                    <div class="tab-pane" id="assignsection" role="tabpanel">
										<form action="javascript:void(0);" name="frmAssignSection" id="frmAssignSection" method="post">
										@csrf
										<div class="message-container"></div>
											<div class="row">
												<h6 class="pb-3">Sales Permission</h6>
												<div class="form-group">
													<div class="row">
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Sales_Invoice"><span class="checkmark"></span> Sales Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Payment_Invoice"><span class="checkmark"></span> Payment Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Proforma_Invoice"><span class="checkmark"></span> Proforma Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Online_Order"><span class="checkmark"></span> Online Order
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Sales_Returns"><span class="checkmark"></span> Sales Returns
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Recurring_Invoice"><span class="checkmark"></span> Recurring Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Credit_Debit_Note_Sales"><span class="checkmark"></span> Credit Debit Note
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Invoice_Template"><span class="checkmark"></span> Invoice Template
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
																	<input type="checkbox" name="ca_set_permission[]" value="Purchases_Invoice"><span class="checkmark"></span> Purchases Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Payment_Out"><span class="checkmark"></span> Payment Out
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Proforma_Invoice"><span class="checkmark"></span> Proforma Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Online_purchases"><span class="checkmark"></span> Online purchases
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Purchases_Returns"><span class="checkmark"></span> Purchases Returns
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Recurring_Invoice"><span class="checkmark"></span> Recurring Invoice
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Credit_Debit_Note_Purchase"><span class="checkmark"></span> Credit Debit Note
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Invoice_Template"><span class="checkmark"></span> Invoice Template
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
																	<input type="checkbox" name="ca_set_permission[]" value="Assets_Details"><span class="checkmark"></span> Assets Details
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Assets_Invoice"><span class="checkmark"></span> Assets Invoice
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
																	<input type="checkbox" name="ca_set_permission[]" value="Expanses"><span class="checkmark"></span> Expanses
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Payment"><span class="checkmark"></span> Payment
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
																	<input type="checkbox" name="ca_set_permission[]" value="Bank_Accounts"><span class="checkmark"></span> Bank Accounts
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Loan_Accounts"><span class="checkmark"></span> Loan Accounts
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="Cash"><span class="checkmark"></span> Cash
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
																	<input type="checkbox" name="ca_set_permission[]" value="ROC"><span class="checkmark"></span> ROC
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="GST"><span class="checkmark"></span> GST
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="TDS"><span class="checkmark"></span> TDS
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="PF"><span class="checkmark"></span> PF
																</label>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-sm-12 mt-3">
															<div class="form-control me-3">
																<label class="custom_checkbox mb-0">
																	<input type="checkbox" name="ca_set_permission[]" value="ESIC"><span class="checkmark"></span> ESIC
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
                                                                <input type="checkbox" name="ca_set_permission[]" value="Profit_Loss"><span class="checkmark"></span> Profit & Loss
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                                        <div class="form-control me-3">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Cash_FLow_Statement"><span class="checkmark"></span> Cash FLow Statement
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                                        <div class="form-control me-3">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Balance_Statement"><span class="checkmark"></span> Balance Statement
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Sales_Order_Details"><span class="checkmark"></span> Sales Order Details
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Receivable_Details"><span class="checkmark"></span> Receivable Details
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Invoice_Details"><span class="checkmark"></span> Invoice Details
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Expenses_Details"><span class="checkmark"></span> Expenses Details
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="GST_Report"><span class="checkmark"></span> GST Report
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Day_Book"><span class="checkmark"></span> Day Book
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Bill_wise_Profit"><span class="checkmark"></span> Bill wise Profit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Final_Accounts"><span class="checkmark"></span> Final Accounts
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Outstanding_Report"><span class="checkmark"></span> Outstanding Report
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Business_Performance_Ratio"><span class="checkmark"></span> Business Performance Ratio
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Business_Performance_Ratio"><span class="checkmark"></span> Inventory Report
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                                                        <div class="form-control">
                                                            <label class="custom_checkbox mb-0">
                                                                <input type="checkbox" name="ca_set_permission[]" value="Project_Analysis_Report"><span class="checkmark"></span> Project Analysis Report
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
											
											<div class="message-container"></div>
											<div class="add-customer-btns text-end">
												<a href="javascript:void(0);" id="prevBtnTwo" class="btn customer-btn-cancel">Previous</a>
												<button type="submit" id="subBtnAssign" class="btn customer-btn-save">Submit</button>
											</div>
											<div id="frmAssignCALoader" class="loader"></div>
										</form>
                                    
										
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