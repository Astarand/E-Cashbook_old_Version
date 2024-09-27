<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','empId','dept_id','desig_id','dob','qualification','c_addr_lineone','c_addr_linetwo','c_emp_country','c_emp_state','c_emp_city','c_emp_pincode','p_addr_lineone','p_addr_linetwo','p_emp_country','p_emp_state','p_emp_city','p_emp_pincode','basic_sal','hra','convayance','special_bonus','provident_fund','esi','loan','ptax','tds','total_deduction','total_addition','net_sal','net_sal_word','created_at','updated_at'];
}
