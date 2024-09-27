@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add New Quote</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="javascript:void(0);" method="post" name="addTaskquoteFrm" id="addTaskquoteFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="quoteId" value="">
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
                                                    <option value="Accounts Preparation">Accounts Preparation</option>
                                                    <option value="Advisory & Consulting">Advisory & Consulting</option>
                                                    <option value="Audits">Audits</option>
                                                    <option value="Business Development">Business Development</option>
                                                    <option value="Case related matters">Case related matters</option>
                                                    <option value="Company Incorporation">Company Incorporation</option>
                                                    <option value="Company Compliances">Company Compliances</option>
                                                    <option value="GST Returns">GST Returns</option>
                                                    <option value="HR & Administration">HR & Administration</option>
                                                    <option value="Income Tax Returns">Income Tax Returns</option>                                                    
                                                    <option value="Legal Services">Legal Services</option>
                                                    <option value="Licensing & Registration">Licensing & Registration</option>
                                                    <option value="Outsourcing of Accountant">Outsourcing of Accountant</option>
                                                    <option value="Project Report / DPR">Project Report / DPR</option>
                                                    <option value="P-Tax & Trade License">P-Tax & Trade License</option>
                                                    <option value="ROC Returns">ROC Returns</option>                                                    
                                                    <option value="TDS, PF & ESIC">TDS, PF & ESIC</option> 
                                                    {{-- <option value="Others">Others</option> --}}
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
                                                    <option value="GST">GST</option>
                                                    <option value="ROC">ROC</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Goverment fees<span class="text-danger"> *</span></label>
                                            <input type="text" name="govfee" id="govfee" class="form-control" placeholder="Enter Goverment fees">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Services Charge<span class="text-danger"> *</span></label>
                                            <input type="text" name="service_charge" id="service_charge" class="form-control" placeholder="Enter Services Charge">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-customer-btns text-end">
                        <a href="javascript:void(0);" id="cancel_attaBtn" class="btn customer-btn-cancel">Cancel</a>
                        <button type="submit" id="save_attaBtn" class="btn customer-btn-save">Upload & Save</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
