<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
	protected $fillable = ['id','custId','payment_date','purpose_of_payment','mode_of_payment','payment_type','payment_type_opt','amount','message','cash_type','customerId','bankname','pay_voucher_no','common_narration'];
}
?>