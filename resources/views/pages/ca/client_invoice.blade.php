@extends('layouts.default')
@section('content')
<div class="page-wrapper invoice-one">
    <div class="container">
        <div class="invoice-wrapper download_section">
            <div class="inv-content">
                <span class="line">
                    <?php 
                    //echo '<pre>';
                        //print_r($companyDetails);
                        
                        ?>
                </span>
                <div class="invoice-header">
                    <div class="inv-header-left">
                        <h4>Invoice</h4>
                        <div class="company-details">
                            <div class="gst-details">
                                <h6>{{ $companyDetails[0]->comp_name }}</h6>
                                <h6>Pan No. {{ $companyDetails[0]->gst_no }}</h6>
                                <span>Address: {{ $companyDetails[0]->comp_bill_addone }}</span>
                            </div>
                            <div class="address-bg"></div>
                        </div>
                    </div>
                    <div class="inv-header-right">
                        <a href="#">
                            <img class="logo-lightmode" src="{{asset('public/assets/img/logo2.png')}}" alt="Logo">
                        </a>
                        <h6>Task ID : <span> {{ $paymentDetails[0]->task_id }}</span></h6>
                        <p> <span>Task Category : {{ $paymentDetails[0]->task_category }}</span></p>
                        <h6>Task Date :<span> {{ $paymentDetails[0]->task_date }}</span></h6>
                        <h6>Project Priority  :<span> {{ $paymentDetails[0]->project_priority }}</span></h6>
                        <p> <span>Due Date. : {{ $paymentDetails[0]->due_date }}</span></p>
                        
                    </div>
                </div>
                <span class="line"></span>
                <h5>Payment Information</h5>
                
                <div class="invoice-table">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr class="ecommercetable">
                                    <th class="table_width_1">#</th>
                                    <th class="table_width_2">Govt Fees</th>
                                    <th class="text-start">Services charges</th>
                                    <th class="text-start">Advance Payment</th>
                                    <th class="text-start">Due Amount</th>
                                    
                                    <th class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="ecommercetable">
                                    <td class="table_width_1">#</td>
                                    <td class="table_width_2">{{ $paymentDetails[0]->gov_fees }}</td>
                                    <td class="text-start">{{ $paymentDetails[0]->services_charges }}</td>
                                    <td class="text-start">{{ $paymentDetails[0]->advance_payment }}</td>
                                    <td class="text-start">{{ $paymentDetails[0]->due_amount }}</td>
                                    <td class="text-end">{{ $paymentDetails[0]->total_amount }}</td>
                                    
                                </tr>
                            </tbody>
                            {{-- <tbody>
                                <?php 
									$cgst = 0;
									$igst = 0;
									$taxableAmt = 0;
									$totalDisc = 0;
									$totalTax = 0;
									$totalAmount = 0;
								?>
                                <?php if(!empty($sales_values)) { 

								foreach($sales_values as $k=>$value) {
									$k = $k+1;
								?>
                                <tr>
                                    <td>{{ $k }}</td>
                                    <td class="text-start">{{ $value->item_name }}</td>
                                    <td class="text-start"> {{ ($value->sac_code!="")?$value->sac_code:$value->hsn_code
                                        }}</td>
                                    <td class="text-start">{{ $value->quantity }}</td>
                                    <td class="text-start unit-price-data">₹{{ $value->rate }}</td>
                                    <td class="text-start">₹{{ $value->disc_amt }}</td>
                                    <td class="text-end">₹{{ $value->amount }}</td>
                                </tr>
                                <?php 
		  
									 
									 $totalDisc += $value->disc_amt;
									 $totalTax += $value->tax_amt;
									 $cgst += ($value->amount)*9/100;
									 $igst += ($value->amount)*9/100;
									 $taxableAmt += $value->amount;
									 $totalAmount += $value->amount; 
								} 
									//$taxableAmt = $taxableAmt + $cgst;
									$totalAmount = ceil(($totalAmount + $cgst + $igst));
								}?>
                            </tbody> --}}
                        </table>
                    </div>
                </div>
                {{-- <div class="invoice-table-footer">
                    <div class="text-end table-footer-right">
                        <table>
                            <tbody>
                                <tr>
                                    <td><span>Taxable Amount</span></td>
                                    <td>₹10</td>
                                </tr>
                                <tr>
                                    <td><span>CGST 9.0%</span></td>
                                    <td>₹00</td>
                                </tr>
                                <tr>
                                    <td><span>IGST 9.0%</span></td>
                                    <td>₹20</td>
                                </tr>
                                <tr>
                                    <td><span>Extra Discount (Promo - 5%)</span></td>
                                    <td>₹235.25</td>
                                </tr>
                                <tr>
                                    <td><span>Round Off</span></td>
                                    <td>-₹.65</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}


                {{-- <div class="invoice-table-footer totalamount-footer">
                    <div class="table-footer-left"></div>
                    <div class="table-footer-right">
                        <table class="totalamt-table">
                            <tbody>
                                <tr>
                                    <td>Total Amount</td>
                                    <td>₹
                                        <?php echo "102"; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
                {{-- <div class="total-amountdetails">
                    <p>Total amount ( in words): <span> One Hundred</span></p>
                </div> --}}
                <div class="bank-details">
                    <div class="row">
                        <div class="col md-4">
                            {{-- <div class="payment-info">
                                <div class="qr">
                                    <h6 class="payment-title">Mode Of Payment : Test</h6>
                                </div>
                                <div class="pay-details">
                                    <span class="payment-title">Dispatch Document No : 212536</span><br>
                                    <span class="payment-title">Dispatched Through : 236520</span><br>
                                    <span class="payment-title">Destination : Test</span>

                                </div>
                            </div> --}}
                        </div>
                        <div class="col md-4">
                            {{-- <div class="payment-info">
                                <div class="qr">
                                    <h6 class="payment-title">Delivery Note</h6>
                                </div>
                                <div class="pay-details">
                                    <span class="payment-title">Delivery Note Date:</span><br>
                                    <span class="payment-title">Supplier's Ref : 20315</span><br>
                                    <span class="payment-title">Other Reference(s) : 203152</span><br>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-4">
                            <div class="terms-condition">
                                <span class="payment-title">Terms of Delivery</span>
                                <ol>
                                    <li> Goods Once sold cannot be taken back or exchanged</li>
                                    <li> We are not the manufactures, company will stand for warrenty as per their terms
                                        and conditions.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="thanks-msg text-center">
                    Thanks for your Business
                </div>
            </div>
        </div>
        <div class="file-link">
            <a href="{{ url('/sales-invoice-pdf/'.base64_encode($sid).'/download') }}"
                class="download_btn download-link">
                <i class="feather-download-cloud me-1"></i> <span>Download</span>
            </a>
            <a href="javascript:window.print()" class="print-link">
                <i class="feather-printer"></i> <span class="">Print</span>
            </a>
        </div>
    </div>
</div>
@endsection