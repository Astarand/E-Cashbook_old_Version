@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add New Company</h5>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <form action="javascript:void(0);" method="post" name="addcustFrm" id="addcustFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="custId" value="">
                        @csrf
                        <div class="card-body">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Name<span class="text-danger"> *</span></label>
                                            <input type="text" name="comp_name" id="comp_name" class="form-control" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Compnay Email<span class="text-danger"> *</span></label>
                                            <input type="email" name="comp_email" id="comp_email" class="form-control" placeholder="Enter Email">
                                            <div id="email-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Compnay Phone Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="comp_phone" id="comp_phone" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Compnay GST Number</label>
                                            <input type="text" name="comp_gst_no" id="comp_gst_no" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Website</label>
                                            <input type="text" name="comp_website" id="comp_website" class="form-control" placeholder="Enter Company Website">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Pan Number</label>
                                            <input type="text" name="comp_pan_no" id="comp_pan_no" class="form-control" placeholder="Enter Pan Number">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Business Agent Name<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                            <select class="select form-select" name="agent_name" id="agent_name">
                                                    <option value="">Select Name</option>
                                                    <option value=" ">None</option>
                                                    @foreach($agents as $k=>$val)
															<option value="{{ $val->id }}" >{{ $val->agent_name }}</option>
														@endforeach
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <ul class="nav nav-tabs nav-bordered">
                                                        <li class="nav-item">
                                                            <a href="#purpose" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                                <strong>Perposes of Attachments</strong>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane show active" id="purpose">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]"  value="Company Incorporation" >
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Company Incorporation</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]"  value="Company Compliances">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Company Compliances</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="ROC Return">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">ROC Return</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Accounts Preparation">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Accounts Preparation</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="GST & Taxation" >
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">GST & Taxation</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Auditing">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Auditing</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Auditor Recruitment">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Auditor Recruitment</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Auditor Recruitment">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Licensing & Registration</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Income Tax Return">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Income Tax Return</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="TDS">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">TDS</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="PF & ESIC">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">PF & ESIC</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="P-tax">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">P-tax</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Project Report / DPR with CMA Data">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Project Report / DPR with CMA Data</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]"  value="Outsourcing of work">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Outsourcing of work</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" value="Outsourcing of employee">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Outsourcing of employee</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]"  value="Other">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Other</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
