@extends('layouts.default')
<style>
    .hidden {
        display: none;
    }
</style>

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>View Product/Service</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
					<form action="javascript:void(0);" method="post" name="addItemFrm" id="addItemFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="itemId" value="{{ $item->id }}">
                        @csrf
                        <div class="form-group-item">
                            <h5 class="form-title">Basic Details</h5>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Choose Type<span class="text-danger"> *</span></label>
                                        <div class="align-center">
                                            <div class="form-control me-3">
                                                <label class="custom_radio me-3 mb-0">
                                                    <input type="radio" name="item_type" value="manufacturing" <?php echo ($item->item_type=='manufacturing')? "checked":"" ?>><span class="checkmark"></span> Manufacturing
                                                </label>
                                            </div>
                                            <div class="form-control me-3">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="item_type" value="reseller" <?php echo ($item->item_type=='reseller')? "checked":"" ?>><span class="checkmark"></span> Trading/Reseller
                                                </label>
                                            </div>
                                            <div class="form-control me-3">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="item_type" value="service" <?php echo ($item->item_type=='service')? "checked":"" ?>><span class="checkmark"></span> Service
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Item/ Product Name <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="item_name"  id="item_name" value="{{ $item->item_name}}" placeholder="Enter Item Name">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unit" style="width:100%; padding: 8px 15px; margin-top:28px;">Select Units</button>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12" id="sac_div">
                                    <div class="form-group add-products" >
                                        <label>SAC Code<span class="text-danger"> *</span></label>
                                        <input type="text" name="sac_code" id="sac_code" value="{{ $item->sac_code}}" class="form-control" placeholder="Enter SAC Code">
                                        <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                        Search SAC
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" id="hsn_div">
                                    <div class="form-group add-products">
                                        <label>HSN Code<span class="text-danger"> *</span></label>
                                        <input type="text" name="hsn_code" id="hsn_code" value="{{ $item->hsn_code}}" class="form-control" placeholder="Enter HSN Code">
                                        <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                        Search HSN
                                        </button>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Opening Stock / Balance</label>
                                        <input type="text" class="form-control" name="opening_stock_bal" id="opening_stock_bal" value="{{ $item->opening_stock_bal}}" placeholder="Enter Opening Stock / Balance">
                                    </div>
                                </div>
                                
                                <div class="row" id="manufacturing_content">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-bordered">
                                                    <li class="nav-item">
                                                        <a href="#manufacturing_stock" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <strong>Stock</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-details" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                                            <strong>Product Details</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-pricing" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                            <strong>Pricing</strong>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
												<?php 
													$openingStock = ($item->opening_stock!="")?json_decode($item->opening_stock):[];
													$openingStockAmt = ($item->opening_stock_amt!="")?json_decode($item->opening_stock_amt):[];
													$purchaseStock = ($item->purchase_stock!="")?json_decode($item->purchase_stock):[];
													$purchaseStockAmt = ($item->purchase_stock_amt!="")?json_decode($item->purchase_stock_amt):[];
													$closingStock = ($item->closing_stock!="")?json_decode($item->closing_stock):[];
													$closingStockAmt = ($item->closing_stock_amt!="")?json_decode($item->closing_stock_amt):[];
													$resellerStock = ($item->reseller_stock!="")?json_decode($item->reseller_stock):[];
													$resellerStockAmt = ($item->reseller_stock_amt!="")?json_decode($item->reseller_stock_amt):[];													
										
													$openingStockAmt = json_decode(json_encode($openingStockAmt), true);
													$purchaseStockAmt = json_decode(json_encode($purchaseStockAmt), true);
													$closingStockAmt = json_decode(json_encode($closingStockAmt), true);
													$resellerStockAmt = json_decode(json_encode($resellerStockAmt), true);
													//echo "<pre>";print_r($purchaseStockAmt );exit;
													$openArray = array(
														"raw"=>"Raw Materials",
														"wip"=>"Work in Progress (WIP)",
														"finished-goods"=>"Finished Goods",
														"merchandise"=>"Merchandise Inventory",
														"supplies"=>"Supplies",
														"spare"=>"Spare Parts",
														"consignment"=>"Consignment Inventory",
													);
													//echo "<pre>";print_r($openingStock );exit;
													$temp1 = array();								
													foreach($openingStock as $k=>$v){
														if (!array_key_exists($v, $openArray)) {
															$temp1[$v] = $v;
														}
													}
													$openArray = array_merge($openArray,$temp1);
													
													$purchaseArray = array(
																"registered-purchase"=>"Registered Purchase",
																"unregistered-purchase"=>"Unregistered Purchase",
																"factory-expenses"=>"Factory Expenses",
																"marketing-expenses"=>"Marketing Expenses",
																"packing-charges"=>"Packing Charges",
																"job-charges"=>"Job Charges",
																"freight-charges"=>"Freight Charges",
																"electricity-expenses"=>"Electricity Expenses",
																"labour-charges"=>"Labour Charges",
																"deprecation"=>"Deprecation",
																"inventory-purchases"=>"Inventory Purchases",
																"expense-purchases"=>"Expense Purchases",
																"capital-purchases"=>"Capital Purchases",
																"services-purchases"=>"Services Purchases",
																"subcontractor-purchases"=>"Subcontractor Purchases",
																"operating-lease-payments"=>"Operating Lease Payments",
																"utilities-overheads"=>"Utilities and Overheads",
																"travel-entertainment"=>"Travel and Entertainment",
																"software-licenses"=>"Software and Licenses",
																"insurance-premiums"=>"Insurance Premiums"
															);
														$temp2 = array();								
														foreach($purchaseStock as $k=>$v){
															if (!array_key_exists($v, $purchaseArray)) {
																$temp2[$v] = $v;
															}
														}
														$purchaseArray = array_merge($purchaseArray,$temp2);
														
														$closeArray = array(
															"raw-materials"=>"Raw Materials",
															"wip2"=>"Work-in-Progress (WIP)",
															"finished-goods2"=>"Finished Goods",
															"obsolete-stock"=>"Obsolete or Slow-Moving Stock",
															"perishable-goods"=>"Perishable Goods",
															"valuation-adjustments"=>"Valuation Adjustments",
															"consignment-stock"=>"Consignment Stock",
															"restricted-stock"=>"Restricted Stock "
															);
														$temp3 = array();								
														foreach($closingStock as $k=>$v){
															if (!array_key_exists($v, $closeArray)) {
																$temp3[$v] = $v;
															}
														}
														$closeArray = array_merge($closeArray,$temp3);
															
														$tradingArray = array(
															"raw1"=>"Raw Materials",
															"wip1"=>"Work in Progress (WIP)",
															"finished-goods1"=>"Finished Goods",
															"merchandise1"=>"Merchandise Inventory",
															"supplies1"=>"Supplies",
															"spare1"=>"Spare Parts",
															"consignment1"=>"Consignment Inventory"
															);
														$temp4 = array();								
														foreach($resellerStock as $k=>$v){
															if (!array_key_exists($v, $tradingArray)) {
																$temp4[$v] = $v;
															}
														}
														$tradingArray = array_merge($tradingArray,$temp4);
												?>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="manufacturing_stock">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <h6>Opening Stocks</h6>
                                                            <div class="row">
                                                                
																<?php if($openArray !=""){
																		foreach($openArray as $key=>$val){	
																?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
																		<div class="form-control" style="width: 100%;">
																			<label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
																				<input type="checkbox" name="opening_stock[]" id="{{ $key }}" value="{{ $key }}" <?php if (in_array($key, $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('<?php echo $key; ?>')" style="margin-right: 5px;"><span class="checkmark"></span> {{ str_replace("-"," ",$val) }}
																			</label>
																		</div>
																	</div>
																<?php } } ?>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    
                                                                </div>
                                                                <div class="row">
                                                                    
																	<?php if($openArray !=""){
																		foreach($openArray as $key=>$val){	
																	?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3 {{$key}}-input <?php echo (array_key_exists($key,$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">    
                                                                            <label>{{ str_replace("-"," ",$val)." Amount"}}</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists($key,$openingStockAmt))?$openingStockAmt[$key]:"";?>"  placeholder="Enter Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
																	<?php } } ?>
                                                                    
                                                                </div>
                                                                <div class="row" id="staticRow1">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="1" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-4">
                                                            <h6>Purchase</h6>
                                                            <div class="row">
                                                                
																<?php if($purchaseArray !=""){
																		foreach($purchaseArray as $key=>$val){	
																?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
																		<div class="form-control" style="width: 100%;">
																			<label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
																				<input type="checkbox" name="purchase_stock[]" id="{{ $key }}" value="{{ $key }}" <?php if (in_array($key, $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('<?php echo $key; ?>')" style="margin-right: 5px;"><span class="checkmark"></span> {{ str_replace("-"," ",$val) }}
																			</label>
																		</div>
																	</div>
																<?php } } ?>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex; ">
                                                                    
                                                                </div>
                                                                <div class="row">
                                                                    
																	<?php if($purchaseArray !=""){
																		foreach($purchaseArray as $key=>$val){	
																	?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3 {{$key}}-input <?php echo (array_key_exists($key,$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">    
                                                                            <label>{{ str_replace("-"," ",$val)." Amount"}}</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists($key,$purchaseStockAmt))?$purchaseStockAmt[$key]:"";?>"  placeholder="Enter Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
																	<?php } } ?>
                                                                </div>
                                                                <div class="row" id="staticRow2">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="2" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-4">
                                                            <h6>Closing Stock</h6>
                                                            <div class="row">
                                                                
																<?php if($closeArray !=""){
																		foreach($closeArray as $key=>$val){	
																?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
																		<div class="form-control" style="width: 100%;">
																			<label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
																				<input type="checkbox" name="closing_stock[]" id="{{ $key }}" value="{{ $key }}" <?php if (in_array($key, $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('<?php echo $key; ?>')" style="margin-right: 5px;"><span class="checkmark"></span> {{ str_replace("-"," ",$val) }}
																			</label>
																		</div>
																	</div>
																<?php } } ?>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex; ">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
																<?php if($closeArray !=""){
																		foreach($closeArray as $key=>$val){	
																	?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3 {{$key}}-input <?php echo (array_key_exists($key,$closingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">    
                                                                            <label>{{ str_replace("-"," ",$val)." Amount"}}</label>
                                                                            <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists($key,$closingStockAmt))?$closingStockAmt[$key]:"";?>"  placeholder="Enter Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
																	<?php } } ?>
                                                                <div class="row" id="staticRow3">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="3" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
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
                                </div>

                                <div class="row" id="trading_content">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-bordered">
                                                    <li class="nav-item">
                                                        <a href="#trading_stock" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <strong>Stock</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-details" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                                            <strong>Product Details</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-pricing" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                            <strong>Pricing</strong>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="trading_stock">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <h6>Opening Stocks/Trading/Reseller</h6>
                                                            <div class="row">
                                                                
																<?php if($tradingArray !=""){
																		foreach($tradingArray as $key=>$val){	
																?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
																		<div class="form-control" style="width: 100%;">
																			<label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
																				<input type="checkbox" name="reseller_stock[]" id="{{ $key }}" value="{{ $key }}" <?php if (in_array($key, $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('<?php echo $key; ?>')" style="margin-right: 5px;"><span class="checkmark"></span> {{ str_replace("-"," ",$val) }}
																			</label>
																		</div>
																	</div>
																<?php } } ?>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                
                                                                </div>
                                                                <div class="row">
                                                                    
																	<?php if($tradingArray !=""){
																		foreach($tradingArray as $key=>$val){	
																	?>
																	<div class="col-lg-3 col-md-6 col-sm-12 mt-3 {{$key}}-input <?php echo (array_key_exists($key,$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">    
                                                                            <label>{{ str_replace("-"," ",$val)." Amount"}}</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists($key,$resellerStockAmt))?$resellerStockAmt[$key]:"";?>"  placeholder="Enter Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
																	<?php } } ?>
                                                                    
                                                                </div>
                                                                <div class="row" id="staticRow4">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="4" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
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
                                </div>

                                <div class="row" id="service_content">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-bordered">
                                                    <li class="nav-item">
                                                        <a href="#service-details" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <strong>Service Details</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-pricing" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                            <strong>Pricing</strong>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<!--------------->
								<div class="row">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<div class="tab-content">
													<div class="tab-pane" id="service-details">
														<div class="form-group-item">
															<div class="row">
																<div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
																	<div class="form-group" id="summernote_container">
																		<label id="description_text" class="form-control-label">Service Descriptions</label>
																		<textarea class="summernote form-control" name="prod_desc" id="prod_desc" placeholder="Write Product Description" rows="7">{{ $item->prod_desc}}</textarea>
																	</div>
																</div>
																<div class="col-xl-6 col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label id="service_text">Service Image</label>
																		<div class="form-group service-upload mb-0">
																			<span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
																			<h6 class="drop-browse align-center">
																				Drop your files here or<span class="text-primary ms-1">browse</span>
																			</h6>
																			<p class="text-muted">Maximum size: 50MB</p>
																			<input type="file" name="prod_image[]" multiple id="prod_image" >
																			<div id="frames"></div>
																			
																		</div>
																		@if(@$item->prod_image !="")
																			<?php $arrayOfFiles = explode(',',$item->prod_image); ?>
																			@foreach($arrayOfFiles as $img)
																			  <div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/items-image/'.$img) }}">Download</a></div>
																			@endforeach
																		@endif
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane show" id="service-pricing">
														<div class="row">
															<div class="col-lg-4 col-md-4 col-sm-12">
																<div class="form-group">
																	<label>Billing No. </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="item_bill_no" id="item_bill_no" value="{{ $item->item_bill_no}}"  aria-label="Billing no" placeholder="Billing no.">                                                                        
																		</div>
																	</div>																
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-12">
																<div class="form-group">                                                                
																	<label>Actual No. </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="item_actual_no" id="item_actual_no" value="{{ $item->item_actual_no}}"  aria-label="Actual no" placeholder="Actual no.">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Date</label>
																	<input type="Date" name="item_date" id="item_date" value="{{ $item->item_date}}" class="form-control" placeholder="Enter Date">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Selling Price </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="selling_price" id="selling_price" value="{{ $item->selling_price}}" aria-label="Selling Price" placeholder="Sales Price">
																			<select class="form-select" name="selling_tax" id="selling_tax" aria-label="Select Action">
																				<option value="without_tax" <?php echo ($item->selling_price=='without_tax')? "selected":"" ?>>Without Tax</option>
																				<option value="include_tax" <?php echo ($item->selling_price=='include_tax')? "selected":"" ?>>Include Tax</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Discount on selling Price </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="disc_sell" id="disc_sell" value="{{ $item->disc_sell}}" aria-label="Selling Price" placeholder="Discount">
																			<select class="form-select" name="disc_sell_type" id="disc_sell_type" aria-label="Select Action">
																				<option value="percentage" <?php echo ($item->disc_sell_type=='percentage')? "selected":"" ?>>Percentage</option>
																				<option value="amount" <?php echo ($item->disc_sell_type=='amount')? "selected":"" ?>>Amount</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Wholesale Price</label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="wholesale_price" id="wholesale_price" value="{{ $item->wholesale_price}}" aria-label="Selling Price" placeholder="Wholesale Price">
																			<select class="form-select" name="wholesale_tax" id="wholesale_tax" aria-label="Select Action">
																				<option value="without_tax" <?php echo ($item->wholesale_tax=='without_tax')? "selected":"" ?>>Without Tax</option>
																				<option value="include_tax" <?php echo ($item->wholesale_tax=='include_tax')? "selected":"" ?>>Include Tax</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Minimum Wholesale Quantity</label>
																	<div class="input-group">
																		<input type="text" class="form-control" name="min_wholesale_quantity" id="min_wholesale_quantity" value="{{ $item->min_wholesale_quantity}}" placeholder="Quantity" aria-label="Recipient's username" aria-describedby="basic-addon2">
																		<span class="input-group-text" data-toggle="popover" data-placement="top" data-html="true" data-content="<h5>Popover Title</h5><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</p>">
																			<i class="fa fa-info-circle"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Purchase Price </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="purchase_price" id="purchase_price" value="{{ $item->purchase_price}}" aria-label="Selling Price" placeholder="Purchase Price">
																			<select class="form-select" name="purchase_tax" id="purchase_tax" aria-label="Select Action">
																				<option value="without_tax" <?php echo ($item->purchase_tax=='without_tax')? "selected":"" ?>>Without Tax</option>
																				<option value="include_tax" <?php echo ($item->purchase_tax=='include_tax')? "selected":"" ?>>Include Tax</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															{{-- <div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Tax</label>
																	<div class="form-group">
																		<select class="select form-select" name="item_tax" id="item_tax">
																			<option value="">Select Tax</option>
																			<option value="IVA" <?php echo ($item->item_tax=='IVA')? "selected":"" ?>>IVA - (21%)</option>
																			<option value="IRPF" <?php echo ($item->item_tax=='IRPF')? "selected":"" ?>>IRPF - (-15%)</option>
																			<option value="PDV" <?php echo ($item->item_tax=='PDV')? "selected":"" ?>>PDV - (20%)</option>
																		</select>
																	</div>
																</div>
															</div> --}}
														</div>
													</div>
													
												</div>
								
											</div>
										</div>
									</div>
								</div>
 
                            </div>
                            
                            <div class="message-container"></div>
                            <div id="addItemLoader" class="loader"></div>
                            <div class="add-customer-btns text-end">
                                <a href="{{ url('/items') }}" class="btn customer-btn-cancel">Cancel</a>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
			<form action="javascript:void(0);" method="post" name="baseUnitFrm" id="baseUnitFrm">
			<input type="hidden" name="prodId" id="prodId" value="{{ $item->id }}">
			@csrf
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Base Unit</label>
                        <div class="form-group">
                            <select class="select form-select" name="base_unit" id="base_unit">
                                <option value="">None</option>
                                <option value="bags" <?php echo ($item->base_unit=='bags')? "selected":"" ?>>BAGS (Bag)</option>
                                <option value="bottle" <?php echo ($item->base_unit=='bottle')? "selected":"" ?>>BOTTLES (Bottle)</option>
                                <option value="box" <?php echo ($item->base_unit=='box')? "selected":"" ?>>BOXS (Box)</option>
                                <option value="can" <?php echo ($item->base_unit=='can')? "selected":"" ?>>CANS (Can)</option>
                                <option value="ctn" <?php echo ($item->base_unit=='ctn')? "selected":"" ?>>CARTONS (Ctn)</option>
                                <option value="dzn" <?php echo ($item->base_unit=='dzn')? "selected":"" ?>>DOZENS (Dzn)</option>
                                <option value="grm" <?php echo ($item->base_unit=='grm')? "selected":"" ?>>GRAMMES (Gm)</option>
                                <option value="kg" <?php echo ($item->base_unit=='kg')? "selected":"" ?>>KILOGRAMMES (Kg)</option>
                                <option value="ltr" <?php echo ($item->base_unit=='ltr')? "selected":"" ?>>LITER (Ltr)</option>
                                <option value="mtr" <?php echo ($item->base_unit=='mtr')? "selected":"" ?>>METERS (Mtr)</option>
                                <option value="ml" <?php echo ($item->base_unit=='ml')? "selected":"" ?>>MILILITER (Ml)</option>
                                <option value="nos" <?php echo ($item->base_unit=='nos')? "selected":"" ?>>NUMBERS (Nos)</option>
                                <option value="pack" <?php echo ($item->base_unit=='pack')? "selected":"" ?>>PACKS (Pac)</option>
                                <option value="pair" <?php echo ($item->base_unit=='pair')? "selected":"" ?>>PAIRS (Prs)</option>
                                <option value="pcs" <?php echo ($item->base_unit=='pcs')? "selected":"" ?>>PIECES (Pcs)</option>
                                <option value="qtl" <?php echo ($item->base_unit=='qtl')? "selected":"" ?>>QUINTAL (Qtl)</option>
                                <option value="Other" <?php echo ($item->base_unit=='Other')? "selected":"" ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Secondary Unit</label>
                        <div class="form-group">
                            <select class="select form-select" name="sec_unit" id="sec_unit">
                                <option value="">None</option>
                                <option value="IVA" <?php echo ($item->sec_unit=='IVA')? "selected":"" ?>>IVA - (21%)</option>
								<option value="IRPF" <?php echo ($item->sec_unit=='IRPF')? "selected":"" ?>>IRPF - (-15%)</option>
								<option value="PDV" <?php echo ($item->sec_unit=='PDV')? "selected":"" ?>>PDV - (20%)</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12" id="baseUnitOther">
                        <label>Other</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="base_unit_other" id="base_unit_other" value="{{ $item->base_unit_other }}" >
                        </div>
                    </div>
				</div>
            </div>
            
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="other-open-stock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" name="openingStockOtherFrm" id="openingStockOtherFrm">
				<input type="hidden" name="id" id="itemId" value="{{ $item->id }}">
				<input type="hidden" name="other_rowid" id="other_rowid">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Open Stock Name</label>
                            <input type="text" class="form-control" id="openStockName" name="opening_stockOther[]" value="" placeholder="Enter Open Stock Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Enter Stock Amount</label>
                            <input type="text" class="form-control" id="stockAmount" name="stockAmountOther[]" value="" placeholder="Enter Stock Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
					<div class="message-container"></div>
                    <div id="stockLoader" class="loader"></div>
                    
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

var itemTypeRadios = document.querySelectorAll('input[name="item_type"]');
var sacDiv = document.getElementById('sac_div');
var hsnDiv = document.getElementById('hsn_div');
var manufacturingDiv = document.getElementById('manufacturing_content');
var tradingDiv = document.getElementById('trading_content');
var serviceDiv = document.getElementById('service_content');

manufacturingDiv.style.display = 'none';
tradingDiv.style.display = 'none';
serviceDiv.style.display = 'none';
sacDiv.style.display = 'none';
hsnDiv.style.display = 'Block';

	//When it loaded DOM
	var itemType = "<?php echo $item->item_type ?>"; 
	if (itemType === 'manufacturing') {
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'block';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'none';
		$("#manufacturing_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");

    } else if(itemType === 'reseller') {
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'block';
        serviceDiv.style.display = 'none';
		$("#trading_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");
    } else {
        sacDiv.style.display = 'block';
        hsnDiv.style.display = 'none';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'block';
		$("#service-details").addClass("active");
		$("#service-pricing").removeClass("active");
    }

// Function to handle radio button change event
function handleItemTypeChange() {
    const label = document.getElementById('description_text');
    const label_service = document.getElementById('service_text');
    if (this.value === 'manufacturing') {
        label.textContent = 'Product Descriptions';
        label_service.textContent = 'Product Images';
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'block';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'none';
		$("#manufacturing_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");

    } else if(this.value === 'reseller') {
        label.textContent = 'Trading/Reseller Descriptions';
        label_service.textContent = 'Trading/Reseller Images';
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'block';
        serviceDiv.style.display = 'none';
		$("#trading_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");
    } else {
        label.textContent = 'Service Descriptions';
        label_service.textContent = 'Service Images';
        sacDiv.style.display = 'block';
        hsnDiv.style.display = 'none';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'block';
		$("#service-details").addClass("active");
		$("#service-pricing").removeClass("active");
    }
}

// Attach change event listener to each radio button
itemTypeRadios.forEach(function(radio) {
    radio.addEventListener('change', handleItemTypeChange);
});

});


var count = 1; // Initialize count for incremental IDs

function saveModalData(val) {
    // Get values from modal inputs
    var openStockName = document.getElementById('openStockName').value;
    var stockAmount = document.getElementById('stockAmount').value;

    // Get the data-row-id from the button that triggered the modal
    var rowId = $('#other-open-stock').data('row-id');
	
	//start added for dynamic
	document.getElementById('other_rowid').value = val; //set value in form hidden input
	/*if(val == "manufacturing_stock1")
	{
		document.getElementById('openStockName').value = "<?php echo $item->opening_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->op_stock_oth_amt; ?>"
	}else if(val == "manufacturing_stock2"){
		document.getElementById('openStockName').value = "<?php echo  $item->purchase_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->pu_stock_oth_amt; ?>"
	}
	else if(val == "manufacturing_stock3"){
		document.getElementById('openStockName').value = "<?php echo  $item->closing_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->cl_stock_oth_amt; ?>"
	}
	else if(val == "reseller_stock4"){
		document.getElementById('openStockName').value = "<?php echo $item->reseller_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->re_stock_oth_amt; ?>"
	}*/
	//end added for dynamic

    // Create new elements for the next entry
    var newInputSection = document.createElement('div');
    newInputSection.className = 'col-lg-3 col-md-6 col-sm-12 mt-3 new-input';
    newInputSection.setAttribute('data-row-id', rowId);

    var newLabel = document.createElement('label');
    newLabel.textContent = openStockName;
    newLabel.className = 'newLabel';

    var newAmount = document.createElement('input');
    newAmount.setAttribute('type', 'text');
    newAmount.setAttribute('class', 'form-control newAmount');
    newAmount.setAttribute('placeholder', 'Enter Stock Amount');
    newAmount.setAttribute('style', 'width: 100%;');
    newAmount.value = stockAmount;

    // Append new elements to the form
    var staticRow = document.getElementById('staticRow' + rowId);
    staticRow.innerHTML = ''; // Clear existing content
    newInputSection.appendChild(newLabel);
    newInputSection.appendChild(newAmount);
    staticRow.appendChild(newInputSection);

    // Clear modal inputs
    document.getElementById('openStockName').value = '';
    document.getElementById('stockAmount').value = '';

    // Close the modal
    $('#other-open-stock').modal('hide');
}

function toggleInputField(el){
	var selc = '.'+el+'-input';
	//if ($('input:checkbox[name='+el+']').is(':checked')) {
	if($('#' + el).is(":checked")){
		$(selc).show();
	}else{
		$(selc).hide();
	} 
}


</script>



@endsection