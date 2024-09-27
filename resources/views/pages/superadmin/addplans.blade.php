@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="content-page-header">
                <h5>Add New Subscription</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
					<form action="javascript:void(0);" method="post" name="addPlanFrm" id="addPlanFrm" enctype="multipart/form-data">
					<input type="hidden" name="id" id="planId" value="">
					@csrf
                    <div class="card-body">
                        <div class="form-group-add">
                            <h5 class="form-title">Plan</h5>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Plan Name</label>
                                        <input type="text" name="plan_name" id="plan_name" class="form-control" placeholder="Enter Plan Name">
                                    </div>
                                </div>
								<div class="col-lg-4 col-md-4 col-sm-12">
									<label>Plan Type</label>
									<div class="form-group">
										<select class="select form-select" name="plan_type" id="plan_type">
											<option value="">select</option>
											<option value="Monthly">Monthly</option>
											<option value="Yearly">Yearly</option>
										</select>
									</div>
								</div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Monthly Price</label>
                                        <input type="text" name="monthly_price" id="monthly_price" value="0" class="form-control" placeholder="Enter Plan Price">
                                        <span class="me-2"><i class="fe fe-alert-circle"></i></span><span>Set 0 for free</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Yearly Price</label>
                                        <input type="text" name="yearly_price" id="yearly_price" value="0" class="form-control" placeholder="Yearly Price">
                                        <span class="me-2"><i class="fe fe-alert-circle"></i></span><span>Set 0 for free</span>
                                    </div>
                                </div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-12 description-box">
									<div class="form-group">
										<label class="form-control-label">Plan Descriptions</label>
										<textarea class="summernote form-control" name="plan_desc" id="plan_desc" placeholder="Plan Description" rows="5"></textarea>
									</div>
								</div>
                            </div>
                        </div>
                        <div class="form-group-add">
                            <h5 class="form-title">Plan Settings</h5>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Services</label>
                                        <div class="align-center">
                                            <input type="number" name="service" id="service" class="form-control" placeholder="1-100">
                                            <div class="status-toggle">
                                                <input id="rating_1" name="service_status" class="check" type="checkbox" checked>
                                                <label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
                                            </div>
                                        </div>
                                        <span>
                                        <label class="custom_check">
                                        <input type="checkbox" name="service_unlimited">
                                        <span class="checkmark"></span>
                                        </label>
                                        </span>
                                        <span>Unlimited</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Appointments</label>
                                        <div class="align-center">
                                            <input type="number" name="appointment" class="form-control" placeholder="1-100">
                                            <div class="status-toggle">
                                                <input id="rating_2" name="appointment_status" class="check" type="checkbox" checked>
                                                <label for="rating_2" class="checktoggle checkbox-bg">checkbox</label>
                                            </div>
                                        </div>
                                        <span>
                                        <label class="custom_check">
                                        <input type="checkbox" name="appointment_unlimited">
                                        <span class="checkmark"></span>
                                        <span>Unlimited</span>
                                        </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Staffs</label>
                                        <div class="align-center">
                                            <input type="number" name="staffs" class="form-control" placeholder="1-100">
                                            <div class="status-toggle">
                                                <input id="rating_3" name="staffs_status" class="check" type="checkbox" checked>
                                                <label for="rating_3" class="checktoggle checkbox-bg">checkbox</label>
                                            </div>
                                        </div>
                                        <span>
                                        <label class="custom_check">
                                        <input type="checkbox" name="staffs_unlimited">
                                        <span class="checkmark"></span>
                                        <span>Unlimited</span>
                                        </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Gallery</label>
                                        <div class="align-center">
                                            <input type="number" name="gallery" class="form-control" placeholder="1-100">
                                            <div class="status-toggle">
                                                <input id="rating_4" name="gallery_status" class="check" type="checkbox" checked>
                                                <label for="rating_4" class="checktoggle checkbox-bg">checkbox</label>
                                            </div>
                                        </div>
                                        <span>
                                        <label class="custom_check">
                                        <input type="checkbox" name="gallery_unlimited">
                                        <span class="checkmark"></span>
                                        <span>Unlimited</span>
                                        </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Additional Service</label>
                                        <div class="align-center">
                                            <input type="number" name="additional" class="form-control" placeholder="1-100">
                                            <div class="status-toggle">
                                                <input id="rating_5" name="additional_status" class="check" type="checkbox" checked>
                                                <label for="rating_5" class="checktoggle checkbox-bg">checkbox</label>
                                            </div>
                                        </div>
                                        <span>
                                        <label class="custom_check">
                                        <input type="checkbox" name="additional_unlimited">
                                        <span class="checkmark"></span>
                                        <span>Unlimited</span>
                                        </label>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!--<div class="text-end mt-4">
                            <button type="reset" class="btn btn-primary cancel me-2">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>-->
						<div class="message-container"></div>
						<div id="addPlanLoader" class="loader"></div>
						<div class="add-customer-btns text-end">
						   <a href="{{ url('/plans') }}" class="btn btn-primary cancel me-2">Cancel</a>
							<button type="submit" class="btn btn-primary">Add Plan</button>
						</div>
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
@endsection