<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','item_type','item_name','base_unit','sec_unit','base_unit_other','item_cat','hsn_code','sac_code','opening_stock_bal','opening_stock','opening_stock_amt','purchase_stock','purchase_stock_amt','closing_stock','closing_stock_amt','reseller_stock','reseller_stock_amt','opening_stock_name','op_stock_oth_amt','purchase_stock_name','pu_stock_oth_amt','closing_stock_name','cl_stock_oth_amt','reseller_stock_name','re_stock_oth_amt','item_bill_no','item_actual_no','item_date','selling_price','selling_tax','wholesale_price','wholesale_tax','purchase_price','purchase_tax','disc_sell','disc_sell_type','min_wholesale_quantity','item_tax','prod_desc','prod_image','created_at','updated_at'];
}
