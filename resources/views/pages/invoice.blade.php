@extends('layouts.default')
@section('content')
    <div class="page-wrapper invoice-one">
        <div class="container">
            <div class="invoice-wrapper download_section">
                <div class="inv-content">
                    <span class="line"></span>
                    <div class="invoice-header">
                        <div class="inv-header-left">
                            <h4>Invoice</h4>
                            <div class="company-details">
                                <div class="gst-details">
                                    <h6>{{ $compDetails->comp_name }}</h6>
                                    <h6>Pan No. {{ $compDetails->comp_pan_no }}</h6>
                                    <span>Address:{{ $compDetails->comp_bill_addone }}</span>
                                </div>
                                <div class="address-bg"></div>
                            </div>
                        </div>
                        <div class="inv-header-right">
                            <a href="#">
                                <img class="logo-lightmode" src="{{asset('public/assets/img/logo2.png')}}" alt="Logo">
                            </a>
                            <h6>Invoice No : <span> #{{ $inv_num }}</span></h6>
                            <h6>Invoice Date :<span> {{ date("d-m-Y",strtotime( $sales->inv_date )) }}</span></h6>
                            <p> <span>Buyer's Order No. : {{ $sales->buyer_orderno }}</span></p>
                            <p> <span>Dated : {{ date("d-m-Y",strtotime($sales->order_date)) }}</span></p>
                        </div>
                    </div>
                    <span class="line"></span>
                    <h5>Customer Information</h5>
                    <div class="patient-infos">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class=" patient-detailed">
                                    <div class="bill-add">
                                        Customer Details :
                                    </div>
                                    <div class="customer-name">
										{{ $custDetails->cust_name }}
                                        <p><span>GSTIN : {{ $custDetails->cust_gst_no }}</span> </p>
                                    </div>
                                    <div class="payment-status">
                                        Payment Status
                                        <p><span> {{ $sales->pay_status }} </span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class=" patient-detailed">
                                    <div class="bill-add">
                                        Billing Address :
                                    </div>
                                    <div class="add-details">
                                        {{ $stateBill[0]->name }} <br> {{ $cityBill[0]->name }}, <br> {{ $custDetails->cust_bill_pin }}<br> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class=" patient-detailed">
                                    <div class="bill-add">
                                        Shipping Address :
                                    </div>
                                    <div class="add-details">
                                        {{ $stateShip[0]->name }} <br> {{ $cityShip[0]->name }}, <br> {{ $custDetails->cust_ship_pin }}<br> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-table">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                <tr class="ecommercetable">
                                    <th class="table_width_1">#</th>
                                    <th class="table_width_2">Description of Goods</th>
                                    <th class="text-start">HSN / SAC</th>
                                    <th class="text-start">Quantity</th>
                                    <th class="text-start">Unit Price</th>
                                    <th class="text-start">Discount</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                    <td class="text-start"> {{ ($value->sac_code!="")?$value->sac_code:$value->hsn_code }}</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-table-footer">
                        <div class="text-end table-footer-right">
                            <table>
                                <tbody>
                                <tr>
                                    <td><span>Taxable Amount</span></td>
                                    <td>₹{{ $taxableAmt }}</td>
                                </tr>
                                <tr>
                                    <td><span>CGST 9.0%</span></td>
                                    <td>₹{{ $cgst }}</td>
                                </tr>
                                <tr>
                                    <td><span>IGST 9.0%</span></td>
                                    <td>₹{{ $igst }}</td>
                                </tr>
                                <!--<tr>
                                    <td><span>Extra Discount (Promo - 5%)</span></td>
                                    <td>₹235.25</td>
                                </tr>
                                <tr>
                                    <td><span>Round Off</span></td>
                                    <td>-₹.65</td>
                                </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-table-footer totalamount-footer">
                        <div class="table-footer-left"></div>
                        <div class="table-footer-right">
                            <table class="totalamt-table">
                                <tbody>
                                <tr>
                                    <td>Total Amount</td>
                                    <td>₹<?php echo $totalAmount; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="total-amountdetails">
                       <p>Total amount ( in words): <span> {{ Helper::convert_number_to_words($totalAmount) }}</span></p>
                    </div>
                    <div class="bank-details">
                        <div class="row">
                            <div class="col md-4">
                                <div class="payment-info">
                                    <div class="qr">
                                        <h6 class="payment-title">Mode Of Payment : {{ $sales->mode_of_pay }}</h6>
                                    </div>
                                    <div class="pay-details">
                                        <span class="payment-title">Dispatch Document No : {{ $sales->dispa_docno_one }}</span><br>
                                        <span class="payment-title">Dispatched Through : {{ $sales->disp_through }}</span><br>
                                        <span class="payment-title">Destination : {{ $sales->other_dispa_det }}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="payment-info">
                                    <div class="qr">
                                        <h6 class="payment-title">Delivery Note</h6>
                                    </div>
                                    <div class="pay-details">
                                        <span class="payment-title">Delivery Note Date:</span><br>
                                        <span class="payment-title">Supplier's Ref : {{ $sales->supplier_refno }}</span><br>
                                        <span class="payment-title">Other Reference(s) : {{ $sales->other_refno }}</span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="terms-condition">
                                    <span class="payment-title">Terms of Delivery</span>
                                    <ol>
                                        <li> Goods Once sold cannot be taken back or exchanged</li>
                                        <li> We are not the manufactures, company will stand for warrenty as per their terms and conditions.</li>
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
                <a href="{{ url('/sales-invoice-pdf/'.base64_encode($sid).'/download') }}" class="download_btn download-link">
                    <i class="feather-download-cloud me-1"></i> <span>Download</span>
                </a>
                <a href="javascript:window.print()" class="print-link">
                    <i class="feather-printer"></i> <span class="">Print</span>
                </a>
            </div>
        </div>
    </div>
@endsection
