<!doctype html>
<html>
<head>
<style>
body {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  color: ##1c1c1e;
  line-height: 1.5;
  background-color: #f7f8f9;
}

.container {
  width: 100%;
  max-width: 1140px;
  padding-left: 15px;
  padding-right: 15px;
  margin: 0 auto;
}
.invoice-one .inv-content {
    border: 1px solid #bdbdbd;
    margin: 0;
    padding: 24px;
}
.invoice-one .inv-content span.line {
     display: block;
    background: linear-gradient(320deg, #DDCEFF 0%, #DBECFF 100%);
    height: 10px;
}
.invoice-one .inv-content .invoice-header {
    margin: 0;
    padding: 20px;
    background: #fff;
}
.invoice-one .invoice-table {
    margin: 0;
    padding: 0 0 20px;
}
.invoice-one .invoice-table-footer {
    justify-content: end;
    padding: 5px 30px;
}
.invoice-one .totalamount-footer {
    border: 1px solid #95979b;
    border-left: none;
    border-right: none;
    margin: 10px 0 0;
    padding: 15px;
}
.invoice-one .total-amountdetails {
    margin: 0;
    padding: 20px 0;
    border-bottom: 1px solid #bebebe;
    text-align: end;
}
.invoice-one .bank-details {
    margin: 0;
    padding: 25px 15px;
    border-bottom: 1px solid #bebebe;
}
.invoice-one .thanks-msg {
    background: #f2f2f2;
    border-bottom: 1px solid #bebebe;
    color: #000;
    font-size: 16px;
    font-weight: 450;
}
.invoice-one .file-link {
    margin-bottom: 40px;
    display: flex;
    align-items: center;
    padding-top: 24px;
    justify-content: flex-start;
}
.invoice-one .bill-add {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 450;
    color: #878a99;
}
.invoice-one .bill-add {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 450;
    color: #878a99;
}
.invoice-one h5 {
    background: #f4f4f4;
    color: #2c3038;
    font-size: 18px;
    font-weight: 450;
    margin: 20px 0;
    padding: 10px 20px;
}
.invoice-one .payment-status {
    color: #878a99;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
}
.invoice-one .payment-status span {
    font-size: 18px;
    font-weight: 700;
    line-height: 28px;
    color: #33b469;
}
.invoice-one .customer-name span {
    color: #878a99;
    font-size: 16px;
    font-weight: 600;
}
.invoice-one .customer-name {
    font-size: 24px;
    font-weight: 700;
    color: #2c3038;
    margin-bottom: 15px;
}
.invoice-one .bill-add {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 450;
    color: #878a99;
}
.invoice-one .invoice-table table tr td {
    margin: 0;
    padding: 20px 15px;
    font-size: 15px;
    font-weight: 350;
    height: 82px;
    vertical-align: middle;
}
.invoice-one .invoice-table table tr td span {
    color: #7539ff;
    display: block;
    font-size: 12px;
    font-weight: 400;
}
.invoice-one .invoice-table-footer .table-footer-right .totalamt-table td {
    color: #2c3038;
    font-size: 17px;
    font-weight: 700;
}
.invoice-one .bank-details .terms-condition span {
    font-size: 18px;
    margin: 0 10px;
    color: #28084b;
}
.invoice-one .bank-details .terms-condition {
    margin: 0;
    padding: 0;
    color: #2c3038;
    border: 0;
}

</style>
<meta charset="utf-8">
</head>
<body>
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
                                    <td class="text-start">{{ $value->disc_amt }}%</td>
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
									$totalAmount = ceil(($totalAmount + $totalTax));
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
                                        <span class="payment-title">Supplier's Ref :{{ $sales->supplier_refno }}</span><br>
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
            
        </div>
    </div>

</body>
</html>
