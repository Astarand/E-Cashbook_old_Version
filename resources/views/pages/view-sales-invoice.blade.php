@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>View Sales Invoice</h5>
                </div>
            </div>
			<form action="javascript:void(0);" method="post" name="addSalesFrmTop" id="addSalesFrmTop">
			@csrf
            <div class="row mb-4">				
                <div class="col-lg-6">
                    <label for="validationCustom01">Invoice Number</label>
                    <input type="text" name="inv_num" id="inv_num" class="form-control" value="{{ isset($sales->inv_num)?$sales->inv_num:""}}"  readonly>
                </div>

                <div class="col-lg-6">
                    <label for="validationCustom01">Invoice Date</label>
                    <input type="date" name="inv_date" id="inv_date" value="{{ isset($sales->inv_date)?$sales->inv_date:""}}" class="form-control" required>
                </div>
            </div>
			</form>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-A" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="false" role="tab" tabindex="-1">
                                Seller Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-B" data-bs-toggle="tab" aria-expanded="true" class="nav-link " aria-selected="true" role="tab">
                                Customer Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-C" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                Product/Service Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-D" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                Other Details
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">

                    <div class="tab-content">
						
                        <div class="tab-pane active show" id="basic" role="tabpanel">
							<form action="javascript:void(0);" method="post" name="addSalesFrm" id="addSalesFrm" enctype="multipart/form-data">
							<input type="hidden" name="id" id="sId" value="{{ $sales->id }}">
							@csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_name" id="seller_name" value="{{ $sales->seller_name }}" placeholder="Seller Name" >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_contact" id="seller_contact" value="{{ $sales->seller_contact }}" placeholder="Contact Number" >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Email Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_email" id="seller_email" value="{{ $sales->seller_email }}" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Pan Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_pan" id="seller_pan" value="{{ $sales->seller_pan }}" placeholder="Pan Number" >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>GST Number</label>
                                        <input type="text" class="form-control" name="seller_gst" id="seller_gst" value="{{ $sales->seller_gst }}" placeholder="GST Number" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Address Line 1 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_addone" id="seller_addone" value="{{ $sales->seller_addone }}" placeholder="Address Line 1" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Address Line 2</label>
                                        <input type="text" class="form-control" name="seller_addtwo" id="seller_addtwo" value="{{ $sales->seller_addtwo }}" placeholder="Address Line 2" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <select class="form-control select-style" name="seller_country" id="country" onChange="changeCountry(this);">
											<option value="">Select Country</option>
											@foreach($countries as $k=>$country)
											<option value="{{ $country->id }}" <?php echo ($country->id==$sales->seller_country)? "selected":"" ?> >{{ $country->name }}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>State <span class="text-danger">*</span></label>
                                        <select class="form-control select-style" name="seller_state" id="state" onChange="changeState(this);">
											<option value="">Select State</option>
											@foreach($states_seller as $k=>$state)
												<option value="{{ $state->id }}" <?php echo ($state->id==$sales->seller_state)? "selected":"" ?> >{{ $state->name }}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>City <span class="text-danger">*</span></label>
                                        <select class="form-control select-style" name="seller_city" id="city">
											<option value="">Select City</option>
											@foreach($cities_seller as $k=>$city)
												<option value="{{ $city->id }}" <?php echo ($city->id==$sales->seller_city)? 'selected="selected"':"" ?> >{{ $city->name }}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_pin" id="seller_pin" value="{{ $sales->seller_pin }}" placeholder="Pincode">
                                    </div>
                                </div>
                            </div>
								<div class="message-container"></div>
								<div id="addSalesLoader" class="loader"></div>
								<div class="add-customer-btns text-end">
									<a href="{{ url('/sales-invoice') }}" class="btn btn-primary cancel me-2">Cancel</a>
									<a href="{{ url('/sales-invoice-pdf/OQ==/invoice')}}" class="btn customer-btn-cancel">Preview Invoice</a>
									<a href="javascript:void(0);" id="nextBtnSeller" title="Next" class="btn btn-primary cancel me-2"> >> </a>
								</div>
							</form>
                        </div>
							
                        <div class="tab-pane " id="customer" role="tabpanel">
							<form action="javascript:void(0);" method="post" name="addSalesFrmTwo" id="addSalesFrmTwo" enctype="multipart/form-data">
							<input type="hidden" name="id" id="sId" value="{{ $sales->id }}">
							@csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group add-products">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="inv_name" id="invNameCustomer" onChange="changeCustomer();">
                                                <option value="">Select Customer</option>
												@foreach($custData as $k=>$cust)
													<option value="{{ $cust->id }}" <?php echo @($cust->id==$sales->inv_name)? "selected":"" ?>>{{ $cust->cust_name }}</option> 
												@endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="contact_no" placeholder="Contact Number" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Email Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cust_email" placeholder="Email Address" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Pan Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cust_pan" placeholder="Pan Number" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>GST Number</label>
                                        <input type="text" class="form-control" id="cust_gst_no" placeholder="GST Number" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Address Type<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="add_type" id="add_type">
                                                <option value="">Select</option>
                                                <option value="billing_add" <?php echo ($sales->add_type=="billing_add")? "selected":"" ?>>Billing Address</option>
                                                <option value="shipping_add" <?php echo ($sales->add_type=="shipping_add")? "selected":"" ?>>Shipping Address</option>
                                                <option value="both" <?php echo ($sales->add_type=="both")? "selected":"" ?>>Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" id="bill_addone" placeholder="Address Line 1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" id="bill_addtwo" placeholder="Address Line 2" disabled>
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
												<option value="">Select State</option>
													
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Pincode</label>
                                            <input type="text" id="cust_bill_pin" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="another" style="display: none;">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" id="cust_ship_addone" placeholder="Address Line 1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" id="cust_ship_addtwo" placeholder="Address Line 2" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Country</label>
                                            <select class="form-control select-style"  id="cust_ship_country" >
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
                                            <select class="form-control select-style"  id="cust_ship_state" >
												<option value="">Select State</option>
												@foreach($states_ship as $k=>$state)
													<option value="{{ $state->id }}" >{{ $state->name }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>City</label>
                                            <select class="form-control select-style" id="cust_ship_city">
												<option value="">Select City</option>
												@foreach($cities_ship as $k=>$city)
													<option value="{{ $city->id }}">{{ $city->name }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Pincode</label>
                                            <input type="text" id="cust_ship_pin" class="form-control" placeholder="Pincode" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
								<div class="message-container"></div>
								<div id="editSalesLoader" class="loader"></div>
								<div class="add-customer-btns text-end">
									<a href="javascript:void(0);" id="prevBtnCust" title="Previous" class="btn btn-primary cancel me-2"> << </a>
									<a href="{{ url('/sales-invoice-pdf/'.base64_encode($sales->id).'/invoice') }}" class="btn customer-btn-cancel">Preview Invoice</a>
									<a href="javascript:void(0);" id="nextBtnCust" title="Next" class="btn btn-primary cancel me-2"> >> </a>
								</div>
							</form>
						</div>
						
                        <div class="tab-pane" id="product" role="tabpanel">
							<form action="javascript:void(0);" method="post" name="addSalesFrmThree" id="addSalesFrmThree" enctype="multipart/form-data">
							<input type="hidden" name="id" id="sId" value="{{ $sales->id }}">
							<input type="hidden" id="sign" value="{{ $sales->signature }}">
							@csrf
                            <div class="row mb-4">
                                
                            </div>
                            <div class="row border-0">
                                <div class="col-md-12">
                                    <div class="cards">
                                        <div class="form-groups-item" id="invoiceData">
                                            <div class="card-table">
                                                <div class="card-body">
                                                    <div class="table-responsive no-pagination">
                                                        <table class="table table-center table-hover datatable">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product / Service</th>
                                                                <th>HSN / SAC</th>
                                                                <th>Quantity</th>
                                                                <th>Rate</th>
                                                                <th>Discount</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
																<?php $i = 1 ?>
																<?php $taxableAmt = 0 ?>
																<?php $totalDisc = 0 ?>
																<?php $totalTax = 0 ?>
																<?php $totalAmount = 0 ?>
																@foreach ($sales_values as $value)
																<tr>
																	<td>{{ $i = $i+1 }}</td>
																	<td>{{ $value->item_name }}</td>
																	<td>{{ ($value->sac_code !="")?$value->sac_code:$value->hsn_code }}</td>
																	<td><input type="text" name="quantity" id="quantity_<?php echo $value->id; ?>"  data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" data-prod_id="{{ $value->prod_id }}" class="form-control quantity" value="{{ $value->quantity }}" onChange="changeQuantity(this)" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" ></td>
																	<td><input type="text" name="rate" id="rate_<?php echo $value->id; ?>"  data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" onChange="changeRate(this)" class="form-control rate" value="{{ $value->rate }}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
																	<td>{{ $value->disc_amt }}</td>																	
																	<td>₹{{ $value->amount }}</td>
																	<td class="d-flex align-items-center">
																		<a href="javascript:void(0);" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" data-rate="{{ $value->rate }}" data-discamt="{{ $value->disc_amt }}" data-taxtype="{{ $value->tax_type }}"  class="btn-action-icon me-2" data-bs-toggle="modal" data-bs-target="#add_discount"><span><i class="fe fe-edit"></i></span></a>
																		<a href="javascript:void(0);" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" class="btn-action-icon" data-bs-toggle="modal" data-bs-target="#delete_discount"><span><i class="fe fe-trash-2"></i></span></a>
																	</td>
																</tr>
																<?php $taxableAmt += ($value->rate * $value->quantity); ?>
																<?php $totalDisc += $value->disc_amt; ?>
																<?php $totalTax += $value->tax_amt; ?>
																<?php $totalAmount += $value->amount; ?>
																@endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
											
											<div class="row mb-4">
												<div class="col-xl-12 col-lg-12">
													<div class="form-group-bank">
														<div class="invoice-total-box">
                                                            <div class="invoice-total-inner">
                                                                <p>Taxable Amount <span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $taxableAmt; ?></span></p>
                                                                <p>Discount <span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $totalDisc; ?></span></p>
                                                                <p>GST<span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $totalTax; ?></span></p>
                                                                <!--<div class="status-toggle justify-content-between ">
                                                                    <div class="d-flex align-center">
                                                                        <p>Round Off </p>
                                                                        <input id="rating_1" class="check" type="checkbox" onclick="toggleEdit()">
                                                                        <label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
                                                                    </div>
                                                                    <span><i class="fa-solid fa-indian-rupee-sign" style="position: absolute; right: 15%; top:43%;"></i> <input type="number" id="value" class="form-control" placeholder="0.00" readonly style="width:40%; float: right;"></span>
                                                                </div>-->
                                                            </div>
                                                            <div class="invoice-total-footer mt-2">
                                                                <h4>Total Amount <span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $totalAmount; ?></span></h4>
                                                            </div>
                                                            <p>Amount in words<span> {{ Helper::convert_number_to_words($totalAmount) }} Only</span></p>
                                                        </div>
													</div>
												</div>
											</div>
                                        </div>
                                        <div class="form-group-item  p-0">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="form-group-bank">
                                                        <div class="input-block mb-3">
                                                            <label>Signature Name</label>
                                                            <input type="text" name="signature_name" id="signature_name" value="{{ $sales->signature_name }}" class="form-control" placeholder="Enter Signature Name">
                                                        </div>
                                                        <div class="input-block mb-0">
                                                            <label>Signature Image</label>
                                                            <div class="input-block mb-3  service-upload service-upload-info mb-0">
                                                                <span><i class="fe fe-upload-cloud me-1"></i>Upload Signature</span>
                                                                <input type="file" name="signature" id="signature" value="{{ $sales->signature }}">
																<div id="frames"></div>
																@if(@$sales->signature !="")
																<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/invoice-signature/'.$sales->signature) }}">Download</a></div>
																@endif
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
							<div id="editSalesLoader" class="loader"></div>
                            <div class="add-customer-btns text-end">
                                <a href="javascript:void(0);" id="prevBtnProd" title="Previous" class="btn btn-primary"> << </a>
								<a href="{{ url('/sales-invoice-pdf/'.base64_encode($sales->id).'/invoice') }}" class="btn customer-btn-cancel">Preview Invoice</a>
								<a href="javascript:void(0);" id="nextBtnProd" title="Next" class="btn btn-primary cancel me-2"> >> </a>
                            </div>
							</form>
                        </div>
						
                        <div class="tab-pane" id="other" role="tabpanel">
							<form action="javascript:void(0);" method="post" name="addSalesFrmFour" id="addSalesFrmFour" enctype="multipart/form-data">
							<input type="hidden" name="id" id="sId" value="{{ $sales->id }}">
							@csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Mode of Payment<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select name="mode_of_pay" id="mode_of_pay" class="form-select">
                                                <option value="">Select</option>
                                                <option value="IMPS" <?php echo ($sales->mode_of_pay=="IMPS")? "selected":"" ?>>IMPS</option>
                                                <option value="RTGS" <?php echo ($sales->mode_of_pay=="RTGS")? "selected":"" ?>>RTGS</option>
                                                <option value="NEFT" <?php echo ($sales->mode_of_pay=="NEFT")? "selected":"" ?>>NEFT</option>
                                                <option value="UPI" <?php echo ($sales->mode_of_pay=="UPI")? "selected":"" ?>>UPI</option>
                                                <option value="CARD" <?php echo ($sales->mode_of_pay=="CARD")? "selected":"" ?>>Credit/Debit Card</option>
                                                <option value="CASH" <?php echo ($sales->mode_of_pay=="CASH")? "selected":"" ?>>Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Payment Status<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="pay_status" id="pay_status">
                                                <option value="">Select</option>
                                                <option value="Full" <?php echo ($sales->pay_status=="Full")? "selected":"" ?>>Full Payment</option>
                                                <option value="Partial" <?php echo ($sales->pay_status=="Partial")? "selected":"" ?>>Partial Payment</option>
                                                <option value="Due" <?php echo ($sales->pay_status=="Due")? "selected":"" ?>>Due</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="partial"  style="display: none">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Total Amount<span class="text-danger">*</span></label>
                                            <input type="text" name="total_amount" id="total_amount" value="{{ $sales->total_amount }}" class="form-control" placeholder="Total Amount" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Advance Amount<span class="text-danger">*</span></label>
                                            <input type="text" name="advance_amount" id="advance_amount" value="{{ $sales->advance_amount }}" class="form-control" placeholder="Advance Amount" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Due Amount<span class="text-danger">*</span></label>
                                            <input type="text" name="due_amount" id="due_amount" value="{{ $sales->due_amount }}" class="form-control" placeholder="Due Amount" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Buyer's Order Number</label>
                                        <input type="text" name="buyer_orderno" id="buyer_orderno" value="{{ $sales->buyer_orderno }}" class="form-control" placeholder="Buyer's Order Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Order Date<span class="text-danger">*</span></label>
                                        <input type="date" name="order_date" id="order_date" value="{{ $sales->order_date }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Suppliers Ref No.</label>
                                        <input type="text" name="supplier_refno" id="supplier_refno" value="{{ $sales->supplier_refno }}" class="form-control" placeholder="Suppliers Ref No.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Others Ref No.</label>
                                        <input type="text" name="other_refno" id="other_refno" value="{{ $sales->other_refno }}" class="form-control" placeholder="Others Ref No.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Dispatch Document No.</label>
                                        <input type="text" name="dispa_docno_one" id="dispa_docno_one" value="{{ $sales->dispa_docno_one }}" class="form-control" placeholder="Dispatch Document No.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Dispatch Document No.</label>
                                        <input type="text" name="dispa_docno_two" id="dispa_docno_two" value="{{ $sales->dispa_docno_two }}" class="form-control" placeholder="Dispatch Document No.">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Dispatch trough<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="disp_through" id="disp_through">
                                                <option value="">Select</option>
                                                <option value="Road Transportation" <?php echo ($sales->disp_through=="Road Transportation")? "selected":"" ?>>Road Transportation</option>
                                                <option value="Rail Transportation" <?php echo ($sales->disp_through=="Rail Transportation")? "selected":"" ?>>Rail Transportation</option>
                                                <option value="Air Transportation" <?php echo ($sales->disp_through=="Air Transportation")? "selected":"" ?>>Air Transportation</option>
                                                <option value="Sea Transportation" <?php echo ($sales->disp_through=="Sea Transportation")? "selected":"" ?>>Sea Transportation</option>
                                                <option value="Multi model Transportation" <?php echo ($sales->disp_through=="Multi model Transportation")? "selected":"" ?>>Multi model Transportation</option>
                                                <option value="Parcel & Courier Service" <?php echo ($sales->disp_through=="Parcel & Courier Service")? "selected":"" ?>>Parcel & Courier Service</option>
                                                <option value="By Hand" <?php echo ($sales->disp_through=="By Hand")? "selected":"" ?>>By Hand</option>
                                                <option value="Other" <?php echo ($sales->disp_through=="Other")? "selected":"" ?>>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" style="display: none" id="other_dispatch">
                                    <div class="form-group ">
                                        <label>Other Dispatch Details</label>
                                        <input type="text" name="other_dispa_det" id="other_dispa_det" value="{{ $sales->other_dispa_det }}" class="form-control" placeholder="Other Dispatch Details">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                    <div class="form-group" id="summernote_container">
                                        <label class="form-control-label">Terms of Delivery</label>
                                        <textarea class="summernote form-control" name="terms_delivery" id="terms_delivery" placeholder="Write Terms of Delivery" rows="1">{{ $sales->terms_delivery }}</textarea>
                                    </div>
                                </div>
                            </div>
							<div class="message-container"></div>
							<div id="editSalesLoader" class="loader"></div>
                            <div class="add-customer-btns text-end">
                                <a href="javascript:void(0);" id="prevBtnOther" title="Previous" class="btn btn-primary"> << </a>
								<a href="{{ url('/sales-invoice-pdf/'.base64_encode($sales->id).'/invoice') }}" class="btn customer-btn-cancel">Preview Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal custom-modal fade" id="delete_discount" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 justify-content-center pb-0">
                    <div class="form-header modal-header-title text-center mb-0">
                        <h4 class="mb-2">Delete Product / Services</h4>
                        <p>Are you sure want to delete?</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" id="delItem" class="btn btn-primary paid-continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Date Picker
            function setTodayDate() {
                var today = new Date();
                var formattedDate = today.toISOString().substr(0, 10);
                $("#invoiceDate").val(formattedDate);
            }

            function updateDateToTomorrow() {
                var today = new Date();
                var tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                var formattedDate = tomorrow.toISOString().substr(0, 10);
                $("#invoiceDate").val(formattedDate);
            }

            setTodayDate();
            setInterval(updateDateToTomorrow, 86400000);

            // Customer Details Address type
            function toggleAddressFields() {
                var selectedOption = $("select[name='add_type']").val();
                if(selectedOption === 'both') {
                    $("#another").show();
                    $("#another input").prop('disabled', true);
                } else {
                    $("#another").hide();
                    $("#another input").prop('disabled', true);
                }
            }

            toggleAddressFields();
            $("select[name='add_type']").change(function(){
                toggleAddressFields();
            });

            // Product / Service Details GST Transaction mode
            function updateGSTAllocation() {
                var selectedOption = $("select[name='gst_trans']").val();
                var allocationInput = $("#gst_allocation input");

                switch(selectedOption) {
                    case 'intrastate':
                        allocationInput.val("CGST(9%) & SGST(9%)");
                        break;
                    case 'interstate':
                        allocationInput.val("IGST(18%)");
                        break;
                    case 'union':
                        allocationInput.val("UGST(18%)");
                        break;
                    default:
                        allocationInput.val("");
                        break;
                }
            }

            updateGSTAllocation();
            $("select[name='gst_trans']").change(function(){
                updateGSTAllocation();
            });

            // Other Details Partial Payment Option
            function togglePartialPaymentFields() {
                var selectedOption = $("select[name='pay_status']").val();
                if(selectedOption === 'Partial') {
                    $("#partial").show();
                    $("#partial input").prop('disabled', false);
                } else {
                    $("#partial").hide();
                    $("#partial input").prop('disabled', true);
                }
            }

            togglePartialPaymentFields();
            $("select[name='pay_status']").change(function(){
                togglePartialPaymentFields();
            });

            // Other Details Other Dispatch Option
            function toggleDispatchFields() {
                var selectedOption = $("select[name='disp_through']").val();
                if(selectedOption === 'Other') {
                    $("#other_dispatch").show();
                    $("#other_dispatch input").prop('disabled', false);
                } else {
                    $("#other_dispatch").hide();
                    $("#other_dispatch input").prop('disabled', true);
                }
            }

            toggleDispatchFields();
            $("select[name='disp_through']").change(function(){
                toggleDispatchFields();
            });

            // Billing Type
            function toggleBillingFields() {
                var selectedOption = $("select[name='billing_type']").val();
                if(selectedOption === 'gov') {
                    $("#billing_input").show();
                    $("#billing_input input").prop('disabled', false);
                } else {
                    $("#billing_input").hide();
                    $("#billing_input input").prop('disabled', true);
                }
            }

            toggleBillingFields();
            $("select[name='billing_type']").change(function(){
                toggleBillingFields();
            });

            // Enable/Disable Value Input based on Checkbox
            $("#rating_1").change(function(){
                var checkbox = $(this);
                var valueInput = $("#value");

                if (checkbox.is(":checked")) {
                    valueInput.prop("readonly", false).focus();
                } else {
                    valueInput.prop("readonly", true);
                }
            });
        });
    </script>
@endsection

