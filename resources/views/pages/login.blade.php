@extends('layouts.default')
@section('content')

<?php  
		//$loginId = \Request::cookie('loginId');
		//$loginPass = \Request::cookie('loginPass');
		$loginId = ((Cookie::get('loginId') && Cookie::get('loginId') !=""))?Cookie::get('loginId'):"";
		$loginPass = ((Cookie::get('loginPass') && Cookie::get('loginPass') !=""))?Cookie::get('loginPass'):"";
		$remember_me = ($loginId !="" && $loginPass !="")?true:false;
?>

<div class="main-wrapper login-body">
	<div class="login-wrapper">
		<div class="container">
			<div class="loginbox">
				<div class="row">
					<div class="col-lg-12 d-flex">
						<div class="col-lg-6 justify-content-center">
							<img class="img-fluid" src="{{asset('public/assets/img/login.jpg')}}" alt="Logo" style="height: 90%; border-radius:20px;">
						</div>
						<div class="col-lg-6">
							<div class="login-right">
								<div class="login-right-wrap">
									<img class="img-fluid logo-dark mb-2" src="{{asset('public/assets/img/logo2.png')}}" alt="Logo">
									<h1 class="mb-lg-4 mb-sm-2">Welcome to e-CashBook</h1>
									
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
									
									<form class="needs-validation" action="javascript:void(0);" name="loginform" id="loginform">
										@csrf
										<div class="message-container"></div>
										<div class="form-group">
											<label class="form-control-label" for="username">Username / Email Address</label>
											<input type="email" class="form-control" name="username" id="username" value="{{ $loginId }}" placeholder="Enter Username" required>
											<div class="invalid-feedback">
												Please Enter correct Username
											</div>
										</div>
										<div class="form-group">
											<label class="form-control-label">Password</label>
											<div class="pass-group">
												<input type="password" class="form-control pass-input" name="password" id="password" value="{{ $loginPass }}" placeholder="Enter Password" required>
												<span class="fas fa-eye toggle-password"></span>
												<div class="invalid-feedback">
												Please Enter Correct Password
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-6">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" name="remember" id="cb1" <?php echo ($remember_me)?'checked':'';?> >
														<label class="custom-control-label" for="cb1">Remember me</label>
													</div>
												</div>
												<div class="col-6 text-end">
													<!--<a class="forgot-link" href="forgot-password.html">Forgot Password ?</a>-->
													<a class="forgot-link" href="{{ url('forgotpassword') }}">Forgot Password ?</a>
												</div>
											</div>
										</div>
										<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>
										<div id="loginLoader" class="loader"></div>
									</form>
									<div class="text-center dont-have">
										Want to join us? <a href="{{ url('/signup') }}"><strong>Register Now</strong></a>
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
    
@stop