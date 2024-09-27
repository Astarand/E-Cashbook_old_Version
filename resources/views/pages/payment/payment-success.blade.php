@extends('layouts.default')

@section('content')


<style>
.pay-success {
    margin: 60px auto;
    max-width: 600px;
    border: #00acba 1px solid;
    padding: 60px 30px;
    -moz-border-radius: 16px;
    -webkit-border-radius: 16px;
    border-radius: 16px;
}

.payment-img {
    font-size: 26px;
    font-weight: 600;
    color: #333;
}

.payment-img span img {
    width: 100%;
}

.pay-success ul {
    margin: 0;
}

.pay-success ul li {
    font-size: 20px;
    color: #6c6b6b;
    margin-bottom: 10px;
}

.pay-success ul li span {
    font-weight: 600;
    color: #333;
}

.payment-img span {
    display: block;
    margin-bottom: 15px;
    width: 80px;
    margin: 0 auto;
}

.pay-success ul li a.goToMyCart {
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    background: #ff481c;
    display: inline-block;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    line-height: 42px;
    padding: 0 30px;
}
</style>
	<section class="reg-banner-sec d-flex align-items-center">
		
		<div class="container">

			@if (Session::has('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<h4 class="alert-heading">Success!</h4>
					<p>{{ Session::get('success') }}</p>

					<button type="button" class="close" data-dismiss="alert aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif
			
			
			<div class="row justify-content-center">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">

							@if(Session::has('transactionId'))
							
							<div class="pay-success text-center">
								<div class="payment-img"><span class="payment-text"><img width="50" src="{{ asset('/public/img/payment-tick.png') }}"></span>Payment Success</div>
								<ul>
									<li><span>Merchant Transaction Id : </span> 
										@if(Session::has('merchantTransactionId')) 
											{{ session('merchantTransactionId') }} 
										@endif
									</li>
									<li><span>Transaction Id : </span> 
										@if(Session::has('transactionId')) 
											{{ session('transactionId') }} 
										@endif
									</li>
									<li><span>Paid Amount : </span> 
										@if(Session::has('amount')) 
											₹{{ session('amount') }} 
										@endif
									</li>
									
									<li><a href="{{ url('/subscribers') }}" class="goToMyCart">Go to My Subscription</a></li>
								</ul>
							</div>
							
							@endif	
				</div>
				
			</div>
		</div>
	</section>


@endsection