@extends('layouts.default')
@section('content')


<div class="page-wrapper">
	<div class="content container-fluid">
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
									
									<h5 class="mb-lg-4 mb-sm-2">Change Password</h5>
									
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
									</div>
									@endif
									
									@if (Session::has('success'))
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<h4 class="alert-heading">Success!</h4>
											<p>{{ Session::get('success') }}</p>
										</div>
									@endif
									
									<form class="image-upload" method="post" action="{{ route('reset.password.store') }}" enctype="multipart/form-data">

										@csrf

										<div class="form-group">

											<label>Current Password</label>

											<input type="password" name="current_password" class="form-control" value="{{ old('current_password') }}"/>

										</div>

										<div class="form-group">

											<label>New Password</label>

											<input type="password" name="new_password" class="form-control" value="{{ old('new_password') }}"/>

										</div>

										<div class="form-group">

											<label>Confirm Password</label>

											<input type="password" name="confirm_password" class="form-control" value="{{ old('confirm_password') }}"/>

										</div>

										<div class="form-group text-center">

											<button type="submit" class="btn btn-success">Save</button>

										</div>

									</form>
									
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