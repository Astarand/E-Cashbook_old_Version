@extends('layouts.default')
@section('content')

<style>
.form-group .toggle-password,.toggle-password-conf {
  cursor: pointer;
  position: absolute;
  top: 20%;
  right: 0;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, 50%);
}

</style>

<div class="main-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-12 register_bg">
				<div class="login-right">
					<div class="login-right-wrap">
						<img class="img-fluid mb-2 mt-lg-5" src="{{asset('public/assets/img/logo2.png')}}" alt="Logo">
						<h1 class="mb-lg-4 mb-sm-2 text-center" style="color:#fff;">Welcome to e-CashBook</h1>
						<h5 class="mb-lg-4 mb-sm-2 text-center" style="color:#fff;">Register to e-CashBook</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-12">
				<div class="login-right">
					<div class="login-right-wrap">
						<br/>
						@if (Session::has('errors'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<h4 class="alert-heading">Error!</h4>
							<p>
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</p>

							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif
						<div class="register-form">
							<form class="needs-validation" action="javascript:void(0);" name="signupform" id="signupform">
								@csrf
								
								<div class="form-group">
									<label class="form-control-label" for="username">Want To Register as</label>
									<div class="align-center">
										<div class="form-control me-3">
											<label class="custom_radio me-3 mb-0">
											<input type="radio" class="form-control" name="u_type" id="u_type_ca" value="1" checked="checked">
											<span class="checkmark"></span> CA / Accountant
											</label>
										</div>
										<div class="form-control">
											<label class="custom_radio mb-0">
											<input type="radio" name="u_type" id="u_type_user" value="2">
											<span class="checkmark"></span> User
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="form-control-label">Name</label>
									<input class="form-control" type="text" name="name" id="name">
								</div>
								<div class="form-group">
									<label class="form-control-label">Phone Number</label>
									<input class="form-control" type="text" name="phone" id="phone">
								</div>
								<div class="form-group">
									<label class="form-control-label">Email Address</label>
									<input class="form-control" type="text" name="email" id="email">
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="form-group">
											<label>State</label>
											<select class="form-control select-style" name="state_id" id="state" onChange="changeState(this);">
												<option value="">Select State</option>
												@foreach($states as $k=>$state)
													<option value="{{ $state->id }}">{{ $state->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="form-group">
											<label>City</label>
											<select class="form-control select-style" name="city_id" id="city">
												<option value="">Select City</option>
											</select>
										</div>
									</div>  
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="form-group">
											<label class="form-control-label">Password</label>
											<div class="pass-group">
											<input class="form-control pass-input" type="password" name="password" id="password">
											<span class="fas fa-eye toggle-password"></span>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="form-group">
											<label class="form-control-label">Confirm Password</label>
											<div class="pass-group">
											<input class="form-control pass-input-conf" type="password" name="confirm_Password" id="confirm_Password">
											<span class="fas fa-eye toggle-password-conf"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="message-container"></div>
								<div class="form-group mb-0">
									<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Register</button>
								</div>
								<div id="registerLoader" class="loader"></div>
								<div class="text-center dont-have mt-2">Already have an account? <a href="{{ url('/userlogin') }}">Login</a></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
@stop