@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>View Payment</h5>
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
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="payment_date" id="payment_date" value="{{ $payment->payment_date}}" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Purpose Of Payment</label>
                                    <input type="text" class="form-control" name="purpose_of_payment" id="purpose_of_payment"  value="{{ $payment->purpose_of_payment}}" placeholder="Enter Purpose Of Payment">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mode of Payment</label>
                                    <div class="form-group">
                                        <select class="form-select" name="mode_of_payment" id="mode_of_payment">
                                        <option value="{{ $payment->mode_of_payment }}" <?php echo ($payment->mode_of_payment)? "selected":"" ?>>{{ $payment->mode_of_payment }}</option>

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
                                            <option value="Bank Cash" <?php echo ($payment->cash_type=='Bank Cash')? "selected":"" ?>>Bank Cash</option>
                                            <option value="Petty Cash" <?php echo ($payment->cash_type=='Petty Cash')? "selected":"" ?>>Petty Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								 <div class="form-group">
									<label>Customer Name</label>
										<select class="form-control select-style" name="customerId" id="customerId">
										<option value="">Select Customer</option>
											@foreach($custData as $k=>$cust)
												<option value="{{ $cust->id }}" <?php echo @($cust->id==$payment->customerId)? "selected":"" ?>>{{ $cust->cust_name }}</option>
											@endforeach
										</select>
								</div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" name="bankname" id="bankname" value="{{ $payment->bankname }}" placeholder="Enter bank">
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Payment Voucher No.</label>
                                    <input type="text" class="form-control" name="pay_voucher_no" id="pay_voucher_no" value="{{ $payment->pay_voucher_no }}">
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Common Narration</label>
                                    <input type="text" class="form-control" name="common_narration" id="common_narration" value="{{ $payment->common_narration }}" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Payment Type</label>
                                <div class="form-group">
                                    <select class="form-select" name="payment_type" id="payment_type">
                                        <option value="">Select</option>
										<option value="Direct Payment" <?php echo ($payment->payment_type=='Direct Payment')? "selected":"" ?>>Direct Payment</option>
                                        <option value="Indirect Payment" <?php echo ($payment->payment_type=='Indirect Payment')? "selected":"" ?>>Indirect Payment</option>
                                        <!--<option value="Rent" <?php echo ($payment->payment_type=='Rent')? "selected":"" ?>>Rent</option>
                                        <option value="Utilities" <?php echo ($payment->payment_type=='Utilities')? "selected":"" ?>>Utilities</option>
                                        <option value="Insurance" <?php echo ($payment->payment_type=='Insurance')? "selected":"" ?>>Insurance</option>
                                        <option value="Legal and Professional Fees" <?php echo ($payment->payment_type=='Legal and Professional Fees')? "selected":"" ?>>Legal and Professional Fees</option>
                                        <option value="Advertising and Marketing" <?php echo ($payment->payment_type=='Advertising and Marketing')? "selected":"" ?>>Advertising and Marketing</option>
                                        <option value="Repairs and Maintenance" <?php echo ($payment->payment_type=='Repairs and Maintenance')? "selected":"" ?>>Repairs and Maintenance</option>
                                        <option value="Depreciation" <?php echo ($payment->payment_type=='Depreciation')? "selected":"" ?>>Depreciation</option>
                                        <option value="Property Taxes" <?php echo ($payment->payment_type=='Property Taxes')? "selected":"" ?>>Property Taxes</option>
                                        <option value="Office Supplies" <?php echo ($payment->payment_type=='Office Supplies')? "selected":"" ?>>Office Supplies</option>
                                        <option value="Postage and Shipping" <?php echo ($payment->payment_type=='Postage and Shipping')? "selected":"" ?>>Postage and Shipping</option>
                                        <option value="Telephone and Internet" <?php echo ($payment->payment_type=='Telephone and Internet')? "selected":"" ?>>Telephone and Internet</option>
                                        <option value="Travel and Entertainment" <?php echo ($payment->payment_type=='Travel and Entertainment')? "selected":"" ?>>Travel and Entertainment</option>
                                        <option value="Training and Development" <?php echo ($payment->payment_type=='Training and Development')? "selected":"" ?>>Training and Development</option>
                                        <option value="Office Rent and Equipment Leases" <?php echo ($payment->payment_type=='Office Rent and Equipment Leases')? "selected":"" ?>>Office Rent and Equipment Leases</option>
                                        <option value="Vehicle Expenses" <?php echo ($payment->payment_type=='Vehicle Expenses')? "selected":"" ?>>Vehicle Expenses</option>
                                        <option value="Bank Charges and Interest" <?php echo ($payment->payment_type=='Bank Charges and Interest')? "selected":"" ?>>Bank Charges and Interest</option>
                                        <option value="Security Expenses" <?php echo ($payment->payment_type=='Security Expenses')? "selected":"" ?>>Security Expenses</option>
                                        <option value="Employee Benefits" <?php echo ($payment->payment_type=='Employee Benefits')? "selected":"" ?>>Employee Benefits</option>
                                        <option value="Administrative Software" <?php echo ($payment->payment_type=='Administrative Software')? "selected":"" ?>>Administrative Software</option>
                                        <option value="Membership Dues and Subscriptions" <?php echo ($payment->payment_type=='Membership Dues and Subscriptions')? "selected":"" ?>>Membership Dues and Subscriptions</option>
                                        <option value="Miscellaneous General Expenses" <?php echo ($payment->payment_type=='Miscellaneous General Expenses')? "selected":"" ?>>Miscellaneous General Expenses</option>-->
                                    </select>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label>Payment Type Option</label>						
								<select class="form-control select-style" name="payment_type_opt" id="payment_type_opt"  onchange="getPaymentOptions(this);">
									<option value="">Select</option>
									@foreach($paymentCatOpt as $k=>$catOpt)
										<option value="{{ $catOpt->opt_val }}" <?php echo ($catOpt->opt_val==$payment->payment_type_opt)? "selected":"" ?>>{{ $catOpt->opt_val }}</option>
									@endforeach
									
								</select>
							</div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" id="amount" value="{{ $payment->amount}}" placeholder="Enter Payment Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" class="form-control" name="message" id="message" value="{{ $payment->message}}" placeholder="Enter Message">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-customer-btns text-end">
                        <a href="{{ url('/payment') }}" class="btn customer-btn-cancel">Cancel</a>
                        
                        
                    </div>
                </div>
            </form>
         </div>
        
        </div>
    </div>
@endsection
