@extends('layouts.default')
@section('content')

	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header">
				<div class="content-page-header ">
					<h5>Membership Plans</h5>
					<div class="list-btn">
						<ul class="filter-list">
							<li>
								<a class="btn btn-primary" href="{{ url('/addplans') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add New Subscription</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="price-table-main">
				<div class="plan-selected">
					<h4>Monthly</h4>
					<div class="status-toggle me-2 ms-2">
						<input id="rating_1" class="px-4 check" type="checkbox" checked>
						<label for="rating_1" class="px-4 checktoggle checkbox-bg">checkbox</label>
					</div>
					<h4>Annually</h4>
				</div>
				<div class="row">
					@foreach ($plans as $val)
					<div class="col-lg-4 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="plan-header">
									<span class="plan-widget-icon">
									<img src="assets/img/icons/plan-price-01.svg" alt>
									</span>
									<div class="plan-title">
										<h6>{{ $val->plan_name }}</h6>
										<h4 class="plan-name">{{ $val->plan_type }}</h4>
									</div>
								</div>
								<div class="description-content">
									<p>{{ $val->plan_desc }} </p>
								</div>
								<div class="price-dollar">
								@if($val->monthly_price > 0)
									<h1 class="d-flex align-items-center"> ₹{{ $val->monthly_price }}<span class="ms-1">/monthly</span></h1>
								@else
									<h1 class="d-flex align-items-center"> ₹{{ $val->yearly_price }}<span class="ms-1">/yearly</span></h1>
								@endif
								</div>
								<div class="plan-included">
									<h6>What’s included</h6>			

									{!!html_entity_decode( strlen($val->plan_included) > 150 ? substr($val->plan_included,0,150)."..." : $val->plan_included )!!}
									
									<!--<ul>
										<li>
											<span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
											All analytics features
										</li>
										<li>
											<span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
											Up to 250,000 tracked visits
										</li>
										<li>
											<span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
											Normal support
										</li>
										<li>
											<span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
											Up to 3 team members
										</li>
									</ul>-->
								</div>
								<div class="plan-button">
									<a class="btn btn-primary d-flex align-items-center justify-content-center" href="{{ url('/editplan/'.base64_encode($val->id)) }}">Get Started<span class="ms-2"><i class="fe fe-arrow-right"></i></span></a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					
				</div>
			</div>
		</div>
	</div>
	
@endsection


<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>