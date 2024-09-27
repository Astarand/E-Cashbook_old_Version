@extends('layouts.default')
@section('content')


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
									
									<h1 class="mb-lg-4 mb-sm-2">Forgot Password</h1>
									
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
									
									<form class="needs-validation" action="javascript:void(0);" name="forgotform" id="forgotform">
										@csrf
										<div class="message-container"></div>
										<div class="form-group">
											<label class="form-control-label" for="username">Username / Email Address</label>
											<input type="email" class="form-control" name="username" id="username" placeholder="Enter Username" required>
											<div class="invalid-feedback">
												Please Enter correct Username
											</div>
										</div>
										<div id="newPasswordLoader" class="loader"></div>
										<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Submit</button>
									</form>
									<div class="text-center dont-have">
										<a href="{{ url('/userlogin') }}" class="forgot-link">Login</a>
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