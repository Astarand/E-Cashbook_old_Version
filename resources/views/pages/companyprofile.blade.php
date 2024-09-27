@extends('layouts.default')

@section('content')
<style>
    #mandatory_fields {
        color: red;
    }
</style>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div>
            @if (session('alert'))
                <div class="alert alert-warning">
                    {{ session('alert') }}
                </div>
            @endif
        </div>
        <div class="page-header">
            <div class="content-page-header">
                <h5>Update Your Company Profile</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--<form action="#">-->
                <div class="card-body">
                    <h5 class="form-title">Basic Details</h5>
                    <div class="profile-picture">

                        <div class="upload-profile">
                            <div class="profile-img">
                                @if(isset($compDetails->comp_logo) && $compDetails->comp_logo !="")
                                <img id="image-preview-user" class="avatar"
                                    src="{{asset('/public/uploads/profile/'.$compDetails->comp_logo)}}" alt>
                                @else
                                <img id="image-preview_user" class="avatar"
                                    src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt>
                                @endif
                            </div>
                            <div class="add-profile">
                                <h5>Upload Company Logo<span id="mandatory_fields">*</span></h5>
                                <span id="image-preview"></span>
                            </div>
                        </div>
                        <div class="img-upload">
                            <form action="javascript:void(0);" id="frmprofileimage" name="frmprofileimage">
                                @csrf
                                <div class="message-container"></div>
                                <label class="btn btn-primary">
                                    Upload <input type="file" name="comp_logo" id="comp_logo">
                                </label>
                                <a class="btn btn-remove compimagedel">Remove</a>
                            </form>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                                        aria-selected="true" role="tab">Company Details</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#details" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                        aria-selected="true" role="tab">Business Details</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#bank" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                                        aria-selected="true" role="tab">Bank Details</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#attachments" data-bs-toggle="tab" aria-expanded="false" class="nav-link "
                                        aria-selected="true" role="tab">Attachments</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="info" role="tabpanel">
                                    <form action="javascript:void(0);" name="frmcompdet" id="frmcompdet">
                                        @csrf
                                        <div class="message-container"></div>


                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group add-products">
                                                    <label>Company GST Registered <span id="mandatory_fields">*</span></label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="gst_reg" id="gst_reg">
                                                            <option value="">Select</option>
                                                            <option value="Yes" <?php echo (isset($compDetails->gst_reg)
                                                                && $compDetails->gst_reg =='Yes')? "selected":"" ?>>Yes
                                                            </option>
                                                            <option value="No" <?php echo (isset($compDetails->gst_reg)
                                                                && $compDetails->gst_reg =='No')? "selected":"" ?>>No
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-6 col-sm-12" id="gst_reg_no">
                                                <div class="form-group add-products">
                                                    <label>GST Number <span id="mandatory_fields">*</span></label>
                                                    <input type="text" name="gst_no" id="gst_no"
                                                            value="{{ isset($compDetails->gst_no) ? $compDetails->gst_no : '' }}"
                                                            class="form-control" placeholder="Enter Company GST Number">
                                                    <button type="submit" class="btn btn-primary">Fetch Details</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12" id="gst_reg_tran">
                                                <div class="form-group">
                                                    <label>GST Transaction Type <span
                                                            id="mandatory_fields">*</span></label>
                                                    <select class="form-select" name="comp_tran_type"
                                                        id="comp_tran_type">
                                                        <option value="">Select</option>
                                                        <option value="Regular" <?php echo (isset($compDetails->
                                                            comp_tran_type) && $compDetails->comp_tran_type
                                                            =='Regular')? "selected":"" ?>>Regular</option>
                                                        <option value="Composite" <?php echo (isset($compDetails->
                                                            comp_tran_type) && $compDetails->comp_tran_type
                                                            =='Composite')? "selected":"" ?>>Composite</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Company Name <span id="mandatory_fields">*</span></label>
                                                    <input type="text" name="comp_name" id="comp_name"
                                                        value="{{ isset($compDetails->comp_name)?$compDetails->comp_name:''}}"
                                                        class="form-control" placeholder="Company Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <label>Company Type <span id="mandatory_fields">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-select" name="comp_type" id="comp_type">
                                                        <option value="">Select</option>
                                                        <option value="Proprietorship" <?php echo (isset($compDetails->
                                                            comp_type) && $compDetails->comp_type=='Proprietorship')?
                                                            "selected":"" ?>>Proprietorship</option>
                                                        <option value="Partnership" <?php echo (isset($compDetails->
                                                            comp_type) && $compDetails->comp_type=='Partnership')?
                                                            "selected":"" ?>>Partnership</option>
                                                        <option value="One person Company (OPC)" <?php echo
                                                            (isset($compDetails->comp_type) &&
                                                            $compDetails->comp_type=='One person Company (OPC)')?
                                                            "selected":"" ?>>One person Company (OPC)</option>
                                                        <option value="LLP Company" <?php echo (isset($compDetails->
                                                            comp_type) && $compDetails->comp_type=='LLP Company')?
                                                            "selected":"" ?>>LLP Company</option>
                                                        <option value="PVT Ltd Company" <?php echo (isset($compDetails->
                                                            comp_type) && $compDetails->comp_type=='PVT Ltd Company')?
                                                            "selected":"" ?>>PVT Ltd Company</option>
                                                        <option value="LTD Company" <?php echo (isset($compDetails->
                                                            comp_type) && $compDetails->comp_type=='LTD Company')?
                                                            "selected":"" ?>>LTD Company</option>
                                                        <option value="Section-8 Company" <?php echo
                                                            (isset($compDetails->comp_type) &&
                                                            $compDetails->comp_type=='Section-8 Company')? "selected":""
                                                            ?>>Section-8 Company</option>
                                                        <option value="Society/Trust" <?php echo (isset($compDetails->
                                                            comp_type) && $compDetails->comp_type=='Society/Trust')?
                                                            "selected":"" ?>>Society/Trust</option>
                                                        <option value="Other" <?php echo (isset($compDetails->comp_type)
                                                            && $compDetails->comp_type=='Other')? "selected":"" ?>>Other
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12" id="comp_type_other"
                                                style="display: none;">
                                                <div class="form-group">
                                                    <label>Type Name <span id="mandatory_fields">*</span></label>
                                                    <input type="text" name="other_comp" id="other_comp" value="{{ isset($compDetails->other_comp_type)?$compDetails->other_comp_type:''}}"
                                                        class="form-control" placeholder="Other Name">

                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12" id="comp_type_cin">
                                                <div class="form-group">
                                                    <label>CIN <span id="mandatory_fields">*</span></label>
                                                    <input type="text" name="cin" id="cin"
                                                        value="{{ isset($compDetails->cin)?$compDetails->cin:""}}"
                                                        class="form-control" placeholder="CIN Number">

                                                </div>
                                            </div>


                                            <div class="col-lg-4 col-md-4 col-sm-12" id="comp_type_inc_date">
                                                <div class="form-group">
                                                    <label>Incorporation Date </label>
                                                    <input type="Date" name="inc_date" id="inc_date"
                                                        value="{{ isset($compDetails->inc_date)?$compDetails->inc_date:""}}"
                                                        class="form-control" placeholder="">

                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Company Email <span id="mandatory_fields">*</span></label>
                                                    <input type="email" name="comp_email" id="comp_email"
                                                        value="{{ isset($compDetails->comp_email)?$compDetails->comp_email:""}}"
                                                        class="form-control" placeholder="Enter Email Address">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone <span id="mandatory_fields">*</span></label>
                                                    <input type="text" name="comp_phone" id="comp_phone"
                                                        value="{{ isset($compDetails->comp_phone)?$compDetails->comp_phone:""}}"
                                                        class="form-control" placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>PAN Number <span id="mandatory_fields">*</span></label>
                                                    <input type="text" name="comp_pan_no" id="comp_pan_no"
                                                        value="{{ isset($compDetails->comp_pan_no)?$compDetails->comp_pan_no:""}}"
                                                        class="form-control" placeholder="Enter PAN Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>TAN </label>
                                                    <input type="text" name="comp_tan" id="comp_tan"
                                                        value="{{ isset($compDetails->comp_pan_no)?$compDetails->comp_pan_no:""}}"
                                                        class="form-control" placeholder="Enter PAN Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" name="comp_website" id="comp_website"
                                                        value="{{ isset($compDetails->comp_website)?$compDetails->comp_website:""}}"
                                                        class="form-control" placeholder="Enter Website Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="billing-btn mb-2">
                                                        <h5 class="form-title">Billing Address</h5>
                                                        {{-- <a href="#" class="btn btn-primary"
                                                            onclick="addBillingAddress()">Add Branch</a> --}}
                                                        <span class="btn btn-primary" onclick="addBillingAddress()">Add
                                                            Branch</span>
                                                    </div>
                                                    <div class="form-group add-products">
                                                        <label>GST Number</label>
                                                        <input type="text" name="comp_bill_gst_no" id="comp_bill_gst_no"
                                                            value="{{ isset($compDetails->comp_bill_gst_no)?$compDetails->comp_bill_gst_no:""}}"
                                                            class="form-control" placeholder="Enter Company GST Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Person Name <span id="mandatory_fields">*</span></label>
                                                        <input type="text" class="form-control" name="comp_bill_name"
                                                            id="comp_bill_name"
                                                            value="{{ isset($compDetails->comp_bill_name)?$compDetails->comp_bill_name:""}}"
                                                            placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 1 <span
                                                                id="mandatory_fields">*</span></label>
                                                        <input type="text" class="form-control" name="comp_bill_addone"
                                                            id="comp_bill_addone"
                                                            value="{{ isset($compDetails->comp_bill_addone)?$compDetails->comp_bill_addone:""}}"
                                                            placeholder="Enter Address 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" class="form-control" name="comp_bill_addtwo"
                                                            id="comp_bill_addtwo"
                                                            value="{{ isset($compDetails->comp_bill_addtwo)?$compDetails->comp_bill_addtwo:""}}"
                                                            placeholder="Enter Address 2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Country <span
                                                                        id="mandatory_fields">*</span></label>
                                                                <!--<input type="text" class="form-control" name="comp_bill_country" id="comp_bill_country" placeholder="Enter Country">-->
                                                                <select class="form-control select-style"
                                                                    name="comp_bill_country" id="country"
                                                                    onChange="changeCountry(this);">
                                                                    <option value="">Select Country</option>
                                                                    @foreach($countries as $k=>$country)
                                                                    <option value="{{ $country->id }}" <?php echo
                                                                        @($country->
                                                                        id==$compDetails->comp_bill_country)?
                                                                        "selected":"" ?>>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>City <span id="mandatory_fields">*</span></label>
                                                                <!--<input type="text" class="form-control" name="comp_bill_city" id="comp_bill_city" placeholder="Enter City">-->
                                                                <select class="form-control select-style"
                                                                    name="comp_bill_city" id="city">
                                                                    <option value="">Select City</option>
                                                                    @foreach($cities_bill as $k=>$city)
                                                                    <option value="{{ $city->id }}" <?php echo ($city->
                                                                        id==$compDetails->comp_bill_city)?
                                                                        'selected="selected"':"" ?>>{{ $city->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>State <span
                                                                        id="mandatory_fields">*</span></label>
                                                                <!--<input type="text" class="form-control" name="comp_bill_state" id="comp_bill_state" placeholder="Enter State">-->
                                                                <select class="form-control select-style"
                                                                    name="comp_bill_state" id="state"
                                                                    onChange="changeState(this);">
                                                                    <option value="">Select State</option>
                                                                    @foreach($states_bill as $k=>$state)
                                                                    <option value="{{ $state->id }}" <?php echo
                                                                        ($state->id==$compDetails->comp_bill_state)?
                                                                        "selected":"" ?>>{{ $state->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pincode <span
                                                                        id="mandatory_fields">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="comp_bill_pin" id="comp_bill_pin"
                                                                    value="{{ isset($compDetails->comp_bill_pin)?$compDetails->comp_bill_pin:""}}"
                                                                    placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Shipping Address</h5>
                                                        <a href="javascript:void(0);" onclick="sameAsBillAddr()"
                                                            class="btn btn-primary">Same as Billing Address</a>
                                                    </div>
                                                    <div class="form-group add-products">
                                                        <label>GST Number</label>
                                                        <input type="text" name="comp_ship_gst_no" id="comp_ship_gst_no"
                                                            value="{{ isset($compDetails->comp_ship_gst_no)?$compDetails->comp_ship_gst_no:""}}"
                                                            class="form-control" placeholder="Enter Company GST Number">

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Person Name </label>
                                                        <input type="text" class="form-control" name="comp_ship_name"
                                                            id="comp_ship_name"
                                                            value="{{ isset($compDetails->comp_ship_name)?$compDetails->comp_ship_name:""}}"
                                                            placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" class="form-control" name="comp_ship_addone"
                                                            id="comp_ship_addone"
                                                            value="{{ isset($compDetails->comp_ship_addone)?$compDetails->comp_ship_addone:""}}"
                                                            placeholder="Enter Address 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" class="form-control" name="comp_ship_addtwo"
                                                            id="comp_ship_addtwo"
                                                            value="{{ isset($compDetails->comp_ship_addtwo)?$compDetails->comp_ship_addtwo:""}}"
                                                            placeholder="Enter Address 2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <!--<input type="text" class="form-control" name="comp_ship_country" id="comp_ship_country" placeholder="Enter Country">-->
                                                                <select class="form-control select-style"
                                                                    name="comp_ship_country" id="country_ship"
                                                                    onChange="changeCountry_ship(this);">
                                                                    <option value="">Select Country</option>
                                                                    @foreach($countries as $k=>$country)
                                                                    <option value="{{ $country->id }}" <?php echo
                                                                        @($country->
                                                                        id==$compDetails->comp_ship_country)?
                                                                        "selected":"" ?>>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <!--<input type="text" class="form-control" name="comp_ship_city" id="comp_ship_city" placeholder="Enter City">-->
                                                                <select class="form-control select-style"
                                                                    name="comp_ship_city" id="city_ship">
                                                                    <option value="">Select City</option>
                                                                    @foreach($cities_ship as $k=>$city)
                                                                    <option value="{{ $city->id }}" <?php echo ($city->
                                                                        id==$compDetails->comp_ship_city)? "selected":""
                                                                        ?>>{{ $city->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <!--<input type="text" class="form-control" name="comp_ship_state" id="comp_ship_state" placeholder="Enter State">-->
                                                                <select class="form-control select-style"
                                                                    name="comp_ship_state" id="state_ship"
                                                                    onChange="changeState_ship(this);">
                                                                    <option value="">Select State</option>
                                                                    @foreach($states_ship as $k=>$state)
                                                                    <option value="{{ $state->id }}" <?php echo
                                                                        ($state->id==$compDetails->comp_ship_state)?
                                                                        "selected":"" ?>>{{ $state->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pincode</label>
                                                                <input type="text" class="form-control"
                                                                    name="comp_ship_pin" id="comp_ship_pin"
                                                                    value="{{ isset($compDetails->comp_ship_pin)?$compDetails->comp_ship_pin:""}}"
                                                                    placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-end">
                                            <a href="javascript:void(0);" id="cancel_compDetBtn"
                                                class="btn customer-btn-cancel">Cancel</a>
                                            <button type="submit" id="save_compDetBtn"
                                                class="btn customer-btn-save">Save Changes</button>
                                        </div>
                                    </form>
                                </div>



                                <div class="tab-pane" id="details" role="tabpanel">
                                    <form action="javascript:void(0);" name="frmbusdet" id="frmbusdet" method="post">
                                        @csrf
                                        <div class="message-container"></div>
                                        <div class="form-group-customer customer-additional-form">
                                            <div class="row">
                                                <div class="billing-btn">
                                                    <h5 class="form-title mb-0">Business Details</h5>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group row pt-4">
                                                        <div class="col-lg-12 pt-4">

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="comp_nature" id="business" value="Manufacturing" {{
                                                                    isset($compDetails->comp_nature)?($compDetails->comp_nature
                                                                =='Manufacturing') ? 'checked' : '':"" }} >
                                                                <label class="form-check-label"
                                                                    for="Manufacturing"> Manufacturing
                                                                </label>
                                                            </div>
                                                            
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="comp_nature" id="profession"
                                                                    value="Trading/Reseller" {{
                                                                    isset($compDetails->comp_nature)?($compDetails->comp_nature
                                                                =='Trading/Reseller') ? 'checked' : '':"" }} >
                                                                <label class="form-check-label"
                                                                    for="business">Trading/Reseller</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="comp_nature" id="service" value="service" {{
                                                                    isset($compDetails->comp_nature)?($compDetails->comp_nature
                                                                =='service') ? 'checked' : '':""}} >
                                                                <label class="form-check-label"
                                                                    for="service">Service</label>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Exact Nature of Business <span id="mandatory_fields">*</span></label>
                                                        <input type="text" name="exact_comp_nature"
                                                            id="exact_comp_nature" class="form-control"
                                                            value="{{ isset($compDetails->exact_comp_nature)?$compDetails->exact_comp_nature:""}}"
                                                            placeholder="Nature of Business">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Turn over in Last Year </label>
                                                        <input type="text" name="turnover_last_year"
                                                            id="turnover_last_year" class="form-control"
                                                            value="{{ isset($compDetails->turnover_last_year)?$compDetails->turnover_last_year:""}}"
                                                            placeholder="Turn over">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Start Date of Business <span id="mandatory_fields">*</span></label>
                                                        <input type="date" name="start_date" id="start_date"
                                                            class="form-control"
                                                            value="{{ isset($compDetails->start_date)?$compDetails->start_date:""}}"
                                                            placeholder="DD-MM-YYYY"
                                                            max="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-end">
                                            <a href="javascript:void(0);" id="cancel_busDetBtn"
                                                class="btn customer-btn-cancel">Cancel</a>
                                            <button type="submit" id="save_busDetBtn"
                                                class="btn customer-btn-save">Upload & Save</button>
                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane" id="bank" role="tabpanel">
                                    <form action="javascript:void(0);" name="frmbankdet" id="frmbankdet" method="post">
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
                                                            <label>Bank Name <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="bank_name[]" id=""
                                                                value="{{ $bankData->bank_name }}" class="form-control"
                                                                placeholder="Enter Bank Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Branch <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="bank_branch[]" id=""
                                                                value="{{ $bankData->bank_branch }}"
                                                                class="form-control" placeholder="Enter Branch Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Account Holder Name <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="bank_holder_name[]" id=""
                                                                value="{{ $bankData->bank_holder_name }}"
                                                                class="form-control"
                                                                placeholder="Enter Account Holder Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Account Number <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="ac_no[]" id=""
                                                                value="{{ $bankData->ac_no }}" class="form-control"
                                                                placeholder="Enter Account Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>IFSC <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="ifsc_code[]" id=""
                                                                value="{{ $bankData->ifsc_code }}" class="form-control"
                                                                placeholder="Enter IFSC Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>UPI ID</label>
                                                            <input type="text" name="ac_upid[]" id=""
                                                                value="{{ $bankData->ac_upid }}" class="form-control"
                                                                placeholder="Enter UPI ID">
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
                                                            <label>Bank Name <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="bank_name[]" id=""
                                                                class="form-control" placeholder="Enter Bank Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Branch <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="bank_branch[]" id=""
                                                                class="form-control" placeholder="Enter Branch Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Account Holder Name <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="bank_holder_name[]" id=""
                                                                class="form-control"
                                                                placeholder="Enter Account Holder Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Account Number <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="ac_no[]" id="" class="form-control"
                                                                placeholder="Enter Account Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>IFSC <span id="mandatory_fields">*</span></label>
                                                            <input type="text" required name="ifsc_code[]" id=""
                                                                class="form-control" placeholder="Enter IFSC Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>UPI ID </label>
                                                            <input type="text" name="ac_upid[]" id=""
                                                                class="form-control" placeholder="Enter UPI ID">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another
                                                Bank Accounts</a>
                                        </div>
                                        <div class="add-customer-btns text-end">
                                            <a href="javascript:void(0);" id="cancel_bankDetBtn"
                                                class="btn customer-btn-cancel">Cancel</a>
                                            <button type="submit" id="save_bankDetBtn"
                                                class="btn customer-btn-save">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="attachments" role="tabpanel">
                                    <form action="javascript:void(0);" name="frmattadet" id="frmattadet" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" id="gstdocstate"
                                            value="{{isset($compDetails->inc_certificate)?$compDetails->inc_certificate:""}}">
                                        @csrf
                                        <div class="message-container"></div>
                                        <div class="row">
                                            <h5 class="text-muted pb-3">Statutory Details</h5>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Upload Incorporation Certificate</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your files here
                                                            or<span class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="inc_certificate" id="inc_certificate">
                                                        <div id="frames1"></div>
                                                    </div>
                                                    @if(@$compDetails->inc_certificate !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->inc_certificate) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Proprietor/ Company Pan Card</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your files here
                                                            or<span class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="pan_doc" id="pan_doc">
                                                        <div id="frames2"></div>
                                                    </div>
                                                    @if(@$compDetails->pan_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->pan_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Upload Company GST Certificate</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="gst_doc" id="gst_doc">
                                                        <div id="frames3"></div>
                                                    </div>
                                                    @if(@$compDetails->gst_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->gst_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Trade License / Shop & Establishment</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="trade_doc" id="trade_doc">
                                                        <div id="frames4"></div>
                                                    </div>
                                                    @if(@$compDetails->trade_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->trade_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>PF & ESI Certificate</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="pf_doc" id="pf_doc">
                                                        <div id="frames5"></div>
                                                    </div>
                                                    @if(@$compDetails->pf_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->pf_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>P Tax Certificate</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="ptex_doc" id="ptex_doc">
                                                        <div id="frames6"></div>
                                                    </div>
                                                    @if(@$compDetails->ptex_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->ptex_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h5 class="text-muted pb-3">Proprietor/Partner/Directors Details</h5>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>First Director’s Aadhar Card </label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your files here
                                                            or<span class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="first_diraadh_doc"
                                                            id="first_diraadh_doc">
                                                        <div id="frames7"></div>
                                                    </div>
                                                    @if(@$compDetails->first_diraadh_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->first_diraadh_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>First Director’s Pan Card</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your files here
                                                            or<span class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="firstpan_doc" id="firstpan_doc">
                                                        <div id="frames8"></div>
                                                    </div>
                                                    @if(@$compDetails->firstpan_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->firstpan_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>First Director’s Photo</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="first_dirphoto_doc"
                                                            id="first_dirphoto_doc">
                                                        <div id="frames9"></div>
                                                    </div>
                                                    @if(@$compDetails->first_dirphoto_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->first_dirphoto_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Second Director’s Aadhar Card </label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="second_aadha_doc"
                                                            id="second_aadha_doc">
                                                        <div id="frames10"></div>
                                                    </div>
                                                    @if(@$compDetails->second_aadha_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->second_aadha_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Second Director’s Pan Card</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="second_pan_doc" id="second_pan_doc">
                                                        <div id="frames11"></div>
                                                    </div>
                                                    @if(@$compDetails->second_pan_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->second_pan_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Second Director’s Photo</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="second_dirphoto_doc"
                                                            id="second_dirphoto_doc">
                                                        <div id="frames12"></div>
                                                    </div>
                                                    @if(@$compDetails->second_dirphoto_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->second_dirphoto_doc) }}">Download</a>
                                                    </div>
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
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="other_logo_doc" id="other_logo_doc">
                                                        <div id="frames13"></div>
                                                    </div>
                                                    @if(@$compDetails->other_logo_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->other_logo_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Upload Signeture</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="signature_doc" id="signature_doc">
                                                        <div id="frames14"></div>
                                                    </div>
                                                    @if(@$compDetails->signature_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->signature_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 mb-3">
                                                <div class="form-group service-bg mb-0 pb-0">
                                                    <label>Upload Company Stamp</label>
                                                    <div class="form-group service-upload mb-0">
                                                        <span><img
                                                                src="{{asset('public/assets/img/icons/drop-icon.svg')}}"
                                                                alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your file here or<span
                                                                class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                        <input type="file" name="stamp_doc" id="stamp_doc">
                                                        <div id="frames15"></div>
                                                    </div>
                                                    @if(@$compDetails->stamp_doc !="")
                                                    <div class="downloadFile"><a target="_blank"
                                                            href="{{ asset('/public/uploads/company-files/'.$compDetails->stamp_doc) }}">Download</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tacbox">
                                            <input id="checkbox" name="checkbox" type="checkbox" />
                                            <label for="checkbox"> I agree to these <a href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#terms_modal">Terms and
                                                    Conditions</a>.</label>
                                        </div>
                                        <div class="message-container"></div>
                                        <div class="add-customer-btns text-end">
                                            <a href="javascript:void(0);" id="cancel_attaBtn"
                                                class="btn customer-btn-cancel">Cancel</a>
                                            <button type="submit" id="save_attaBtn"
                                                onclick="if(!this.form.checkbox.checked){alert('You must agree to Terms and Conditions.');return false}"
                                                class="btn customer-btn-save">Upload & Save</button>
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


<div class="modal custom-modal fade" id="terms_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Terms and Conditions</h3>
                    <p>The user agrees to use our accounting software service, providing accurate information,
                        maintaining login confidentiality, and using it for lawful purposes only.
                        The company reserves the right to suspend or terminate accounts for any violation.
                        The software is provided 'as is' and we disclaim warranties regarding its performance and
                        suitability for specific needs</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        < <div class="col-12 text-end">
                            <button type="submit" data-bs-dismiss="modal"
                                class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('jsscript')
<script type="text/javascript">
    $(document).ready(function(){
    $('#profile-image-uploader').change(function(){
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#name-preview').text($('#profile-image-uploader')[0].files[0].name);
                
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#image-preview').attr('src', '');
        }
    }
});
</script>
<script>
    let branchCount = 1; // Initialize branch count

function addBillingAddress(button) {
    // Clone the billing address section
    const billingAddressClone = document.querySelector('.form-group-item .col-md-6:first-child').cloneNode(true);

    // Clear the input fields in the cloned section
    const inputFields = billingAddressClone.querySelectorAll('input');
    inputFields.forEach(input => {
        input.value = '';
    });

    // Change the title to "Branch Address"
    const titleElement = billingAddressClone.querySelector('.form-title');
    titleElement.textContent = `Branch Address ${branchCount}`;

    // Change the button text to "Delete this Branch" and add the deleteBranch function
    const deleteButton = billingAddressClone.querySelector('.btn-primary');
    deleteButton.textContent = 'Delete this Branch';
    deleteButton.onclick = function () {
        deleteBranch(this);
    };

    // Insert the cloned billing address section after the shipping address section
    const shippingAddressSection = document.querySelector('.form-group-item .col-md-6:last-child');
    shippingAddressSection.parentNode.insertBefore(billingAddressClone, shippingAddressSection.nextSibling);

    // Increment the branch count
    branchCount++;
}

function deleteBranch(button) {
    // Find the parent element of the button (the cloned billing address section) and remove it
    const branchSection = button.closest('.col-md-6');
    branchSection.parentNode.removeChild(branchSection);
}




</script>



@endsection