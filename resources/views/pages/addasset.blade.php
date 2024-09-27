@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="content-page-header">
                <h5>Add New Asset Details</h5>
            </div>
        </div>

        <form action="javascript:void(0);" method="post" name="addAssetFrm" id="addAssetFrm" enctype="multipart/form-data">
            <input type="hidden" name="assetId" id="assetId" value="">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h5 class="form-title">Asset Information</h5>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="date" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Asset Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="asset_name" id="asset_name" placeholder="Enter Asset Name">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div id="assetTypeGroup" class="form-group">
                                <label>Asset Type<span class="text-danger">*</span></label>
                                <select id="assetType" name="assetType" id="assetType" class="form-select">
                                    <option value="">Select</option>
                                    <option value="tangible">Tangible Assets</option>
                                    <option value="intangible">Intangible Assets</option>
                                    <option value="current">Current Assets</option>
                                    <option value="longterm">Long-term Investments</option>
                                    <option value="other">Other Asset Types</option>
                                    <option value="custom">Custom Asset Types</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">

                            <!--Tangible Assets-->
                            <div id="tangibleAssetsGroup"  class="form-group">
                                <label>Tangible Assets</label>
                                <select class="form-select" name="tangible_assets" id="tangible_assets">
                                    <option value="">Select</option>
                                    <option value="land">Land</option>
                                    <option value="buildings">Buildings</option>
                                    <option value="machinery">Machinery and Equipment</option>
                                    <option value="vehicles">Vehicles</option>
                                    <option value="furniture">Furniture and Fixtures</option>
                                    <option value="computer">Computer Equipment</option>
                                    <option value="leasehold">Leasehold Improvements</option>
                                </select>
                            </div>

                            <!--Intangible Assets -->
                            <div id="intangibleAssetsGroup" class="form-group">
                                <label>Intangible Assets</label>
                                <select class="form-select" name="tangible_assets" id="tangible_assets">
                                    <option value="">Select</option>
                                    <option value="patents">Patents</option>
                                    <option value="trademarks">Trademarks</option>
                                    <option value="copyrights">Copyrights</option>
                                    <option value="goodwill">Goodwill</option>
                                    <option value="licenses">Licenses</option>
                                    <option value="software">Software</option>
                                </select>
                            </div>

                            <!--Current Assets-->
                            <div id="currentAssetsGroup"  class="form-group">
                                <label>Current Assets</label>
                                <select class="form-select" name="tangible_assets" id="tangible_assets">
                                    <option value="">Select</option>
                                    <option value="cash">Cash and Cash Equivalents</option>
                                    <option value="receivable">Accounts Receivable</option>
                                    <option value="inventory">Inventory</option>
                                    <option value="prepaid">Prepaid Expenses</option>
                                </select>
                            </div>

                            <!--Long-term Investments-->
                            <div id="longtermAssetsGroup"  class="form-group">
                                <label>Long-term Investments</label>
                                <select class="form-select" name="tangible_assets" id="tangible_assets">
                                    <option value="">Select</option>
                                    <option value="bonds">Bonds</option>
                                    <option value="stocks">Stocks</option>
                                    <option value="realEstate">Real Estate</option>
                                </select>
                            </div>

                            <!--Other Asset Types--->
                            <div id="otherAssetsGroup"  class="form-group">
                                <label>Other Asset Types</label>
                                <select class="form-select" name="tangible_assets" id="tangible_assets">
                                    <option value="">Select</option>
                                    <option value="naturalResources">Natural Resources</option>
                                    <option value="wip">Work in Progress (WIP)</option>
                                    <option value="biological">Biological Assets</option>
                                </select>
                            </div>

                            <!--Custom Asset Types-->
                            <div id="customAssetsGroup"  class="form-group">
                                <label>Custom Asset Types</label>
                                <input type="text" name="tangible_assets" id="tangible_assets" class="form-control" placeholder="Enter Custom Asset Types">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group" id="summernote_container">
                                <label class="form-control-label">Asset Description</label>
                                <textarea class="summernote form-control" name="assets_description" id="assets_description"  placeholder="Enter Asset Description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="form-title">Purchase Information</h5>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Purchase Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="purchase_date" id="purchase_date" placeholder="Purchase Date">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Purchase Price(INR)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="purchase_cost" id="purchase_cost" placeholder="Enter Purchase Cost">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Vendor / Shop Name</label>
                                <input type="text" class="form-control" name="shop_name" placeholder="Enter Vendor / Shop Name">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" class="form-control" name="invoice_number" placeholder="Enter Invoice Number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="form-title">Asset Details</h5>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Asset Serial Number</label>
                                <input type="text" class="form-control" name="serial_number" placeholder="Enter Asset Serial Number">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Location For</label>
                                <input type="text" class="form-control" name="location_for" placeholder="Enter Location For">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Department  For</label>
                                <input type="text" class="form-control" name="department_for" placeholder="Enter Department For">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Warranty Information</label>
                                <input type="text" class="form-control" name="warranty_information" placeholder="Enter Warranty Information">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Maintenance Schedule</label>
                                <input type="text" class="form-control" name="maintenance_schedule" placeholder="Enter Maintenance Schedule">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Details</label>
                                <input type="text" class="form-control" name="insurance_details" placeholder="Enter Insurance Details">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="form-title">Documentation</h5>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="form-group service-bg mb-0 pb-0">
                                <label>Attachment 1</label>
                                <div class="form-group service-upload mb-0">
                                    <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                    <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                    <p class="text-muted">Maximum size: 50MB</p>
                                    <input type="file" name="documentation" id="documentation">
                                    <div id="documentation_img"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="form-group service-bg mb-0 pb-0">
                                <label>Attachment 2</label>
                                <div class="form-group service-upload mb-0">
                                    <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                    <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                    <p class="text-muted">Maximum size: 50MB</p>
                                    <input type="file" name="attachment" id="attachment">
                                    <div id="attachment"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="form-title">Audit Trail</h5>
                    <div class="form-group-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Purchase By<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="purchase_by" id="purchase_by" placeholder="Purchase By">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Purchase Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="purchase_date_audit" id="purchase_date_audit" placeholder="Purchase Date">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Approve By</label>
                                    <input type="text" class="form-control" name="approve_by" placeholder="Purchase By">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Approve Date</label>
                                    <input type="date" class="form-control" name="approve_date"  id="approve_date" placeholder="Approve Date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="message-container"></div>
                    <div id="addAssetLoader" class="loader"></div>
                    <div class="add-customer-btns text-end">
                        <a href="https://ecashbook.in/assets" class="btn btn-primary cancel me-2">Cancel</a>
                        {{-- <button type="submit" class="btn btn-primary" fdprocessedid="xe6ebp">Add Asset</button> --}}
                        <button type="submit" class="btn btn-primary" >Add Asset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tangibleAssetsGroup').hide();
        $('#intangibleAssetsGroup').hide();
        $('#currentAssetsGroup').hide();
        $('#longtermAssetsGroup').hide();
        $('#otherAssetsGroup').hide();
        $('#customAssetsGroup').hide();


        $('#assetTypeGroup').show();

        $('#assetType').on('change', function() {
            $('#tangibleAssetsGroup').hide();
            $('#intangibleAssetsGroup').hide();
            $('#currentAssetsGroup').hide();
            $('#longtermAssetsGroup').hide();
            $('#otherAssetsGroup').hide();
            $('#customAssetsGroup').hide();

            var selectedAssetType = $(this).val();
            if (selectedAssetType === 'tangible') {
                $('#tangibleAssetsGroup').show();
            } else if (selectedAssetType === 'intangible') {
                $('#intangibleAssetsGroup').show();
            } else if (selectedAssetType === 'current') {
                $('#currentAssetsGroup').show();
            } else if (selectedAssetType === 'longterm') {
                $('#longtermAssetsGroup').show();
            } else if (selectedAssetType === 'other') {
                $('#otherAssetsGroup').show();
            } else if (selectedAssetType === 'custom') {
                $('#customAssetsGroup').show();
            }
        });
    });
</script>
@endsection



