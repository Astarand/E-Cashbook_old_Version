@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add New Bank Account</h5>
                </div>
            </div>
            <div class="card">
            <form action="javascript:void(0);" method="post" name="addBankFrm" id="addBankFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="bankId" value="">
                <div class="card-body">
                    <div class="form-group-customer customer-additional-form">
                        <div class="row">
                            <div class="billing-btn">
                                <h5 class="form-title mb-0">Bank Details</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Bank Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch" placeholder="Enter Branch Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Account Holder Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="accholder_name" id="accholder_name" class="form-control" placeholder="Enter Account Holder Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Account Number <span class="text-danger"> *</span></label>
                                    <input type="text" name="bank_ac_no" id="bank_ac_no" class="form-control" placeholder="Enter Account Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>IFSC Code <span class="text-danger"> *</span></label>
                                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" placeholder="Enter IFSC Code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Swift Code</label>
                                    <input type="text" name="swift_code" id="swift_code" class="form-control" placeholder="Enter IFSC Code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>UPI ID</label>
                                    <input type="text" name="upi_id" id="upi_id" class="form-control" placeholder="Enter UPI ID">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Current Balance in Bank <span class="text-danger"> *</span></label>
                                    <input type="text" name="curr_bal" id="curr_bal" class="form-control" placeholder="Enter Current Balance">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="message-container"></div>
					<div id="addBankLoader" class="loader"></div>
                    <div class="add-customer-btns text-end">
                        <a href="{{ url('/banks') }}" class="btn btn-primary cancel me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                        
                    </div>
                </div>
                </form>
            </div>
@endsection
