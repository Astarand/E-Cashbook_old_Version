<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_banks extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'uid','bank_name','bank_branch','bank_holder_name','ac_no','ifsc_code','ac_upid'];
}
