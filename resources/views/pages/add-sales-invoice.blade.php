@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Create Sales Invoice</h5>
                </div>
            </div>
			<form action="javascript:void(0);" method="post" name="addSalesFrmTop" id="addSalesFrmTop">
			@csrf
            <div class="row mb-4">				
                <div class="col-lg-6">
                    <label for="validationCustom01">Invoice Number</label>
                    <input type="text" name="inv_num" id="inv_num" class="form-control" value="{{ $invoiceNo }}"  readonly>
                </div>

                <div class="col-lg-6">
                    <label for="validationCustom01">Invoice Date</label>
                    <input type="date" name="inv_date" id="inv_date" class="form-control" required>
                </div>				
            </div>
			</form>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="false" role="tab" tabindex="-1">
                                Seller Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" data-bs-toggle="tab" aria-expanded="true" class="nav-link " aria-selected="true" role="tab">
                                Customer Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                Product/Service Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
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
							<input type="hidden" name="id" id="sId" value="">
							@csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_name" value="{{ $comp_name }}" id="seller_name" placeholder="Seller Name" >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_contact" value="{{ $comp_phone }}" id="seller_contact" placeholder="Contact Number" >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Email Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_email" value="{{ $comp_email }}" id="seller_email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Pan Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_pan" value="{{ $comp_pan_no }}"  id="seller_pan" placeholder="Pan Number" >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>GST Number</label>
                                        <input type="text" class="form-control" value="{{ $comp_pan_no }}" name="seller_gst" id="seller_gst" placeholder="GST Number" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Address Line 1 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_addone" value="{{ $comp_bill_addone }}" id="seller_addone" placeholder="Address Line 1" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Address Line 2</label>
                                        <input type="text" class="form-control" name="seller_addtwo" value="{{ $comp_bill_addtwo }}" id="seller_addtwo" placeholder="Address Line 2" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <select class="form-control select-style has-success" name="seller_country" id="country" onChange="changeCountry(this);">
											<option value="">Select Country</option>
											@foreach($countries as $k=>$country)
                                            <option value="{{ $country->id }}" <?php echo
                                                                        @($country->
                                                                        id==$comp_bill_country)?
                                                                        "selected":"" ?>>{{ $country->name }}</option>
											
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>State <span class="text-danger">*</span></label>
                                        <select class="form-control select-style has-success" name="seller_state" id="state" onChange="changeState(this);">
											<option value="">Select State</option>                                           
											@foreach($states_bill as $k=>$state)
                                            <option value="{{ $state->id }}" <?php echo
                                                                        @($state->id==$comp_bill_state)?
                                                                        "selected":"" ?>>{{ $state->name }}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>City <span class="text-danger">*</span></label>
                                        <select class="form-control select-style has-success" name="seller_city" id="city">
											<option value="">Select City</option>
											@foreach($cities_bill as $k=>$city)
                                            <option value="{{ $city->id }}" <?php echo ($city->id==$comp_bill_city)?
                                                                        'selected="selected"':"" ?>>{{ $city->name }}
                                                                    </option>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="seller_pin" value="" id="seller_pin" placeholder="Pincode">
                                    </div>
                                </div>
                            </div>
								<div class="message-container"></div>
								<div id="addSalesLoader" class="loader"></div>
								<div class="add-customer-btns text-end">
									<a href="{{ url('/sales-invoice') }}" class="btn btn-primary cancel me-2">Cancel</a>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</form>
                        </div>
							
                        <div class="tab-pane " id="customer" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group add-products">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="gst_reg" id="gst_reg">
                                                <option value="">Select</option>
                                                <option value="">Company 1</option>
                                                <option value="">Company 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Contact Number" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Email Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Email Address" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Pan Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Pan Number" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>GST Number</label>
                                        <input type="text" class="form-control" placeholder="GST Number" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Address Type<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="add_type">
                                                <option value="">Select</option>
                                                <option value="billing_add">Billing Address</option>
                                                <option value="shipping_add">Shipping Address</option>
                                                <option value="both">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Contect person name</label>
                                            <input type="text" class="form-control" name="cont_person" id="cont_person" placeholder="Contect person name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Contect person mobile</label>
                                            <input type="text" class="form-control" name="cont_person_no" id="cont_person_no" placeholder="Contect person mobile">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" placeholder="Address Line 1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" placeholder="Address Line 2" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Country</label>
                                            <input type="text" class="form-control" placeholder="Country" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>State</label>
                                            <input type="text" class="form-control" placeholder="State" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>City</label>
                                            <input type="text" class="form-control" placeholder="City" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" placeholder="Pincode" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="another" style="display: none;">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" placeholder="Address Line 1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" placeholder="Address Line 2" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Country</label>
                                            <input type="text" class="form-control" placeholder="Country" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>State</label>
                                            <input type="text" class="form-control" placeholder="State" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>City</label>
                                            <input type="text" class="form-control" placeholder="City" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" placeholder="Pincode" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="product" role="tabpanel">
                            <div class="row mb-4">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Product Type<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="prod_type">
                                                <option value="">Select</option>
                                                <option value="">Manufacturing</option>
                                                <option value="">Trading / Reseller</option>
                                                <option value="">Service</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Product/Service Name<span class="text-danger">*</span></label>
                                        <select class="form-select" name="prod_type">
                                            <option value="">Select</option>
                                            <option value="">Product 1</option>
                                            <option value="">Product 2</option>
                                            <option value="">Product 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Billing Type<span class="text-danger">*</span></label>
                                        <select class="form-select" name="billing_type">
                                            <option value="">Select</option>
                                            <option value="normal">Product/ Service Billing</option>
                                            <option value="gov">Government Payment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="billing_input" style="display:none;">
                                    <div class="form-group">
                                        <label>Fees<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Fees Amount">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="billing_hsn" style="display:none;">
                                    <div class="form-group ">
                                        <label>HSN / SAC Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="HSN / SAC Code" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="billing_gst">
                                    <div class="form-group">
                                        <label>GST Rate<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" Value="" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="billing_gstmode">
                                    <div class="form-group">
                                        <label>GST Transaction Mode<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="gst_trans">
                                                <option value="">Select</option>
                                                <option value="intrastate">Intra State</option>
                                                <option value="interstate">Inter State</option>
                                                <option value="union">Union Territory</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12" id="billing_gstallo">
                                    <div class="form-group" id="gst_allocation">
                                        <label>GST % Allocation<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Discount on product</label>
                                        <div class="form-group">
                                            <div class="input-group row mb-0">
                                                <input type="text" class="form-control" name="" id="" aria-label="" placeholder="Discount">
                                                <select class="form-select" name="" id="" aria-label="Select Action">
                                                    <option value="percentage" selected>Percentage</option>
                                                    <option value="amount">Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 my-auto">
                                    <a href="#" class="btn btn-primary w-100"> Save Data</a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 my-auto">
                                    <a href="#" class="btn btn-outline-secondary w-100"> Add Another Product</a>
                                </div>
                            </div>
                            <div class="row border-0">
                                <div class="col-md-12">
                                    <div class="cards">
                                        <div class="form-groups-item">
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
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Product 1</td>
                                                                <td>123456879</td>
                                                                <td><input type="number" class="form-control" placeholder="0"></td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i> 500 /Pcs</td>
                                                                <td>20%</td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i> 120.00</td>
                                                                <td class="d-flex align-items-center">
                                                                    <a href="#" class="btn-action-icon me-2" data-bs-toggle="modal" data-bs-target="#add_discount"><span><i class="fe fe-edit"></i></span></a>
                                                                    <a href="#" class="btn-action-icon" data-bs-toggle="modal" data-bs-target="#delete_discount"><span><i class="fe fe-trash-2"></i></span></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-item  p-0">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="form-group-bank">
                                                        <div class="invoice-total-box">
                                                            <div class="invoice-total-inner">
                                                                <p>Taxable Amount <span><i class="fa-solid fa-indian-rupee-sign"></i> 120.00</span></p>
                                                                <p>Discount <span><i class="fa-solid fa-indian-rupee-sign"></i> 13.20</span></p>
                                                                <p>GST<span><i class="fa-solid fa-indian-rupee-sign"></i> 0.00</span></p>
                                                                <div class="status-toggle justify-content-between ">
                                                                    <div class="d-flex align-center">
                                                                        <p>Round Off </p>
                                                                        <input id="rating_1" class="check" type="checkbox" onclick="toggleEdit()">
                                                                        <label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
                                                                    </div>
                                                                    <span><i class="fa-solid fa-indian-rupee-sign" style="position: absolute; right: 15%; top:43%;"></i> <input type="number" id="value" class="form-control" placeholder="0.00" readonly style="width:40%; float: right;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="invoice-total-footer mt-2">
                                                                <h4>Total Amount <span><i class="fa-solid fa-indian-rupee-sign"></i> 107.80</span></h4>
                                                            </div>
                                                            <p>Amount in words<span> One hundred Twenty Rupees Only</span></p>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label>Signature Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Signature Name">
                                                        </div>
                                                        <div class="input-block mb-0">
                                                            <label>Signature Image</label>
                                                            <div class="input-block mb-3  service-upload service-upload-info mb-0">
                                                                <span><i class="fe fe-upload-cloud me-1"></i>Upload Signature</span>
                                                                <input type="file" multiple="" id="image_sign">
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
                        </div>
                        <div class="tab-pane" id="other" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Mode of Payment<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select">
                                                <option value="">Select</option>
                                                <option value="">IMPS</option>
                                                <option value="">RTGS</option>
                                                <option value="">NEFT</option>
                                                <option value="">UPI</option>
                                                <option value="">Credit/ Debit Card</option>
                                                <option value="">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Payment Status<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="payment_status">
                                                <option value="">Select</option>
                                                <option value="full">Full Payment</option>
                                                <option value="partial">Partial Payment</option>
                                                <option value="due">Due</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="partial"  style="display: none">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Total Amount<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Total Amount" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Advance Amount<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Advance Amount" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label>Due Amount<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Due Amount" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Buyer's Order Number</label>
                                        <input type="text" class="form-control" placeholder="Buyer's Order Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Order Date</label>
                                        <input type="date" id="invoiceDate" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Suppliers Ref No.</label>
                                        <input type="text" class="form-control" placeholder="Suppliers Ref No.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Others Ref No.</label>
                                        <input type="text" class="form-control" placeholder="Others Ref No.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Dispatch Document No.</label>
                                        <input type="text" class="form-control" placeholder="Dispatch Document No.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Dispatch Document No.</label>
                                        <input type="text" class="form-control" placeholder="Dispatch Document No.">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Dispatch trough<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="transport">
                                                <option value="">Select</option>
                                                <option value="Road Transportation">Road Transportation</option>
                                                <option value="Rail Transportation">Rail Transportation</option>
                                                <option value="Air Transportation">Air Transportation</option>
                                                <option value="Sea Transportation">Sea Transportation</option>
                                                <option value="Multi model Transportation">Multi model Transportation</option>
                                                <option value="Parcel & Courier Service">Parcel & Courier Service</option>
                                                <option value="By Hand">By Hand</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" style="display: none" id="other_dispatch">
                                    <div class="form-group ">
                                        <label>Other Dispatch Details</label>
                                        <input type="text" class="form-control" placeholder="Other Dispatch Details">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                    <div class="form-group" id="summernote_container">
                                        <label class="form-control-label">Terms of Delivery</label>
                                        <textarea class="summernote form-control" name="prod_desc" id="prod_desc" placeholder="Write Terms of Delivery" rows="1"></textarea>
                                    </div>
                                </div>
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
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Delete</a>
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
                $("#inv_date").val(formattedDate);
            }

            function updateDateToTomorrow() {
                var today = new Date();
                var tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                var formattedDate = tomorrow.toISOString().substr(0, 10);
                $("#inv_date").val(formattedDate);
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
                var selectedOption = $("select[name='payment_status']").val();
                if(selectedOption === 'partial') {
                    $("#partial").show();
                    $("#partial input").prop('disabled', false);
                } else {
                    $("#partial").hide();
                    $("#partial input").prop('disabled', true);
                }
            }

            togglePartialPaymentFields();
            $("select[name='payment_status']").change(function(){
                togglePartialPaymentFields();
            });

            // Other Details Other Dispatch Option
            function toggleDispatchFields() {
                var selectedOption = $("select[name='transport']").val();
                if(selectedOption === 'Other') {
                    $("#other_dispatch").show();
                    $("#other_dispatch input").prop('disabled', false);
                } else {
                    $("#other_dispatch").hide();
                    $("#other_dispatch input").prop('disabled', true);
                }
            }

            toggleDispatchFields();
            $("select[name='transport']").change(function(){
                toggleDispatchFields();
            });

            // Billing Type
            function toggleBillingFields() {
                var selectedOption = $("select[name='billing_type']").val();               
                 if(selectedOption === 'gov') {
                    $("#billing_input").show();
                    $("#billing_input input").prop('disabled', false);
                    $("#billing_hsn").hide();
                    $("#billing_hsn input").prop('disabled', true);
                    $("#billing_gst").hide();
                    $("#billing_gst input").prop('disabled', true);
                    $("#billing_gstmode").hide();
                    $("#billing_gstmode input").prop('disabled', true);
                    $("#billing_gstallo").hide();
                    $("#billing_gstallo input").prop('disabled', true);
                    
                } else {
                    $("#billing_input").hide();
                    $("#billing_input input").prop('disabled', true);
                    $("#billing_hsn").show();
                    $("#billing_hsn input").prop('disabled', false);
                    $("#billing_gst").show();
                    $("#billing_gst input").prop('disabled', false);
                    $("#billing_gstmode").show();
                    $("#billing_gstmode input").prop('disabled', false);
                    $("#billing_gstallo").show();
                    $("#billing_gstallo input").prop('disabled', false);
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

