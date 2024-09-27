@extends('layouts.default')
@section('content')
  <div class="page-wrapper">
      <div class="content container-fluid">
          <div class="page-header">
              <div class="content-page-header">
                  <h5>Customer Details</h5>
              </div>
          </div>
          <div class="card customer-details-group">
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-img d-inline-flex">
											    {{-- <img class="rounded-circle" src="{{asset('public/assets/img/profiles/avatar-14.jpg') }}" alt="profile-img"> --}}
                                                @if (empty($users->comp_logo))
                                                    <img class="rounded-circle" src="{{ asset('public/assets/img/profiles/avatar-14.jpg') }}" alt="profile-img">
                                                @else
                                                    <img class="rounded-circle" src="{{ asset('/public/uploads/profile/'.$users->comp_logo) }}" alt="">
                                                @endif
											</span>
                                        <div class="customer-details-cont">
                                            <h6>{{ $users->comp_name }}</h6>
                                            <p></p>
                                        </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-mail"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Email Address</h6>
                                      {{-- <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9ef4f1f6f0defbe6fff3eef2fbb0fdf1f3">[email&#160;protected]</a></p> --}}
                                      <p><a href="mailto:{{ $users->comp_email }}" class="__cf_email__" data-cfemail="9ef4f1f6f0defbe6fff3eef2fbb0fdf1f3">{{ $users->comp_email }}</a></p>
                                  
                                    </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-phone"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Phone Number</h6>
                                      <p>{{ $users->comp_phone }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-airplay"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Company Name</h6>
                                      <p>{{ $users->comp_name }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-globe"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Website</h6>
                                      {{-- <p class="customer-mail">www.example.com</p> --}}
                                      <p class="customer-mail">{{ $users->comp_website }}</p>

                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-briefcase"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Company Address</h6>
                                      {{-- <p>4712 Cherry Ridge Drive Rochester, NY 14620.</p> --}}
                                      <p>
                                        @if (!empty($users->state))
                                            {{ $users->state }},{{ $users->city }}
                                        @else
                                            {{ $users->city }}
                                        @endif
                                    </p>

                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fe fe-user"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Company Attach</h6>
                                      <p>{{ $users->company_attach }} </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                          <div class="customer-details">
                              <div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
											<i class="fa-solid fa-percent"></i>
											</span>
                                  <div class="customer-details-cont">
                                      <h6>Commission Earn</h6>
                                      <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $users->totalCommission }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12">
                  <div class="card-table">
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-center table-hover datatable">
                                  <thead class="thead-light">
                                  <tr>
                                      <th>#</th>
                                      <th>Company Name</th>
                                      <th>Package Name</th>
                                      <th>Subscription Type</th>
                                      <th>Amount</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                      <th>Commission</th>
                                      <th>Transaction Id</th>
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php $i = 1; ?>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <?php 
                                                $totalAfterCommission = 0;
                                                    $totalPaidAmount = $customer->paid_amount;
                                                    $totalCommission = $totalPaidAmount * 0.10;
                                                    $totalAfterCommission = $totalPaidAmount - $totalCommission;
                                                ?>
                                                <td><?php echo $i++; ?></td>
                                                <td>{{ isset($customer->comp_name) ? $customer->comp_name : 'N/A' }}</td>
                                                <td>{{ isset($customer->plan_name) ? $customer->plan_name : 'N/A' }}</td>
                                                <td>{{ isset($customer->plan_type) ? $customer->plan_type : 'N/A' }}</td>
                                                <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($customer->monthly_price) ? $customer->monthly_price : 'N/A' }}</td>
                                                <td>{{ isset($customer->start_at) ? date('dS F Y', strtotime($customer->start_at)) : 'N/A' }}</td>
                                                <td>{{ isset($customer->end_at) ? date('dS F Y', strtotime($customer->end_at)) : 'N/A' }}</td>
                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>{{$totalAfterCommission}} </td>
                                                <td>{{ isset($customer->transaction_id) ? $customer->transaction_id : 'N/A' }}</td>
                                                <td class="d-flex align-items-center">
                                                    <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa-regular fa-paper-plane me-1"></i> Message</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
