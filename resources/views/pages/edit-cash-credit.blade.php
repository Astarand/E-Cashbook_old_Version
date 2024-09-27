@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Cash Update</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
					<form  action="javascript:void(0);" method="POST" name="addCashCreditFrm" id="addCashCreditFrm" enctype="multipart/form-data">
					<input type="hidden" name="id" id="cId" value="{{ $cashData->id }}">
					@csrf
                    <div class="form-group-customer customer-additional-form">
                        <div class="row">
                            <div class="billing-btn">
                                <h5 class="form-title mb-0">Cash Credit Details</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cd_date" id="cd_date" value="{{ $cashData->cd_date }}" class="form-control" placeholder="Enter Bank Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Particulars</label>
                                    <input type="text" name="particulars" id="particulars" value="{{ $cashData->particulars }}" class="form-control" placeholder="Enter Particulars">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cd_amount" id="cd_amount" value="{{ $cashData->cd_amount }}" class="form-control" placeholder="Enter Credit/ Dabit Amount">
                                </div>
                            </div>
                        </div>

                    </div>
                    
					<div class="message-container"></div>
					<div id="cashLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
						<a href="{{ url('/cash') }}" class="btn customer-btn-cancel">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
					</form>
                </div>
            </div>
        </div>
    </div>

@endsection
