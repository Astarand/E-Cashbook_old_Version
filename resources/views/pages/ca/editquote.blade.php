@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Quote</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="javascript:void(0);" method="post" name="addTaskquoteFrm" id="addTaskquoteFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="quoteId" value="{{$quote->id}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Category<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                            <select class="select form-select" name="task_cat" id="task_cat">
                                                    <option value="">Select Category</option>
                                                    <option value="Company Incorporation" <?php echo ($quote->task_cat=='Company Incorporation')? "selected":"" ?>>Company Incorporation</option>
                                                    <option value="Company Compliances" <?php echo ($quote->task_cat=='Company Compliances')? "selected":"" ?>>Company Compliances</option>
                                                    <option value="Licensing & Registration" <?php echo ($quote->task_cat=='Licensing & Registration')? "selected":"" ?>>Licensing & Registration</option>
                                                    <option value="Income Tax Returns" <?php echo ($quote->task_cat=='Income Tax Returns')? "selected":"" ?>>Income Tax Returns</option>
                                                    <option value="GST Returns" <?php echo ($quote->task_cat=='GST Returns')? "selected":"" ?>>GST Returns</option>
                                                    <option value="ROC Returns" <?php echo ($quote->task_cat=='ROC Returns')? "selected":"" ?>>ROC Returns</option>
                                                    <option value="Audits"<?php echo ($quote->task_cat=='Audits')? "selected":"" ?>>Audits</option>
                                                    <option value="TDS, PF & ESIC" <?php echo ($quote->task_cat=='TDS, PF & ESIC')? "selected":"" ?>>TDS, PF & ESIC</option>
                                                    <option value="Project Report / DPR" <?php echo ($quote->task_cat=='Project Report / DPR')? "selected":"" ?>>Project Report / DPR</option>
                                                    <option value="Accounts Preparation" <?php echo ($quote->task_cat=='Accounts Preparation')? "selected":"" ?>>Accounts Preparation</option>
                                                    <option value="Outsourcing of Accountant" <?php echo ($quote->task_cat=='Outsourcing of Accountant')? "selected":"" ?>>Outsourcing of Accountant</option>
                                                    <option value="Others" <?php echo ($quote->task_cat=='Others')? "selected":"" ?>>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Sub-category<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                            <select class="select form-select" name="task_sub_cat" id="task_sub_cat">
                                                    <option value="">Select Category</option>
                                                    <option value="GST" <?php echo ($quote->task_sub_cat=='GST')? "selected":"" ?>>GST</option>
                                                    <option value="ROC" <?php echo ($quote->task_sub_cat=='ROC')? "selected":"" ?>>ROC</option>
                                                    <option value="Other" <?php echo ($quote->task_sub_cat=='Other')? "selected":"" ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Goverment fees<span class="text-danger"> *</span></label>
                                            <input type="text" name="govfee" id="govfee" value="{{$quote->govfee}}" class="form-control" placeholder="Enter Goverment fees">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Services Charge <span class="text-danger"> *</span></label>
                                            <input type="text" name="service_charge" id="service_charge" value="{{$quote->service_charge}}" class="form-control" placeholder="Enter Services Charge">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-customer-btns text-end">
                        <a href="{{ url('/quote') }}" id="cancel_attaBtn" class="btn customer-btn-cancel">Cancel</a>
                        <button type="submit" id="save_attaBtn" class="btn customer-btn-save">Upload & Save</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
