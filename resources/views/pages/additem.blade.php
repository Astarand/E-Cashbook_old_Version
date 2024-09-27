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
                <h5>Add Product/Service</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
					<form action="javascript:void(0);" method="post" name="addItemFrm" id="addItemFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="itemId" value="">
                        @csrf
                        <div class="form-group-item">
                            <h5 class="form-title">Basic Details</h5>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Choose Type <span class="text-danger"> *</span></label>
                                        <div class="align-center">
                                            <div class="form-control me-3">
                                                <label class="custom_radio me-3 mb-0">
                                                    <input type="radio" name="item_type" value="manufacturing"><span class="checkmark"></span> Manufacturing
                                                </label>
                                            </div>
                                            <div class="form-control me-3">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="item_type" value="reseller"><span class="checkmark"></span> Trading/Reseller
                                                </label>
                                            </div>
                                            <div class="form-control me-3">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="item_type" value="service"><span class="checkmark"></span> Service
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Item/ Product Name <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="item_name"  id="item_name" placeholder="Enter Item Name">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unit" style="width:100%; padding: 8px 15px; margin-top:28px;">Select Units</button>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12" id="sac_div">
                                    <div class="form-group add-products" >
                                        <label>SAC Code<span class="text-danger"> *</span></label>
                                        <input type="text" name="sac_code" id="sac_code" class="form-control" placeholder="Enter SAC Code">
                                        <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                        Search SAC
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" id="hsn_div">
                                    <div class="form-group add-products">
                                        <label>HSN Code<span class="text-danger"> *</span></label>
                                        <input type="text" required name="hsn_code" id="hsn_code" class="form-control" placeholder="Enter HSN Code">
                                        <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                        Search HSN
                                        </button>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Opening Stock / Balance</label>
                                        <input type="text" class="form-control" name="opening_stock_bal"  id="opening_stock_bal" placeholder="Enter Opening Stock / Balance">
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
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="manufacturing_stock">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <h6>Opening Stocks</h6>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="raw" value="raw" onchange="toggleInputField('raw')" style="margin-right: 5px;"><span class="checkmark"></span> Raw Materials
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="wip"  value="wip" onchange="toggleInputField('wip')" style="margin-right: 5px;"><span class="checkmark"></span> Work in Progress (WIP)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="finished-goods"  value="finished-goods" onchange="toggleInputField('finished-goods')" style="margin-right: 5px;"><span class="checkmark"></span> Finished Goods
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="merchandise" value="merchandise" onchange="toggleInputField('merchandise')" style="margin-right: 5px;"><span class="checkmark"></span> Merchandise Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="supplies"  value="supplies" onchange="toggleInputField('supplies')" style="margin-right: 5px;"><span class="checkmark"></span> Supplies
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="spare" value="spare" onchange="toggleInputField('spare')" style="margin-right: 5px;"><span class="checkmark"></span> Spare Parts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" id="checkBoxContainer1" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="consignment" value="consignment" onchange="toggleInputField('consignment')" style="margin-right: 5px;"><span class="checkmark"></span> Consignment Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <button type="button" class="btn btn-primary" id="otherId1" data-bs-toggle="modal" data-bs-target="#other-open-stock1" data-row-id="1" style="width:100%; padding: 8px 15px; " >Others</button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 raw-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Raw Material Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter Raw Material Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 wip-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>WIP Amout</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter WIP Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 finished-goods-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Finished Goods Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter Finished Goods Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 merchandise-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Merchandise Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter Merchandise Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 supplies-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Supplies Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter supplies Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 spare-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Spare Parts Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter spare Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 consignment-input"  id="textBoxContainer1" style="display: none;">
                                                                        <div class="form-group">    
                                                                            <label>Consignment Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]"  placeholder="Enter Consignment Inventory Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    
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
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="registered-purchase" value="registered-purchase" onchange="toggleInputField('registered-purchase')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Registered Purchase
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="unregistered-purchase" value="unregistered-purchase" onchange="toggleInputField('unregistered-purchase')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Unregistered Purchase
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="factory-expenses" value="factory-expenses" onchange="toggleInputField('factory-expenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Factory Expenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="marketing-expenses" value="marketing-expenses" onchange="toggleInputField('marketing-expenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Marketing Expenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="packing-charges" value="packing-charges" onchange="toggleInputField('packing-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Packing Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="job-charges" value="job-charges" onchange="toggleInputField('job-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Job Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="freight-charges" value="freight-charges" onchange="toggleInputField('freight-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Freight Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="electricity-expenses" value="electricity-expenses" onchange="toggleInputField('electricity-expenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Electricity Expenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="labour-charges" value="labour-charges" onchange="toggleInputField('labour-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Labour Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="deprecation" value="deprecation" onchange="toggleInputField('deprecation')" style="margin-right: 5px;"><span class="checkmark"></span> Deprecation
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="inventory-purchases" value="inventory-purchases" onchange="toggleInputField('inventory-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Inventory Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="expense-purchases" value="expense-purchases" onchange="toggleInputField('expense-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Expense Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="capital-purchases" value="capital-purchases" onchange="toggleInputField('capital-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Capital Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="services-purchases" value="services-purchases" onchange="toggleInputField('services-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Services Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="subcontractor-purchases" value="subcontractor-purchases" onchange="toggleInputField('subcontractor-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Subcontractor Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="operating-lease-payments" value="operating-lease-payments" onchange="toggleInputField('operating-lease-payments')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Operating Lease Payments
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="utilities-overheads" value="utilities-overheads" onchange="toggleInputField('utilities-overheads')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Utilities and Overheads
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="travel-entertainment" value="travel-entertainment" onchange="toggleInputField('travel-entertainment')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Travel and Entertainment
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="software-licenses" value="software-licenses" onchange="toggleInputField('software-licenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Software and Licenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" id="checkBoxContainer2" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="insurance-premiums" value="insurance-premiums" onchange="toggleInputField('insurance-premiums')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Insurance Premiums
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex; ">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock2" data-row-id="2" style="width:100%; padding: 8px 15px; " >Others</button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 registered-purchase-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Registered Purchase Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Registered Purchase Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 unregistered-purchase-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Unregistered Purchase Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Unregistered Purchase Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 factory-expenses-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Factory Expenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Factory Expenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 marketing-expenses-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Marketing Expenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Marketing Expenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 packing-charges-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Packing Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Packing Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 job-charges-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Job Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Job Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 freight-charges-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Freight Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Freight Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 electricity-expenses-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Electricity Expenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Electricity Expenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 labour-charges-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Labour Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Labour Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 deprecation-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Deprecation Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Deprecation Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 inventory-purchases-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Inventory Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Inventory Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 expense-purchases-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Expense Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Expense Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 capital-purchases-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Capital Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Capital Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 services-purchases-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Services Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Services Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 subcontractor-purchases-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Subcontractor Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Subcontractor Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 operating-lease-payments-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Operating Lease Payments Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Operating Lease Payments Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 utilities-overheads-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Utilities and Overheads Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Utilities and Overheads Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 travel-entertainment-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Travel and Entertainment Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Travel and Entertainment Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 software-licenses-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Software and Licenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Software and Licenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 insurance-premiums-input" id="textBoxContainer2" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Insurance Premiums Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]"  placeholder="Enter Insurance Premiums Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
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
                                                                <!-- Raw Materials -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="raw-materials" value="raw-materials" onchange="toggleInputField('raw-materials')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Raw Materials
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Work-in-Progress (WIP) -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="wip2" value="wip2" onchange="toggleInputField('wip2')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Work-in-Progress (WIP)
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Finished Goods -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="finished-goods2" value="finished-goods2" onchange="toggleInputField('finished-goods2')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Finished Goods
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Obsolete or Slow-Moving Stock -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center; font-size:13px;">
                                                                            <input type="checkbox" name="closing_stock[]" id="obsolete-stock"  value="obsolete-stock" onchange="toggleInputField('obsolete-stock')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Obsolete or Slow-Moving Stock
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Perishable Goods -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="perishable-goods" value="perishable-goods" onchange="toggleInputField('perishable-goods')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Perishable Goods
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Valuation Adjustments -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="valuation-adjustments" value="valuation-adjustments" onchange="toggleInputField('valuation-adjustments')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Valuation Adjustments
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Consignment Stock -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="consignment-stock" value="consignment-stock" onchange="toggleInputField('consignment-stock')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Consignment Stock
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Restricted Stock -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" id="checkBoxContainer3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="restricted-stock" value="restricted-stock" onchange="toggleInputField('restricted-stock')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Restricted Stock
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex; ">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock3" data-row-id="3" style="width:100%; padding: 8px 15px; " >Others</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- Raw Materials Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 raw-materials-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Raw Materials Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Raw Materials Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Work-in-Progress (WIP) Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 wip2-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Work-in-Progress (WIP) Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter WIP Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Finished Goods Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 finished-goods2-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Finished Goods Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Finished Goods Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 obsolete-stock-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Obsolete or Slow-Moving Stock Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Obsolete or Slow-Moving Stock Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Perishable Goods Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 perishable-goods-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Perishable Goods Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Perishable Goods Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Valuation Adjustments Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 valuation-adjustments-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Valuation Adjustments Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Valuation Adjustments Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Consignment Stock Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 consignment-stock-input" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Consignment Stock Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Consignment Stock Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Restricted Stock Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 restricted-stock-input" id="textBoxContainer3" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Restricted Stock Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" placeholder="Enter Restricted Stock Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>
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
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="raw1" value="raw1" onchange="toggleInputField('raw1')" style="margin-right: 5px;"><span class="checkmark"></span> Raw Materials
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="wip1" value="wip1" onchange="toggleInputField('wip1')" style="margin-right: 5px;"><span class="checkmark"></span> Work in Progress (WIP)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="finished-goods1" value="finished-goods1" onchange="toggleInputField('finished-goods1')" style="margin-right: 5px;"><span class="checkmark"></span> Finished Goods
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="merchandise1" value="merchandise1" onchange="toggleInputField('merchandise1')" style="margin-right: 5px;"><span class="checkmark"></span> Merchandise Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="supplies1" value="supplies1" onchange="toggleInputField('supplies1')" style="margin-right: 5px;"><span class="checkmark"></span> Supplies
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="spare1" value="spare1" onchange="toggleInputField('spare1')" style="margin-right: 5px;"><span class="checkmark"></span> Spare Parts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" id="checkBoxContainer4" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="consignment1" value="consignment1" onchange="toggleInputField('consignment1')" style="margin-right: 5px;"><span class="checkmark"></span> Consignment Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock4" data-row-id="4" style="width:100%; padding: 8px 15px; " >Others</button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 raw1-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Raw Material Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter Raw Material Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 wip1-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>WIP Amout</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter WIP Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 finished-goods1-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Finished Goods Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter Finished Goods Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 merchandise1-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Merchandise Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter Merchandise Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 supplies1-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Supplies Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter supplies Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 spare1-input" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Spare Parts Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter spare Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 consignment1-input" id="textBoxContainer4" style="display: none;">
                                                                        <div class="form-group">    
                                                                            <label>Consignment Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]"  placeholder="Enter Consignment Inventory Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    
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
                                                                        

																		<textarea class="summernote form-control" name="prod_desc" id="prod_desc" placeholder="Write Product Description" rows="7"></textarea>
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
																			<input type="text" class="form-control" name="item_bill_no" id="item_bill_no"  aria-label="Billing no" placeholder="Billing no.">                                                                        
																		</div>
																	</div>																
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-12">
																<div class="form-group">                                                                
																	<label>Actual No. </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="item_actual_no" id="item_actual_no"  aria-label="Actual no" placeholder="Actual no.">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Date</label>
																	<input type="Date" name="item_date" id="item_date"  class="form-control" placeholder="Enter Date">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Selling Price </label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="selling_price" id="selling_price" value="0" aria-label="Selling Price" placeholder="Sales Price">
																			<select class="form-select" name="selling_tax" id="selling_tax" aria-label="Select Action">
																				<option value="without_tax" selected>Without Tax</option>
																				<option value="include_tax">Include Tax</option>
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
																			<input type="text" class="form-control" name="disc_sell" id="disc_sell" value="0" aria-label="Selling Price" placeholder="Discount">
																			<select class="form-select" name="disc_sell_type" id="disc_sell_type" aria-label="Select Action">
																				<option value="percentage" selected>Percentage</option>
																				<option value="amount">Amount</option>
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
																			<input type="text" class="form-control" name="wholesale_price" id="wholesale_price" value="0" aria-label="Selling Price" placeholder="Wholesale Price">
																			<select class="form-select" name="wholesale_tax" id="wholesale_tax" aria-label="Select Action">
																				<option value="without_tax" selected>Without Tax</option>
																				<option value="include_tax">Include Tax</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Minimum Wholesale Quantity</label>
																	<div class="input-group">
																		<input type="text" class="form-control" name="min_wholesale_quantity" id="min_wholesale_quantity" value="0" placeholder="Quantity" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
																			<input type="text" class="form-control" name="purchase_price" id="purchase_price" value="0" aria-label="Selling Price" placeholder="Purchase Price">
																			<select class="form-select" name="purchase_tax" id="purchase_tax" aria-label="Select Action">
																				<option value="without_tax" selected>Without Tax</option>
																				<option value="include_tax">Include Tax</option>
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
																			<option value="IVA">IVA - (21%)</option>
																			<option value="IRPF">IRPF - (-15%)</option>
																			<option value="PDV">PDV - (20%)</option>
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
                                <button type="submit" class="btn btn-primary">Add Item</button>
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
			<input type="hidden" name="prodId" id="prodId" value="">
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
                                <option value="bags">BAGS (Bag)</option>
                                <option value="bottle">BOTTLES (Bottle)</option>
                                <option value="box">BOXS (Box)</option>
                                <option value="can">CANS (Can)</option>
                                <option value="ctn">CARTONS (Ctn)</option>
                                <option value="dzn">DOZENS (Dzn)</option>
                                <option value="grm">GRAMMES (Gm)</option>
                                <option value="kg">KILOGRAMMES (Kg)</option>
                                <option value="ltr">LITER (Ltr)</option>
                                <option value="mtr">METERS (Mtr)</option>
                                <option value="ml">MILILITER (Ml)</option>
                                <option value="nos">NUMBERS (Nos)</option>
                                <option value="pack">PACKS (Pac)</option>
                                <option value="pair">PAIRS (Prs)</option>
                                <option value="pcs">PIECES (Pcs)</option>
                                <option value="qtl">QUINTAL (Qtl)</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Secondary Unit</label>
                        <div class="form-group">
                            <select class="select form-select" name="sec_unit" id="sec_unit">
                                <option value="">None</option>
                                <option value="IVA">IVA - (21%)</option>
                                <option value="IRPF">IRPF - (-15%)</option>
                                <option value="PDV">PDV - (20%)</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12" id="baseUnitOther">
                        <label>Other</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="base_unit_other" id="base_unit_other" >
                        </div>
                    </div>
				</div>
            </div>
            <div class="modal-footer">
                
                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                
            </div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="other-open-stock1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" name="stockOtherFrm1" id="stockOtherFrm1">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Open Stock Name</label>
                            <input type="text" class="form-control" id="openStockName1" name="" placeholder="Enter Open Stock Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Enter Stock Amount</label>
                            <input type="text" class="form-control" id="stockAmount1"  name="" placeholder="Enter Stock Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveModalData('1')">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="other-open-stock2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" name="stockOtherFrm2" id="stockOtherFrm2">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Open Stock Name</label>
                            <input type="text" class="form-control" id="openStockName2" name="" placeholder="Enter Open Stock Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Enter Stock Amount</label>
                            <input type="text" class="form-control" id="stockAmount2" name="" placeholder="Enter Stock Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveModalData('2')">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="other-open-stock3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" name="stockOtherFrm3" id="stockOtherFrm3">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Open Stock Name</label>
                            <input type="text" class="form-control" id="openStockName3" name="" placeholder="Enter Open Stock Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Enter Stock Amount</label>
                            <input type="text" class="form-control" id="stockAmount3" name="" placeholder="Enter Stock Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveModalData('3')">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="other-open-stock4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" name="stockOtherFrm4" id="stockOtherFrm4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Open Stock Name</label>
                            <input type="text" class="form-control" id="openStockName4" name="" placeholder="Enter Open Stock Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Enter Stock Amount</label>
                            <input type="text" class="form-control" id="stockAmount4" name="" placeholder="Enter Stock Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveModalData('4')">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$('#stockAmount1,#stockAmount2,#stockAmount3,#stockAmount4').on('input', function (event) { 
        this.value = this.value.replace(/[^0-9]/g, '');
}); 


	
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
	var rowId = val;
	
	var stockName = $("#openStockName"+val).val();
	stockName = stockName.replace(" ","-");
	var stockAmt = $("#stockAmount"+val).val();
	var className = stockName+'-input';
	if(stockName ==""){
		alert("Enter stock name");
		return false;
	}else if(stockAmt ==""){
		alert("Enter stock amount");
		return false;
	}else if(isNaN(stockAmt)){
		alert("Invalid stock amount");
		return false;
	}else{	
		var chkBoxName = "";
		var txtBoxName = "";
		if(val =='1'){
			chkBoxName = "opening_stock[]";
			txtBoxName = "opening_stock_amt[]";
		}else if(val =='2'){
			chkBoxName = "purchase_stock[]";
			txtBoxName = "purchase_stock_amt[]";
		}else if(val =='3'){
			chkBoxName = "closing_stock[]";
			txtBoxName = "closing_stock_amt[]";
		}else if(val =='4'){
			chkBoxName = "reseller_stock[]";
			txtBoxName = "reseller_stock_amt[]";
		}

		$("#checkBoxContainer"+val).last().after(generateCheckbox(stockName,stockAmt,className,chkBoxName));
		$("#textBoxContainer"+val).last().after(generateTextbox(stockName,stockAmt,className,txtBoxName));
		
		$("#openStockName"+val).val('');
		$("#stockAmount"+val).val('');
		$('#other-open-stock'+val).modal('hide');
	}
	
}
function generateCheckbox(stockName,stockAmt,className,chkBoxName){
	var className2 = `'${className}'`;
	return '<div class="col-lg-3 col-md-6 col-sm-12 mt-3 '+className+'"  style="display: flex;">'+
				'<div class="form-control" style="width: 100%;">'+
					'<label class="custom_checkbox mb-0" style="display: flex; align-items: center;">'+
						'<input type="checkbox" checked name="'+chkBoxName+'" id="'+stockName+'" value="'+stockName+'" onchange="toggleInputField('+stockName+')" style="margin-right: 5px;"><span class="checkmark"></span>'+ stockName+
					'</label>'+
				'</div>'+
				'<div class="input-group-prepend">' +
				'<a class="" onClick="delData(this,'+ className2 +')">' +
                '<i class="fa fa-remove" style="font-size:30px;color:red;margin-top:5px;"></i></a> </div>' +
			'</div>';
}
function generateTextbox(stockName,stockAmt,className,txtBoxName){
	return '<div class="col-lg-3 col-md-6 col-sm-12 mt-3 '+className+'"  style="display: block;">'+
			'<div class="form-group">'+
				'<label>'+stockName+' Amount</label>'+
				'<input type="text" class="form-control" name="'+txtBoxName+'" value="'+stockAmt+'"  placeholder="Enter Amount" style="width: 100%;">'+
			'</div>'+
			'</div>';
}
function delData(el,className2){
	var rowID = className2;
	//$(el).parents("."+rowID).remove();
	//$(el).parent("."+rowID).remove();
	document.querySelectorAll("."+rowID).forEach(e => e.remove());
	
}
function saveModalData_old() {
    // Get values from modal inputs
    var openStockName = document.getElementById('openStockName').value;
    var stockAmount = document.getElementById('stockAmount').value;

    // Get the data-row-id from the button that triggered the modal
    var rowId = $('#other-open-stock').data('row-id');

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