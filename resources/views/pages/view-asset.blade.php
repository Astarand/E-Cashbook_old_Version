@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="content-page-header">
                <h5>View Asset</h5>
            </div>
        </div>

        <form action="javascript:void(0);" method="post" name="addAssetFrm" id="addAssetFrm" enctype="multipart/form-data">
            <input type="hidden" name="assetId" id="assetId" value="{{ $assetId }}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h5 class="form-title">Asset Information</h5>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="date" value="{{ $asset->date }}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Asset Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="asset_name" id="asset_name" value="{{ $asset->asset_name }}" placeholder="Enter Asset Name">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div id="assetTypeGroup" class="form-group">
                                <label>Asset Type<span class="text-danger">*</span></label>
                                <select id="assetType" name="assetType" class="form-select">
                                    <option value="">Select</option>
                                    <option value="tangible" {{ $asset->assetType == 'tangible' ? 'selected' : '' }}>Tangible Assets</option>
                                    <option value="intangible" {{ $asset->assetType == 'intangible' ? 'selected' : '' }}>Intangible Assets</option>
                                    <option value="current" {{ $asset->assetType == 'current' ? 'selected' : '' }}>Current Assets</option>
                                    <option value="longterm" {{ $asset->assetType == 'longterm' ? 'selected' : '' }}>Long-term Investments</option>
                                    <option value="other" {{ $asset->assetType == 'other' ? 'selected' : '' }}>Other Asset Types</option>
                                    <option value="custom" {{ $asset->assetType == 'custom' ? 'selected' : '' }}>Custom Asset Types</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <!-- Asset type specific fields (initially hidden) -->
                            <div id="tangibleAssetsGroup" class="form-group">
                                <label>Tangible Assets</label>
                                <select class="form-select" name="tangible_assets" id="tangible_assets">
                                    <option value="">Select</option>
                                    <option value="land" {{ $asset->tangible_assets == 'land' ? 'selected' : '' }}>Land</option>
                                    <option value="buildings" {{ $asset->tangible_assets == 'buildings' ? 'selected' : '' }}>Buildings</option>
                                    <option value="machinery" {{ $asset->tangible_assets == 'machinery' ? 'selected' : '' }}>Machinery and Equipment</option>
                                    <option value="vehicles" {{ $asset->tangible_assets == 'vehicles' ? 'selected' : '' }}>Vehicles</option>
                                    <option value="furniture" {{ $asset->tangible_assets == 'furniture' ? 'selected' : '' }}>Furniture and Fixtures</option>
                                    <option value="computer" {{ $asset->tangible_assets == 'computer' ? 'selected' : '' }}>Computer Equipment</option>
                                    <option value="leasehold" {{ $asset->tangible_assets == 'leasehold' ? 'selected' : '' }}>Leasehold Improvements</option>
                                </select>
                            </div>
                            <div id="intangibleAssetsGroup" class="form-group">
                                <label>Intangible Assets</label>
                                <select class="form-select" name="intangible_assets" id="intangible_assets">
                                    <option value="">Select</option>
                                    <option value="patents" {{ $asset->tangible_assets == 'patents' ? 'selected' : '' }}>Patents</option>
                                    <option value="trademarks" {{ $asset->tangible_assets == 'trademarks' ? 'selected' : '' }}>Trademarks</option>
                                    <option value="copyrights" {{ $asset->tangible_assets == 'copyrights' ? 'selected' : '' }}>Copyrights</option>
                                    <option value="goodwill" {{ $asset->tangible_assets == 'goodwill' ? 'selected' : '' }}>Goodwill</option>
                                    <option value="licenses" {{ $asset->tangible_assets == 'licenses' ? 'selected' : '' }}>Licenses</option>
                                    <option value="software" {{ $asset->tangible_assets == 'software' ? 'selected' : '' }}>Software</option>
                                </select>
                            </div>
                            <div id="currentAssetsGroup" class="form-group">
                                <label>Current Assets</label>
                                <select class="form-select" name="current_assets" id="current_assets">
                                    <option value="">Select</option>
                                    <option value="cash" {{ $asset->tangible_assets == 'cash' ? 'selected' : '' }}>Cash and Cash Equivalents</option>
                                    <option value="receivable" {{ $asset->tangible_assets == 'receivable' ? 'selected' : '' }}>Accounts Receivable</option>
                                    <option value="inventory" {{ $asset->tangible_assets == 'inventory' ? 'selected' : '' }}>Inventory</option>
                                    <option value="prepaid" {{ $asset->tangible_assets == 'prepaid' ? 'selected' : '' }}>Prepaid Expenses</option>
                                </select>
                            </div>
                            <div id="longtermAssetsGroup" class="form-group">
                                <label>Long-term Investments</label>
                                <select class="form-select" name="longterm_assets" id="longterm_assets">
                                    <option value="">Select</option>
                                    <option value="bonds" {{ $asset->tangible_assets == 'bonds' ? 'selected' : '' }}>Bonds</option>
                                    <option value="stocks" {{ $asset->tangible_assets == 'stocks' ? 'selected' : '' }}>Stocks</option>
                                    <option value="realEstate" {{ $asset->tangible_assets == 'realEstate' ? 'selected' : '' }}>Real Estate</option>
                                </select>
                            </div>
                            <div id="otherAssetsGroup" class="form-group">
                                <label>Other Asset Types</label>
                                <select class="form-select" name="other_assets" id="other_assets">
                                    <option value="">Select</option>
                                    <option value="naturalResources" {{ $asset->tangible_assets == 'naturalResources' ? 'selected' : '' }}>Natural Resources</option>
                                    <option value="wip" {{ $asset->tangible_assets == 'wip' ? 'selected' : '' }}>Work in Progress (WIP)</option>
                                    <option value="biological" {{ $asset->tangible_assets == 'biological' ? 'selected' : '' }}>Biological Assets</option>
                                </select>
                            </div>
                            <div id="customAssetsGroup" class="form-group">
                                <label>Custom Asset Types</label>
                                <input type="text" class="form-control" name="custom_assets" value="{{ $asset->tangible_assets }}" placeholder="Enter Custom Asset Types">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">Asset Description</label>
                                <textarea class="summernote form-control" name="assets_description" id="assets_description" placeholder="Enter Asset Description" rows="5">{{ $asset->assets_description }}</textarea>
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
                                <input type="date" class="form-control" name="purchase_date" id="purchase_date" value="{{ $asset->purchase_date }}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Purchase Price(INR)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="purchase_cost" id="purchase_cost" value="{{ $asset->purchase_cost }}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Vendor / Shop Name</label>
                                <input type="text" class="form-control" name="shop_name" value="{{ $asset->shop_name }}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" class="form-control" name="invoice_number" value="{{ $asset->invoice_number }}">
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
                                <input type="text" class="form-control" name="serial_number" value="{{ $asset->serial_number }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Location For</label>
                                <input type="text" class="form-control" name="location_for" value="{{ $asset->location_for }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Department  For</label>
                                <input type="text" class="form-control" name="department_for" value="{{ $asset->department_for }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Warranty Information</label>
                                <input type="text" class="form-control" name="warranty_information" value="{{ $asset->warranty_information }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Maintenance Schedule</label>
                                <input type="text" class="form-control" name="maintenance_schedule" value="{{ $asset->maintenance_schedule }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Details</label>
                                <input type="text" class="form-control" name="insurance_details" value="{{ $asset->insurance_details }}">
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
                                    <span><img style="width: 50%;" src="{{ asset('public/storage/uploads/assets/'.$asset->documentation) }}" alt="attachment"></span>
                                    <!-- Display existing attachment or allow for a new one -->
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
                                    <span><img style="width: 50%;" src="{{ asset('public/storage/uploads/assets/'.$asset->attachment) }}" alt="attachment"></span>
                                    <!-- Display existing attachment or allow for a new one -->
                                    <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                    <p class="text-muted">Maximum size: 50MB</p>
                                    <input type="file" name="attachment" id="attachment">
                                    <div id="attachment_img"></div>
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
                                    <input type="text" class="form-control" name="purchase_by" id="purchase_by" value="{{ $asset->purchase_by }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Purchase Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="purchase_date_audit" id="purchase_date_audit" value="{{ $asset->purchase_date_audit }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Approve By</label>
                                    <input type="text" class="form-control" name="approve_by" value="{{ $asset->approve_by }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Approve Date</label>
                                    <input type="date" class="form-control" name="approve_date" id="approve_date" value="{{ $asset->approve_date }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="message-container"></div>
                    <div id="addAssetLoader" class="loader"></div>
                    <div class="add-customer-btns text-end">
                        <a href="https://ecashbook.in/assets" class="btn btn-primary cancel me-2">Cancel</a>
                        {{-- <button type="submit" class="btn btn-primary" fdprocessedid="xe6ebp">Add Asset</button> --}}
                        {{-- <button type="submit" class="btn btn-primary">Update Asset</button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Hide all asset type groups initially
        $('#tangibleAssetsGroup').hide();
        $('#intangibleAssetsGroup').hide();
        $('#currentAssetsGroup').hide();
        $('#longtermAssetsGroup').hide();
        $('#otherAssetsGroup').hide();
        $('#customAssetsGroup').hide();

        // Show assetTypeGroup initially
        $('#assetTypeGroup').show();

        // Function to handle assetType change
        $('#assetType').on('change', function() {
            // Hide all asset type groups
            $('#tangibleAssetsGroup').hide();
            $('#intangibleAssetsGroup').hide();
            $('#currentAssetsGroup').hide();
            $('#longtermAssetsGroup').hide();
            $('#otherAssetsGroup').hide();
            $('#customAssetsGroup').hide();

            // Show the selected asset type group based on dropdown value
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

        // Trigger change event on page load if assetType is pre-selected
        $('#assetType').trigger('change');
    });
</script>


@endsection
