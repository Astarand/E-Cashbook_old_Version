@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add Sales Credit Debit Note</h5>
                </div>
            </div>

			<form action="javascript:void(0);" method="post" name="salesCreditDebitFrm" id="salesCreditDebitFrm" enctype="multipart/form-data">
			<input type="hidden" name="id" id="sId" value="">
			@csrf
            <div class="row mb-4">
                {{-- <div class="col-lg-6">
                    <label for="validationCustom01">Invoice Number</label>
                    <input type="text" name="inv_num" id="inv_num" value="{{ $vNo }}" class="form-control"  required="">
                </div> --}}

                <div class="col-lg-6">
                    <label for="inv_num">Invoice Number</label>
                    <select name="inv_num" id="inv_num" class="form-control" required aria-invalid="false">
                        <option value="">Select Invoice Number</option>
                        @foreach($invoiceNumbers as $invoice)
                            <option value="{{ $invoice->inv_num }}">{{ $invoice->inv_num }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-6">
                    <label for="validationCustom01">Invoice Date</label>
                    <input type="date" name="inv_date" id="inv_date" class="form-control" required>
                </div>
            </div>
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 text-center">
					<h6>Please fill Basic Details & Other Details tab information</h6>
				</div>
			</div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#basic" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                Basic Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#other" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                Other Details
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic">
                               
                                    <div class="row">
                                        <h5 class="my-3">Seller Details</h5>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Seller Name</label>
                                                <input type="text" name="seller_name" id="seller_name" class="form-control" placeholder="Seller Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Address Line 1</label>
                                                <input type="text" name="seller_addone" id="seller_addone" class="form-control" placeholder="Address Line 1">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
											<div class="form-group ">
												<label>Address Line 2</label>
												<input type="text" class="form-control" name="seller_addtwo" id="seller_addtwo" placeholder="Address Line 2" >
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="form-group ">
												<label>Country <span class="text-danger">*</span></label>
												<select class="form-control select-style" name="seller_country" id="country" onChange="changeCountry(this);">
													<option value="">Select Country</option>
													@foreach($countries as $k=>$country)
													<option value="{{ $country->id }}" >{{ $country->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="form-group ">
												<label>State <span class="text-danger">*</span></label>
												<select class="form-control select-style" name="seller_state" id="state" onChange="changeState(this);">
													<option value="">Select State</option>
													@foreach($states_bill as $k=>$state)
														<option value="{{ $state->id }}" >{{ $state->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="form-group ">
												<label>City <span class="text-danger">*</span></label>
												<select class="form-control select-style" name="seller_city" id="city">
													<option value="">Select City</option>
													@foreach($cities_bill as $k=>$city)
														<option value="{{ $city->id }}" >{{ $city->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="form-group ">
												<label>Pincode <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="seller_pin" id="seller_pin" placeholder="Pincode">
											</div>
										</div>
                                        
                                        <h5 class="my-3">Buyer Details</h5>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Buyer Name</label>
                                                <div class="form-group">
                                                    <select class="form-select" name="v_name" id="invNameCustomer" onchange="changeCustomer();">
                                                        <option value="">Select</option>
														@foreach($custData as $k=>$cust)
															<option value="{{ $cust->id }}" >{{ $cust->cust_name }}</option>
														@endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Contact Number</label>
                                                <input type="text" id="contact_no" class="form-control" placeholder="Contact Number" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Email Address</label>
                                                <input type="text" id="cust_email" class="form-control" placeholder="Email Address" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Address Line 1</label>
                                                <input type="text" id="bill_addone" class="form-control" placeholder="Address Line 1" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Address Line 2</label>
                                                <input type="text" id="bill_addtwo" class="form-control" placeholder="Address Line 2" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Country</label>
                                                <select class="form-control select-style" id="cust_bill_country" disabled>
													<option value="">Select Country</option>
													@foreach($countries as $k=>$country)
													<option value="{{ $country->id }}" >{{ $country->name }}</option>
													@endforeach			
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>State</label>
                                                <select class="form-control select-style" id="cust_bill_state" disabled>
													<option value="">Select State</option>													
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>City</label>
                                                <select class="form-control select-style" id="cust_bill_city" disabled>
												<option value="">Select City</option>
													
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Pincode</label>
                                                <input type="text" id="cust_bill_pin" class="form-control" placeholder="Pincode" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Contact Person Name</label>
                                                <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Contact Person Name" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Contact Person Number</label>
                                                <input type="text" name="cont_person_no" id="cont_person_no" class="form-control" placeholder="Contact Person Number" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group add-products">
                                                <label>Note Type<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-select" name="note_type" id="note_type">
                                                        <option value="">Select</option>
                                                        <option value="Credit">Credit</option>
                                                        <option value="Debit">Debit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="validationCustom01">Date of Note</label>
                                            <input type="date" name="note_date" id="note_date" class="form-control" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group add-products">
                                                <label>Reason for Issuance<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-select" name="reason_issuance" id="reason_issuance" onchange="showOtherIssuance(this)">
                                                        <option value="">Select</option>
                                                        <option value="returns">Returns</option>
                                                        <option value="discount">Discount</option>
                                                        <option value="price_adjustment">Price Adjustment</option>
                                                        <option value="damage_goods">Damage Goods</option>
                                                        <option value="incorrect_billing">Incorrect Billing</option>
                                                        <option value="rebates">Rebates</option>
                                                        <option value="cancelled_order">Cancelled Order</option>
                                                        <option value="good">Good Not received</option>
                                                        <option value="transportation">Transportation Charges</option>
                                                        <option value="tax">Tax Adjustment</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12" id="other_issuance" style="display: none;">
                                            <label for="otherIssuance">Other Issuance</label>
                                            <input type="text" name="otherIssuance" id="otherIssuance" class="form-control" placeholder="Other Issuance">
                                        </div>                                        
                                    </div>
                             
                            </div>
                            <div class="tab-pane" id="other">
                               
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Voucher No.</label>
                                            <input type="text" name="v_num" id="v_num" class="form-control" placeholder="Voucher No.">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Credit & Debit Amount</label>
                                            <input type="text" name="credit_debit_amount" id="credit_debit_amount"  class="form-control" placeholder="Credit & Debit Amount">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Adjusted Amount</label>
                                            <input type="text" name="adjusted_amount" id="adjusted_amount" class="form-control" placeholder="Adjusted Amout">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Date of Payment</label>
                                            <input type="date" name="date_of_payment" id="date_of_payment" class="form-control" placeholder="Date of Paymemt">
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Mode of Payment<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="mode_of_pay" id="mode_of_pay" class="form-select has-success" >
                                                    <option value="">Select</option>
                                                    <option value="IMPS">IMPS</option>
                                                    <option value="RTGS">RTGS</option>
                                                    <option value="NEFT">NEFT</option>
                                                    <option value="UPI">UPI</option>
                                                    <option value="CARD">Credit/Debit Card</option>
                                                    <option value="CASH">Cash</option>
                                                    <option value="OTHER">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="other_payment_div" style="display: none;">
                                        <div class="form-group">
                                            <label>Specify Other Payment Method<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="other_payment" id="other_payment" placeholder="Specify Other Payment Method">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Payment Status<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select class="form-select has-success" name="pay_status" id="pay_status" >
                                                    <option value="">Select</option>
                                                    <option value="Full">Full Payment</option>
                                                    <option value="Partial">Partial Payment</option>
                                                    <option value="Due">Due</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 description-box">
                                        <div class="form-group" id="summernote_container">
                                            <label class="form-control-label">Terms of Delivery</label>
                                            <textarea name="terms_delivery" id="terms_delivery" class="summernote form-control" placeholder="Description of Goods" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Challan No.</label>
                                            <input type="text" name="challan_no" id="challan_no" class="form-control" placeholder="Challan No.">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Challan Date</label>
                                            <input type="Date" name="challan_date" id="challan_date" class="form-control" placeholder="Challan Date">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Document No.</label>
                                            <input type="text" name="doc_no" id="doc_no" class="form-control" placeholder="Document No.">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Document Date</label>
                                            <input type="Date" name="doc_date" id="doc_date" class="form-control" placeholder="Document Date">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                        <div class="form-group" id="summernote_container">
                                            <label class="form-control-label">Terms & Condition</label>
                                            <textarea name="term_condition" id="term_condition" class="summernote form-control" placeholder="Terms & Condition" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="input-block mb-0">
                                            <label>Upload Document</label>
                                            <div class="input-block mb-3  service-upload service-upload-info mb-0">
                                                <span><i class="fe fe-upload-cloud me-1"></i>Upload Document</span>
                                                <input type="file" name="voucher_doc" id="voucher_doc">
                                                <div id="frames"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 text-center">
					<h6>Please fill Basic Details & Other Details tab information</h6>
				</div>
			</div>

            <div class="message-container"></div>
			<div id="addSalesLoader" class="loader"></div>
			<div class="add-customer-btns text-end">
				<a href="{{ url('/sales-credit-debit') }}" class="btn btn-primary cancel me-2">Cancel</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
        </div>
    </div>
<script>
    function showOtherIssuance(selectElement) {
        var otherIssuanceDiv = document.getElementById("other_issuance");
        var otherIssuanceInput = document.getElementById("otherIssuance");

        if (selectElement.value === "other") {
            otherIssuanceDiv.style.display = "block";
            otherIssuanceInput.required = true; // Making the field required
        } else {
            otherIssuanceDiv.style.display = "none";
            otherIssuanceInput.required = false; // Making the field not required
        }
    }

    // Function to handle the change event on the dropdown
    document.getElementById('mode_of_pay').addEventListener('change', function() {
            var otherPaymentDiv = document.getElementById('other_payment_div');
            if (this.value === 'OTHER') {
                otherPaymentDiv.style.display = 'block';
            } else {
                otherPaymentDiv.style.display = 'none';
            }
        });

        // Initial check in case "Other" is selected by default
        window.addEventListener('DOMContentLoaded', function() {
            var modeOfPay = document.getElementById('mode_of_pay').value;
            var otherPaymentDiv = document.getElementById('other_payment_div');
            if (modeOfPay === 'OTHER') {
                otherPaymentDiv.style.display = 'block';
            }
        });
</script>
@endsection

