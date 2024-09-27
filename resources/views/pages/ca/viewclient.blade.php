@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>View Customer</h5>
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
                                            <input type="text" name="comp_name" id="comp_name" value="{{$client->comp_name}}" class="form-control" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Compnay Email<span class="text-danger"> *</span></label>
                                            <input type="email" name="comp_email" id="comp_email" value="{{$client->comp_email}}" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Compnay Phone Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="comp_phone" id="comp_phone" value="{{$client->comp_phone}}" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Compnay GST Number</label>
                                            <input type="text" name="comp_gst_no" id="comp_gst_no" value="{{$client->comp_gst_no}}" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Website</label>
                                            <input type="text" name="comp_website" id="comp_website" value="{{$client->comp_website}}" class="form-control" placeholder="Enter Company Website">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Pan Number</label>
                                            <input type="text" name="comp_pan_no" id="comp_pan_no" value="{{$client->comp_pan_no}}" class="form-control" placeholder="Enter Pan Number">
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
															<option value="{{ $val->id }}" <?php echo ($client->id==$val->id)? "selected":"" ?>>{{ $val->agent_name }}</option>
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
                                                                <?php 
                                                                    $perposesDetails = isset($client->compincorp)?$client->compincorp:"";
                                                                    $perposesDetails = explode(',', $perposesDetails);
                                                                ?>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Company Incorporation', $perposesDetails)) { echo 'checked="checked"'; }?> value="Company Incorporation" >
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Company Incorporation</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Company Compliances', $perposesDetails)) { echo 'checked="checked"'; }?>  value="Company Compliances">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Company Compliances</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('ROC Return', $perposesDetails)) { echo 'checked="checked"'; }?>  value="ROC Return">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">ROC Return</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Accounts Preparation', $perposesDetails)) { echo 'checked="checked"'; }?> value="Accounts Preparation">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Accounts Preparation</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('GST & Taxation', $perposesDetails)) { echo 'checked="checked"'; }?> value="GST & Taxation" >
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">GST & Taxation</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Auditing', $perposesDetails)) { echo 'checked="checked"'; }?> value="Auditing">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Auditing</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Auditor Recruitment', $perposesDetails)) { echo 'checked="checked"'; }?> value="Auditor Recruitment">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Auditor Recruitment</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Licensing & Registration', $perposesDetails)) { echo 'checked="checked"'; }?> value="Licensing & Registration">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Licensing & Registration</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Income Tax Return', $perposesDetails)) { echo 'checked="checked"'; }?> value="Income Tax Return">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Income Tax Return</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('TDS', $perposesDetails)) { echo 'checked="checked"'; }?> value="TDS">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">TDS</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('PF & ESIC', $perposesDetails)) { echo 'checked="checked"'; }?>  value="PF & ESIC">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">PF & ESIC</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('P-tax', $perposesDetails)) { echo 'checked="checked"'; }?> value="P-tax">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">P-tax</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Project Report / DPR with CMA Data', $perposesDetails)) { echo 'checked="checked"'; }?> value="Project Report / DPR with CMA Data">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Project Report / DPR with CMA Data</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Outsourcing of work', $perposesDetails)) { echo 'checked="checked"'; }?>  value="Outsourcing of work">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Outsourcing of work</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Outsourcing of employee', $perposesDetails)) { echo 'checked="checked"'; }?> value="Outsourcing of employee">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <label for="company_incorporation">Outsourcing of employee</label>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label class="custom_check">
                                                                            <input type="checkbox" name="compincorp[]" <?php if (in_array('Other', $perposesDetails)) { echo 'checked="checked"'; }?>  value="Other">
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
                        <a href="{{ url('/client') }}" class="btn customer-btn-cancel">Cancel</a>                        
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
