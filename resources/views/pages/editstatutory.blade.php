@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit statutory</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
					<form  action="javascript:void(0);" method="POST" name="addStatutoryFrm" id="addStatutoryFrm">
                        <input type="hidden" name="id" id="eId" value="{{ $statutory->id }}">
                        @csrf
                    <div class="form-group-item">
                        <div class="row">
                            
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Company <span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <select class="form-select" name="compId" id="compId">
                                            
											@foreach($companys as $k=>$company)
												<option value="{{ $company->userId }}" <?php echo ($company->userId==$statutory->compId)? "selected":"" ?> >{{ $company->comp_name }}</option>
											@endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
							
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Document <span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <select class="form-select" name="statutory_doc" id="statutory_doc">
                                            <option value="">Select</option>
                                            <option value="Annual GST Return" <?php echo ($statutory->statutory_doc=='Annual GST Return')? "selected":"" ?>>Annual GST Return</option>
                                            <option value="Annual P-tax Return" <?php echo ($statutory->statutory_doc=='Annual P-tax Return')? "selected":"" ?>>Annual P-tax Return</option>
                                            <option value="Annual TDS Return" <?php echo ($statutory->statutory_doc=='Annual TDS Return')? "selected":"" ?>>Annual TDS Return </option>
                                            <option value="Excise Duty Return" <?php echo ($statutory->statutory_doc=='Excise Duty Return')? "selected":"" ?>>Excise Duty Return</option>
                                            <option value="FSSAI Renew" <?php echo ($statutory->statutory_doc=='FSSAI Renew')? "selected":"" ?>>FSSAI Renew</option>
                                            <option value="Income Tax Return (ITR)" <?php echo ($statutory->statutory_doc=='Income Tax Return (ITR)')? "selected":"" ?>>Income Tax Return (ITR)</option>
                                            <option value="Monthly GST Return" <?php echo ($statutory->statutory_doc=='Monthly GST Return')? "selected":"" ?>>Monthly GST Return</option>
                                            <option value="Monthly TDS Return" <?php echo ($statutory->statutory_doc=='Monthly TDS Return')? "selected":"" ?>>Monthly TDS Return</option>
                                            <option value="Monthly PF Payment" <?php echo ($statutory->statutory_doc=='Monthly PF Payment')? "selected":"" ?>>Monthly PF Payment</option>
                                            <option value="Monthly ESIC Return" <?php echo ($statutory->statutory_doc=='Monthly ESIC Return')? "selected":"" ?>>Monthly ESIC Return</option>
                                            <option value="Monthly P-tax Payment" <?php echo ($statutory->statutory_doc=='Monthly P-tax Payment')? "selected":"" ?>>Monthly P-tax Payment</option>
                                            <option value="Payroll Tax Return" <?php echo ($statutory->statutory_doc=='Payroll Tax Return')? "selected":"" ?>>Payroll Tax Return</option>
                                            <option value="P-tax Enrollment Payment" <?php echo ($statutory->statutory_doc=='P-tax Enrollment Payment')? "selected":"" ?>>P-tax Enrollment Payment</option>
                                            <option value="Quaterly TDS Return" <?php echo ($statutory->statutory_doc=='Quaterly TDS Return')? "selected":"" ?>>Quaterly TDS Return</option>
                                            <option value="Quater GST Return" <?php echo ($statutory->statutory_doc=='Quater GST Return')? "selected":"" ?>>Quater GST Return</option>
                                            <option value="ROC Return" <?php echo ($statutory->statutory_doc=='ROC Return')? "selected":"" ?>>ROC Return</option>
                                            <option value="Shop & Establishment Renew" <?php echo ($statutory->statutory_doc=='Shop & Establishment Renew')? "selected":"" ?>>Shop & Establishment Renew</option>
                                            <option value="TCS Return" <?php echo ($statutory->statutory_doc=='TCS Return')? "selected":"" ?>>TCS Return</option>
                                            <option value="Tax Audit" <?php echo ($statutory->statutory_doc=='Tax Audit')? "selected":"" ?>>Tax Audit</option>
                                            <option value="Trade License Renew" <?php echo ($statutory->statutory_doc=='Trade License Renew')? "selected":"" ?>>Trade License Renew</option>                                            
                                            {{-- <option value="Other" <?php echo ($statutory->statutory_doc=='ROC Return')? "selected":"" ?>>Other</option>  --}}
                                         </select>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="Date" name="statutory_due_date" id="statutory_due_date" value="{{ $statutory->statutory_due_date }}" class="form-control" placeholder="Enter Date">
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Message By CA <span class="text-danger"> *</span></label>
                                    <input type="text" name="statutory_msg" id="statutory_msg" value="{{ $statutory->statutory_msg }}" class="form-control" placeholder="Enter Message">
                                </div>
                            </div>
							
							<div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Action Status <span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <select class="form-select" name="status" id="status">
                                            <option value="0" <?php echo ($statutory->status==0)? "selected":"" ?>>Pending</option>
                                            <option value="1" <?php echo ($statutory->status==1)? "selected":"" ?>>Completed</option>
                                            <option value="2" <?php echo ($statutory->status==2)? "selected":"" ?>>On-going</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="message-container"></div>
					<div id="statutoryLoader" class="loader"></div>
                    <div class="add-customer-btns text-end">
                        <a href="{{ url('/statutory') }}" class="btn customer-btn-cancel">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
@endsection

