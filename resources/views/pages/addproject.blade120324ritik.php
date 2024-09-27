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
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Project Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="proj_name" id="proj_name" class="form-control" placeholder="Enter Project Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label> Project Category<span class="text-danger"> *</span></label>
                                    <select class="select form-select" name="project_category" id="project_category">
                                        <option value="0" id="#">Select</option>
                                        <option value="1" id="proj_technology">Technology</option>
                                        <option value="2" id="proj_finance">Finance</option>
                                        <option value="3" id="proj_healthcare">Healthcare</option>
                                        <option value="4" id="proj_energy">Energy</option>
                                        <option value="5" id="proj_manufacturing">Manufacturing</option>
                                        <option value="6" id="proj_retail">Retail</option>
                                        <option value="7" id="proj_cons_good">Consumer Goods</option>
                                        <option value="8" id="proj_logi">Transportation and Logistics</option>
                                        <option value="9" id="proj_real_estate">Real Estate</option>
                                        <option value="10" id="proj_construction">Construction</option>
                                        <option value="11" id="proj_hospitality">Hospitality and Tourism</option>
                                        <option value="12" id="proj_media">Media and Entertainment</option>
                                        <option value="13" id="proj_edu">Education</option>
                                        <option value="14" id="proj_agriculture">Agriculture</option>
                                        <option value="15" id="proj_govt">Government and Public Services</option>
                                        <option value="16" id="proj_prof">Professional Services</option>
                                        <option value="17" id="proj_social">Nonprofit and Social Services</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group"  id="proj_technology" style="display: none">
                                <div class="form-group" >
                                    <label for="technologySelect">Technology</label>
                                    <select class="select form-select" id="technologySelect" name="technologySelect">
                                        <option value="">Software Development</option>
                                        <option value="">Hardware Manufacturing</option>
                                        <option value="">Information Technology Services</option>
                                        <option value="">Internet and e-commerces</option>
                                        <option value="">Telecommunications</option>
                                        <option value="18">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group"  id="proj_finance" style="display: none">
                                <div class="form-group">
                                    <label for="financeSelect">Finance</label>
                                    <select class="select form-select" id="financeSelect" name="financeSelect">
                                        <option value="">Banking</option>
                                        <option value="">Investment Banking</option>
                                        <option value="">Asset Management</option>
                                        <option value="">Insurance</option>
                                        <option value="">Financial Technology (Fintech)</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group"  id="proj_healthcare" style="display: none">
                                <div class="form-group">
                                    <label for="healthcareSelect">Healthcare</label>
                                    <select class="select form-select" id="healthcareSelect" name="healthcareSelect">
                                        <option value="">Pharmaceuticals</option>
                                        <option value="">Biotechnology</option>
                                        <option value="">Medical Devices</option>
                                        <option value="">Healthcare Services</option>
                                        <option value="">HealthTech</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group"  id="proj_healthcare" style="display: none">
                                <div class="form-group">
                                    <label for="healthcareSelect">Healthcare</label>
                                    <select class="select form-select" id="healthcareSelect" name="healthcareSelect">
                                        <option value="">Pharmaceuticals</option>
                                        <option value="">Biotechnology</option>
                                        <option value="">Medical Devices</option>
                                        <option value="">Healthcare Services</option>
                                        <option value="">HealthTech</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group"   id="proj_energy" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Energy</label>
                                    <select class="select form-select" id="healthcareSelect" name="healthcareSelect">
                                        <option value="">Oil and gas</option>
                                        <option value="">Renewable energy (solar, wind, hydroelectric, etc.)</option>
                                        <option value="">Utilities (Electricity, Water, Gas)</option>
                                        <option value="">Energy Services</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group"  id="proj_manufacturing" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Manufacturing</label>
                                    <select class="select form-select" id="healthcareSelect" name="healthcareSelect">
                                        <option value="">Automotive</option>
                                        <option value="">Aerospace and defence</option>
                                        <option value="">Consumer Goods</option>
                                        <option value="">Industrial Machinery</option>
                                        <option value="">Chemicals</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12  project-group"  id="proj_retail" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Retail</label>
                                    <select class="select form-select">
                                        <option value="">General Retail</option>
                                        <option value="">E-commerce and online retail</option>
                                        <option value="">Specialty Retail</option>
                                        <option value="">Wholesale</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12  project-group" id="proj_cons_good" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Consumer Goods</label>
                                    <select class="select form-select">
                                        <option value="">Food and Beverage</option>
                                        <option value="">Personal Care and Cosmetics</option>
                                        <option value="">Apparel and Footwear</option>
                                        <option value="">Household Products</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12  project-group" id="proj_logi" style="display: none">
                                <div class="form-group" >
                                    <label for="energySelect">Transportation and Logistics</label>
                                    <select class="select form-select">
                                        <option value="">Air Transportation</option>
                                        <option value="">Rail Transportation</option>
                                        <option value="">Maritime and Shipping</option>
                                        <option value="">Logistics and Supply Chain</option>
                                        <option value="">Warehousing and Distribution</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12  project-group" id="proj_real_estate" style="display: none">
                                <div class="form-group" >
                                    <label for="energySelect">Real Estate</label>
                                    <select class="select form-select">
                                        <option value="">Residential real estate</option>
                                        <option value="">Commercial real estate</option>
                                        <option value="">Real Estate Development</option>
                                        <option value="">Property Management</option>
                                        <option value="">Real Estate Investment Trusts (REITs)</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_construction" style="display: none">
                                <div class="form-group" >
                                    <label for="energySelect">Construction</label>
                                    <select class="select form-select">
                                        <option value="">Building Construction</option>
                                        <option value="">Infrastructure Development</option>
                                        <option value="">Civil Engineering</option>
                                        <option value="">Architectural Services</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_hospitality" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Hospitality and Tourism</label>
                                    <select class="select form-select">
                                        <option value="">Hotels and Accommodations</option>
                                        <option value="">Travel agencies and tour operators</option>
                                        <option value="">Restaurants and food services</option>
                                        <option value="">Attractions and Entertainment</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_media" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Media and Entertainment</label>
                                    <select class="select form-select">
                                        <option value="">Broadcasting (television, radio)</option>
                                        <option value="">Film Production and Distribution</option>
                                        <option value="">Streaming Services</option>
                                        <option value="">Publishing</option>
                                        <option value="">Gaming and interactive entertainment</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_edu" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Education</label>
                                    <select class="select form-select">
                                        <option value="">Schools and universities</option>
                                        <option value="">E-learning and online education</option>
                                        <option value="">Educational Services</option>
                                        <option value="">Educational Technology (EdTech)</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_agriculture" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Agriculture</label>
                                    <select class="select form-select">
                                        <option value="">Crop Production</option>
                                        <option value="">Livestock Farming</option>
                                        <option value="">Agribusiness</option>
                                        <option value="">Agricultural Technology (AgriTech)</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_govt" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Government and Public Services</label>
                                    <select class="select form-select">
                                        <option value="">Public Administration</option>
                                        <option value="">Defense and security</option>
                                        <option value="">Healthcare Services</option>
                                        <option value="">Education Services</option>
                                        <option value="">Infrastructure Development</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_prof" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Professional Services</label>
                                    <select class="select form-select">
                                        <option value="">Legal Services</option>
                                        <option value="">Accounting and auditing</option>
                                        <option value="">Consulting</option>
                                        <option value="">Human Resources</option>
                                        <option value="">Marketing and advertising</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 project-group" id="proj_social" style="display: none">
                                <div class="form-group">
                                    <label for="energySelect">Nonprofit and Social Services</label>
                                    <select class="select form-select">
                                        <option value="">Charitable Organisations</option>
                                        <option value="">Social Advocacy Groups</option>
                                        <option value="">Foundations</option>
                                        <option value="">NGOs (non-governmental organisations)</option>
                                        <option value="18" id="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 project-group" id="other" style="display: none">
                                <div class="form-group" >
                                    <label for="otherInput">Other</label>
                                    <input type="text" class="form-control" id="otherInput" name="otherInput" placeholder="Enter Other Subcategory">
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-6 col-sm-12"  style="display: none;">
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
                                                                    <label>Project End Date<span class="text-danger"> *</span></label>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const projectCategorySelect = document.getElementById("project_category");
        const projectDivs = document.querySelectorAll(".project-group");

        projectCategorySelect.addEventListener("change", function() {
            const selectedOptionId = this.value;

            // Hide all project divs
            projectDivs.forEach(function(div) {
                div.style.display = "none";
            });

            // Show the selected project div
            const selectedProjectDiv = document.getElementById("proj_" + selectedOptionId);
            if (selectedProjectDiv) {
                selectedProjectDiv.style.display = "block";
            }
        });
    });
</script>

