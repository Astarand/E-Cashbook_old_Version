@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add New Loan Account</h5>
                </div>
            </div>
            <div class="card">
				<form action="javascript:void(0);" method="post" name="addLoanFrm" id="addLoanFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="loanId" value="">
				@csrf
                <div class="card-body">
                    <div class="form-group-customer customer-additional-form">
                        <div class="row">
                            <div class="billing-btn">
                                <h5 class="form-title mb-0">Loan Details</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Bank Name <span class="text-danger"> *</span></label>
                                    {{-- <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name"> --}}
                                    <select name="bank_name" id="bank_name" class="form-control">
                                        <option>Select Bank Name</option>
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="branch" id="branch" name="branch" placeholder="Enter Branch Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Applicant Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="app_name" id="app_name" placeholder="Enter Applicant Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Loan Account Number <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="loan_ac_no" id="loan_ac_no" placeholder="Enter Loan Account Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Banking Unit Code <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="bank_code" id="bank_code" placeholder="Enter Banking Unit Code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Credit Limit <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="credit_limit" id="credit_limit" placeholder="Enter Credit Limit">
                                </div>
                            </div>
                        </div>

                    </div>
					
					<div class="message-container"></div>
					<div id="addLoanLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
						<a href="{{ url('/loans') }}" class="btn btn-primary cancel me-2">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>	
                </div>
				</form>
            </div>
@endsection
