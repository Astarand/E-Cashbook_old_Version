@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Bank Statement</h5>
                </div>
            </div>
            <div class="card">
            <form action="javascript:void(0);" method="post" name="addTranFrm" id="addTranFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="tranId" value="{{ $tranData->id }}">
				<input type="hidden" name="bankId" id="bankId" value="{{ $tranData->bankId }}">
				<input type="hidden" id="tranDoc" value="{{ $tranData->tran_doc }}">
                @csrf
                <div class="card-body">
                    <div class="form-group-customer customer-additional-form">
                        <div class="row">
                            <div class="billing-btn">
                                <h5 class="form-title mb-0">Enter Bank transaction</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="tran_date" id="tran_date" value="{{ $tranData->tran_date }}" class="form-control" placeholder="Enter Bank Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <div class="form-group">
                                    <select name="tran_type" id="tran_type" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Credit" <?php echo ($tranData->tran_type=='Credit')? "selected":"" ?>>Credit</option>
                                            <option value="Debit" <?php echo ($tranData->tran_type=='Debit')? "selected":"" ?>>Debit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mode of Payment</label>
                                    <div class="form-group">
                                    <select name="payment_mode" id="payment_mode" class="form-select">                                       
                                            <option value="">Select</option>
                                            <option value="NEFT" <?php echo ($tranData->payment_mode=='NEFT')? "selected":"" ?>>NEFT</option>
                                            <option value="IMPS" <?php echo ($tranData->payment_mode=='IMPS')? "selected":"" ?>>IMPS</option>
                                            <option value="RTGS" <?php echo ($tranData->payment_mode=='RTGS')? "selected":"" ?>>RTGS</option>
                                            <option value="Cheque" <?php echo ($tranData->payment_mode=='Cheque')? "selected":"" ?>>Cheque</option>
                                            <option value="Demand Draft" <?php echo ($tranData->payment_mode=='Demand Draft')? "selected":"" ?>>Demand Draft</option>
                                            <option value="Pay Order" <?php echo ($tranData->payment_mode=='Pay Order')? "selected":"" ?>>Pay Order</option>
                                            <option value="UPI" <?php echo ($tranData->payment_mode=='UPI')? "selected":"" ?>>UPI</option>                                       
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Purpose</label>
                                    <input type="text" name="purpose" id="purpose" value="{{$tranData->purpose}}" class="form-control" placeholder="Enter Purpose">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number"  name="tran_amt" id="tran_amt" value="{{$tranData->tran_amt}}" class="form-control" placeholder="Enter Credit/ Dabit Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Current Balance</label>
                                    <input type="text"  name="curr_amt" id="curr_amt" value="{{$tranData->curr_amt}}" class="form-control" placeholder="Enter Current Bank Balance">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text"  name="message" id="message" value="{{$tranData->message}}" class="form-control" placeholder="Enter Message">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 mb-3">
                                <div class="form-group mb-0 pb-0">
                                    <label>Upload Document Aganist this Transaction</label>
                                    <div class="form-group service-upload mb-0">
                                        <span><img src="http://localhost/e-cashbook/public/assets/img/icons/drop-icon.svg" alt="upload"></span>
                                        <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                        <p class="text-muted">Maximum size: 50MB</p>
                                        <input type="file" name="tran_doc" id="tran_doc">
                                        <div id="frames2"></div>
                                        <div class="downloadFile"><a target="_blank" href="http://localhost/e-cashbook/public/uploads/company-files/20230927162334-android.jpg">Download</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="message-container"></div>
					<div id="addBankLoader" class="loader"></div>
                    <div class="add-customer-btns text-end">
                       <a href="{{ url('/bank-statement/'.base64_encode($tranData->bankId)) }}" class="btn btn-primary cancel me-2">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
