@extends('layouts.default')

@section('content')
<style>
       body {
            background: #f7f7f7;
        }
 
        .form-box {
            margin: auto;
            padding: 25px;
            background: #ffffff;
            border: 10px solid #f2f2f2;
            margin-top: 5px;
        }
 
        h1, p {
            text-align: center;
        }
 
        input, textarea {
            width: 100%;
        }
        .form-control{
            margin-bottom:20px;
        }
		.form-box ul {
			margin: 0;
		}

		.form-box ul li {
			font-size: 20px;
			color: #6c6b6b;
			margin-bottom: 10px;
		}

		.form-box ul li span {
			font-weight: 600;
			color: #333;
		}
		
		.plan-included ul li {
			float:left; width:50%;
		}
    </style>
<div class="page-wrapper">
    <div class="content container-fluid">
        
		<div class="form-box">			
			<ul>
				<li><span>Paln Name : </span> 
					{{ $plans->plan_name }}
				</li>
				<li><span>Plan type : </span> 
					{{ $plans->plan_type }}
				</li>				
			</ul>
			<div class="plan-included">
				<h6>What’s included :</h6>			
				{!!html_entity_decode($plans->plan_included)!!}
			</div>
			<form action="{{ route('pay-now') }}" method="post" style="margin-top: 50px;">
				@csrf
				<div class="formgroup">
					<label>Amount</label>
					<input type="hidden" name="pid" value="{{ $plans->id }}">
					<input type="text" name="amount" readonly value="{{ $plans->amount}}" placeholder="Amount" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Pay Now</button>
			</form>
		</div>

    </div>
</div>



@endsection