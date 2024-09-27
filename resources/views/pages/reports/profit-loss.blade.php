@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Profit Loss Report</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <form action="javascript:void(0);" method="post" name="profitLossFrm" id="profitLossFrm">
					@csrf	
                    <div class="form-group-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="Date" class="form-control" name="fromDate" id="fromDate" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="Date" class="form-control" name="toDate" id="toDate" placeholder="Enter Date">
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
					<div class="message-container"></div>
                    <div class="add-customer-btns">
                    <div id="reportLoader" class="loader"></div>
                        <a href="{{ url('/') }}" class="btn customer-btn-cancel">Cancel</a>
                        <button type="submit" id="reportSubmit" class="btn customer-btn-save">Generate</button>
                        
                    </div>
                </div>
            </form>
         </div>
        
        </div>
    </div>
@endsection
