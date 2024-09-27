<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;
	protected $fillable = ['id','added_by','bank_name','branch','app_name','loan_ac_no','bank_code','credit_limit','status','created_at','updated_at'];
}
?>