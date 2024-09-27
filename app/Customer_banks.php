<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_banks extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'custId','uid','utype','cust_bank_name','cust_bank_branch','cust_bank_holder_name','cust_ac_no','cust_ifsc_code','cust_ac_upid'];
}
