@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add Payment</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <form action="javascript:void(0);" method="post" name="payment_detail" id="payment_detail">
						<input type="hidden" name="custId" id="custId" value="">
                    <div class="form-group-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date <span class="text-danger"> *</span></label>
                                    <input type="Date" required class="form-control" name="payment_date" id="payment_date" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Purpose Of Payment <span class="text-danger"> *</span></label>
                                    <input type="text" required class="form-control" name="purpose_of_payment" id="purpose_of_payment" placeholder="Enter Purpose Of Payment">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mode of Payment <span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <select class="form-select" required name="mode_of_payment" id="mode_of_payment">
                                            <option value="">Select</option>
                                            <option value="NEFT">NEFT</option>
                                            <option value="IMPS">IMPS</option>
                                            <option value="RTGS">RTGS</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Demand Draft">Demand Draft</option>
                                            <option value="Pay Order">Pay Order</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12" id="cashTypeOther">
                                <div class="form-group">
                                    <label>Cash Type</label>
                                    <div class="form-group">
                                        <select class="form-select" name="cash_type" id="cash_type">
                                            <option value="">Select</option>
                                            <option value="Bank Cash">Bank Cash</option>
                                            <option value="Petty Cash">Petty Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								 <div class="form-group">
									<label>Customer Name <span class="text-danger"> *</span></label>
										<select class="form-control select-style" required name="customerId" id="customerId">
										<option value="">Select Customer</option>
											@foreach($custData as $k=>$cust)
												<option value="{{ $cust->id }}">{{ $cust->cust_name }}</option>
											@endforeach
										</select>
								</div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" name="bankname" id="bankname" placeholder="Enter bank">
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Payment Voucher No. <span class="text-danger"> *</span></label>
                                    <input type="text" required class="form-control" name="pay_voucher_no" id="pay_voucher_no" value="{{ $payVoucherNo }}">
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Common Narration</label>
                                    <input type="text" class="form-control" name="common_narration" id="common_narration" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Payment Type <span class="text-danger"> *</span></label>
                                <div class="form-group">
                                    <select class="form-select" required name="payment_type" id="payment_type" onchange="getPaymentOptions(this);">
                                        <option value="">Select</option>
										<option value="Direct Payment">Direct Payment</option>
                                        <option value="Indirect Payment">Indirect Payment</option>
                                        <!--<option value="Rent">Rent</option>
                                        <option value="Utilities">Utilities</option>
                                        <option value="Insurance">Insurance</option>
                                        <option value="Legal and Professional Fees">Legal and Professional Fees</option>
                                        <option value="Advertising and Marketing">Advertising and Marketing</option>
                                        <option value="Repairs and Maintenance">Repairs and Maintenance</option>
                                        <option value="Depreciation">Depreciation</option>
                                        <option value="Property Taxes">Property Taxes</option>
                                        <option value="Office Supplies">Office Supplies</option>
                                        <option value="Postage and Shipping">Postage and Shipping</option>
                                        <option value="Telephone and Internet">Telephone and Internet</option>
                                        <option value="Travel and Entertainment">Travel and Entertainment</option>
                                        <option value="Training and Development">Training and Development</option>
                                        <option value="Office Rent and Equipment Leases">Office Rent and Equipment Leases</option>
                                        <option value="Vehicle Expenses">Vehicle Expenses</option>
                                        <option value="Vehicle Expenses">Bank Charges and Interest</option>
                                        <option value="Security Expenses">Security Expenses</option>
                                        <option value="Employee Benefits">Employee Benefits</option>
                                        <option value="Administrative Software">Administrative Software</option>
                                        <option value="Membership Dues and Subscriptions">Membership Dues and Subscriptions</option>
                                        <option value="Miscellaneous General Expenses">Miscellaneous General Expenses</option>-->
                                    </select>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label>Payment Type Option <span class="text-danger"> *</span></label>						
								<select class="form-control select-style" required name="payment_type_opt" id="payment_type_opt">
									<option value="">Select</option>
									
								</select>
							</div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Amount <span class="text-danger"> *</span></label>
                                    <input type="number" required class="form-control" name="amount" id="amount" placeholder="Enter Payment Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" class="form-control" name="message" id="message" placeholder="Enter Message">
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="message-container"></div>
                    <div class="add-customer-btns text-end">
                    <div id="paymentLoader" class="loader"></div>
                        <a href="{{ url('/payment') }}" class="btn customer-btn-cancel">Cancel</a>
                        <button type="submit" id="paysubmit" class="btn customer-btn-save">Save Changes</button>
                        
                    </div>
                </div>
            </form>
         </div>
        
        </div>
    </div>
@endsection
