<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','inv_num','invoice_number','inv_date','v_num','v_name','seller_name','seller_addone','seller_addtwo','seller_country','seller_state','seller_city','seller_pin','note_date','reason_issuance','otherIssuance','credit_debit_amount','adjusted_amount','terms_delivery','term_condition','voucher_doc','contact_no','branch_name','trans_type','note_type','return_reason','return_reason_other','purchase_no','purchase_date','sales_no','sales_date','doc_no','doc_date','challan_no','challan_date','v_date','v_due_date','v_no','tax_nature','total_amt','signature','signature_name','status','created_at','updated_at'];
}

