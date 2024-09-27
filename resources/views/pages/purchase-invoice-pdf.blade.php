<!doctype html>
<html>
<head>

<meta charset="utf-8">

<?php  $sales_values = json_decode(json_encode($sales_values)); 


//echo "<pre>";print_r($sales_values);exit; 

$signature = isset($sales_values[0]->signature)?$sales_values[0]->signature:"";
$signature_name = isset($sales_values[0]->signature_name)?$sales_values[0]->signature_name:"";
$added_by = isset($sales_values[0]->added_by)?$sales_values[0]->added_by:"";
$inv_num = isset($sales_values[0]->inv_num)?$sales_values[0]->inv_num:"";

if($added_by !=""){
	$userDetails = DB::table('users')->where('id','=',$added_by)->get();
}else{
	$userDetails = "";
}
?>
<title>Purchase Invoice #{{ $inv_num }}</title>
<style>

.forborder tr th,.forborder tr td {
  border: 1px solid #e8e8e8;
}
</style>
</head>



<body>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:16px;color:#333;font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif">
  <tr>
    <td colspan="2" align="center" style="padding:20px 0;"><img src="<?php  echo asset('public/assets/img/logo.png') ?>" width="299" height="61"  alt=""/></td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:25px;font-weight:bold;border-bottom:#bbb 4px double;border-top:#bbb 4px double;padding:10px 0;">
    	Purchase Invoice #{{ $inv_num }}
    </td>
  </tr>
  <tr>
    <td width="100%" valign="top" style="padding:15px;border-bottom:#bbb 4px double; background:#fff8e9;">
    	<table border="0" cellpadding="0" cellspacing="0" width="81%">
          <tr>
            <td width="" style="font-weight:bold; font-size:18px;">User Details</td>
          </tr>
          <tr>
            <td><strong>Name:</strong> {{ isset($userDetails[0]->name)?$userDetails[0]->name:"" }}</td>
          </tr>
          <tr>
            <td><strong>Email:</strong> {{ isset($userDetails[0]->email)?$userDetails[0]->email:"" }}</td>
          </tr>
          <tr>
            <td><strong>Phone:</strong> {{ isset($userDetails[0]->phone)?$userDetails[0]->phone:"" }}</td>
          </tr>
        </table>
    </td>
    
  </tr>
  <tr>
  	<td colspan="2" style="font-weight:bold; font-size:18px; padding:10px 0;"></td>
  </tr>
  <tr>
  	<td colspan="2">
    	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="forborder">
          <tr style="background:#4cbcac">
            <th align="" width="9%" scope="col" style="padding:10px;color:#fff;">Sl No.</th>
            <th width="43%" scope="col" style="padding:10px;color:#fff;">Product/Service</th>
            <th width="8%" scope="col" style="padding:10px;color:#fff;">Quantity</th>
            <th width="10%" scope="col" style="padding:10px;color:#fff;">Unit</th>
            <th width="10%" scope="col" style="padding:10px;color:#fff;">Rate</th>
            <th width="9%" scope="col" style="padding:10px;color:#fff;">Discount</th>
            <th width="9%" scope="col" style="padding:10px;color:#fff;">Tax</th>
            <th align="right" width="11%" scope="col" style="padding:10px;color:#fff;">Total</th>
          </tr>
		  
			<?php 
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
            <td align="left" style="padding:10px;">{{ $k }}.</td>
            <td align="center" style="padding:10px;">{{ $value->item_name }}</td>
            <td align="center" style="padding:10px;">{{ $value->quantity }}</td>
            <td align="center" style="padding:10px;">{{ $value->base_unit }}</td>
            <td align="center" style="padding:10px;">{{ $value->rate }}</td>
            <td align="center" style="padding:10px;">₹{{ $value->disc_amt }}</td>
            <td align="center" style="padding:10px;">₹{{ $value->tax_amt }}</td>
            <td align="right" style="padding:10px;">₹{{ $value->amount }}</td>
          </tr>
			
          <?php 
		  
				 $taxableAmt += ($value->rate * $value->quantity);
				 $totalDisc += $value->disc_amt;
				 $totalTax += $value->tax_amt; 
				 $totalAmount += $value->amount; 
			} }?>
          <tr>
            
            <td colspan="8">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <th width="89%" align="right" scope="col" style="padding:10px;border:none;">Total</th>
                    <th width="11%" align="right" scope="col" style="padding:10px;border:none;">₹{{ number_format($totalAmount,2) }}</th>
                  </tr>
                </table>

            </td>
          </tr>
        </table>

    </td>
  </tr>
  
  @if(@$signature !="")
  <tr>
    <td colspan="2" align="right" style="padding:20px 0;"><img src="<?php  echo asset('public/uploads/invoice-signature/'.$signature) ?>" width="299" height="61"  alt=""/></td>
  </tr>
  @endif
  @if(@$signature_name !="")
  <tr>
    <td colspan="2" align="right" style="padding:20px 0;">
    	{{ $signature_name }}
    </td>
  </tr>
  @endif
</table>

</body>
</html>
