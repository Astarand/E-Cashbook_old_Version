@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>View Task</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="javascript:void(0);" method="post" name="addTaskFrm" id="addTaskFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="taskId" value="{{$task->id}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Date</label>
                                            <input type="text" name="task_date" id="task_date" value="{{$task->task_date}}" class="form-control" placeholder="Date will auto fetch by create time">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Time</label>
                                            <input type="text" name="task_time" id="task_time" value="{{$task->task_time}}" class="form-control" placeholder="time will auto fetch by create time">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Name<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                            <select class="select form-select" name="company_id" id="company_id">
                                                    <option value="">Select Name</option>                                                    
                                                    @foreach($company as $k=>$val)
															<option value="{{ $val->id }}" <?php echo ($task->company_id==$val->id)? "selected":"" ?>>{{ $val->name }}</option>
														@endforeach
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Category<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="task_category" id="task_category">
                                                <option value="Accounts Preparation" <?php echo ($task->task_category=='Accounts Preparation')? "selected":"" ?>>Accounts Preparation</option>
                                                    <option value="Advisory & Consulting" <?php echo ($task->task_category=='Advisory & Consulting')? "selected":"" ?>>Advisory & Consulting</option>
                                                    <option value="Audits"<?php echo ($task->task_category=='Audits')? "selected":"" ?>>Audits</option>
                                                    <option value="Business Development" <?php echo ($task->task_category=='Business Development')? "selected":"" ?>>Business Development</option>
                                                    <option value="Case related matters" <?php echo ($task->task_category=='Case related matters')? "selected":"" ?>>Case related matters</option>
                                                    <option value="Company Incorporation" <?php echo ($task->task_category=='Company Incorporation')? "selected":"" ?>>Company Incorporation</option>
                                                    <option value="Company Compliances" <?php echo ($task->task_category=='Company Compliances')? "selected":"" ?>>Company Compliances</option>
                                                    <option value="GST Returns" <?php echo ($task->task_category=='GST Returns')? "selected":"" ?>>GST Returns</option>
                                                    <option value="HR & Administration" <?php echo ($task->task_category=='HR & Administration')? "selected":"" ?>>HR & Administration</option>
                                                    <option value="Income Tax Returns" <?php echo ($task->task_category=='Income Tax Returns')? "selected":"" ?>>Income Tax Returns</option>                                                    
                                                    <option value="Legal Services" <?php echo ($task->task_category=='Legal Services')? "selected":"" ?>>Legal Services</option>
                                                    <option value="Licensing & Registration" <?php echo ($task->task_category=='Licensing & Registration')? "selected":"" ?>>Licensing & Registration</option>
                                                    <option value="Outsourcing of Accountant" <?php echo ($task->task_category=='Outsourcing of Accountant')? "selected":"" ?>>Outsourcing of Accountant</option>
                                                    <option value="Project Report / DPR" <?php echo ($task->task_category=='Project Report / DPR')? "selected":"" ?>>Project Report / DPR</option>
                                                    <option value="P-Tax & Trade License" <?php echo ($task->task_category=='P-Tax & Trade License')? "selected":"" ?>>P-Tax & Trade License</option>
                                                    <option value="ROC Returns" <?php echo ($task->task_category=='ROC Returns')? "selected":"" ?>>ROC Returns</option>                                                    
                                                    <option value="TDS, PF & ESIC" <?php echo ($task->task_category=='TDS, PF & ESIC')? "selected":"" ?>>TDS, PF & ESIC</option> 
                                                    {{-- <option value="Others" <?php echo ($task->task_category=='Others')? "selected":"" ?>>Others</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Sub-category<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="task_sub_category" id="task_sub_category">
                                                    <option value="">Select Category</option>
                                                    <option value="GST" <?php echo ($task->task_sub_category=='GST')? "selected":"" ?>>GST</option>
                                                    <option value="ROC" <?php echo ($task->task_sub_category=='ROC')? "selected":"" ?>>ROC</option>
                                                    <option value="Other" <?php echo ($task->task_sub_category=='Other')? "selected":"" ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label>Agent Name<span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                            <select class="select form-select" name="agent_id" id="agent_id">
                                                    <option value="">Select Name</option>                                                    
                                                    @foreach($agents as $k=>$val)
                                                            <option value="none" <?php echo ($task->agent_id=='none')? "selected":"" ?>>none</option>
															<option value="{{ $val->id }}" <?php echo ($task->agent_id==$val->id)? "selected":"" ?>>{{ $val->agent_name }}</option>
														
                                                            @endforeach
                                                    

                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Goverment Fees</label>
                                            <input type="text" name="gov_fees" id="gov_fees" value="{{$task->gov_fees}}" class="form-control" placeholder="1500">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Services Charges</label>
                                            <input type="text" name="services_charges" id="services_charges" value="{{$task->services_charges}}" class="form-control" placeholder="500">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Total Amount</label>
                                            <input type="text" name="total_amount" id="total_amount" value="{{$task->total_amount}}" class="form-control" placeholder="2000">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Advance Payment<span class="text-danger"> *</span></label>
                                            <input type="text" name="advance_payment" id="advance_payment" value="{{$task->advance_payment}}" class="form-control" placeholder="Enter Paid Amount">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Due Amount</label>
                                            <input type="text" name="due_amount" id="due_amount" value="{{$task->due_amount}}" class="form-control" placeholder="2000">
                                        </div>
                                    </div>
                                   {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Team<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="task_team" id="task_team">
                                                    <option value="">Select Team</option>
                                                    <option value="ROC" <?php echo ($task->task_team=='ROC')? "selected":"" ?>>ROC</option>
                                                    <option value="GST" <?php echo ($task->task_team=='GST')? "selected":"" ?>>GST</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Employee Name<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                            <select class="select form-select" name="emp_id" id="emp_id">
                                                    <option value="">Select Name</option>                                                    
                                                    @foreach($employees as $k=>$val)
															<option value="{{ $val->id }}" <?php echo ($val->id==$task->emp_id)? "selected":"" ?> >{{ $val->name }}</option>
														@endforeach
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" name="due_date" id="due_date" value="{{$task->due_date}}" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Project Priority<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="project_priority" id="project_priority">
                                                    <option value="">Select Priority</option>
                                                    <option value="High" <?php echo ($task->project_priority=='High')? "selected":"" ?>>High</option>
                                                    <option value="Average" <?php echo ($task->project_priority=='Average')? "selected":"" ?>>Average</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Enter Message</label>
                                            <input type="text" name="message" id="message" value="{{$task->message}}" class="form-control" placeholder="Enter Message About task">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Project Status<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="project_status" id="project_status">
                                                    <option value="1"  <?php echo ($task->project_status==1)? "selected":"" ?>>Pending</option>
                                                    <option value="2"  <?php echo ($task->project_status==2)? "selected":"" ?>>Ongoing</option>
                                                    <option value="3"  <?php echo ($task->project_status==3)? "selected":"" ?>>Completed</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-customer-btns text-end">
                        <a href="{{ url('/task') }}" id="cancel_attaBtn" class="btn customer-btn-cancel">Cancel</a>
                        
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
