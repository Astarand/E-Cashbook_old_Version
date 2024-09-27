<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','expense_date','pur_of_expense','mode_of_expense','expense_cat','expense_type','expense_amt','expense_msg','exp_invno','approved_by','designation','approved_date','spec_note','exp_inv_doc','status','created_at', 'updated_at'];
}
