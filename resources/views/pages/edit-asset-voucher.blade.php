@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="content-page-header">
                <h5>Edit Asset Voucher</h5>
            </div>
        </div>

        <div class="card">
			<form action="javascript:void(0);" method="post" name="addAssetVoucherFrm" id="addAssetVoucherFrm" enctype="multipart/form-data">
			<input type="hidden" name="id" id="vId" value="{{ $assetvoucher->id }}">
			@csrf
            <div class="card-body">
                <div class="form-group-item">
                    <h5 class="form-title">Basic Details</h5>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="align-center">
                                    <div class="form-control me-3">
                                        <label class="custom_radio me-3 mb-0">
                                            <input type="radio" class="form-control" name="v_type" value="1" <?php echo ($assetvoucher->v_type=='1')? "checked":"" ?>><span class="checkmark"></span> Inward
                                        </label>
                                    </div>
                                    <div class="form-control">
                                        <label class="custom_radio mb-0">
                                            <input type="radio" name="v_type" value="2" <?php echo ($assetvoucher->v_type=='2')? "checked":"" ?>><span class="checkmark"></span> Outward
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Voucher Number <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="voucher_no" id="voucher_no" value="{{ $assetvoucher->voucher_no }}" placeholder="Enter Voucher Number">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Voucher Name <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="voucher_name" id="voucher_name" value="{{ $assetvoucher->voucher_name }}" placeholder="Enter Voucher Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" id="branch_name" value="{{ $assetvoucher->branch_name }}" placeholder="Enter branch Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Series</label>
                                <ul class="form-group-plus css-equal-heights">
                                    <li>
                                        <select name="series_id" id="series_id" class="form-select" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                            <option value="">Select Series</option>
                                            @foreach($assetSeries as $k=>$series)
											<option value="{{ $series->id }}" <?php echo ($assetvoucher->series_id==$series->id)? "selected":"" ?>>{{ $series->series_name }}</option>
											@endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <a class="btn btn-primary form-plus-btn" data-bs-toggle="modal" data-bs-target="#add_series">
                                            <i class="fe fe-plus-circle"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Invoice Date <span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="invoice_date" id="invoice_date" value="{{ $assetvoucher->invoice_date }}" placeholder="Purchase Date">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Vendor</label>
                                <ul class="form-group-plus css-equal-heights">
                                    <li>
                                        <select name="vendor_id" id="vendor_id" class="form-select" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                            <option value="">Select Country</option>
											@foreach($vendors as $k=>$vendor)
											<option value="{{ $vendor->id }}" <?php echo ($assetvoucher->vendor_id==$vendor->id)? "selected":"" ?>>{{ $vendor->vendor_name }}</option>
											@endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <a class="btn btn-primary form-plus-btn" href="addvendor">
                                            <i class="fe fe-plus-circle"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Invoice Voucher Number <span class="text-danger"> *</span></label>
                                <input type="text" name="inv_voucher_no" id="inv_voucher_no" value="{{ $assetvoucher->inv_voucher_no }}" class="form-control" placeholder="Enter Opening Stocks">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Total Cost (INR) <span class="text-danger"> *</span></label>
                                <input type="text" name="total_cost" id="total_cost" value="{{ $assetvoucher->total_cost }}" class="form-control" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
				<div class="message-container"></div>
				<div id="addVocherLoader" class="loader"></div>
                <div class="add-customer-btns text-end">
                    <a href="{{ url('/asset-voucher') }}" class="btn btn-primary cancel me-2">Cancel</a>
					<button type="submit" class="btn btn-primary">Update Voucher</button>
                </div>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal custom-modal fade" id="add_series" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0 align-center">
                    <h4 class="mb-0">Add New Series Name</h4>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="align-center" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Asset Series Name</label>
                            <input type="text" class="form-control" placeholder="Enter Asset Series Name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer add-tax-btns">
                <button type="reset" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Create</button>
            </div>
        </div>
    </div>
</div>
@endsection
