@extends('layouts.default')
@section('content')

<style>
    header,
    footer {
        display: none !important
    }
</style>


	<!--<section class="banner-sec d-flex align-items-center">
        <div class="login-bg"></div>

			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">{{ __('Reset Password') }}</div>

							<div class="card-body">
								@if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
									</div>
								@endif

								<form method="POST" action="{{ route('password.email') }}">
									@csrf

									<div class="form-group row">
										<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

										<div class="col-md-6">
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>

									<div class="form-group row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary">
												{{ __('Send Password Reset Link') }}
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>-->
	
	<section class="relative logingArea d-flex align-items-center justify-content-center">
        <div class="login-screen d-flex flex-wrap">

            <div class="right-item">
                <div class="slider-panel">
                    <div class="inner-slider-panel">
                        <a href="{{ url('/') }}"><img src="<?php  echo asset('public/home-assets/images/logo.png') ?>" alt=""></a>
                        <!--<p>Sign in to access your account.</p>-->
                    </div>
                </div>
            </div>
            <div class="left-item">
                <div class="login-panel">
                    <div class="inner-login-panel">
                        <div class="content-panel">
                            <h3 class="title">Reset Password</h3>
                            @if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
									</div>
								@endif

								<form method="POST" action="{{ route('password.email') }}">
									@csrf

									<div class="form-group row">
										

										
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										
									</div>

									<div class="form-group row mb-0">
										
											<button type="submit" class="btn btn-primary">
												{{ __('Send Password Reset Link') }}
											</button>
										
									</div>
									<div class="full notAmember m-t-20 text-center">
										<p>
											<a href="javascript:history.back()">Cancel</a>
										</p>
									</div>
								</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
