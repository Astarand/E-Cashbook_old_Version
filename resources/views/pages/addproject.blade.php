@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Add New Project</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<form action="javascript:void(0);" method="post" name="addProjectFrm" id="addProjectFrm" enctype="multipart/form-data">
					<input type="hidden" name="id" id="projId" value="">
					@csrf
                <div class="card-body">
                    <div class="form-group-item">
                        <h5 class="form-title">Project Details</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Project Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="proj_name" id="proj_name" class="form-control" placeholder="Enter Project Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label> Project Category<span class="text-danger"> *</span></label>
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
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Project Status<span class="text-danger"> *</span></label>
                                    <div class="align-center">
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" class="form-control" name="proj_status" value="2" checked><span class="checkmark"></span> Yet to Start
                                            </label>
                                        </div>
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" name="proj_status" value="3"><span class="checkmark"></span> Ongoing
                                            </label>
                                        </div>
                                        <div class="form-control">
                                            <label class="custom_radio mb-0">
                                                <input type="radio" name="proj_status" value="0"><span class="checkmark"></span> Not Complete
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
                                                                <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Enter Client Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Email<span class="text-danger"> *</span></label>
                                                                <input type="email" name="client_email" id="client_email" class="form-control" placeholder="Enter Client Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Contact Number<span class="text-danger"> *</span></label>
                                                                <input type="text" name="client_contact" id="client_contact" class="form-control" placeholder="Enter Contact Number">
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
                                                                    <input type="Date" name="proj_start_date" id="proj_start_date" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project End Date</label>
                                                                    <input type="Date" name="proj_end_date" id="proj_end_date" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Valuation<span class="text-danger"> *</span></label>
                                                                    <input type="text" name="proj_cost" id="proj_cost" class="form-control" placeholder="Enter Project Cost">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Details<span class="text-danger"> *</span></label>
                                                                    <input type="text" name="proj_details" id="proj_details" class="form-control" placeholder="Enter Project Details">
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
						<button type="submit" class="btn btn-primary">Add Project</button>
					</div>
                </div>
            
				</form>
			</div>
        </div>
    </div>
</div>



@endsection