@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Edit Project</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<form action="javascript:void(0);" method="post" name="addProjectFrm" id="addProjectFrm" enctype="multipart/form-data">
					<input type="hidden" name="id" id="projId" value="{{ $project->id }}">
					@csrf
                <div class="card-body">
                    <div class="form-group-item">
                        <h5 class="form-title">Project Details</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Project Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="proj_name" id="proj_name" value="{{ $project->proj_name}}" class="form-control" placeholder="Enter Project Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label> Project Category<span class="text-danger"> *</span></label>
                                    <div class="form-group">

                                    <select class="select form-select" name="proj_cat" id="proj_cat">
                                        <option>Please Select</div>
                                            <optgroup label="Technology">
                                            <option  value="Software Development" <?php echo ($project->proj_cat=='Software Development')? "selected":"" ?>>Software Development</option>
                                            <option value="Hardware Manufacturing" <?php echo ($project->proj_cat=='Hardware Manufacturing')? "selected":"" ?>>Hardware Manufacturing</option>
                                            <option value="Information Technology Services" <?php echo ($project->proj_cat=='Information Technology Services')? "selected":"" ?>>Information Technology Services</option>
                                            <option value="Internet and e-commerce" <?php echo ($project->proj_cat=='Internet and e-commerce')? "selected":"" ?>>Internet and e-commerce</option>
                                            <option value="Telecommunications" <?php echo ($project->proj_cat=='Telecommunications')? "selected":"" ?>>Telecommunications</option>  
                                            </optgroup>
                                            <optgroup label="Finance">
                                            <option  value="Banking" <?php echo ($project->proj_cat=='Banking')? "selected":"" ?>>Banking</option>
                                            <option value="Investment Banking" <?php echo ($project->proj_cat=='Investment Banking')? "selected":"" ?>>Investment Banking</option>
                                            <option value="Asset Management" <?php echo ($project->proj_cat=='Asset Management')? "selected":"" ?>>Asset Management</option>
                                            <option value="Insurance" <?php echo ($project->proj_cat=='Insurance')? "selected":"" ?>>Insurance</option>
                                            <option value="Financial Technology (Fintech)" <?php echo ($project->proj_cat=='Financial Technology (Fintech)')? "selected":"" ?>>Financial Technology (Fintech)</option>  
                                            </optgroup>
                                            <optgroup label="Healthcare">
                                            <option  value="Pharmaceuticals" <?php echo ($project->proj_cat=='Pharmaceuticals')? "selected":"" ?>>Pharmaceuticals</option>
                                            <option value="Biotechnology" <?php echo ($project->proj_cat=='Biotechnology')? "selected":"" ?>>Biotechnology</option>
                                            <option value="Medical Devices" <?php echo ($project->proj_cat=='Medical Devices')? "selected":"" ?>>Medical Devices</option>
                                            <option value="Healthcare Services" <?php echo ($project->proj_cat=='Healthcare Services')? "selected":"" ?>>Healthcare Services</option>
                                            <option value="HealthTech" <?php echo ($project->proj_cat=='HealthTech')? "selected":"" ?>>HealthTech</option>  
                                            </optgroup>
                                            <optgroup label="Energy">
                                            <option  value="Oil and gas" <?php echo ($project->proj_cat=='Oil and gas')? "selected":"" ?>>Oil and gas</option>
                                            <option value="Renewable energy (solar, wind, hydroelectric, etc.)" <?php echo ($project->proj_cat=='Renewable energy (solar, wind, hydroelectric, etc.)')? "selected":"" ?>>Renewable energy (solar, wind, hydroelectric, etc.)</option>
                                            <option value="Utilities (Electricity, Water, Gas)" <?php echo ($project->proj_cat=='Utilities (Electricity, Water, Gas)')? "selected":"" ?>>Utilities (Electricity, Water, Gas)</option>
                                            <option value="Energy Services" <?php echo ($project->proj_cat=='Energy Services')? "selected":"" ?>>Energy Services</option>                                             
                                            </optgroup>
                                            <optgroup label="Manufacturing">
                                            <option  value="Automotive" <?php echo ($project->proj_cat=='Automotive')? "selected":"" ?>>Automotive</option>
                                            <option value="Aerospace and defence" <?php echo ($project->proj_cat=='Aerospace and defence')? "selected":"" ?>>Aerospace and defence</option>
                                            <option value="Consumer Goods" <?php echo ($project->proj_cat=='Consumer Goods')? "selected":"" ?>>Consumer Goods</option>
                                            <option value="Industrial Machinery" <?php echo ($project->proj_cat=='Industrial Machinery')? "selected":"" ?>>Industrial Machinery</option>
                                            <option value="Chemicals" <?php echo ($project->proj_cat=='Chemicals')? "selected":"" ?>>Chemicals</option>  
                                            </optgroup>
                                            <optgroup label="Retail">
                                            <option  value="General Retail" <?php echo ($project->proj_cat=='General Retail')? "selected":"" ?>>General Retail</option>
                                            <option value="E-commerce and online retail" <?php echo ($project->proj_cat=='E-commerce and online retail')? "selected":"" ?>>E-commerce and online retail</option>
                                            <option value="Specialty Retail" <?php echo ($project->proj_cat=='Specialty Retail')? "selected":"" ?>>Specialty Retail</option>
                                            <option value="Wholesale" <?php echo ($project->proj_cat=='Wholesale')? "selected":"" ?>>Wholesale</option>                                             
                                            </optgroup>
                                            <optgroup label="Consumer Goods">
                                            <option  value="Food and Beverage" <?php echo ($project->proj_cat=='Food and Beverage')? "selected":"" ?>>Food and Beverage</option>
                                            <option value="Personal Care and Cosmetics" <?php echo ($project->proj_cat=='Personal Care and Cosmetics')? "selected":"" ?>>Personal Care and Cosmetics</option>
                                            <option value="Apparel and Footwear" <?php echo ($project->proj_cat=='Apparel and Footwear')? "selected":"" ?>>Apparel and Footwear</option>
                                            <option value="Household Products" <?php echo ($project->proj_cat=='Household Products')? "selected":"" ?>>Household Products</option>                                             
                                            </optgroup>
                                            <optgroup label="Transportation and Logistics">
                                            <option  value="Air Transportation" <?php echo ($project->proj_cat=='Air Transportation')? "selected":"" ?>>Air Transportation</option>
                                            <option value="Rail Transportation" <?php echo ($project->proj_cat=='Rail Transportation')? "selected":"" ?>>Rail Transportation</option>
                                            <option value="Maritime and Shipping" <?php echo ($project->proj_cat=='Maritime and Shipping')? "selected":"" ?>>Maritime and Shipping</option>
                                            <option value="Logistics and Supply Chain" <?php echo ($project->proj_cat=='Logistics and Supply Chain')? "selected":"" ?>>Logistics and Supply Chain</option>
                                            <option value="Warehousing and Distribution" <?php echo ($project->proj_cat=='Warehousing and Distribution')? "selected":"" ?>>Warehousing and Distribution</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Real Estate">
                                            <option  value="Residential real estate" <?php echo ($project->proj_cat=='Residential real estate')? "selected":"" ?>>Residential real estate</option>
                                            <option value="Commercial real estate" <?php echo ($project->proj_cat=='Commercial real estate')? "selected":"" ?>>Commercial real estate</option>
                                            <option value="Real Estate Development" <?php echo ($project->proj_cat=='Real Estate Development')? "selected":"" ?>>Real Estate Development</option>
                                            <option value="Property Management" <?php echo ($project->proj_cat=='Property Management')? "selected":"" ?>>Property Management</option>
                                            <option value="Real Estate Investment Trusts (REITs)" <?php echo ($project->proj_cat=='Real Estate Investment Trusts (REITs)')? "selected":"" ?>>Real Estate Investment Trusts (REITs)</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Construction">
                                            <option  value="Building Construction" <?php echo ($project->proj_cat=='Building Construction')? "selected":"" ?>>Building Construction</option>
                                            <option value="Infrastructure Development" <?php echo ($project->proj_cat=='Infrastructure Development')? "selected":"" ?>>Infrastructure Development</option>
                                            <option value="Civil Engineering" <?php echo ($project->proj_cat=='Civil Engineering')? "selected":"" ?>>Civil Engineering</option>
                                            <option value="Architectural Services" <?php echo ($project->proj_cat=='Architectural Services')? "selected":"" ?>>Architectural Services</option>                                                                                                                                     
                                            </optgroup>
                                            <optgroup label="Hospitality and Tourism">
                                            <option  value="Hotels and Accommodations" <?php echo ($project->proj_cat=='Hotels and Accommodations')? "selected":"" ?>>Hotels and Accommodations</option>
                                            <option value="Travel agencies and tour operators" <?php echo ($project->proj_cat=='Travel agencies and tour operators')? "selected":"" ?>>Travel agencies and tour operators</option>
                                            <option value="Restaurants and food services" <?php echo ($project->proj_cat=='Restaurants and food services')? "selected":"" ?>>Restaurants and food services</option>
                                            <option value="Attractions and Entertainment" <?php echo ($project->proj_cat=='Attractions and Entertainment')? "selected":"" ?>>Attractions and Entertainment</option>                                                                                                                                    
                                            </optgroup>
                                            <optgroup label="Media and Entertainment">
                                            <option  value="Broadcasting (television, radio)" <?php echo ($project->proj_cat=='Broadcasting (television, radio)')? "selected":"" ?>>Broadcasting (television, radio)</option>
                                            <option value="Film Production and Distribution" <?php echo ($project->proj_cat=='Film Production and Distribution')? "selected":"" ?>>Film Production and Distribution</option>
                                            <option value="Streaming Services" <?php echo ($project->proj_cat=='Streaming Services')? "selected":"" ?>>Streaming Services</option>
                                            <option value="Publishing" <?php echo ($project->proj_cat=='Publishing')? "selected":"" ?>>Publishing</option>
                                            <option value="Gaming and interactive entertainment" <?php echo ($project->proj_cat=='Gaming and interactive entertainment')? "selected":"" ?>>Gaming and interactive entertainment</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Education">
                                            <option  value="Schools and universities" <?php echo ($project->proj_cat=='Schools and universities')? "selected":"" ?>>Schools and universities</option>
                                            <option value="E-learning and online education" <?php echo ($project->proj_cat=='E-learning and online education')? "selected":"" ?>>E-learning and online education</option>
                                            <option value="Educational Services" <?php echo ($project->proj_cat=='Educational Services')? "selected":"" ?>>Educational Services</option>
                                            <option value="Educational Technology (EdTech)" <?php echo ($project->proj_cat=='Educational Technology (EdTech)')? "selected":"" ?>>Educational Technology (EdTech)</option>                                                                                                                                   
                                            </optgroup>
                                            <optgroup label="Agriculture">
                                            <option  value="Crop Production" <?php echo ($project->proj_cat=='Crop Production')? "selected":"" ?>>Crop Production</option>
                                            <option value="Livestock Farming" <?php echo ($project->proj_cat=='Livestock Farming')? "selected":"" ?>>Livestock Farming</option>
                                            <option value="Agribusiness" <?php echo ($project->proj_cat=='Agribusiness')? "selected":"" ?>>Agribusiness</option>
                                            <option value="Agricultural Technology (AgriTech)" <?php echo ($project->proj_cat=='Agricultural Technology (AgriTech)')? "selected":"" ?>>Agricultural Technology (AgriTech)</option>                                                                                  
                                            </optgroup>
                                            <optgroup label="Government and Public Services">
                                            <option  value="Public Administration" <?php echo ($project->proj_cat=='Public Administration')? "selected":"" ?>>Public Administration</option>
                                            <option value="Defense and security" <?php echo ($project->proj_cat=='Defense and security')? "selected":"" ?>>Defense and security</option>
                                            <option value="Healthcare Services" <?php echo ($project->proj_cat=='Healthcare Services')? "selected":"" ?>>Healthcare Services</option>
                                            <option value="Education Services" <?php echo ($project->proj_cat=='Education Services')? "selected":"" ?>>Education Services</option>
                                            <option value="Infrastructure Development" <?php echo ($project->proj_cat=='Infrastructure Development')? "selected":"" ?>>Infrastructure Development</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Professional Services">
                                            <option  value="Legal Services" <?php echo ($project->proj_cat=='Legal Services')? "selected":"" ?>>Legal Services</option>
                                            <option value="Accounting and auditing" <?php echo ($project->proj_cat=='Accounting and auditing')? "selected":"" ?>>Accounting and auditing</option>
                                            <option value="Consulting" <?php echo ($project->proj_cat=='Consulting')? "selected":"" ?>>Consulting</option>
                                            <option value="Human Resources" <?php echo ($project->proj_cat=='Human Resources')? "selected":"" ?>>Human Resources</option>
                                            <option value="Marketing and advertising" <?php echo ($project->proj_cat=='Marketing and advertising')? "selected":"" ?>>Marketing and advertising</option>                                                                                         
                                            </optgroup>
                                            <optgroup label="Nonprofit and Social Services">
                                            <option  value="Charitable Organisations" <?php echo ($project->proj_cat=='Charitable Organisations')? "selected":"" ?>>Charitable Organisations</option>
                                            <option value="Social Advocacy Groups" <?php echo ($project->proj_cat=='Social Advocacy Groups')? "selected":"" ?>>Social Advocacy Groups</option>
                                            <option value="Foundations" <?php echo ($project->proj_cat=='Foundations')? "selected":"" ?>>Foundations</option>
                                            <option value="NGOs (non-governmental organisations)" <?php echo ($project->proj_cat=='NGOs (non-governmental organisations)')? "selected":"" ?>>NGOs (non-governmental organisations)</option>                                                                               
                                            </optgroup>
                                            <optgroup label="Other ">
                                            <option  value="Other" <?php echo ($project->proj_cat=='Other')? "selected":"" ?>>Other </option>                                                    
                                            </optgroup>
                                            
                                        </select>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Project Status<span class="text-danger"> *</span></label>
                                    <div class="align-center">
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" class="form-control" name="proj_status" value="2" <?php echo ($project->proj_status=='1')? "checked":"" ?>><span class="checkmark"></span> Yet to Start
                                            </label>
                                        </div>
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" name="proj_status" value="3" <?php echo ($project->proj_status=='2')? "checked":"" ?>><span class="checkmark"></span> Ongoing
                                            </label>
                                        </div>
                                        <div class="form-control">
                                            <label class="custom_radio mb-0">
                                                <input type="radio" name="proj_status" value="0" <?php echo ($project->proj_status=='3')? "checked":"" ?>><span class="checkmark"></span> Not Complete
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <li class="nav-item">
                                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        <strong>Client Details</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        <strong>Project Details</strong>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="home-b1">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Name<span class="text-danger"> *</span></label>
                                                                <input type="text" name="client_name" id="client_name" value="{{ $project->client_name}}" class="form-control" placeholder="Enter Client Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Email<span class="text-danger"> *</span></label>
                                                                <input type="email" name="client_email" id="client_email" value="{{ $project->client_email}}" class="form-control" placeholder="Enter Client Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Contact Number<span class="text-danger"> *</span></label>
                                                                <input type="text" name="client_contact" id="client_contact" value="{{ $project->client_contact}}" class="form-control" placeholder="Enter Contact Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile-b1">
                                                    <div class="form-group-item">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Start Date<span class="text-danger"> *</span></label>
                                                                    <input type="Date" name="proj_start_date" id="proj_start_date" value="{{ $project->proj_start_date}}" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project End Date</label>
                                                                    <input type="Date" name="proj_end_date" id="proj_end_date" value="{{ $project->proj_end_date}}" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Valuation<span class="text-danger"> *</span></label>
                                                                    <input type="text" name="proj_cost" id="proj_cost" value="{{ $project->proj_cost}}" class="form-control" placeholder="Enter Project Cost">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Details<span class="text-danger"> *</span></label>
                                                                    <input type="text" name="proj_details" id="proj_details" value="{{ $project->proj_details}}" class="form-control" placeholder="Enter Project Details">
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
					<div id="addProjectLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
						<a href="{{ url('/projects') }}" class="btn btn-primary cancel me-2">Cancel</a>
						<button type="submit" class="btn btn-primary">Edit Project</button>
					</div>
                </div>
            
				</form>
			</div>
        </div>
    </div>
</div>



@endsection