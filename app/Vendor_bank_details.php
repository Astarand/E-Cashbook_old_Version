<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor_bank_details extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'vendor_id','uid','utype','bank_name','bank_branch','acc_holder_name','acc_number','acc_ifsc','acc_upi_id'];
}
