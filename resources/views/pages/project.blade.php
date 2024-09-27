@extends('layouts.default')

@section('content')

<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Project(s)</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Share"><i class="fa-brands fa-whatsapp"></i></span> </a>
                            </li>
                            <li>
                                <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                    <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="d-block">
                                        <li>
                                            <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-pdf me-2"></i>PDF</a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-text me-2"></i>Excel</a>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
                            </li>
							@if (Auth::user()->u_type == 2)
                            <li>
                                <a class="btn btn-primary" href="{{ url('/addproject') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add New Project</a>
                            </li>
							@endif
                        </ul>
                    </div>
                </div>
            </div>
            <div id="filter_inputs" class="card filter-card">
                <div class="card-body pb-0">
                    <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Project Name">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Client Name">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                <select class="select form-select" name="proj_cat" id="proj_cat">
                                        <option>Please Select</div>
                                            <optgroup label="Technology">
                                            <option  value="Software Development">Software Development</option>
                                            <option value="Hardware Manufacturing">Hardware Manufacturing</option>
                                            <option value="Information Technology Services">Information Technology Services</option>
                                            <option value="Internet and e-commerce">Internet and e-commerce</option>
                                            <option value="Telecommunications">Telecommunications</option>  
                                            </optgroup>
                                            <optgroup label="Finance">
                                            <option  value="Banking6">Banking</option>
                                            <option value="Investment Banking">Investment Banking</option>
                                            <option value="Asset Management">Asset Management</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Financial Technology (Fintech)">Financial Technology (Fintech)</option>  
                                            </optgroup>
                                            <optgroup label="Healthcare">
                                            <option  value="Pharmaceuticals">Pharmaceuticals</option>
                                            <option value="Biotechnology">Biotechnology</option>
                                            <option value="Medical Devices">Medical Devices</option>
                                            <option value="Healthcare Services">Healthcare Services</option>
                                            <option value="HealthTech">HealthTech</option>  
                                            </optgroup>
                                            <optgroup label="Energy">
                                            <option  value="Oil and gas">Oil and gas</option>
                                            <option value="Renewable energy (solar, wind, hydroelectric, etc.)">Renewable energy (solar, wind, hydroelectric, etc.)</option>
                                            <option value="Utilities (Electricity, Water, Gas)">Utilities (Electricity, Water, Gas)</option>
                                            <option value="Energy Services">Energy Services</option>                                             
                                            </optgroup>
                                            <optgroup label="Manufacturing">
                                            <option  value="Automotive">Automotive</option>
                                            <option value="Aerospace and defence">Aerospace and defence</option>
                                            <option value="Consumer Goods">Consumer Goods</option>
                                            <option value="Industrial Machinery">Industrial Machinery</option>
                                            <option value="Chemicals">Chemicals</option>  
                                            </optgroup>
                                            <optgroup label="Retail">
                                            <option  value="General Retail">General Retail</option>
                                            <option value="E-commerce and online retail">E-commerce and online retail</option>
                                            <option value="Specialty Retail">Specialty Retail</option>
                                            <option value="Wholesale">Wholesale</option>                                             
                                            </optgroup>
                                            <optgroup label="Consumer Goods">
                                            <option  value="Food and Beverage">Food and Beverage</option>
                                            <option value="Personal Care and Cosmetics">Personal Care and Cosmetics</option>
                                            <option value="Apparel and Footwear">Apparel and Footwear</option>
                                            <option value="Household Products">Household Products</option>                                             
                                            </optgroup>
                                            <optgroup label="Transportation and Logistics">
                                            <option  value="Air Transportation">Air Transportation</option>
                                            <option value="Rail Transportation">Rail Transportation</option>
                                            <option value="Maritime and Shipping">Maritime and Shipping</option>
                                            <option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
                                            <option value="Warehousing and Distribution">Warehousing and Distribution</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Real Estate">
                                            <option  value="Residential real estate">Residential real estate</option>
                                            <option value="Commercial real estate">Commercial real estate</option>
                                            <option value="Real Estate Development">Real Estate Development</option>
                                            <option value="Property Management">Property Management</option>
                                            <option value="Real Estate Investment Trusts (REITs)">Real Estate Investment Trusts (REITs)</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Construction">
                                            <option  value="Building Construction">Building Construction</option>
                                            <option value="Infrastructure Development">Infrastructure Development</option>
                                            <option value="Civil Engineering">Civil Engineering</option>
                                            <option value="Architectural Services">Architectural Services</option>                                                                                                                                     
                                            </optgroup>
                                            <optgroup label="Hospitality and Tourism">
                                            <option  value="Hotels and Accommodations">Hotels and Accommodations</option>
                                            <option value="Travel agencies and tour operators">Travel agencies and tour operators</option>
                                            <option value="Restaurants and food services">Restaurants and food services</option>
                                            <option value="Attractions and Entertainment">Attractions and Entertainment</option>                                                                                                                                    
                                            </optgroup>
                                            <optgroup label="Media and Entertainment">
                                            <option  value="Broadcasting (television, radio)">Broadcasting (television, radio)</option>
                                            <option value="Film Production and Distribution">Film Production and Distribution</option>
                                            <option value="Streaming Services">Streaming Services</option>
                                            <option value="Publishing">Publishing</option>
                                            <option value="Gaming and interactive entertainment">Gaming and interactive entertainment</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Education">
                                            <option  value="Schools and universities">Schools and universities</option>
                                            <option value="E-learning and online education">E-learning and online education</option>
                                            <option value="Educational Services">Educational Services</option>
                                            <option value="Educational Technology (EdTech)">Educational Technology (EdTech)</option>                                                                                                                                   
                                            </optgroup>
                                            <optgroup label="Agriculture">
                                            <option  value="Crop Production">Crop Production</option>
                                            <option value="Livestock Farming">Livestock Farming</option>
                                            <option value="Agribusiness">Agribusiness</option>
                                            <option value="Agricultural Technology (AgriTech)">Agricultural Technology (AgriTech)</option>                                                                                  
                                            </optgroup>
                                            <optgroup label="Government and Public Services">
                                            <option  value="Public Administration">Public Administration</option>
                                            <option value="Defense and security">Defense and security</option>
                                            <option value="Healthcare Services">Healthcare Services</option>
                                            <option value="Education Services">Education Services</option>
                                            <option value="Infrastructure Development">Infrastructure Development</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Professional Services">
                                            <option  value="Legal Services">Legal Services</option>
                                            <option value="Accounting and auditing">Accounting and auditing</option>
                                            <option value="Consulting">Consulting</option>
                                            <option value="Human Resources">Human Resources</option>
                                            <option value="Marketing and advertising">Marketing and advertising</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Nonprofit and Social Services">
                                            <option  value="Charitable Organisations">Charitable Organisations</option>
                                            <option value="Social Advocacy Groups">Social Advocacy Groups</option>
                                            <option value="Foundations">Foundations</option>
                                            <option value="NGOs (non-governmental organisations)">NGOs (non-governmental organisations)</option>                                                                               
                                            </optgroup>
                                            <optgroup label="Other ">
                                            <option  value="Other">Other </option>                                                    
                                            </optgroup>
                                            
                                        </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-primary w-100" style="padding: 9px 25px;">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-center table-hover datatable">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Company Name</th>
                                                    <th>Project Name</th>
                                                    <th>Project Category</th>
                                                    <th>Client Information</th>
                                                    <th>Phone</th>
                                                    <th>Project Cost</th>
                                                    <th>Create Date</th>
                                                    <th>Dead Line</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
												<?php $i = 1; ?>
												@foreach ($projects as $project)
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
													<td>{{ $project->comp_name }}</td>
                                                    <td>{{ $project->proj_name }}</td>
                                                    <td>
														@if ($project->proj_cat ==1)
															Web Designer
														@elseif ($project->proj_cat ==2)
															Web Developer
														@elseif ($project->proj_cat ==3)
															App Developer
														@endif
													</td>
                                                    <td>
                                                        {{ $project->client_name }}
                                                    </td>
                                                    <td>{{ $project->client_contact }}</td>
                                                    <td>₹{{ $project->proj_cost }}</td>
                                                    <td>{{ $project->proj_start_date }}</td>
                                                    <td>{{ $project->proj_end_date }}</td>
                                                    <td>
														@if ($project->proj_status ==2)
														<span class="badge badge-pill bg-danger-light">Not-Started</span>
														@elseif ($project->proj_status ==3)
														<span class="badge badge-pill bg-warning">Ongoing</span>
														@elseif ($project->proj_status ==0)
														<span class="badge badge-pill bg-danger">Not Completed</span>
														@elseif ($project->proj_status ==1)
														<span class="badge badge-pill bg-success-light">Complete</span>
														@endif
													</td>
                                                    <td class="d-flex align-items-center">
                                                        <a href="{{ url('/sales-invoice') }}" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
																@if ( (Auth::user()->u_type == 2 || Auth::user()->u_type == 3) && $project->proj_status !=1)
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ url('/edit-project/'.base64_encode($project->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                                </li>
																@endif
																
																@if ( (Auth::user()->u_type == 2 || Auth::user()->u_type == 3) && $project->proj_status !=1)
                                                                <li>
                                                                    <a class="dropdown-item projectdelete" href="javascript:void(0);" data-id="{{$project->id}}" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                                </li>
																@endif
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ url('/view-project/'.base64_encode($project->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                                </li>
                                                                @if ( (Auth::user()->u_type == 2 || Auth::user()->u_type == 3) && $project->proj_status !=1)
																<li>
																	<a data-id="{{$project->id}}" data-stat="1" class="dropdown-item proj_active" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Completed</a>
																</li>
																@endif
																
                                                            </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
												@endforeach
                                                    
                                                
                                                </tbody>
                                            </table>
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

    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Filter</h5>
                <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
            </div>
            <div class="sidebar-body">
                <form action="#" autocomplete="off">
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Customer Name
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="assets/img/icons/search.svg" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Email Address
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="assets/img/icons/search.svg" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Phone Number
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="assets/img/icons/search.svg" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                By Status
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> All Status
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Activate
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Deactivate
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-buttons">
                        <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
                        Apply
                        </button>
                        <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
                        Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                    <h3>Delete Customer</h3>
                    <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <button type="reset" data-bs-dismiss="modal" id="del_project" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection