@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Fillup your Profile Information</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
					<!--<form action="#">-->
                        <div class="card-body">
                            <div class="profile-picture">
								
									<div class="upload-profile">
										<div class="profile-img">
											<!--<img id="image-preview" class="avatar" src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt>-->
											@if(isset($compDetails->comp_logo) && $compDetails->comp_logo !="")
											<img id="image-preview" class="avatar" src="{{asset('/public/uploads/profile/'.$compDetails->comp_logo)}}" alt>
											@else
											<img id="image-preview" class="avatar" src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt>
											@endif
										</div>
										<div class="add-profile">
											<h5>Upload Your Firm Logo/Image*</h5>
											<span id="name-preview"></span>
										</div>
									</div>
									<div class="img-upload">
										<!--<form action="javascript:void(0);">
										<label class="btn btn-primary">
										Upload <input type="file" name="profile-image-uploader" id="profile-image-uploader">
										</label>
										<a class="btn btn-remove">Remove</a>
										</form>-->
										<form action="javascript:void(0);" id="frmprofileimageCA" name="frmprofileimageCA">
										@csrf
										<div class="message-container"></div>
										<label class="btn btn-primary">
										Upload <input type="file" name="comp_logo" id="comp_logo_ca">
										</label>
										<a class="btn btn-remove compimagedelCA">Remove</a>
										</form>
									</div>
								
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Firm Details</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#details" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Speclization</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#bank" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">Bank Details</a>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <a href="#partner" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">Partner Details</a>
                                        </li>
                                    
                                        <li class="nav-item" role="presentation">
                                            <a href="#attachments" data-bs-toggle="tab" aria-expanded="false" class="nav-link " aria-selected="true" role="tab">Firm Profile</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="info" role="tabpanel">
											<form action="javascript:void(0);" name="CAfrmcompdet" id="CAfrmcompdet">
											@csrf
                                            <div class="message-container"></div>
											<div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>CA /CA Firm / Tax Consultant Name</label>
                                                        <input type="text" name="comp_name" id="comp_name" value="{{ isset($compDetails->comp_name)?$compDetails->comp_name:""}}" class="form-control" placeholder="Enter Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="comp_email" id="comp_email" value="{{ isset($compDetails->comp_email)?$compDetails->comp_email:""}}" class="form-control" placeholder="Enter Email Address" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" name="comp_phone" id="comp_phone" value="{{ isset($compDetails->comp_phone)?$compDetails->comp_phone:""}}" class="form-control" placeholder="Phone Number" >
                                                    </div>
                                                </div>
                                               <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" name="comp_bill_addone" id="comp_bill_addone" value="{{ isset($compDetails->comp_bill_addone)?$compDetails->comp_bill_addone:""}}" class="form-control" placeholder="Enter Address Line 1">
                                                    </div>
                                               </div>
                                               <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" name="comp_bill_addtwo" id="comp_bill_addtwo" value="{{ isset($compDetails->comp_bill_addtwo)?$compDetails->comp_bill_addtwo:""}}" class="form-control" placeholder="Enter Address Line 2">
                                                    </div>
                                               </div>
											   <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select class="form-control select-style" name="comp_bill_country" id="country" onChange="changeCountry(this);">
															<option value="">Select Country</option>
															@foreach($countries as $k=>$country)
															<option value="{{ $country->id }}" <?php echo @($country->id==$compDetails->comp_bill_country)? "selected":"" ?>>{{ $country->name }}</option>
															@endforeach
														</select>
                                                    </div>
                                               </div>
											   <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control select-style" name="comp_bill_state" id="state" onChange="changeState(this);">
														<option value="">Select State</option>
														@foreach($states_bill as $k=>$state)
															<option value="{{ $state->id }}" <?php echo ($state->id==$compDetails->comp_bill_state)? "selected":"" ?>>{{ $state->name }}</option>
														@endforeach
													</select>
                                                </div>
                                               </div>
                                               <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <select class="form-control select-style" name="comp_bill_city" id="city">
															<option value="">Select City</option>
															@foreach($cities_bill as $k=>$city)
																<option value="{{ $city->id }}" <?php echo ($city->id==$compDetails->comp_bill_city)? 'selected="selected"':"" ?>>{{ $city->name }}</option>
															@endforeach
														</select>
                                                    </div>
                                               </div>
                                               
                                               <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Pincode</label>
                                                        <input type="text" name="comp_bill_pin" id="comp_bill_pin" value="{{ isset($compDetails->comp_bill_pin)?$compDetails->comp_bill_pin:""}}" class="form-control" placeholder="Enter Pincode">
                                                    </div>
                                               </div>
                                               
                                            </div>
                                           
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" id="cancel_compDetBtn" class="btn customer-btn-cancel">Cancel</a>
                                                <button type="submit" id="save_compDetBtn" class="btn customer-btn-save">Save Changes</button>
                                            </div>
											</form>
                                        </div>
										
										
										
                                        <div class="tab-pane" id="details" role="tabpanel">
											<form action="javascript:void(0);" name="frmCa_spec" id="frmCa_spec" method="post">
											@csrf
                                            <div class="message-container"></div>
											<?php 
												$specDetails = isset($compDetails->ca_spec)?$compDetails->ca_spec:"";
												$specDetails = explode(',', $specDetails);
											?>
                                            <div class="form-group-customer customer-additional-form">
                                                <div class="row">
                                                    <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Your Speclization with</h5>
                                                    </div>
                                                   <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Company Incorporation', $specDetails)) { echo 'checked="checked"'; }?> value="Company Incorporation">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Company Incorporation</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Company Compliances', $specDetails)) { echo 'checked="checked"'; }?> value="Company Compliances">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Company Compliances</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('ROC Return', $specDetails)) { echo 'checked="checked"'; }?> value="ROC Return">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">ROC Return</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Accounts Preparation', $specDetails)) { echo 'checked="checked"'; }?> value="Accounts Preparation">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Accounts Preparation</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('GST & Taxation', $specDetails)) { echo 'checked="checked"'; }?> value="GST & Taxation">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">GST & Taxation</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Auditing', $specDetails)) { echo 'checked="checked"'; }?> value="Auditing">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Auditing</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Auditor Recruitment', $specDetails)) { echo 'checked="checked"'; }?> value="Auditor Recruitment">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Auditor Recruitment</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Licensing & Registration', $specDetails)) { echo 'checked="checked"'; }?> value="Licensing & Registration">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Licensing & Registration</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Income Tax Return', $specDetails)) { echo 'checked="checked"'; }?> value="Income Tax Return">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Income Tax Return</label>
                                                            </div>
                                                            <div class="col-2">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('TDS, PF & ESIC', $specDetails)) { echo 'checked="checked"'; }?> value="TDS, PF & ESIC">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">TDS, PF & ESIC</label>
                                                            </div>
                                                            <div class="col-4">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Project Report or DPR with CMA Data', $specDetails)) { echo 'checked="checked"'; }?> value="Project Report or DPR with CMA Data">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Project Report / DPR with CMA Data</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="custom_check">
                                                                    <input type="checkbox" name="ca_spec[]" <?php if (in_array('Accounts Outsource Report', $specDetails)) { echo 'checked="checked"'; }?> value="Accounts Outsource Report">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="company_incorporation">Accounts Outsource Report</label>
                                                            </div>
                                                        </div>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" id="cancel_busDetBtn" class="btn customer-btn-cancel">Cancel</a>
                                                <button type="submit" id="save_busDetBtn" class="btn customer-btn-save">Save Changes</button>
                                            </div>
											</form>
                                        </div>
										
                                        <div class="tab-pane" id="bank" role="tabpanel">
											<form action="javascript:void(0);" name="CAfrmbankdet" id="CAfrmbankdet" method="post">
											@csrf
                                            <div class="message-container"></div>
                                            <div class="form-group-customer customer-additional-form">
											
												<?php  
												if(!empty($bankDetails)) { 
												$i = 1;	
														foreach($bankDetails as $bankData ) {
												?>
													<div class="containerVariant">
														<div class="row">
															<div class="billing-btn">
															<h5 class="form-title mb-0">Bank Account(s)</h5>
															<!--<a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another Bank Accounts</a>-->
															</div>
																
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Bank Name</label>
																	<input type="text" name="bank_name[]" id="" value="{{ $bankData->bank_name }}" class="form-control" placeholder="Enter Bank Name">
																</div>
															</div>
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Branch</label>
																	<input type="text" name="bank_branch[]" id="" value="{{ $bankData->bank_branch }}" class="form-control" placeholder="Enter Branch Name">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>Account Holder Name</label>
																	<input type="text" name="bank_holder_name[]" id="" value="{{ $bankData->bank_holder_name }}" class="form-control" placeholder="Enter Account Holder Name">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>Account Number</label>
																	<input type="text" name="ac_no[]" id="" value="{{ $bankData->ac_no }}" class="form-control" placeholder="Enter Account Number">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>IFSC</label>
																	<input type="text" name="ifsc_code[]" id="" value="{{ $bankData->ifsc_code }}" class="form-control" placeholder="Enter IFSC Code">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>UPI ID</label>
																	<input type="text" name="ac_upid[]" id="" value="{{ $bankData->ac_upid }}" class="form-control" placeholder="Enter UPI ID">
																</div>
															</div>
														</div>	
													</div>
												<?php } }?>
												
                                                <div class="containerVariant">
													<div class="row">
														<div class="billing-btn">
														<h5 class="form-title mb-0">Bank Account(s)</h5>
														</div>
															
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="form-group">
																<label>Bank Name</label>
																<input type="text" name="bank_name[]" id="" class="form-control" placeholder="Enter Bank Name">
															</div>
														</div>
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="form-group">
																<label>Branch</label>
																<input type="text" name="bank_branch[]" id="" class="form-control" placeholder="Enter Branch Name">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>Account Holder Name</label>
																<input type="text" name="bank_holder_name[]" id="" class="form-control" placeholder="Enter Account Holder Name">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>Account Number</label>
																<input type="text" name="ac_no[]" id="" class="form-control" placeholder="Enter Account Number">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>IFSC</label>
																<input type="text" name="ifsc_code[]" id="" class="form-control" placeholder="Enter IFSC Code">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>UPI ID</label>
																<input type="text" name="ac_upid[]" id="" class="form-control" placeholder="Enter UPI ID">
															</div>
														</div>
													</div>	
                                                </div>
												<a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another Bank Accounts</a>
                                            </div>
                                            <div class="add-customer-btns text-end">
												<a href="javascript:void(0);" id="cancel_bankDetBtn" class="btn customer-btn-cancel">Cancel</a>
												<button type="submit" id="save_bankDetBtn" class="btn customer-btn-save">Save Changes</button>
											</div>
											</form>
                                        </div>

                                        <div class="tab-pane" id="partner" role="tabpanel">
											<form action="javascript:void(0);" name="frmPartnerdet" id="frmPartnerdet" method="post">
                                                @csrf
                                                <div class="message-container"></div>
												<?php  
												if(!empty($partnerDetails)) { 
												$i = 1;	
														foreach($partnerDetails as $partnerData ) {
												?>
                                                <div class="form-group-customer customer-additional-form">
                                                    <div class="row">
                                                        <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Partner Details</h5>
                                                        
                                                        </div>
                                                            
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Partner Name</label>
                                                                <input type="text" name="partner_name[]" value="{{ $partnerData->partner_name }}" class="form-control" placeholder="Enter Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Contact Number</label>
                                                                <input type="text" name="partner_no[]" value="{{ $partnerData->partner_no }}" class="form-control" placeholder="Enter Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>E-mail Id</label>
                                                                <input type="text" name="partner_email[]" value="{{ $partnerData->partner_email }}" class="form-control" placeholder="Enter email id">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Tenure of Practicing</label>
                                                                <input type="text" name="practicing[]" value="{{ $partnerData->practicing }}" class="form-control" placeholder="Enter Practicing duration">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <input type="text" name="partner_role[]" value="{{ $partnerData->partner_role }}" class="form-control" placeholder="Enter Role">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												<?php } }?>
												<div class="form-group-customer customer-additional-form">
                                                    <div class="row">
                                                        <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Partner Details</h5>
                                                        
                                                        </div>
                                                         
														<div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Partner Name</label>
                                                                <input type="text" name="partner_name[]" value="" class="form-control" placeholder="Enter Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Contact Number</label>
                                                                <input type="text" name="partner_no[]" value="" class="form-control" placeholder="Enter Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>E-mail Id</label>
                                                                <input type="text" name="partner_email[]" value="" class="form-control" placeholder="Enter email id">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Tenure of Practicing</label>
                                                                <input type="text" name="practicing[]" value="" class="form-control" placeholder="Enter Practicing duration">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <input type="text" name="partner_role[]" value="" class="form-control" placeholder="Enter Role">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
												<a href="javascript:void(0);" class="btn btn-primary">Add Another Partner</a>
                                                <div class="add-customer-btns text-end">
                                                    <a href="javascript:void(0);" id="cancel_bankDetBtn" class="btn customer-btn-cancel">Cancel</a>
                                                    <button type="submit" id="save_bankDetBtn" class="btn customer-btn-save">Save Changes</button>
                                                </div>
											</form>
                                        </div>
										
										
                                        <div class="tab-pane" id="attachments" role="tabpanel">
											<form action="javascript:void(0);" name="CAfrmattadet" id="CAfrmattadet" method="post" enctype="multipart/form-data">
											<input type="hidden" id="gstdocstate" value="{{isset($compDetails->gst_doc)?$compDetails->gst_doc:""}}">
											@csrf
                                            <div class="message-container"></div>
                                            <div class="row">
                                                <h5 class="text-muted pb-3">Statutory Details</h5>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Upload GSTIN Documents</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="gst_doc" id="gst_doc">
                                                            <div id="frames1"></div>
                                                            </div>
															@if(@$compDetails->gst_doc !="")
															<div class="downloadFile"><a  href="{{ asset('/public/uploads/company-files/'.$compDetails->gst_doc) }}" download>Download</a></div>
															@endif                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Proprietor/ Company Pan Card</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="pan_doc" id="pan_doc">
                                                            <div id="frames2"></div>
                                                        </div>
                                                        @if(@$compDetails->pan_doc !="")
                                                        <div class="downloadFile pb-3"><a target="_blank" href="{{ asset('/public/uploads/company-files/'.$compDetails->pan_doc) }}">Download</a></div>
                                                        @endif
                                                    </div>
                                                </div>                                                
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Upload TAN Document</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="tan_doc" id="tan_doc">
                                                            <div id="frames3"></div>
                                                            </div>
															@if(@$compDetails->tan_doc !="")
															<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/company-files/'.$compDetails->tan_doc) }}">Download</a></div>
															@endif                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Upload CIN Document</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="cin_doc" id="cin_doc">
                                                            <div id="frames4"></div>
                                                            </div>
															@if(@$compDetails->cin_doc !="")
															<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/company-files/'.$compDetails->cin_doc) }}">Download</a></div>
															@endif                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="text-muted py-3">Other Documents</h5>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Upload Logo</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="other_logo_doc" id="other_logo_doc">
                                                            <div id="frames5"></div>
                                                            </div>
															@if(@$compDetails->other_logo_doc !="")
															<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/company-files/'.$compDetails->other_logo_doc) }}">Download</a></div>
															@endif                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Upload Signature</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="signature_doc" id="signature_doc">
                                                            <div id="frames6"></div>
                                                            </div>
															@if(@$compDetails->signature_doc !="")
															<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/company-files/'.$compDetails->signature_doc) }}">Download</a></div>
															@endif                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group service-bg mb-0 pb-0">
                                                        <label>Upload Company Stamp</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="stamp_doc" id="stamp_doc">
                                                            <div id="frames7"></div>
                                                            </div>
															@if(@$compDetails->stamp_doc !="")
															<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/company-files/'.$compDetails->stamp_doc) }}">Download</a></div>
															@endif                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" id="cancel_attaBtn" class="btn customer-btn-cancel">Cancel</a>
                                                <button type="submit" id="save_attaBtn" class="btn customer-btn-save">Upload & Save</button>
                                            </div>
											</form>
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

@stop