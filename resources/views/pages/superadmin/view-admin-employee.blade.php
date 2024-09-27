@extends('layouts.default')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>View Admin Employee</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<form action="javascript:void(0);" method="post" name="addAdminEmployeeFrm" id="addAdminEmployeeFrm" enctype="multipart/form-data">
				<input type="hidden" name="id" id="empId" value="{{ $employee->empId }}">
                @csrf
                <div class="card-body">
                    <div class="form-group-item">
                        <h5 class="form-title">Basic Details</h5>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control" placeholder="Enter Employee Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Phone Number<span class="text-danger"> *</span></label>
                                    <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" class="form-control" placeholder="Enter Employee Contact Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Employee Email <span class="text-danger">*</span></label>
                                    <input type="email" readonly name="email" id="email" value="{{ $employee->email }}" class="form-control" placeholder="Enter Employee Email">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Create Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Create Login Password">
                                        <span class="input-group-text" data-toggle="popover" data-placement="top" data-html="true">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Comfirm Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="conf_password" id="passwordInput" class="form-control" placeholder="Create Login Password">
                                        <a href="#" class="input-group-text" id="showPasswordBtn">
                                            <i id="passwordIcon" class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Depertment<span class="text-danger">*</span></label>
                                    <ul class="form-group-plus css-equal-heights">
                                        <li>
                                            <div class="form-group">
                                                <select class="select form-select" name="dept_id" id="dept_id"  >
                                                    <option value="">Select Depertment</option>
                                                    @foreach($depts as $k=>$dept)
														<option value="{{ $dept->id }}" <?php echo ($dept->id==$employee->dept_id)? "selected":"" ?>>{{ $dept->dept_name }}</option>
													@endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn btn-primary form-plus-btn" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#depertment">
                                            <i class="fe fe-plus-circle"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Designation<span class="text-danger">*</span></label>
                                    <ul class="form-group-plus css-equal-heights">
                                        <li>
                                            <div class="form-group">
                                                <select class="select form-select" name="desig_id" id="desig_id">
                                                    <option value="">Select Designation</option>
													@foreach($desigs as $k=>$desig)
														<option value="{{ $desig->id }}" <?php echo ($desig->id==$employee->desig_id)? "selected":"" ?>>{{ $desig->designation_name }}</option>
													@endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn btn-primary form-plus-btn" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#designation">
                                            <i class="fe fe-plus-circle"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <li class="nav-item">
                                                    <a href="#personal" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        <strong>Personal Details</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#salary" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        <strong>Salary Details</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#permission" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        <strong>Set Employee Permission</strong>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="personal">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Employee DOB<span class="text-danger"> *</span></label>
                                                                <input type="date" name="dob" id="dob" value="{{ $employee->dob }}" class="form-control" placeholder="Enter Employee DOB">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Gander<span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <select class="select form-select" name="gender" id="gender">
                                                                        <option value="">Select Gander</option>
                                                                        <option  value="Male" <?php echo ($employee->gender=='Male')? "selected":"" ?>>Male</option>
                                                                        <option  value="Female" <?php echo ($employee->gender=='Female')? "selected":"" ?>>Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Highest Qualification<span class="text-danger"> *</span></label>
                                                                <input type="text" name="qualification" id="qualification" value="{{ $employee->qualification }}" class="form-control" placeholder="Enter Highest Qualification">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="billing-btn mb-1">
                                                                <h5 class="form-title">Current Address</h5>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1</label>
                                                                <input type="text" name="c_addr_lineone" id="cust_bill_addone" value="{{ $employee->c_addr_lineone }}" class="form-control" placeholder="Enter Address 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2</label>
                                                                <input type="text" name="c_addr_linetwo" id="cust_bill_addtwo" value="{{ $employee->c_addr_linetwo }}" class="form-control" placeholder="Enter Address 2">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <select class="form-control select-style" name="c_emp_country" id="country" onChange="changeCountry(this);">
																			<option value="">Select Country</option>
																			@foreach($countries as $k=>$country)
																			<option value="{{ $country->id }}" <?php echo ($country->id==$employee->c_emp_country)? "selected":"" ?>>{{ $country->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <select class="form-control select-style" name="c_emp_city" id="city">
																			<option value="">Select City</option>
																			@foreach($c_cities as $k=>$city)
																				<option value="{{ $city->id }}" <?php echo ($city->id==$employee->c_emp_city)? 'selected="selected"':"" ?>>{{ $city->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>State</label>
                                                                        <select class="form-control select-style" name="c_emp_state" id="state" onChange="changeState(this);">
																			<option value="">Select State</option>
																			@foreach($c_states as $k=>$state)
																				<option value="{{ $state->id }}" <?php echo ($state->id==$employee->c_emp_state)? "selected":"" ?>>{{ $state->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pincode</label>
                                                                        <input type="text" name="c_emp_pincode" id="cust_bill_pin" value="{{ $employee->c_emp_pincode }}" class="form-control" placeholder="Enter Pincode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="billing-btn mb-1">
                                                                <h5 class="form-title">Parmanent Address</h5>
                                                                <a href="javascript:void(0);" class="btn btn-primary" onclick="copyBillAddr()">Same as Current Address</a>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1</label>
                                                                <input type="text" name="p_addr_lineone" id="cust_ship_addone" value="{{ $employee->p_addr_lineone }}" class="form-control" placeholder="Enter Address 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2</label>
                                                                <input type="text" name="p_addr_linetwo" id="cust_ship_addtwo" value="{{ $employee->p_addr_linetwo }}" class="form-control" placeholder="Enter Address 2">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <select class="form-control select-style" name="p_emp_country" id="country_ship" onChange="changeCountry_ship(this);">
																			<option value="">Select Country</option>
																			@foreach($countries as $k=>$country)
																			<option value="{{ $country->id }}" <?php echo ($country->id==$employee->p_emp_country)? "selected":"" ?>>{{ $country->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <select class="form-control select-style" name="p_emp_city" id="city_ship">
																			<option value="">Select City</option>
																			@foreach($p_cities as $k=>$city)
																				<option value="{{ $city->id }}" <?php echo ($city->id==$employee->p_emp_city)? "selected":"" ?>>{{ $city->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>State</label>
                                                                        <select class="form-control select-style" name="p_emp_state" id="state_ship" onChange="changeState_ship(this);">
																			<option value="">Select State</option>
																			@foreach($p_states as $k=>$state)
																				<option value="{{ $state->id }}" <?php echo ($state->id==$employee->p_emp_state)? "selected":"" ?>>{{ $state->name }}</option>
																			@endforeach
																		</select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pincode</label>
                                                                        <input type="text" name="p_emp_pincode" id="cust_ship_pin" value="{{ $employee->p_emp_pincode }}" class="form-control" placeholder="Enter Pincode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="salary">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Employee Basic Salary<span class="text-danger"> *</span></label>
                                                                <input type="text" name="basic_sal" id="basic_sal" value="{{ $employee->basic_sal }}"  class="form-control" placeholder="Enter Employee Basic Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>HRA<span class="text-danger"> *</span></label>
                                                                <input type="text" name="hra" id="hra" value="{{ $employee->hra }}" class="form-control" placeholder="Enter HRA">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Convayance<span class="text-danger"> *</span></label>
                                                                <input type="text" name="convayance" value="{{ $employee->convayance }}" id="convayance" class="form-control" placeholder="Enter Convayance">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Special Bonus<span class="text-danger"> *</span></label>
                                                                <input type="text" name="special_bonus" value="{{ $employee->special_bonus }}" id="special_bonus" class="form-control" placeholder="Enter Special Bonus">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Providant Faund<span class="text-danger"> *</span></label>
                                                                <input type="text" name="provident_fund" value="{{ $employee->provident_fund }}" id="provident_fund" class="form-control" placeholder="Enter Providant Faund">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>ESI<span class="text-danger"> *</span></label>
                                                                <input type="text" name="esi" id="esi" value="{{ $employee->esi }}" class="form-control" placeholder="Enter ESI">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Loan<span class="text-danger"> *</span></label>
                                                                <input type="text" name="loan" id="loan" value="{{ $employee->loan }}" class="form-control" placeholder="Enter Loan">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Professional Tax<span class="text-danger"> *</span></label>
                                                                <input type="text" name="ptax" id="ptax" value="{{ $employee->ptax }}" class="form-control" placeholder="Enter Professional Tax">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>TSD / IT<span class="text-danger"> *</span></label>
                                                                <input type="text" name="tds" id="tds" value="{{ $employee->tds }}" class="form-control" placeholder="Enter TSD /IT">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Total Deduction<span class="text-danger"> *</span></label>
                                                                <input type="text" name="total_deduction" id="total_deduction" value="{{ $employee->total_deduction }}" class="form-control" placeholder="Enter Total Deduction">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Total Addition<span class="text-danger"> *</span></label>
                                                                <input type="text" name="total_addition" id="total_addition" value="{{ $employee->total_addition }}" class="form-control" placeholder="Total Addition">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Net Salary<span class="text-danger"> *</span></label>
                                                                <input type="text" name="net_sal" id="net_sal" value="{{ $employee->net_sal }}" class="form-control" placeholder="Enter Net Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Net Salary in Word<span class="text-danger"> *</span></label>
                                                                <input type="text" name="net_sal_word" id="net_sal_word" value="{{ $employee->net_sal_word }}" class="form-control" placeholder="Enter Net Salary in word">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
													$permission = isset($employee->emp_permission)?$employee->emp_permission:"";
													$permission = explode(',', $permission);
												?>
												<div class="tab-pane" id="permission">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <div class="align-center">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="CA_Management" <?php if (in_array('CA_Management', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> CA Management
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Customer_Management" <?php if (in_array('Customer_Management', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Customer Management
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Requested_CA" <?php if (in_array('Requested_CA', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Requested CA
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Our_CA" <?php if (in_array('Our_CA', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Our CA
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Employee_Management" <?php if (in_array('Employee_Management', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Employee Management
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Package Management</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Subscribers" <?php if (in_array('Subscribers', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Subscribers
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="form-control">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Plan" <?php if (in_array('Plan', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Plan
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="pb-3">Ticket Management</h6>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="Customer_Tickets" <?php if (in_array('Customer_Tickets', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> Customer Tickets
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="form-control me-3">
                                                                        <label class="custom_checkbox mb-0">
                                                                            <input type="checkbox" name="emp_permission[]" value="CA_Tickets" <?php if (in_array('CA_Tickets', $permission)) { echo 'checked="checked"'; }?>><span class="checkmark"></span> CA Tickets
                                                                        </label>
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
                    </div>
                   
					<div class="message-container"></div>
					<div id="addBankLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
					   <a href="{{ url('/admin-employee') }}" class="btn btn-primary cancel me-2">Cancel</a>
					</div>
                    
                </div>
				</form>
            </div>
        </div>
    </div>
</div>






@endsection
