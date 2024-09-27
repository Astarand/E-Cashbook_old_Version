@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>CA Transaction Details</h5>
                </div>
            </div>
            <?php
                // echo '<pre>';
                // print_r($user_data);
            ?>
            <div class="card customer-details-group">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
											<span class="customer-widget-img d-inline-flex">
											<img class="rounded-circle" src="{{asset('public/assets/img/profiles/avatar-14.jpg') }}" alt="profile-img">
											</span>
                                    <div class="customer-details-cont">
                                        <h6>{{ $user_data['name'] }}</h6>
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
                                        <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9ef4f1f6f0defbe6fff3eef2fbb0fdf1f3">{{ $user_data['email'] }}</a></p>
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
                                        <p>{{ $user_data['phone'] }}</p>
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
                                        <p>{{ $user_data['company_name'] }}</p>
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
                                        <h6>Company Attached</h6>
                                        <p>{{ $user_data['company_count'] }}</p>
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
                                        <h6> Total Earning</h6>
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $user_data['totalEarnings'] }}</p>
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
                                        <h6> Total Payout</h6>
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $user_data['totalPayout'] }}</p>
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
                                        <h6> Balance Amount</h6>
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $user_data['balance_amount'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="content-page-header d-flex justify-content-end">
                            <div class="list-btn">
                                <ul class="filter-list">
                                    <li>
                                        <a class="btn btn-primary" href="#"  data-bs-toggle="modal" data-bs-target="#payment_modal"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Payment Now</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="filter_inputs" class="card filter-card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="input-block mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="input-block mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="input-block mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        // echo '<pre>';
                        //     print_r($ca_payment_data);
                    
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-center table-hover datatable">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Schedule </th>
                                                <th>Transaction ID </th>
                                                <th>Payment Amount</th>
                                                <th>Mode of Payment</th>
                                                <th>Account Holder Name</th>
                                                <th>Account Number</th>
                                                <th>Bank Name</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ca_payment_data as $index => $payment)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $payment->payment_date }}</td>
                                                    <td>{{ $payment->fortnight_for }}</td>
                                                    <td>{{ $payment->transaction_id }}</td>
                                                    <td class="text-success-light"><i class="fa-solid fa-indian-rupee-sign"></i>{{ $payment->payment_amount }}</td>
                                                    <td>{{ $payment->mode_of_payment }}</td>
                                                    <td>{{ $payment->account_holder_name }}</td>
                                                    <td>{{ $payment->account_number_UPI_ID }}</td>
                                                    <td>{{ $payment->bank_name }}</td>
                                                    <td><span class="badge bg-success-light">{{ $payment->status == 1 ? 'Completed' : 'Pending' }}</span></td>
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
        </div>
    </div>
    <div class="modal custom-modal fade" id="payment_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Pay to the CA/ Accountant</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="#" id="paymentCaForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    @csrf
                                    <label>Date</label>
                                    <input type="date" class="form-control" id="payment_date"  placeholder="Enter Date">
                                    <input type="hidden" value="{{ $user_data['id'] }}" name="ca_id" id="ca_id">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Fortnight for</label>
                                    <div class="form-group">
                                        <select class="form-select" id="fortnight">
                                            <option value="">Select</option>
                                            <option value="First Fortnight">First Fortnight</option>
                                            <option value="Second Fortnight">Second Fortnight</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Transaction ID</label>
                                    <input type="text" class="form-control" id="transaction_id" placeholder="Transaction ID">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Payment Amount</label>
                                    <input type="text" class="form-control" id="amount" placeholder="Payment Amount">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Mode of Payment</label>
                                    <div class="form-group">
                                        <select class="form-select" id="paymet_mode">
                                            <option value="">Select</option>
                                            <option value="imps">IMPS</option>
                                            <option value="rtgs">RTGS</option>
                                            <option value="neft">NEFT</option>
                                            <option value="upi">UPI</option>
                                            <option value="card">Credit/ Debit Card</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Account Holder Name</label>
                                    <input type="text" class="form-control" id="acount_holder_name" placeholder="Account Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Account Number / UPI ID</label>
                                    <input type="text" class="form-control" id="acount_no_uip" placeholder="Account Number / UPI ID">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" placeholder="Bank Name">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Remarks </label>
                                    <textarea class="summernote form-control" id="remarks"  placeholder="Remarks" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="modal-btn d-flex justify-content-end">
                            <button type="button" id="submitCaBtn" class="btn btn-primary paid-continue-btn me-2">Submit</button>
                            <button type="reset" data-bs-dismiss="modal" class=" btn btn-primary paid-cancel-btn">Cancel</button>
                        </div>
    
    
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#submitCaBtn").click(function() {
                
                const createDate = document.getElementById("payment_date").value;
                const ca_id = document.getElementById("ca_id").value;
                const fortnight = document.getElementById("fortnight").value;
                const transaction_id = document.getElementById("transaction_id").value;
                const amount = document.getElementById("amount").value;
                const paymet_mode = document.getElementById("paymet_mode").value;
                const acount_holder_name = document.getElementById("acount_holder_name").value;
                const acount_no_uip = document.getElementById("acount_no_uip").value;
                const bank_name = document.getElementById("bank_name").value;
                const remarks = document.getElementById("remarks").value;

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const formData = {
                    _token: csrfToken,
                    payment_date: createDate,
                    uid: ca_id,
                    fortnight_for: fortnight,
                    transaction_id: transaction_id,
                    payment_amount: amount,
                    mode_of_payment: paymet_mode,
                    account_holder_name: acount_holder_name,
                    account_number_UPI_ID: acount_no_uip,
                    bank_name: bank_name,
                    remarks: remarks,
                    status: 1
                };

                

                $.ajax({
                    url: '{{ route("payment_ca_data") }}',
                    type: "POST", 
                    data: formData,
                    success: function(response) {
                        // Handle success
                        console.log(response);
                        alert('Payment data saved successfully');
                        // Reload the page
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error("Error:", error);
                        alert('Error occurred while saving payment data');
                    }
                });
            });
        });
    </script>
@endsection
