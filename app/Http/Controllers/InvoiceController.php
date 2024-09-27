<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Redirect;
use DB;
use Auth;
use Validator;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Sales;
use App\Sales_values;
use App\Vouchers;
use App\Vouchers_values;
use App\Items;
use App\Customers;
use App\Company_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;


class InvoiceController extends Controller
{
    public function Index()
    {
        return view('pages.invoice');
    }
	
	public function getSalesInvoice($sid, $invType)
	{
		$sid = base64_decode($sid);
		//get sales details
		$sales = DB::table('sales')
								->select(DB::raw('sales.*'))
								->where('id', '=', $sid)
								->get();
		$sales = $sales[0];	
		$inv_num = $sales->inv_num;
		$custId = $sales->inv_name;
		$added_by = $sales->added_by;
		$invDate = $sales->created_at;
		//get company details
		$compDetails = DB::table('users')
						->select(DB::raw('users.name,company_profiles.comp_name,company_profiles.gst_no,company_profiles.comp_pan_no,company_profiles.comp_bill_addone'))					
						->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')                   					
						->where('users.id','=',$added_by) 
						->get();
		$compDetails = isset($compDetails[0])?$compDetails[0]:$compDetails;
		//get customer details
		$custDetails = DB::table('customers')
						->select(DB::raw('customers.*'))					                   					
						->where('customers.id','=',$custId) 
						->get();
		//echo "<pre>";print_r($custDetails);exit;
		$custDetails = isset($custDetails[0])?$custDetails[0]:$custDetails;
		$stateBill = DB::table('states')
					->select(DB::raw('states.name'))
				    ->where('states.id', '=', $custDetails->cust_bill_state) 
				    ->get();
		$cityBill = DB::table('cities')
					->select(DB::raw('cities.name'))
					->where('cities.id', '=', $custDetails->cust_bill_city) 
					->get();
		$stateShip = DB::table('states')
					->select(DB::raw('states.name'))
					->where('states.id', '=', $custDetails->cust_ship_state) 
					->get();
		$cityShip = DB::table('cities')
					->select(DB::raw('cities.name'))
					->where('cities.id', '=', $custDetails->cust_ship_city) 
					->get();
		//get sales items 
		$sales_values = DB::table('sales_values')
								->select(DB::raw('sales_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($sales_values as $k=>$val)
		{
			$array[$k]['id'] = $val->id;
			$array[$k]['sid'] = $val->sid;
			$array[$k]['prod_id'] = $val->prod_id;
			$array[$k]['quantity'] = $val->quantity;
			$array[$k]['rate'] = $val->rate;
			$array[$k]['disc'] = $val->disc;
			$array[$k]['disc_amt'] = $val->disc_amt;
			$array[$k]['tax_amt'] = $val->tax_amt;
			$array[$k]['amount'] = $val->amount;
			$array[$k]['tax_type'] = $val->tax_type;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$k]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$k]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$k]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
				$array[$k]['sac_code'] = isset($item[0]->sac_code)?$item[0]->sac_code:"";
				$array[$k]['hsn_code'] = isset($item[0]->hsn_code)?$item[0]->hsn_code:"";
			}else{
				$array[$k]['item_name'] = "";
				$array[$k]['base_unit'] = "";
				$array[$k]['sec_unit'] = "";
			} 
			$array[$k]['inv_num'] = $inv_num;
			$array[$k]['added_by'] = $sales->added_by;
			$array[$k]['signature'] = $sales->signature;
			$array[$k]['signature_name'] = $sales->signature_name;
		}
		$sales_values = json_decode(json_encode($array));
		
		if($invType == "invoice"){
			return view('pages.invoice')->with([
				'sid'=>$sid,
				'sales'=>$sales,
				'sales_values'=>$sales_values,
				'inv_num' => $inv_num,
				'invDate' => $invDate,
				'compDetails' => $compDetails,
				'custDetails' => $custDetails,
				'stateBill' => $stateBill,
				'cityBill' => $cityBill,
				'stateShip' => $stateShip,
				'cityShip' => $cityShip,
			]);
		}else{
			$pdf = \PDF::loadView('pages.sales-invoice-pdf', 
			compact('sales','sales_values','inv_num','invDate','compDetails','custDetails','stateBill','cityBill','stateShip','cityShip'))
			->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
			$pdfName = 'Sales-Inv-'.$inv_num.'.pdf';
			return $pdf->stream($pdfName);
		}
	}
}

