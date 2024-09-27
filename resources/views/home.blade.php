@extends('layouts.backend')

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->

	<!--<section class="content">-->
	@if (Auth::user()->u_type==1)  
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-12">
					<div class="owl-carousel owl-theme dbSlider">
					
						
						<div class="item">
							<div class="dbSliderBox w-100">
								<div class="dbSliderBoxTop w-100 d-flex justify-content-between align-items-center">
									<h5>Sales</h5> <i class="fas fa-chart-bar"></i>
								</div>
								<div class="dbSliderBoxBtm w-100">
									<ul class="d-flex justify-content-between w-100 align-items-center">
										<li>Completed Sales</li>
										<li class="dbsValue">₹{{ number_format($completedSale[0]->completedSaleAmt,2) }}</li>
									</ul>
									<ul class="d-flex justify-content-between w-100 align-items-center">
										<li>Inprocess Sales</li>
										<li class="dbsValue">₹{{ number_format($inprocessSale[0]->inprocessSaleAmt,2) }}</li>
									</ul>
								</div>
							</div>
							
						</div>
						
						
						
						
						
					</div>
				</div>
				  
			</div>
			
			<script src="{{ asset('/public/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
			<script src="{{ asset('/public/highcharts/highcharts.js') }}"></script>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Sales Graph</h3>
						</div>
						<div class="card-body">
							<div id="container-by-month" style="min-width: 310px; height: 400px; margin: 0 auto;">

							</div>
						</div>
					</div>
				</div>
				
				<script>
				/*
				 * Chart for orders by mount/year 
				 */
				$(function () {
					Highcharts.chart('container-by-month', {
						title: {
							text: 'Monthly Orders',
							x: -20
						},
						credits: {
							enabled: false
						},
						subtitle: {
							text: '',
							x: -20
						},
						xAxis: {
							categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
								'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
						},
						yAxis: {
							title: {
								text: 'Orders'
							},
							plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
						},
						tooltip: {
							valueSuffix: ' Orders'
						},
						legend: {
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'middle',
							borderWidth: 0
						},
						series: [
			<?php foreach ($ordersByMonth['years'] as $year) { ?>
								{
									name: '<?= $year ?>',
									data: [<?= implode(',', $ordersByMonth['orders'][$year]) ?>]
								},
			<?php } ?>
						]
					});
				});
			</script>
				
				<div class="col-md-6">
					<!-- MAP & BOX PANE -->
					
					<!-- /.card -->
					<div class="row">
					  

					  
					</div>
					<!-- /.row -->

					<!-- TABLE: LATEST ORDERS -->
					<div class="card">
					  <div class="card-header border-transparent">
						<h3 class="card-title">Recent Orders</h3>
						
						<div class="card-tools">
						  <a href="{{ url('/order-history') }}" class="btn btn-sm btn-secondary float-right">View All</a>
						</div>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body p-0">
						<div class="table-responsive">
						  <table class="table m-0">
							<thead>
							<tr>
							  <th>Order ID</th>
							  <th>Payment</th>
							  <th>Amount</th>
							  <!--<th>Status</th>-->
							</tr>
							</thead>
							<tbody>
									
									@if(!empty($recent_order))
										@foreach($recent_order as $order)
											<?php 
											if($order->processed==0) 
												$processed = '<span class="badge badge-warning">Not processed</span>';
											else if($order->processed==1) 
												$processed = '<span class="badge badge-info">Processing</span>';
											else if($order->processed==2) 
												$processed = '<span class="badge badge-danger">Rejected</span>';
											else if($order->processed==3) 
												$processed = '<span class="badge badge-success">Shipped</span>';
											?>
										<tr>
										  <td><a href="javascript:void(0)">#{{ "OR".sprintf("%08d", $order->order_id) }}</a></td>
											@if($order->pay_status==1) 
											  <td><span class="badge badge-success">Paid</span></td>
											  @else
											  <td><span class="badge badge-danger">Not paid</span></td>
											 @endif
										  <td>₹<?php echo number_format($order->total_price,2); ?></td>
										  <!--<td><?php //echo $processed; ?></td>-->
										  
										</tr>
										@endforeach
									@endif
									
							
							
							</tbody>
						  </table>
						</div>
						<!-- /.table-responsive -->
					  </div>
					  <!-- /.card-body -->
					  <div class="card-footer clearfix">
						
					  </div>
					  <!-- /.card-footer -->
					</div>
					<!-- /.card -->
				</div>
				
			</div>
			
		</div>
		
		@elseif (Auth::user()->u_type==3)  
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-12">
					<div class="owl-carousel owl-theme dbSlider">
					
						
						<div class="item">
							<div class="dbSliderBox w-100">
								<div class="dbSliderBoxTop w-100 d-flex justify-content-between align-items-center">
									<h5>Sales</h5> <i class="fas fa-chart-bar"></i>
								</div>
								<div class="dbSliderBoxBtm w-100">
									<ul class="d-flex justify-content-between w-100 align-items-center">
										<li>Completed Sales</li>
										<li class="dbsValue">₹0</li>
									</ul>
									<ul class="d-flex justify-content-between w-100 align-items-center">
										<li>Inprocess Sales</li>
										<li class="dbsValue">₹0</li>
									</ul>
								</div>
							</div>
							
						</div>
						
						
						
						
						
					</div>
				</div>
				  
			</div>
			
			<script src="{{ asset('/public/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
			<script src="{{ asset('/public/highcharts/highcharts.js') }}"></script>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Sales Graph</h3>
						</div>
						<div class="card-body">
							<div id="container-by-month" style="min-width: 310px; height: 400px; margin: 0 auto;">

							</div>
						</div>
					</div>
				</div>
				
				
				
				<div class="col-md-6">
					<!-- MAP & BOX PANE -->
					
					<!-- /.card -->
					<div class="row">
					  

					  
					</div>
					<!-- /.row -->

					<!-- TABLE: LATEST ORDERS -->
					<div class="card">
					  <div class="card-header border-transparent">
						<h3 class="card-title">Recent Orders</h3>
						
						<div class="card-tools">
						  <a href="{{ url('/order-history') }}" class="btn btn-sm btn-secondary float-right">View All</a>
						</div>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body p-0">
						<div class="table-responsive">
						  <table class="table m-0">
							<thead>
							<tr>
							  <th>Order ID</th>
							  <th>Payment</th>
							  <th>Amount</th>
							  <!--<th>Status</th>-->
							</tr>
							</thead>
							<tbody>
									
									@if(!empty($recent_order))
										@foreach($recent_order as $order)
											<?php 
											if($order->processed==0) 
												$processed = '<span class="badge badge-warning">Not processed</span>';
											else if($order->processed==1) 
												$processed = '<span class="badge badge-info">Processing</span>';
											else if($order->processed==2) 
												$processed = '<span class="badge badge-danger">Rejected</span>';
											else if($order->processed==3) 
												$processed = '<span class="badge badge-success">Shipped</span>';
											?>
										<tr>
										  <td><a href="javascript:void(0)">#{{ "OR".sprintf("%08d", $order->order_id) }}</a></td>
											@if($order->pay_status==1) 
											  <td><span class="badge badge-success">Paid</span></td>
											  @else
											  <td><span class="badge badge-danger">Not paid</span></td>
											 @endif
										  <td>₹<?php echo number_format($order->total_price,2); ?></td>
										  <!--<td><?php //echo $processed; ?></td>-->
										  
										</tr>
										@endforeach
									@endif
									
							
							
							</tbody>
						  </table>
						</div>
						<!-- /.table-responsive -->
					  </div>
					  <!-- /.card-body -->
					  <div class="card-footer clearfix">
						
					  </div>
					  <!-- /.card-footer -->
					</div>
					<!-- /.card -->
				</div>
				
			</div>
			
		</div>
		@elseif (Auth::user()->u_type==2) 
			<div class="container-fluid">
				<div class="row">
			
					<div class="col-12">
						<div class="owl-carousel owl-theme dbSlider">
							
							
							<div class="item">
								<div class="dbSliderBox w-100">
									<div class="dbSliderBoxTop w-100 d-flex justify-content-between align-items-center">
										<h5>Orders</h5> <i class="fas fa-shopping-cart"></i>
									</div>
									<div class="dbSliderBoxBtm w-100">
										<ul class="d-flex justify-content-between w-100 align-items-center">
											<li>Completed Orders</li>
											<li class="dbsValue">{{ $count_completed_order }}</li>
										</ul>
										<ul class="d-flex justify-content-between w-100 align-items-center">
											<li>Pending Orders</li>
											<li class="dbsValue">{{ $count_quotes_order }}</li>
										</ul>
									</div>
								</div>
								
							</div>
							
							
							
						</div>
					</div>
					
				  
				  
			</div>
			
			
			
			
			<!-- Main row -->
				<div class="row">
				  <!-- Left col -->
				  <div class="col-md-6">
					<!-- MAP & BOX PANE -->
					<div class="card">
					  
					</div>
					<!-- /.card -->
					<div class="row">
					  

					  
					</div>
					<!-- /.row -->

					<!-- TABLE: LATEST ORDERS -->
					<div class="card">
					  <div class="card-header border-transparent">
						<h3 class="card-title">Latest Orders</h3>
						
						<div class="card-tools">
						  <a href="{{ url('/order-history') }}" class="btn btn-sm btn-secondary float-right">View All</a>
						</div>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body p-0">
						<div class="table-responsive">
						  <table class="table m-0">
							<thead>
							<tr>
							  <th>Order ID</th>
							  <th>Payment</th>
							  <th>Amount</th>
							  <!--<th>Status</th>-->
							</tr>
							</thead>
							<tbody>
									
									@if(!empty($recent_order))
										@foreach($recent_order as $order)
											<?php 
											if($order->processed==0) 
												$processed = '<span class="badge badge-warning">Not processed</span>';
											else if($order->processed==1) 
												$processed = '<span class="badge badge-info">Processing</span>';
											else if($order->processed==2) 
												$processed = '<span class="badge badge-danger">Rejected</span>';
											else if($order->processed==3) 
												$processed = '<span class="badge badge-success">Shipped</span>';
											?>
										<tr>
										  <td><a href="javascript:void(0)">#{{ "OR".sprintf("%08d", $order->order_id) }}</a></td>
											@if($order->pay_status==1) 
											  <td><span class="badge badge-success">Paid</span></td>
											  @else
											  <td><span class="badge badge-danger">Not paid</span></td>
											 @endif
										  <td>₹<?php echo number_format($order->total_price,2); ?></td>
										  <!--<td><?php //echo $processed; ?></td>-->
										  
										</tr>
										@endforeach
									@endif
							
							</tbody>
						  </table>
						</div>
						<!-- /.table-responsive -->
					  </div>
					  <!-- /.card-body -->
					  <div class="card-footer clearfix">
						
					  </div>
					  <!-- /.card-footer -->
					</div>
					<!-- /.card -->
				  </div>
				  <!-- /.col -->

				  <div class="col-md-6">
					

					<div class="card">
					 
					</div>
					<!-- /.card -->

					<!-- PRODUCT LIST -->
					<div class="card">
					  <div class="card-header">
						<h3 class="card-title">Latest Offer</h3>

						<div class="card-tools">
						  <a href="{{ url('/offers') }}" class="btn btn-sm btn-secondary uppercase">View All</a>
						</div>
					  </div>
					  <!-- /.card-header -->
						<div class="card-body p-0">
							<ul class="products-list product-list-in-card pl-2 pr-2">
								@if(!empty($latest_offer))
									@foreach($latest_offer as $val)
								<?php 
										$u_path = ('public/uploads/products/thumbnail/');
										if($val->image !=Null  && file_exists($u_path . $val->image)){
											$image_path = asset('public/uploads/products/thumbnail/'.$val->image);
											$image_path_big = asset('public/uploads/products/'.$val->image);
										}
										else{
											$image_path = asset('public/uploads/no-image.png');
										}
								?>
							  <li class="item">
								<div class="product-img">
								  <img src="{{ $image_path }}" alt="{{ $val->product_title }}" class="img-size-50">
								</div>
								<div class="product-info">
								  <a href="{{ url('/product_details/' . $val->id.'/'.$val->p_slug) }}" class="product-title"><?php echo (strlen($val->product_title) > 20) ? substr($val->product_title,0,20)."..." : $val->product_title;  ?>
									<span class="badge badge-warning float-right"><?php  echo ($val->disclose==1)?'₹'.number_format($val->price,2): ""; ?></span></a>
								  <span class="product-description">
									<?php echo (strlen($val->product_desc) > 20) ? substr($val->product_desc,0,20)."..." : $val->product_desc;  ?>
								  </span>
								</div>
							  </li>
							  @endforeach
							  @endif
							
							</ul>
						</div>
					  <!-- /.card-body -->
					  <div class="card-footer text-center">
						
					  </div>
					  <!-- /.card-footer -->
					</div>
					<!-- /.card -->
				  </div>
				  <!-- /.col -->
				</div>
			
		</div>
		@endif
	<!--</section>-->
@endsection


