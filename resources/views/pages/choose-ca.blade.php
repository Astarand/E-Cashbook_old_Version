@if ($ca_details)
	
@foreach ($ca_details as $ca_detail)
<div class="col-lg-4 col-md-6 col-sm-12">
	<div class="card customer-details-group">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="customer-details">
						<div class="d-flex align-items-center">
						<span class="customer-widget-img d-inline-flex">
						
						@if(isset($ca_detail->comp_logo) && $ca_detail->comp_logo !="")
						<img  class="rounded-circle" src="{{asset('/public/uploads/profile/'.$ca_detail->comp_logo)}}" alt>
						@else
						<img  class="rounded-circle" src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt>
						@endif
						</span>
						<div class="customer-details-cont">
							<h6>{{ ($ca_detail->comp_name !="")?$ca_detail->comp_name:$ca_detail->name }}</h6>
							<p>Cl-12345</p>
							<div class="d-flex align-items-center flex-column">
								<span class="customer-widget-icon d-inline-flex">
									<i class="fas fa-star rating"></i>
									<i class="fas fa-star rating"></i>
									<i class="fas fa-star rating"></i>
									<i class="fas fa-star rating"></i>
									<i class="fas fa-star rating"></i>
								</span> 
							</div>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="customer-details">
						<div class="d-flex align-items-center">
						<span class="customer-widget-icon d-inline-flex">
						<i class="fe fe-airplay"></i>
						</span>
						<div class="customer-details-cont">
							<h6>Company Handel</h6>
							<p>500000</p>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="customer-details">
						<div class="d-flex align-items-center">
						<span class="customer-widget-icon d-inline-flex">
						<i class="fe fe-briefcase"></i>
						</span>
						<div class="customer-details-cont">
							<h6>Company Address</h6>
							<p>{{ $ca_detail->comp_bill_addone.','.$ca_detail->ca_state.','.$ca_detail->ca_city.','.$ca_detail->comp_bill_pin }}</p>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="customer-details">
						<div class="d-flex align-items-center">
						<span class="customer-widget-icon d-inline-flex">
						<i class="fe fe-briefcase"></i>
						</span>
						<div class="customer-details-cont">
							<h6>CA Speclization</h6>
							<p>{{ substr($ca_detail->ca_spec, 0, 40) }} 
								<a href="javascript:void(0);" data-toggle="tooltip" title="{{ $ca_detail->ca_spec }}">See More</a>
							</p>
						</div>
						</div>
					</div>
				</div>
				
				<div class="col-12">
					<div class="customer-details">
						<div class="d-flex align-items-center">
						<span class="customer-widget-icon d-inline-flex">
						<i class="fe fe-briefcase"></i>
						</span>
						<div class="customer-details-cont">
							<h6>Request For</h6>
							<select name="request_for{{$ca_detail->id}}" id="request_for{{$ca_detail->id}}" class="form-control">
								<option value=""> Select</option>
								<option value="Multiservices" {{ $ca_detail->request_for == 'Multiservices' ? 'selected' : '' }}>Multiservices</option>
								<option value="Company Incorporation" {{ $ca_detail->request_for == 'Company Incorporation' ? 'selected' : '' }}>Company Incorporation</option>
								<option value="GST & Taxation" {{ $ca_detail->request_for == 'GST & Taxation' ? 'selected' : '' }}>GST & Taxation</option>
								<option value="Income Tax Return" {{ $ca_detail->request_for == 'Income Tax Return' ? 'selected' : '' }}>Income Tax Return</option>
								<option value="Project Report / DPR with CMA Data" {{ $ca_detail->request_for == 'Project Report / DPR with CMA Data' ? 'selected' : '' }}>Project Report / DPR with CMA Data</option>
								<option value="Company Compliances" {{ $ca_detail->request_for == 'Company Compliances' ? 'selected' : '' }}>Company Compliances</option>
								<option value="Auditing" {{ $ca_detail->request_for == 'Auditing' ? 'selected' : '' }}>Auditing</option>
								<option value="TDS" {{ $ca_detail->request_for == 'TDS' ? 'selected' : '' }}>TDS</option>
								<option value="Outsourcing of work" {{ $ca_detail->request_for == 'Outsourcing of work' ? 'selected' : '' }}>Outsourcing of work</option>
								<option value="ROC Return" {{ $ca_detail->request_for == 'ROC Return' ? 'selected' : '' }}>ROC Return</option>
								<option value="Auditor Recruitment" {{ $ca_detail->request_for == 'Auditor Recruitment' ? 'selected' : '' }}>Auditor Recruitment</option>
								<option value="PF & ESIC" {{ $ca_detail->request_for == 'PF & ESIC' ? 'selected' : '' }}>PF & ESIC</option>
								<option value="Outsourcing of employee" {{ $ca_detail->request_for == 'Outsourcing of employee' ? 'selected' : '' }}>Outsourcing of employee</option>
								<option value="Accounts Preparation" {{ $ca_detail->request_for == 'Accounts Preparation' ? 'selected' : '' }}>Accounts Preparation</option>
								<option value="Licensing & Registration" {{ $ca_detail->request_for == 'Licensing & Registration' ? 'selected' : '' }}>Licensing & Registration</option>
								<option value="P-tax" {{ $ca_detail->request_for == 'P-tax' ? 'selected' : '' }}>P-tax</option>
								<option value="Other" {{ $ca_detail->request_for == 'Other' ? 'selected' : '' }}>Other</option>

							</select>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="add-customer-btns text-center">

						<!--<a href="javascript:void(0);" data-id="{{$ca_detail->id}}" data-status="{{$ca_detail->ca_assign_status}}" onClick="assign_ca(this)" class="btn customer-btn-save w-100">
						@if($ca_detail->ca_assign_status ==0) 
							<span>Assign</span>
						@else
							<span>Un-Asssign</span>
						@endif
						</a>-->
						@if($ca_detail->ca_assign_status ==0) 
							<a href="javascript:void(0);" data-id="{{$ca_detail->id}}" data-status="{{$ca_detail->ca_assign_status}}" onClick="assign_ca(this)" class="btn customer-btn-save w-100">
							<span>Assign</span>
							</a>
						@else
							<a href="javascript:void(0);" data-id="{{$ca_detail->id}}" data-status="{{$ca_detail->ca_assign_status}}"  class="btn customer-btn-save w-100">
							<span>Un-Asssign</span>
							</a>
						@endif
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>
@endforeach
	<div class="message-container"></div>
@else
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="card customer-details-group">
			<div class="card-body">
				<div class="row align-items-center">
					<h6 class="text-center"> No CA found in search location</h6>
				</div>
			</div>
		</div>
	</div>
@endif
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
