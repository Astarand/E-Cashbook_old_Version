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
                    
                    <span class="line"></span>
                    <h5>Invoice</h5>
                    
                    <div class="customer">
                        <span>Customer Name: {{ $data->user->name }}</span>
                    </div>
                    <div class="customer">
                        <span>Email: {{ $data->user->email }}</span>
                    </div>
                    <div class="customer">
                        <span>Phone: {{ $data->user->phone }}</span>
                    </div>
                    
                    <div class="customer">
                        <span>Company Name: {{ $data->company_name }}</span>
                    </div>
                    <div class="customer">
                        <span>Subscription Trough: {{ ($data->user->ca_add_by == '0')? 'Individual' : 'CA' }}</span>
                    </div>
                    <div class="customer">
                        <span>Package Name: {{ (empty($data->user->plan_name))? 'N/A' : $data->user->plan_name }}</span>
                    </div>
                    <div class="customer">
                        <span>Subscription Type: {{ (empty($data->user->plan_type))? 'N/A' : $data->user->plan_type }}</span>
                    </div>
                    <div class="customer">
                        <span>Amount: {{ (empty($data->user->paid_amount))? 'N/A' : $data->user->paid_amount }}</span>
                    </div>
                    <div class="customer">
                        <span>Start Date: {{ (empty($data->user->start_at))? 'N/A' : $data->user->start_at }}</span>
                    </div>
                    <div class="customer">
                        <span>End Date: {{ (empty($data->user->end_at))? 'N/A' : $data->user->end_at }}</span>
                    </div>
                    <div class="customer">
                        <span>Transaction Id: {{ (empty($data->user->transaction_id))? 'N/A' : $data->user->transaction_id }}</span>
                    </div>
                    <div class="customer">
                        <span>Transaction Status: {{ (empty($data->user->payment_status))? 'N/A' : $data->user->payment_status }}</span>
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
