@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add New Task</h5>
                </div>
            </div>
            <?php
                date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
               
            ?>

            <div class="row">
                <div class="col-md-12">
                    <form action="javascript:void(0);" method="post" name="addTaskFrm" id="addTaskFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="taskId" value="">
                        @csrf
                        <div class="card-body">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Date</label>
                                            <input type="text" name="task_date" id="task_date" value="<?php  echo date("Y-m-d")?>" readonly class="form-control"  placeholder="Date will auto fetch by create time">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Time</label>
                                            <input type="text" name="task_time" id="task_time" value="<?php  echo date("H:i:s")?>" readonly class="form-control"  placeholder="time will auto fetch by create time">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Name <span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                            <select class="select form-select" name="company_id" id="company_id">
                                                    <option value="">Select Name</option>                                                    
                                                                                                       
                                                    @foreach($company as $k=>$val)
															<option value="{{ $val->id }}" >{{ $val->name }}</option>
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
                                    {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Sub-category<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="task_sub_category" id="task_sub_category">
                                                    <option value="">Select Category</option>
                                                    <option value="GST">GST</option>
                                                    <option value="ROC">ROC</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label>Agent Name<span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                            <select class="select form-select" name="agent_id" id="agent_id">
                                                    <option value="">Select Name</option>  
                                                    <option value="none" selected>None</option>                                                   
                                                    @foreach($agents as $k=>$val)
															<option value="{{ $val->id }}" >{{ $val->agent_name }}</option>
														@endforeach
                                                    

                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Goverment Fees</label>
                                            <input type="text" name="gov_fees" id="gov_fees" class="form-control" value="0" readonly >
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Services Charges <span class="text-danger"> *</span></label>
                                            <input type="text" required name="services_charges" id="services_charges" value="" class="form-control" readonly >
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Total Amount</label>
                                            <input type="text" name="total_amount" id="total_amount" class="form-control" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Advance Payment<span class="text-danger"> *</span></label>
                                            <input type="text" name="advance_payment" id="advance_payment" value="0" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Due Amount</label>
                                            <input type="text" name="due_amount" id="due_amount" class="form-control" value="0">
                                        </div>
                                    </div>
                                   {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Task Team<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="task_team" id="task_team">
                                                    <option value="">Select Team</option>
                                                    <option value="ROC">ROC</option>
                                                    <option value="ROC">GST</option>
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
															<option value="{{ $val->id }}" >{{ $val->name }}</option>
														@endforeach
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" name="due_date" id="due_date" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Project Priority<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="project_priority" id="project_priority">
                                                    <option value="">Select Priority</option>
                                                    <option value="High">High</option>
                                                    <option value="Average">Average</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Enter Message</label>
                                            <input type="text" name="message" id="message" class="form-control" placeholder="Enter Message About task">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Project Status<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <select class="select form-select" name="project_status" id="project_status">
                                                    <option value="1">Pending</option>
                                                    <option value="2">Ongoing</option>
                                                    <option value="3">Completed</option>

                                                </select>
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
<script>
var numOne = document.getElementById("total_amount");
var numTwo = document.getElementById("advance_payment");
var addSum = document. getElementById("due_amount");

numOne.addEventListener("input", add);
numTwo.addEventListener("input", add);

function add(){
    alert('Hi');
  var one = Number(numOne.value) || 0;
  var two = Number(numTwo.value) || 0;
  var sum = Number(one-two);
  addSum.innerHTML =  sum;
}
</script>