@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Loan Account</h5>
                </div>
            </div>
            <div class="card">
				<form action="javascript:void(0);" method="post" name="addLoanFrm" id="addLoanFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="loanId" value="{{ $loan->id }}">
				@csrf
                <div class="card-body">
                    <div class="form-group-customer customer-additional-form">
                        <div class="row">
                            <div class="billing-btn">
                                <h5 class="form-title mb-0">Loan Details</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $loan->bank_name }}" placeholder="Enter Bank Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch</label>
                                    <input type="text" class="form-control" name="branch" id="branch" name="branch" value="{{ $loan->branch }}" placeholder="Enter Branch Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Applicant Name</label>
                                    <input type="text" class="form-control" name="app_name" id="app_name" value="{{ $loan->app_name }}" placeholder="Enter Applicant Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Loan Account Number</label>
                                    <input type="text" class="form-control" name="loan_ac_no" id="loan_ac_no" value="{{ $loan->loan_ac_no }}" placeholder="Enter Loan Account Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Banking Unit Code</label>
                                    <input type="text" class="form-control" name="bank_code" id="bank_code" value="{{ $loan->bank_code }}" placeholder="Enter Banking Unit Code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Credit Limit</label>
                                    <input type="text" class="form-control" name="credit_limit" id="credit_limit" value="{{ $loan->credit_limit }}" placeholder="Enter Credit Limit">
                                </div>
                            </div>
                        </div>

                    </div>
					
					<div class="message-container"></div>
					<div id="addLoanLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
						<a href="{{ url('/loans') }}" class="btn btn-primary cancel me-2">Cancel</a>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>	
                </div>
				</form>
            </div>
@endsection
