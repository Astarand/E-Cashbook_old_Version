@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
					<form action="javascript:void(0);" method="post" name="setReminderFrm" id="setReminderFrm" enctype="multipart/form-data">
					@csrf
                    <div class="form-group-bank">
                        <div class="row align-items-center-center">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Reminder Type</label>
                                    <select name="reminder_type" id="reminder_type" class="form-select" aria-label="Default select example">
                                        <option value=""> Select </option>
                                        <option value="bulk">Bulk</option>
                                        <option value="specific">Specific</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="user_type" id="user_type" onChange="getUserOptions(this);" class="form-select " aria-label="Default select example">
                                        <option value=""> Select </option>
                                        <option value="1">CA</option>
                                        <option value="2">Customer</option>
                                        <!--<option value="3">Others</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Customer Type</label>
                                    <select name="customer_type" id="customer_type" onChange="getUserOptionsByStatus(this);" class="form-select " aria-label="Default select example">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Reminder Through</label>
                                    <select name="reminder_through" id="reminder_through" class="form-select " aria-label="Default select example">
                                        <option value=""> Select </option>
                                        <option value="mail">Mail</option>
                                        <option value="whatsapp">Whatsapp</option>
                                        <option value="notification">Notification</option>
                                        <option value="sms">SMS</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body card-buttons">
                                        <p>List Of Companies / CA</p>
                                        <select name="userId[]" id="userId" class="form-control form-small select tagging" multiple="multiple">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-xl-12 col-lg-6 col-md-6 col-12 mb-4">
                                    <input type="text" name="sub_text" id="sub_text" class="form-control" placeholder="Enter Subject">
							</div>
							<div class="col-xl-8 col-lg-8 col-md-6 col-12">
								<div class="form-group notes-form-group-info">
									<textarea name="msg_text" id="msg_text" class="form-control" placeholder="Enter Message" style="height: 180px !important;"></textarea>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-6 col-12">
								<div class="form-group">
									<div class="form-group service-upload mb-0">
										<span><img src="{{asset('public/assets/img/icons/drop-icon.svg') }}" alt="upload"></span>
										<h6 class="drop-browse align-center">
											Drop your files here or<span class="text-primary ms-1">browse</span>
										</h6>
										<p class="text-muted">Maximum size: 5MB</p>
										<input type="file"  name="fileAttached" id="fileAttached">
										<div id="framesDoc"></div>
									</div>
								</div>
							</div>
								
							<div class="message-container"></div>
							<div id="setReminderLoader" class="loader"></div>
                            <div class="compose-btn">
								<button type="submit" class="btn btn-primary btn-block w-100">Send Reminder</button>
                            </div>
                        </div>
                    </div>
					</form>
                </div>
            </div>

            
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("reminder_type").addEventListener("change", function () {
                var selectField = document.querySelector(".select.tagging");
                var options = selectField.options;

                if (this.value === "1") { // Bulk
                    for (var i = 0; i < options.length; i++) {
                        options[i].selected = true;
                    }
                } else if (this.value === "2") { // Specific
                    // You will manually select options
                }
            });
        });
    </script>

@endsection
