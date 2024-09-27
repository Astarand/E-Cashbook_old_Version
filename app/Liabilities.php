<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liabilities extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','liab_type','ac_payable','short_term_loans','accrued_liabilities','long_term_debt','unearned_revenue','current_liabilities','deferred_tax_liabilities','pension_liabilities','lease_liabilities','long_term_liabilities','liabilities_type','other_liabilities_type','amount','status','created_at','updated_at'];
}
