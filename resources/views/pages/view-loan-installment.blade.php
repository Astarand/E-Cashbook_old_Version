@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>View Loan Installment</h5>
                </div>
            </div>
            <div class="card">
				<form action="javascript:void(0);" method="post" name="addInsFrm" id="addInsFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="insId" value="{{ $insData->id }}">
				<input type="hidden" name="loanId" id="loanId" value="{{ $insData->loanId }}">
				<input type="hidden" id="insDoc" value="{{$insData->ins_doc}}">
				@csrf
                <div class="card-body">
                    <div class="form-group-customer customer-additional-form">
                        <div class="row">
                            <div class="billing-btn">
                                <h5 class="form-title mb-0">Enter Installment Details</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="ins_date" id="ins_date" value="{{ $insData->ins_date }}" class="form-control" placeholder="Enter Bank Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mode of Payment</label>
                                    <div class="form-group">
                                        <select class="form-select" name="payment_mode" id="payment_mode" >
                                            <option value="">Select</option>
                                            <option value="NEFT" <?php echo ($insData->payment_mode=='NEFT')? "selected":"" ?>>NEFT</option>
                                            <option value="IMPS" <?php echo ($insData->payment_mode=='IMPS')? "selected":"" ?>>IMPS</option>
                                            <option value="RTGS" <?php echo ($insData->payment_mode=='RTGS')? "selected":"" ?>>RTGS</option>
                                            <option value="Cheque" <?php echo ($insData->payment_mode=='Cheque')? "selected":"" ?>>Cheque</option>
                                            <option value="Demand Draft" <?php echo ($insData->payment_mode=='Demand Draft')? "selected":"" ?>>Demand Draft</option>
                                            <option value="Pay Order" <?php echo ($insData->payment_mode=='Pay Order')? "selected":"" ?>>Pay Order</option>
                                            <option value="UPI" <?php echo ($insData->payment_mode=='UPI')? "selected":"" ?>>UPI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="ins_amt" id="ins_amt" value="{{ $insData->ins_amt }}"  class="form-control" placeholder="Enter Credit/ Dabit Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Current Avilable Limit</label>
                                    <input type="text" name="curr_amt" id="curr_amt" value="{{ $insData->curr_amt }}" class="form-control" placeholder="Enter Current Bank Balance">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text"  name="message" id="message" value="{{ $insData->message }}" class="form-control" placeholder="Enter Message">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 mb-3">
                                <div class="form-group mb-0 pb-0">
                                    <label>Upload Document Aganist this Transaction</label>
                                    <div class="form-group service-upload mb-0">
                                        <span><img src="{{ asset('/public/assets/img/icons/drop-icon.svg') }}" alt="upload"></span>
                                        <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                        <p class="text-muted">Maximum size: 50MB</p>
                                        <input type="file" name="ins_doc" id="ins_doc">
                                        <div id="frames2"></div>
										@if(@$insData->ins_doc !="")
											<div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/loans/'.$insData->ins_doc) }}">Download</a></div>
										@endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
					
                    <div class="message-container"></div>
					<div id="addLoanLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
						<a href="{{ url('/loan-statement/'.base64_encode($insData->loanId)) }}" class="btn btn-primary cancel me-2">Cancel</a>
						
					</div>	
                </div>
				</form>
            </div>
        </div>
    </div>

@endsection
