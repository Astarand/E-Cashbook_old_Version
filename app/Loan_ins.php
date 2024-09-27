<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_ins extends Model
{
    use HasFactory;
	protected $fillable = ['id','added_by','loanId','ins_date','payment_mode','ins_amt','curr_amt','message','ins_doc','created_at','updated_at'];
}
?>