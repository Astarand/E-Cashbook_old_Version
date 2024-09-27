@extends('layouts.default')

@section('content')
<style>
    #mandatory_fields {
        color: red;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="content-page-header">
                <h5>Add Customers</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="javascript:void(0);" id="tab-A" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Basic Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="javascript:void(0);" id="tab-B" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Billing Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="javascript:void(0);" id="tab-C" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">Bank Details</a>
                    </li>
                </ul>
				@if (Session::has('errors'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">Error!</h4>
						<p>
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</p>
					</div>
				@endif
				
                <div class="tab-content">
                    <div class="tab-pane active" id="info" role="tabpanel">
						<form action="javascript:void(0);" method="post" name="add_cust_detail" id="add_cust_detail">
						<input type="hidden" name="id" id="custId" value="">
						@csrf
                        <div class="form-group-item">
                            <h5 class="form-title">Basic Details</h5>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Customer Priroty <span id="mandatory_fields">*</span></label>
                                        <div class="align-center">
                                            <div class="form-control me-3">
                                                <label class="custom_radio me-3 mb-0">
                                                    <input type="radio" class="form-control" name="cust_value" value="1" checked><span class="checkmark"></span> High Valued Customer
                                                </label>
                                            </div>
                                            <div class="form-control">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="cust_value" value="2"><span class="checkmark"></span> Low Valued Customer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group add-products">
                                                    <label>Company GST Registered <span id="mandatory_fields">*</span></label>
                                                    <div class="form-group">
                                                        <select class="form-select" required name="gst_reg" id="gst_reg" onchange="toggleGSTFields(this.value)">
                                                            <option value="">Select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Company Name <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_name" required id="cust_name" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Company Type <span id="mandatory_fields">*</span></label>
                                                    <div class="form-group">
                                                        <select class="form-select" required name="comp_type" id="comp_type">
                                                            <option value="">Select</option>
                                                            <option value="Proprietorship">Proprietorship</option>
                                                            <option value="Partnership">Partnership</option>
                                                            <option value="One person Company (OPC)">One person Company (OPC)</option>
                                                            <option value="LLP Company">LLP Company</option>
                                                            <option value="PVT Ltd Company">PVT Ltd Company</option>
                                                            <option value="LTD Company">LTD Company</option>
                                                            <option value="Section-8 Company">Section-8 Company</option>
                                                            <option value="Society/Trust">Society/Trust</option>
                                                            <option value="Other">Other</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12" id="comp_type_other" style="display: none;">
                                                    <div class="form-group">
                                                        <label>Type Name <span id="mandatory_fields">*</span></label>
                                                        <input type="text" required name="other_comp" id="other_comp" value=""
                                                            class="form-control" placeholder="Other Name">

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12" id="comp_type_cin">
													<div class="form-group">
														<label>CIN</label>
                                                        <input type="text" name="cin" id="cin" value="" class="form-control" placeholder="CIN Number" >
													
													</div>
												</div>
                                                <div class="col-lg-4 col-md-4 col-sm-12" id="comp_type_inc_date">
													<div class="form-group">
														<label>Incorporation Date</label>
                                                        <input type="Date" name="inc_date" id="inc_date" value="" class="form-control" placeholder="" >
													
													</div>
												</div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>PAN Number <span id="mandatory_fields">*</span></label>
                                        <input type="text" required name="cust_pan" id="cust_pan" class="form-control" placeholder="Enter PAN Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="cust_gst_field" style="display: none;">
                                    <div class="form-group">
                                        <label>GSTIN <span id="mandatory_fields">*</span></label>
                                        <input type="text" required name="cust_gst_no" id="cust_gst_no" class="form-control" placeholder="Enter GSTIN Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="cust_gst_type" style="display: none;">
                                    <label>GST Type <span id="mandatory_fields">*</span></label>
                                    <div class="form-group">
                                        <select class="form-select" required name="cust_gst_type" id="cust_gst_type">
                                            <option value="">Select</option>
                                            <option value="Registered">Registered</option>
                                            <option value="Unregistered">Unregistered </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email <span id="mandatory_fields">*</span></label>
                                        <input type="email" required name="cust_email" id="cust_email" class="form-control" placeholder="Enter Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Phone <span id="mandatory_fields">*</span></label>
                                        <input type="text" required name="cust_phone" id="cust_phone" class="form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="billing-btn">
                                        <h5 class="form-title mb-0">Contact Person Details</h5>
                                        <a href="javascript:void(0);" onclick="sameAsAbove()" class="btn btn-primary">Same as Above</a>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Person Name <span id="mandatory_fields">*</span></label>
                                                <input type="text" required class="form-control" name="cont_name" id="cont_name"  placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Number <span id="mandatory_fields">*</span></label>
                                                <input type="number" required class="form-control" name="cont_no" id="cont_no" placeholder="Enter Contact Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-Mail </label>
                                                <input type="text" class="form-control" name="cont_email" id="cont_email" placeholder="Enter E-Mail">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Special Note </label>
                                                <input type="text" class="form-control" name="cont_notes" id="cont_notes" placeholder="Write a Special Note about Contact Person">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    

                                </div>
                            </div>
                        </div>
                        <div class="add-customer-btns text-end">
                            <a href="{{ url('/customers') }}" class="btn customer-btn-cancel" id="prevBtnOne">Cancel</a>
                            <a href="javascript:void(0);" class="btn customer-btn-save" id="nxtBtnOne">Next</a>
                        </div>
						</form>
                    </div>

                    <div class="tab-pane" id="details" role="tabpanel">
						<form action="javascript:void(0);" method="post" name="add_cust_bill" id="add_cust_bill">
						@csrf
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="billing-btn mb-2">
                                        <h5 class="form-title">Billing Address</h5>
                                    </div>
                                    <div class="form-group">
                                        <label>GST No </label>
                                        <input type="text" name="cust_bill_gstno" id="cust_bill_gstno" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Person Name <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_bill_contact" id="cust_bill_contact" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile No <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_bill_mobilno" id="cust_bill_mobilno" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Designation <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_bill_designa" id="cust_bill_designa" class="form-control" placeholder="Enter Name">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Name <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_bill_name" id="cust_bill_name" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Address Line 1 <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_bill_addone" id="cust_bill_addone" class="form-control" placeholder="Enter Address 1">
                                    </div>
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" name="cust_bill_addtwo" id="cust_bill_addtwo" class="form-control" placeholder="Enter Address 2">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Country <span id="mandatory_fields">*</span></label>
                                                <select class="form-control select-style" name="cust_bill_country" id="country" onChange="changeCountry(this);">
													<option value="">Select Country</option>
													@foreach($countries as $k=>$country)
													<option value="{{ $country->id }}">{{ $country->name }}</option>
													@endforeach
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label>City <span id="mandatory_fields">*</span></label>
                                                <select class="form-control select-style" name="cust_bill_city" id="city">
													<option value="">Select City</option>
													
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>State <span id="mandatory_fields">*</span></label>
                                                <select class="form-control select-style" name="cust_bill_state" id="state" onChange="changeState(this);">
													<option value="">Select State</option>
													
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pincode <span id="mandatory_fields">*</span></label>
                                                <input type="text" name="cust_bill_pin" id="cust_bill_pin" class="form-control" placeholder="Enter Pincode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="billing-btn">
                                        <h5 class="form-title mb-0">Shipping Address</h5>
                                        <a href="javascript:void(0);" class="btn btn-primary" onclick="copyBillAddr()">Copy from Billing</a>
                                    </div>
                                    <div class="form-group">
                                        <label>GST No </label>
                                        <input type="text" name="cust_ship_gstno" id="cust_ship_gstno" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Person Name <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_ship_contact"  id="cust_ship_contact" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile No <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_ship_mobilno"  id="cust_ship_mobilno" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Designation <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_ship_designa" id="cust_ship_designa" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Name <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_ship_name" id="cust_ship_name" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Address Line 1 <span id="mandatory_fields">*</span></label>
                                        <input type="text" name="cust_ship_addone" id="cust_ship_addone" class="form-control" placeholder="Enter Address 1">
                                    </div>
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" name="cust_ship_addtwo" id="cust_ship_addtwo" class="form-control" placeholder="Enter Address 2">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Country <span id="mandatory_fields">*</span></label>
                                                <select class="form-control select-style" name="cust_ship_country" id="country_ship" onChange="changeCountry_ship(this);">
													<option value="">Select Country</option>
													@foreach($countries as $k=>$country)
													<option value="{{ $country->id }}">{{ $country->name }}</option>
													@endforeach
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label>City <span id="mandatory_fields">*</span></label>
                                                <select class="form-control select-style" name="cust_ship_city" id="city_ship">
													<option value="">Select City</option>
													
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>State <span id="mandatory_fields">*</span></label>
                                                <select class="form-control select-style" name="cust_ship_state" id="state_ship" onChange="changeState_ship(this);">
													<option value="">Select State</option>
													
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pincode <span id="mandatory_fields">*</span></label>
                                                <input type="text" name="cust_ship_pin" id="cust_ship_pin" class="form-control" placeholder="Enter Pincode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-customer-btns text-end">
                            <a href="javascript:void(0);" id="prevBtnTwo" class="btn customer-btn-cancel">Previous</a>
                            <a href="javascript:void(0);" id="nxtBtnTwo" class="btn customer-btn-save">Next</a>
                        </div>
						</form>
                    </div>

                    <div class="tab-pane" id="bank" role="tabpanel">
						<form action="javascript:void(0);" method="post" name="add_cust_bank" id="add_cust_bank">
						@csrf
						<div class="message-container"></div>
                        <div class="form-group-customer customer-additional-form">
							<div class="containerVariant">
								<div class="row">
									<div class="billing-btn">
									<h5 class="form-title mb-0">Bank Account(s)</h5>
									</div>
										
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label>Bank Name <span id="mandatory_fields">*</span></label>
											<input type="text" name="cust_bank_name[]" id="" class="form-control" placeholder="Enter Bank Name">
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label>Branch <span id="mandatory_fields">*</span></label>
											<input type="text" name="cust_bank_branch[]" id="" class="form-control" placeholder="Enter Branch Name">
										</div>
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<div class="form-group">
											<label>Account Holder Name <span id="mandatory_fields">*</span></label>
											<input type="text" name="cust_bank_holder_name[]" id="" class="form-control" placeholder="Enter Account Holder Name">
										</div>
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<div class="form-group">
											<label>Account Number <span id="mandatory_fields">*</span></label>
											<input type="text" name="cust_ac_no[]" id="" class="form-control" placeholder="Enter Account Number">
										</div>
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<div class="form-group">
											<label>IFSC <span id="mandatory_fields">*</span></label>
											<input type="text" name="cust_ifsc_code[]" id="" class="form-control" placeholder="Enter IFSC Code">
										</div>
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<div class="form-group">
											<label>UPI ID</label>
											<input type="text" name="cust_ac_upid[]" id="" class="form-control" placeholder="Enter UPI ID">
										</div>
									</div>
								</div>	
							</div>
							<a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another Bank Accounts</a>
							<!--<div class="billing-btn">
								<h5 class="form-title mb-0">Bank Account(s)</h5>
								<a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another Bank Accounts</a>
							</div>-->
                        </div>
                        <div class="add-customer-btns text-end">
                                <a href="javascript:void(0);" id="prevBtnThree" class="btn customer-btn-cancel">Previous</a>
                                <button type="submit" id="nxtBtnThree" class="btn customer-btn-save">Save Changes</button>
                        </div>
						<div id="addCustomerLoader" class="loader"></div>
						<div class="message-container"></div>
						</form>
                    </div>
                </div>
            
					
			</div>
        </div> 
    </div>
</div>
<script>
    function toggleGSTFields(value) {
            
            if (value === 'Yes') {
                document.getElementById('cust_gst_field').style.display = 'block';
                document.getElementById('cust_gst_type').style.display = 'block';
            } else {
                document.getElementById('cust_gst_field').style.display = 'none';
                document.getElementById('cust_gst_type').style.display = 'none';
            }
        }
    </script>
@endsection