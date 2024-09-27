<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Redirect;
//use DB;
use Auth;
use Validator;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Purchases;
use App\Purchase_values;
use App\Voucher_purchases;
use App\Customers;

use App\Voucher_purchase_values;
use App\Items;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;


class PurchaseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function PurchaseInvoiceIndex()
    {
        $title = 'Purchase Invoice';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$sales =  DB::table('purchases')
							->select(DB::raw('purchases.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'purchases.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'purchases.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$sales =  DB::table('purchases')
							->select(DB::raw('purchases.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'purchases.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'purchases.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$sales =  DB::table('purchases')
							->select(DB::raw('purchases.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'purchases.added_by', '=', 'company_profiles.userId')
							->where('purchases.added_by', '=', $userId)
							->orderBy('purchases.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$sales =  DB::table('purchases')
							->select(DB::raw('purchases.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'purchases.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$sales_pagination = $sales;
		
		$array = array();
		foreach($sales as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['inv_num'] = $val->inv_num;
			$array[$val->id]['inv_name'] = $val->inv_name;
			$array[$val->id]['bill_name'] = $val->bill_name;
			$array[$val->id]['contact_no'] = $val->contact_no;
			$array[$val->id]['branch_name'] = $val->branch_name;
			$array[$val->id]['inv_date'] = $val->inv_date;
			$array[$val->id]['mode_of_pay'] = $val->mode_of_pay;
			$array[$val->id]['other_payment'] = $val->other_payment;
			$array[$val->id]['pay_status'] = $val->pay_status;
			$array[$val->id]['total_amount'] = $val->total_amount;
			$array[$val->id]['status'] = $val->status;

			$customerName =  DB::table('customers')
							->select(DB::raw('customers.cust_name,customers.cust_phone'))
							->where('id', '=', $val->inv_name)
							->get();
			$array[$val->id]['cust_name'] = isset($customerName[0]->cust_name)?$customerName[0]->cust_name:"";
			$array[$val->id]['cust_phone'] = isset($customerName[0]->cust_phone)?$customerName[0]->cust_phone:"";
			if($val->id >0){
				$salesValue =  DB::table('purchase_values')
							->select(DB::raw('SUM(purchase_values.amount) as grandTotal'))
							->where('sid', '=', $val->id)
							->get();
				$array[$val->id]['grandTotal'] = isset($salesValue[0]->grandTotal)?$salesValue[0]->grandTotal:0;
			}else{
				$array[$val->id]['grandTotal'] = 0;

			} 
		}
		$sales = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($sales);exit;
		return view('pages.purchase-invoice')->with([
			'title' =>$title,
			'sales'=>$sales,
			'sales_pagination' =>$sales_pagination,
		]); 
        
    }

	public function create_purchase_invoice_number($userId){

		

		$current_month = strtoupper(date('M'));
		$current_year = date('y');
		$next_year = date('y', strtotime('+1 year'));
		$financial_year = "$current_year-$next_year";
		
		// Fetch the latest invoice number
		$latestInvoice = DB::table('purchases')
			
			->where('added_by', $userId)
			->orderBy('id', 'desc')
			->first();

		// Initialize the next invoice number
		$next_number = 1;

		if ($latestInvoice) {
			$latest_inv_num = $latestInvoice->inv_num;
			$latest_parts = explode('/', $latest_inv_num);
			$latest_number = end($latest_parts);
			$next_number = intval($latest_number) + 1;
		}

		// Format the next invoice number
		$next_number = str_pad($next_number, 4, '0', STR_PAD_LEFT);
		$new_inv_num =  $current_month . '/' . $financial_year . '/' . $next_number;
		return $new_inv_num;
	}

    public function addPurchaseInvoice()
    {
        $userId = Auth::user()->id;
		// $invoiceNo = DB::table('purchases')
		// 						->select(DB::raw('MAX(id) as id'))
		// 						->get();
		// $invoiceNo = isset($invoiceNo[0]->id)?$invoiceNo[0]->id:0;
		// $invoiceNo = Helper::invoice_num($invoiceNo+1,7,"PI-");

		$invoiceNo = $this->create_purchase_invoice_number($userId);

		

		$compData = DB::table('company_profiles')
								->select(DB::raw('comp_name,comp_phone,comp_email,comp_pan_no,comp_bill_addone,comp_bill_addtwo,comp_bill_name,comp_bill_mobile_no'))
								->where('company_profiles.userId','=',$userId)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',$userId)
								->where('customers.status','=',1)
								->get();
		$comp_name = isset($compData[0]->comp_name)?$compData[0]->comp_name:"";
		$comp_phone = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:"";
		$comp_email = isset($compData[0]->comp_email)?$compData[0]->comp_email:"";
		$comp_pan_no= isset($compData[0]->comp_pan_no)?$compData[0]->comp_pan_no:"";
		$comp_bill_addone= isset($compData[0]->comp_bill_addone)?$compData[0]->comp_bill_addone:"";
		$comp_bill_addtwo= isset($compData[0]->comp_bill_addtwo)?$compData[0]->comp_bill_addtwo:"";
		$comp_bill_name= isset($compData[0]->comp_bill_name)?$compData[0]->comp_bill_name:"";
		$comp_bill_mobile_no= isset($compData[0]->comp_bill_mobile_no)?$compData[0]->comp_bill_mobile_no:"";
		//echo "<pre>"; print_r($comp_bill_name);exit;
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($compDetails->comp_bill_country)?$compDetails->comp_bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($compDetails->comp_bill_state)?$compDetails->comp_bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($compDetails->comp_ship_country)?$compDetails->comp_ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($compDetails->comp_ship_state)?$compDetails->comp_ship_state:0)->get();
		
		return view('pages.add-purchase-invoice')->with([
			'invoiceNo'=>$invoiceNo,
			'comp_name'=>$comp_name,
			'comp_phone'=>$comp_phone,
			'comp_email'=>$comp_email,
			'comp_pan_no'=>$comp_pan_no,
			'comp_bill_addone'=>$comp_bill_addone,
			'comp_bill_addtwo'=>$comp_bill_addtwo,
			'comp_bill_name'=>$comp_bill_name,
			'comp_bill_mobile_no'=>$comp_bill_mobile_no,
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'custData'=>$custData,
		]);
        
    }
	
	//Start for purchase invoice
	protected function validator(array $data)
    {

		/* if($data['transport_type'] == 'Other'){
			$transport_type_other = "required";
		}else{
			$transport_type_other = "";
		} */
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'inv_num' => 'required',
				//'inv_name' => 'required',
				'inv_date' => 'required',
				/*'add_type' => 'required',
				 'contact_no' => 'required',
				'branch_name' => 'required',
				'trans_type' => 'required',
				'tax_nature' => 'required',
				'comp_type' => 'required',
				'cust_pan' => 'required',
				'cust_gst_no' => 'required',
				'gst_reg' => 'required',
				'cust_gst_type' => 'required',
				'branch' => 'required',
				'cont_per_name'=>'required',
			    'cont_num'=>'required',
				'bill_to_party' => 'required',
				'ship_to_party' => 'required',
				'transport_type' => 'required',
			    'transport_type_other' => $transport_type_other,
				'bill_name' => 'required',              
				'bill_addone' => 'required',                    
				'bill_country' => 'required',
				'bill_state' => 'required',
				'bill_city' => 'required',
				'bill_pin' => 'required',
				'ship_name' => 'required',
				'ship_addone' => 'required',
				'ship_country' => 'required',
				'ship_state' => 'required',
				'ship_city' => 'required',
				'ship_pin' => 'required', */
			]);
			
    }
	
	protected function validatorSeller(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		return Validator::make($data, [
			'inv_num' => 'required',
			'inv_date' => 'required',
			'seller_name' => 'required',
			'seller_contact' => 'required',
			'seller_email' => 'required',
			'seller_pan' => 'required',
			'seller_addone' => 'required',                    
			'seller_country' => 'required',
			'seller_state' => 'required',
			'seller_city' => 'required',
			'seller_pin' => 'required',            
		]);
			
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		// $invoiceNo = DB::table('purchases')
		// 						->select(DB::raw('MAX(id) as id'))
		// 						->get();
		// $invoiceNo = isset($invoiceNo[0]->id)?$invoiceNo[0]->id:0;
		// $invoiceNo = Helper::invoice_num($invoiceNo+1,7,"PI-");

		/* if($data['transport_type'] == 'Other'){
			$transport_type_other = $data['transport_type_other'];
		}else{
			$transport_type_other = "";
		} */

		$uid = Auth::user()->id;
		$invoiceNo = $this->create_purchase_invoice_number($uid);

        return Purchases::create([
            'added_by' => Auth::user()->id,
            'inv_num' => $invoiceNo,
			'inv_date' => $data['inv_date'],
			//'inv_name' => $data['inv_name'],
			//'add_type' => $data['add_type'],
			'seller_name' => $data['seller_name'],
			'seller_contact' => $data['seller_contact'],
			'seller_email' => $data['seller_email'],
			'seller_pan' => $data['seller_pan'],
			'seller_gst' => $data['seller_gst'],
			'seller_person_name'=> $data['seller_person_name'],
			'seller_person_no'=> $data['seller_person_no'],
			'seller_addone' => $data['seller_addone'],
			'seller_addtwo' => $data['seller_addtwo'],
			'seller_country' => $data['seller_country'],
			'seller_state' => $data['seller_state'],
			'seller_city' => $data['seller_city'],
			'seller_pin' => $data['seller_pin'],
			'created_at' => date('Y-m-d H:i:s'),
			/*'gst_reg' => $data['gst_reg'],
			'comp_type' => $data['comp_type'],
			'cust_pan' => $data['cust_pan'],
			'cust_gst_no' => $data['cust_gst_no'],
			'cust_gst_type' => $data['cust_gst_type'],
			'cust_email' => $data['cust_email'],

			'contact_no' => $data['contact_no'],
			'branch_name' => $data['branch_name'],
			'trans_type' => $data['trans_type'],
			'tax_nature' => $data['tax_nature'],
			'tax_applicable'=>$data['tax_applicable'],
			'branch' => $data['branch'],
			'cont_per_name'=>$data['cont_per_name'],
			'cont_num'=>$data['cont_num'],
			'bill_to_party' => $data['bill_to_party'],
			'ship_to_party' => $data['ship_to_party'],
			'transport_type' => $data['transport_type'],
			'transport_type_other' => $transport_type_other,
			'bill_name' => $data['bill_name'],              
			'bill_addone' => $data['bill_addone'],                    
			'bill_addtwo' => isset($data['bill_addtwo'])?$data['bill_addtwo']:"",                    
			'bill_country' => $data['bill_country'],
			'bill_state' => $data['bill_state'],
			'bill_city' => $data['bill_city'],
			'bill_pin' => $data['bill_pin'],
			'ship_name' => $data['ship_name'],
			'ship_addone' => $data['ship_addone'],
			'ship_addtwo' => isset($data['ship_addtwo'])?$data['ship_addtwo']:"",
			'ship_country' => $data['ship_country'],
			'ship_state' => $data['ship_state'],
			'ship_city' => $data['ship_city'],
			'ship_pin' => $data['ship_pin'],                      
			'created_at' => date('Y-m-d H:i:s'),*/
        ]);
    }

	protected function getinvcust_purchase(Request $request)
	{

		 $id = $request->id;
		 $salesTableID = $request->salesTableID;
		
		
		$result = DB::table('purchases')
				->where('inv_name', '=', $id)
				->where('id', '=', $salesTableID)
				->get();
			
		//echo "<pre>";print_r($result);exit;

		if (count($result) > 0) {
			$stateBill = State::query()
				->where('country_id', '=', $result[0]->bill_country)
				->get()->toArray();
			$cityBill = City::query()
				->where('state_id', '=', $result[0]->bill_state)
				->get()->toArray();
			$stateShip = State::query()
				->where('country_id', '=', $result[0]->ship_country)
				->get()->toArray();
			$cityShip = City::query()
				->where('state_id', '=', $result[0]->ship_state)
				->get()->toArray();
			$resStateBill = [];
			$resCityBill = [];
			$resStateShip = [];
			$resCityShip = [];

			foreach ($stateBill as $row) {

				$resStateBill[] = array("id" => $row['id'], "name" => $row['name'], "sid" => $result[0]->bill_state);
			}
			foreach ($cityBill as $row1) {

				$resCityBill[] = array("id" => $row1['id'], "name" => $row1['name'], "sid" => $result[0]->bill_city);
			}
			foreach ($stateShip as $row) {

				$resStateShip[] = array("id" => $row['id'], "name" => $row['name'], "selid" => $result[0]->ship_state);
			}
			foreach ($cityShip as $row1) {

				$resCityShip[] = array("id" => $row1['id'], "name" => $row1['name'], "selid" => $result[0]->ship_city);
			}
			$array = array();
			$resultCust = Customers::query()
					->where('id', '=', $id)
					->get();
			foreach ($result as $k => $val) {
				$array['id'] = $resultCust[0]->id;
				$array['cust_email'] = $resultCust[0]->cust_email;
				$array['cust_phone'] = $resultCust[0]->cust_phone;
				$array['cust_pan'] = $resultCust[0]->cust_pan;
				$array['gst_reg'] = $resultCust[0]->gst_reg;

				

				// $array['cust_gst_no'] = $val->cust_gst_no;
				// $array['cust_gst_type'] = $val->cust_gst_type;
				$array['add_type'] = $val->add_type;
				$array['cust_bill_gstno'] = $val->cust_bill_gstno;
				$array['cust_bill_contact'] = $val->cust_bill_contact;
				$array['cust_bill_mobilno'] = $val->cust_bill_mobilno;
				$array['cust_bill_designa'] = $val->cust_bill_designa;
				$array['cust_bill_name'] = $val->bill_name;
				$array['cust_bill_addone'] = $val->bill_addone;
				$array['cust_bill_addtwo'] = $val->bill_addtwo;
				$array['cust_bill_country'] = $val->bill_country;
				$array['cust_bill_state'] = $val->bill_state;
				$array['cust_bill_city'] = $val->bill_city;
				$array['stateBill'] = $resStateBill;
				$array['cityBill'] = $resCityBill;
				$array['cust_bill_pin'] = $val->bill_pin;

				$array['cust_ship_gstno'] = $val->cust_ship_gstno;
				$array['cust_ship_contact'] = $val->cust_ship_contact;
				$array['cust_ship_mobilno'] = $val->cust_ship_mobilno;
				$array['cust_ship_designa'] = $val->cust_ship_designa;
				$array['cust_ship_name'] = $val->ship_name;

				$array['cust_ship_addone'] = $val->ship_addone;
				$array['cust_ship_addtwo'] = $val->ship_addtwo;
				$array['cust_ship_country'] = $val->ship_country;
				$array['cust_ship_state'] = $val->ship_state;
				$array['cust_ship_city'] = $val->ship_city;
				$array['stateShip'] = $resStateShip;
				$array['cityShip'] = $resCityShip;
				$array['cust_ship_pin'] = $val->ship_pin;
				
			}

		} else {
			$result = Customers::query()
				->where('id', '=', $id)
				->get();


			$stateBill = State::query()
				->where('country_id', '=', $result[0]->cust_bill_country)
				->get()->toArray();
			$cityBill = City::query()
				->where('state_id', '=', $result[0]->cust_bill_state)
				->get()->toArray();
			$stateShip = State::query()
				->where('country_id', '=', $result[0]->cust_ship_country)
				->get()->toArray();
			$cityShip = City::query()
				->where('state_id', '=', $result[0]->cust_ship_state)
				->get()->toArray();
			$resStateBill = [];
			$resCityBill = [];
			$resStateShip = [];
			$resCityShip = [];
			foreach ($stateBill as $row) {

				$resStateBill[] = array("id" => $row['id'], "name" => $row['name'], "sid" => $result[0]->cust_bill_state);
			}
			foreach ($cityBill as $row1) {

				$resCityBill[] = array("id" => $row1['id'], "name" => $row1['name'], "sid" => $result[0]->cust_bill_city);
			}
			foreach ($stateShip as $row) {

				$resStateShip[] = array("id" => $row['id'], "name" => $row['name'], "selid" => $result[0]->cust_ship_state);
			}
			foreach ($cityShip as $row1) {

				$resCityShip[] = array("id" => $row1['id'], "name" => $row1['name'], "selid" => $result[0]->cust_ship_city);
			}
			$array = array();
			foreach ($result as $k => $val) {
				$array['id'] = $val->id;
				$array['cust_email'] = $val->cust_email;
				$array['cust_phone'] = $val->cust_phone;
				$array['cust_pan'] = $val->cust_pan;
				$array['gst_reg'] = $val->gst_reg;
				$array['cust_gst_no'] = $val->cust_gst_no;
				$array['cust_gst_type'] = $val->cust_gst_type;
				$array['comp_type'] = $val->comp_type;

				$array['cust_bill_addone'] = $val->cust_bill_addone;
				$array['cust_bill_addtwo'] = $val->cust_bill_addtwo;
				$array['cust_bill_country'] = $val->cust_bill_country;
				$array['cust_bill_state'] = $val->cust_bill_state;
				$array['cust_bill_city'] = $val->cust_bill_city;
				$array['stateBill'] = $resStateBill;
				$array['cityBill'] = $resCityBill;
				$array['cust_bill_pin'] = $val->cust_bill_pin;


				$array['cust_bill_gstno'] = $val->cust_bill_gstno;
				$array['cust_bill_contact'] = $val->cust_bill_contact;
				$array['cust_bill_mobilno'] = $val->cust_bill_mobilno;
				$array['cust_bill_designa'] = $val->cust_bill_designa;
				$array['cust_bill_name'] = $val->cust_bill_name;



				$array['cust_ship_addone'] = $val->cust_ship_addone;
				$array['cust_ship_country'] = $val->cust_ship_country;
				$array['cust_ship_state'] = $val->cust_ship_state;
				$array['cust_ship_city'] = $val->cust_ship_city;
				$array['stateShip'] = $resStateShip;
				$array['cityShip'] = $resCityShip;
				$array['cust_ship_pin'] = $val->cust_ship_pin;

				$array['cust_ship_gstno'] = $val->cust_ship_gstno;
				$array['cust_ship_contact'] = $val->cust_ship_contact;
				$array['cust_ship_mobilno'] = $val->cust_ship_mobilno;
				$array['cust_ship_designa'] = $val->cust_ship_designa;
				$array['cust_ship_name'] = $val->cust_ship_name;
				$array['cust_ship_addtwo'] = $val->cust_ship_addtwo;
			}
		}


		

		//$result = json_decode(json_encode($array));
		$result = $array;
		//echo "<pre>";print_r($result);exit;
		echo json_encode($result);
	}

     
	
	public function save_purchase_invoice(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validatorSeller($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertSales = $this->create($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if ($insertSales){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/edit-purchase-invoice/'.base64_encode($sId)),
					'message' => 'Purchase added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Purchase add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function items_purchase_list($sid)
	{
		
		$sales_values = DB::table('purchase_values')
								->select(DB::raw('purchase_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($sales_values as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['sid'] = $val->sid;
			$array[$val->id]['prod_id'] = $val->prod_id;
			$array[$val->id]['quantity'] = $val->quantity;
			$array[$val->id]['rate'] = $val->rate;
			$array[$val->id]['disc'] = $val->disc;
			$array[$val->id]['disc_type'] = $val->disc_type;
			$array[$val->id]['disc_amt'] = $val->disc_amt;
			$array[$val->id]['tax_amt'] = $val->tax_amt;
			$array[$val->id]['amount'] = $val->amount;
			$array[$val->id]['tax_type'] = $val->tax_type;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$val->id]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$val->id]['sac_code'] = isset($item[0]->sac_code)?$item[0]->sac_code:"";
				$array[$val->id]['hsn_code'] = isset($item[0]->hsn_code)?$item[0]->hsn_code:"";
				$array[$val->id]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$val->id]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$val->id]['item_name'] = "";
				$array[$val->id]['sac_code'] = "";
				$array[$val->id]['hsn_code'] = "";
				$array[$val->id]['base_unit'] = "";
				$array[$val->id]['sec_unit'] = "";
			} 
		}
		$sales_values = json_decode(json_encode($array));
		return $sales_values;
	}
	
	public function edit_purchase_invoice($sId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/purchase-invoice');
		}
		$sId = base64_decode($sId);
		$sales = DB::table('purchases')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$compData = DB::table('company_profiles')
								->select(DB::raw('comp_name,comp_phone,comp_email,comp_pan_no,comp_bill_addone,comp_bill_addtwo'))
								->where('company_profiles.userId','=',Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		$comp_name = isset($compData[0]->comp_name)?$compData[0]->comp_name:"";
		$comp_phone = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:"";
		$comp_email = isset($compData[0]->comp_email)?$compData[0]->comp_email:"";
		$comp_pan_no= isset($compData[0]->comp_pan_no)?$compData[0]->comp_pan_no:"";
		$comp_bill_addone= isset($compData[0]->comp_bill_addone)?$compData[0]->comp_bill_addone:"";
		$comp_bill_addtwo= isset($compData[0]->comp_bill_addtwo)?$compData[0]->comp_bill_addtwo:"";
		
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($sales->bill_country)?$sales->bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($sales->bill_state)?$sales->bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($sales->ship_country)?$sales->ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($sales->ship_state)?$sales->ship_state:0)->get();
		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();
		//echo "<pre>";print_r($sales);exit;

		$sales_values = $this->items_purchase_list($sId);
		return view('pages.edit-purchase-invoice')->with([	
			'comp_name'=>$comp_name,
			'comp_phone'=>$comp_phone,
			'comp_email'=>$comp_email,
			'comp_pan_no'=>$comp_pan_no,
			'comp_bill_addone'=>$comp_bill_addone,
			'comp_bill_addtwo'=>$comp_bill_addtwo,
			'products' => $products,
			'sales' => $sales,
			'other_payment' => $sales->other_payment,
			'sales_values' => $sales_values,
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'states_seller'=>$states_seller,
			'cities_seller'=>$cities_seller,
			'custData'=>$custData,
			'sId' => $sId
		]); 
    }
	
	public function view_purchase_invoice($sId)  {  
		$sId = base64_decode($sId);
		$sales = DB::table('purchases')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$compData = DB::table('company_profiles')
								->select(DB::raw('comp_name,comp_phone,comp_email,comp_pan_no,comp_bill_addone,comp_bill_addtwo'))
								->where('company_profiles.userId','=',Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		$comp_name = isset($compData[0]->comp_name)?$compData[0]->comp_name:"";
		$comp_phone = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:"";
		$comp_email = isset($compData[0]->comp_email)?$compData[0]->comp_email:"";
		$comp_pan_no= isset($compData[0]->comp_pan_no)?$compData[0]->comp_pan_no:"";
		$comp_bill_addone= isset($compData[0]->comp_bill_addone)?$compData[0]->comp_bill_addone:"";
		$comp_bill_addtwo= isset($compData[0]->comp_bill_addtwo)?$compData[0]->comp_bill_addtwo:"";
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($sales->bill_country)?$sales->bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($sales->bill_state)?$sales->bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($sales->ship_country)?$sales->ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($sales->ship_state)?$sales->ship_state:0)->get();
		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();
		//echo "<pre>";print_r($sales);exit;

		$sales_values = $this->items_purchase_list($sId);
		return view('pages.view-purchase-invoice')->with([	
			'comp_name'=>$comp_name,
			'comp_phone'=>$comp_phone,
			'comp_email'=>$comp_email,
			'comp_pan_no'=>$comp_pan_no,
			'comp_bill_addone'=>$comp_bill_addone,
			'comp_bill_addtwo'=>$comp_bill_addtwo,
			'products' => $products,
			'sales' => $sales,
			'sales_values' => $sales_values,
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'states_seller'=>$states_seller,
			'cities_seller'=>$cities_seller,
			'custData'=>$custData,
			'sId' => $sId
		]); 
    }
	
	public function update_purchase_invoice(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit('hello');
		$sId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			$update = DB::table('purchases')
					->where('id', $sId)
					->update(
						 array(
								'inv_num' => $request->inv_num,
								'inv_date' => $request->inv_date,
								'seller_name' => $request->seller_name,
								'seller_contact' => $request->seller_contact,
								'seller_email' => $request->seller_email,
								'seller_pan' => $request->seller_pan,
								'seller_gst' => isset($request->seller_gst)?$request->seller_gst:"",
								'seller_addone' => $request->seller_addone,
								'seller_addtwo' => isset($request->seller_addtwo)?$request->seller_addtwo:"",
								'seller_country' => $request->seller_country,
								'seller_state' => $request->seller_state,
								'seller_city' => $request->seller_city,
								'seller_pin' => $request->seller_pin,  
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function update_seller_details(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$sId = $request->id;
		
		
			$update = DB::table('purchases')
					->where('id', $sId)
					->update(
						array(
								'inv_name' => $request->inv_name,
								'add_type' => $request->add_type,
								'cust_bill_gstno' => $request->cust_bill_gstno,
								'cust_bill_contact' => $request->cust_bill_contact,
								'cust_bill_mobilno' => $request->cust_bill_mobilno,
								'cust_bill_designa' => $request->cust_bill_designa,
								'bill_name' => $request->cust_bill_name,
								'bill_addone' => $request->bill_addone,
								'bill_addtwo' => $request->bill_addtwo,
								'bill_country' => $request->cust_bill_country,
								'bill_state' => $request->cust_bill_state,
								'bill_city' => $request->cust_bill_city,
								'bill_pin' => $request->cust_bill_pin,


								'cust_ship_gstno' => $request->cust_ship_gstno,
								'cust_ship_contact' => $request->cust_ship_contact,
								'cust_ship_mobilno' => $request->cust_ship_mobilno,
								'cust_ship_designa' => $request->cust_ship_designa,
								'ship_name' => $request->cust_ship_name,
								'ship_addone' => $request->cust_ship_addone,
								'ship_addtwo' => $request->cust_ship_addtwo,
								'ship_country' => $request->cust_ship_country,
								'ship_state' => $request->cust_ship_state,
								'ship_city' => $request->cust_ship_city,
								'ship_pin' => $request->cust_ship_pin,

						)
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
		
    }
	
	
	
	public function purchase_items_display(Request $request)
    {
		//$this->middleware('auth'); 
		
		$sid = $request->sId;
		$uid = Auth::user()->id;
		$prod_id = $request->prod_id;
		
		$purchase_values = DB::table('purchase_values')
								->select(DB::raw('purchase_values.id,purchase_values.quantity'))
								->where('sid', '=', $sid)
								->where('uid', '=', $uid)
								->where('prod_id', '=', $prod_id)
								->get();
		
		$product = DB::table('items')
								->select(DB::raw('items.id,items.item_name,items.selling_price,items.disc_sell,items.disc_sell_type'))
								->where('id', '=', $prod_id)
								->get();
		$billing_type = isset($request->billing_type)?$request->billing_type:"";
		$gst_rate = isset($request->gst_rate)?$request->gst_rate:18;
		$gst_trans = isset($request->gst_trans)?$request->gst_trans:"";
		if (count($purchase_values) == 0) {
			$quantity = 1;
		}else{
			$quantity = $purchase_values[0]->quantity;
		}
		$rate = $product[0]->selling_price;
		$disc = $request->disc_sell;
		$disc_type = $request->disc_sell_type;
		
		if($disc_type == "percentage")
		{
			$disc_amt = (($product[0]->selling_price*$disc)/100);
		}else{
			$disc_amt = $disc;
		}		
		$amount = ($product[0]->selling_price - $disc_amt) * $quantity;
		$tax_amt = ($amount*$gst_rate)/100;
		$tax_type = "N/A";
		
		if (count($purchase_values) == 0) {
			$values = array('sid' => $sid,'uid' => $uid,'prod_id' => $prod_id,'quantity' => $quantity,'rate' => $rate,'disc' => $disc,'disc_type'=>$disc_type,'disc_amt' => $disc_amt,'tax_amt'=>$tax_amt,'amount'=>$amount,'tax_type'=>$tax_type,'billing_type'=>$billing_type,'gst_rate'=>$gst_rate,'gst_trans'=>$gst_trans);
			$insertInvoice = DB::table('purchase_values')->insert($values);
		}else{
			$update = DB::table('purchase_values')
					->where('sid', '=', $sid)
					->where('uid', '=', $uid)
					->where('prod_id', '=', $prod_id)
					->update(
						 array(
								'quantity' => $quantity,
								'rate' => $rate,
								'disc' => $disc,
								'disc_type'=>$disc_type,
								'disc_amt' => $disc_amt,
								'tax_amt'=>$tax_amt,
								'amount'=>$amount,
								'tax_type'=>$tax_type,
								'billing_type'=>$billing_type,
								'gst_rate'=>$gst_rate,
								'gst_trans'=>$gst_trans
						 )
					);
		}
		
		
		$sales_values = $this->items_purchase_list($sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-purchase-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);  
    }
	
	public function fetchPurchaseItem(Request $request)
	{
		$sid = $request->id;
		$purchase_values = DB::table('purchase_values')
								->select(DB::raw('purchase_values.*'))
								->where('purchase_values.id', '=', $sid)
								->get();
							
		$array = array();
		foreach($purchase_values as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['sid'] = $val->sid;
			$array[$val->id]['prod_id'] = $val->prod_id;
			$array[$val->id]['quantity'] = $val->quantity;
			$array[$val->id]['rate'] = $val->rate;
			$array[$val->id]['disc'] = $val->disc;
			$array[$val->id]['disc_type'] = $val->disc_type;
			$array[$val->id]['disc_amt'] = $val->disc_amt;
			$array[$val->id]['tax_amt'] = $val->tax_amt;
			$array[$val->id]['amount'] = $val->amount;
			$array[$val->id]['tax_type'] = $val->tax_type;
			$array[$val->id]['gst_rate'] = $val->gst_rate;
			$array[$val->id]['billing_type'] = $val->billing_type;
			$array[$val->id]['prod_gov_fee'] = $val->prod_gov_fee;
			$array[$val->id]['gst_trans'] = $val->gst_trans;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$val->id]['item_type'] = isset($item[0]->item_type)?$item[0]->item_type:"";
				$array[$val->id]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$val->id]['disc_sell'] = isset($item[0]->item_name)?$item[0]->disc_sell:"";
				$array[$val->id]['sac_code'] = isset($item[0]->sac_code)?$item[0]->sac_code:"";
				$array[$val->id]['hsn_code'] = isset($item[0]->hsn_code)?$item[0]->hsn_code:"";
				$array[$val->id]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$val->id]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$val->id]['item_type'] = "";
				$array[$val->id]['item_name'] = "";
				$array[$val->id]['disc_sell'] = "";
				$array[$val->id]['sac_code'] = "";
				$array[$val->id]['hsn_code'] = "";
				$array[$val->id]['base_unit'] = "";
				$array[$val->id]['sec_unit'] = "";
			} 
		}
		$purchase_values = (json_encode($array));
		//echo "<pre>";print_r($purchase_values);exit;	
		return $purchase_values;
	}
	
	public function delPurchaseItem(Request $request)
    {
        $delPurchaseItem = DB::table('purchase_values')->where('id', $request->id)->delete();
		$sales_values = $this->items_purchase_list($request->sid);
		
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-purchase-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);  
		
    }
	
	public function update_purchase_item(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$salesData = DB::table('purchase_values')
								->select(DB::raw('purchase_values.sid,purchase_values.quantity'))
								->where('id', '=', $request->id)
								->get();
								
		$amount = ($request->rate - $request->disc_amt) * $salesData[0]->quantity;
		$update = DB::table('purchase_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $request->rate,
							'disc_amt' => $request->disc_amt,
							'amount' => $amount,
							'tax_type' => $request->tax_type
					 )
				);
		
		$sales_data = DB::table('purchase_values')
								->select(DB::raw('purchase_values.sid'))
								->where('id', '=', $request->id)
								->get();
		$sales_values = $this->items_purchase_list($sales_data[0]->sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-purchase-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);
    }
	
	public function update_purchase_item_quantity(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$sales_data = DB::table('purchase_values')
								->select(DB::raw('purchase_values.sid,purchase_values.rate,purchase_values.disc,purchase_values.disc_type,purchase_values.gst_rate'))
								->where('id', '=', $request->id)
								->get();
		$productRate = $sales_data[0]->rate;
		$gst_rate = $sales_data[0]->gst_rate;
		$disc = $sales_data[0]->disc;
		$disc_type = $sales_data[0]->disc_type;
		$amount = $productRate * $request->quantity;
		if($disc_type == "percentage")
		{
			$disc_amt = (($amount*$disc)/100);
		}else{
			$disc_amt = $disc;
		}		
		$amount = ($amount - $disc_amt);
		$tax_amt = ($amount*$gst_rate)/100;
		
		$update = DB::table('purchase_values')
				->where('id', $id)
				->update(
					 array(
							'quantity' => $request->quantity,
							//'rate' => $rate,
							'disc_amt' => $disc_amt,
							'tax_amt' => $tax_amt,
							'amount' => $amount 
					 )
				);
				
		$sales_values = $this->items_purchase_list($sales_data[0]->sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-purchase-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);
    }
	
	public function update_purchase_item_rate(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		$prod_id = $request->prod_id;
		
		$sales_data = DB::table('purchase_values')
								->select(DB::raw('purchase_values.sid,purchase_values.quantity,purchase_values.disc,purchase_values.disc_type,purchase_values.gst_rate'))
								->where('id', '=', $request->id)
								->get();

		$productRate = $request->rate;
		$gst_rate = $sales_data[0]->gst_rate;
		$disc = $sales_data[0]->disc;
		$disc_type = $sales_data[0]->disc_type;
		$amount = $productRate * $sales_data[0]->quantity;
		if($disc_type == "percentage")
		{
			$disc_amt = (($amount*$disc)/100);
		}else{
			$disc_amt = $disc;
		}		
		$amount = ($amount - $disc_amt);
		$tax_amt = ($amount*$gst_rate)/100; 
		
		$update = DB::table('purchase_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $productRate,
							'disc_amt' => $disc_amt,
							'tax_amt' => $tax_amt,
							'amount' => $amount
					 )
				);
		
		$sales_values = $this->items_purchase_list($sales_data[0]->sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-purchase-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);
    }
	
	public function update_purchase_invoice_final(Request $request)  {  
	
		//print_r($_FILES);		
		$signature_name = $request->signature_name;

		if($file = $request->hasFile('signature')) {
			$file = $request->file('signature') ;
			
			$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
			$destinationPath1 = public_path().'/uploads/invoice-signature' ;
			
			$file->move($destinationPath1,$fileName1);
			$signature = $fileName1 ;
			
			//Update file
			$update = DB::table('purchases')
			->where('id', $request->id)
			->update(
				 array(
						'signature' => $signature,
						'signature_name' => $signature_name,
						'status' => 1,
						
				 )
			);
		}else{
			$update = DB::table('purchases')
				->where('id', $request->id)
				->update(
					 array(
							'signature_name' => $signature_name,
							'status' => 1,
							
					 )
				);
		}

		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/purchase-invoice'),
			'message' => 'Record successfully updated',
		);
		return response()->json($msg);			
	}
	
	protected function validatorOther(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		if($data['mode_of_pay'] == 'IMPS' || $data['mode_of_pay'] == 'RTGS' || $data['mode_of_pay'] == 'NEFT'){
			$imps_rtgs_neft = "required";
		}else{
			$imps_rtgs_neft = "";
		}
		if($data['mode_of_pay'] == 'UPI'){
			$upi = "required";
		}else{
			$upi = "";
		}
		if($data['mode_of_pay'] == 'CARD'){
			$card = "required";
		}else{
			$card = "";
		}
		if($data['disp_through'] == 'Other'){
			$other_dispa_det = "required";
		}else{
			$other_dispa_det = "";
		}
		return Validator::make($data, [
			'mode_of_pay' => 'required',
			'pay_status' => 'required',
			//'total_amount' => 'numeric',
			//'advance_amount' => 'numeric',
			//'due_amount' => 'numeric',
			'order_date' => 'required',
			'disp_through' => 'required',             
			'other_dispa_det' => $other_dispa_det,             
			'bankname' => $imps_rtgs_neft,             
			'ifsc_code' => $imps_rtgs_neft,             
			'bank_ac' => $imps_rtgs_neft,             
			'ac_type' => $imps_rtgs_neft,             
			'upi_holder_name' => $upi,             
			'upi_id' => $upi,             
			'card_type' => $card,             
			'card_no' => $card,             
			'card_bank_name' => $card,                         
		]);
			
    }
	
	public function update_purchase_other(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$sId = $request->id;
		
		$validation = $this->validatorOther($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			
			//start update image_sign
			$arr = [];
			if ($request->totalImages > 0) {
				for($i=0; $i < $request->totalImages; $i++){
					if ($request->hasFile('image_sign' . $i)) {
							$file = $request->file('image_sign' . $i); 
							$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
							$destinationPath1 = public_path().'/uploads/invoice-signature' ;
							$file->move($destinationPath1,$fileName);
							$arr[] = $fileName;
						
						$image = implode(",", $arr);
					}
				}
				$updateImage = DB::table('purchases')
							->where('id', $sId)
							->update(
								 array(
										'image_sign' => $image, 
								 )
							);
			}
			
			//end update image_sign
			
			$update = DB::table('purchases')
					->where('id', $sId)
					->update(
						array(
								'mode_of_pay' => $request->mode_of_pay,
								'other_payment' => $request->other_payment,
								'pay_status' => $request->pay_status,
								'total_amount' => isset($request->total_amount)?$request->total_amount:0,
								'advance_amount' => isset($request->advance_amount)?$request->advance_amount:0,
								'due_amount' => isset($request->due_amount)?$request->due_amount:0,
								'seller_orderno' => isset($request->seller_orderno)?$request->seller_orderno:"",
								'order_date' => isset($request->order_date)?$request->order_date:"",
								'buyer_refno' => isset($request->buyer_refno)?$request->buyer_refno:"",
								'other_refno' => isset($request->other_refno)?$request->other_refno:"",
								'dispa_docno_one' => isset($request->dispa_docno_one)?$request->dispa_docno_one:"",
								'disp_through' => $request->disp_through,
								'other_dispa_det' => isset($request->other_dispa_det)?$request->other_dispa_det:"",
								'terms_delivery' => isset($request->terms_delivery)?$request->terms_delivery:"",
								'bankname' => isset($request->bankname)?$request->bankname:"",
								'ifsc_code' => isset($request->ifsc_code)?$request->ifsc_code:"",
								'bank_ac' => isset($request->bank_ac)?$request->bank_ac:"",
								'ac_type' => isset($request->ac_type)?$request->ac_type:"",
								'bank_remarks' => isset($request->bank_remarks)?$request->bank_remarks:"",
								'upi_holder_name' => isset($request->upi_holder_name)?$request->upi_holder_name:"",
								'upi_id' => isset($request->upi_id)?$request->upi_id:"",
								'upi_remarks' => isset($request->upi_remarks)?$request->upi_remarks:"",
								'card_type' => isset($request->card_type)?$request->card_type:"",
								'card_no' => isset($request->card_no)?$request->card_no:"",
								'card_bank_name' => isset($request->card_bank_name)?$request->card_bank_name:"",
								'card_remarks' => isset($request->card_remarks)?$request->card_remarks:"",
								'cash_remarks' => isset($request->cash_remarks)?$request->cash_remarks:"",	
						)
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/purchase-invoice'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
		}	
    }
	
	public function delInvoicePurchase(Request $request)
    {
        $delInvoice = DB::table('purchases')->where('id', $request->id)->delete();
        $delInvoiceItemValue = DB::table('purchase_values')->where('sid', $request->id)->delete();
		if($delInvoice){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/purchase-invoice'),
				'message' => 'Record deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/purchase-invoice'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
	public function activateStatusPurchase(Request $request)
    {
        $user = Purchases::find($request->id);
        $user->status = $request->status;
        $user->save();
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/purchase-invoice'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	public function getPdfPurchase($sid)
	{
		$sid = base64_decode($sid);
		$sales = DB::table('purchases')
								->select(DB::raw('purchases.*'))
								->where('id', '=', $sid)
								->get();
		$sales = $sales[0];	
		$inv_num = $sales->inv_num;
		$sales_values = DB::table('purchase_values')
								->select(DB::raw('purchase_values.*'))
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
			$array[$k]['disc_type'] = $val->disc_type;
			$array[$k]['disc_amt'] = $val->disc_amt;
			$array[$k]['tax_amt'] = $val->tax_amt;
			$array[$k]['amount'] = $val->amount;
			$array[$k]['tax_type'] = $val->tax_type;
			$array[$k]['gst_rate'] = $val->gst_rate;
			$array[$k]['billing_type'] = $val->billing_type;
			$array[$k]['prod_gov_fee'] = $val->prod_gov_fee;
			$array[$k]['gst_trans'] = $val->gst_trans;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$k]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$k]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$k]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
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
		
		$pdf = \PDF::loadView('pages.purchase-invoice-pdf', compact('sales_values'))->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
		$pdfName = 'Purchase-Inv-'.$inv_num.'.pdf';
		return $pdf->stream($pdfName);
	}
	
	//End for purchase invoice
	
	
	
    public function OnlinePurchaseIndex()
    {
        //$this->middleware('auth');
        return view('pages.online-purchase')->with([

        ]);
    }
    public function addOnlinePurchase()
    {
        //$this->middleware('auth');
        return view('pages.add-online-purchase')->with([

        ]);
    }
    public function CreditDebitIndex()
    {
        $title = 'Sales Credit Dabit Notes';
		$userId = Auth::user()->id;
		
		if(Auth::user()->u_type ==1){ //ca
			$sales =  DB::table('voucher_purchases')
							->select(DB::raw('voucher_purchases.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'voucher_purchases.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'voucher_purchases.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$sales =  DB::table('voucher_purchases')
							->select(DB::raw('voucher_purchases.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'voucher_purchases.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'voucher_purchases.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$sales =  DB::table('voucher_purchases')
							->select(DB::raw('voucher_purchases.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'voucher_purchases.added_by', '=', 'company_profiles.userId')
							->where('voucher_purchases.added_by', '=', $userId)
							->orderBy('voucher_purchases.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$sales =  DB::table('voucher_purchases')
							->select(DB::raw('voucher_purchases.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'voucher_purchases.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$sales_pagination = $sales;
		
		$array = array();
		foreach($sales as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['inv_num'] = $val->inv_num;
			$array[$val->id]['inv_date'] = $val->inv_date;
			$customerName =  DB::table('customers')
							->select(DB::raw('customers.cust_name,customers.cust_phone'))
							->where('id', '=', $val->v_name)
							->get();
			$array[$val->id]['cust_name'] = isset($customerName[0]->cust_name)?$customerName[0]->cust_name:"";
			$array[$val->id]['cust_phone'] = isset($customerName[0]->cust_phone)?$customerName[0]->cust_phone:"";
			$array[$val->id]['v_num'] = $val->v_num;
			$array[$val->id]['note_type'] = $val->note_type;
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['is_paid'] = $val->is_paid;
			$array[$val->id]['credit_debit_amount'] = $val->credit_debit_amount;
			$array[$val->id]['inv_number'] = $val->inv_number;
			$array[$val->id]['adjusted_amount'] = $val->adjusted_amount;
		}
		$sales = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($sales);exit;
		return view('pages.purchase-credit-debit')->with([
			'title' =>$title,
			'sales'=>$sales,
			'sales_pagination' =>$sales_pagination,
		]); 
    }
    public function addCreditDebit()
    {
        //$this->middleware('auth');
		$inv_voucher = DB::table('purchases')
								->where('added_by','=',Auth::user()->id)
								->select('id', 'inv_num')
								->get();
		
		$vNo = DB::table('voucher_purchases')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$vNo = isset($vNo[0]->id)?$vNo[0]->id:0;
		$vNo = Helper::invoice_num($vNo+1,7,"PN-");
		$userId = Auth::user()->id;
		$compData = DB::table('company_profiles')
								->select(DB::raw('comp_name,comp_phone'))
								->where('company_profiles.userId','=',$userId)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		$comp_name = isset($compData[0]->comp_name)?$compData[0]->comp_name:"";
		$comp_phone = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:"";
		$countries = Country::where('id', '>', '0')->get();
		
		$states_bill = State::where('country_id', '=', isset($compDetails->comp_bill_country)?$compDetails->comp_bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($compDetails->comp_bill_state)?$compDetails->comp_bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($compDetails->comp_ship_country)?$compDetails->comp_ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($compDetails->comp_ship_state)?$compDetails->comp_ship_state:0)->get();

		//echo "<pre>"; print_r($inv_voucher); exit;
		

        return view('pages.add-purchase-credit-dabit')->with([
			'vNo' => $vNo,
			'comp_name' => $comp_name,
			'comp_phone' => $comp_phone,
			'countries' =>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'custData' =>$custData,
			'inv_number' => $inv_voucher

        ]);
    }
	
	
	//Start purchase credit debit
	protected function validatorPurchaseCredit(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			if($data['reason_issuance'] == 'other'){
				$reason_issuance_other = "required";
			}else{
				$reason_issuance_other = "";
			}
			
			return Validator::make($data, [
				'inv_date' => 'required',
				'seller_name' => 'required',
				'seller_contact' => 'required',
				'seller_email' => 'required',
				'seller_addone' => 'required',
				'seller_country' => 'required',
				'seller_state' => 'required',
				'seller_city' => 'required',
				'seller_pin' => 'required',
				'v_name' => 'required',
				'note_type' => 'required',
				'note_date' => 'required',
				'reason_issuance' => 'required',
				'otherIssuance' => $reason_issuance_other,
				'v_num' => 'required',
				'credit_debit_amount' => 'required',
				'adjusted_amount' => 'required',              
				'challan_no' => 'required', 
				'challan_date' => 'required',				
				'doc_no' => 'required',
				'doc_date' => 'required',
			]);
			
    }

    protected function createPurchaseCredit(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		if($data['reason_issuance'] == 'other'){
			$otherIssuance = $data['otherIssuance'];
		}else{
			$otherIssuance = "";
		}
		$invoiceNo = DB::table('voucher_purchases')
								->select(DB::raw('MAX(id) as id'))
								->get();
		//$vNo = isset($vNo[0]->id)?$vNo[0]->id:0;
		//$vNo = Helper::invoice_num($vNo+1,7,"PN-");
		$invoiceNo = isset($invoiceNo[0]->id)?$invoiceNo[0]->id:0;
		$invoiceNo = Helper::invoice_num($invoiceNo+1,7,"PN-");
        return Voucher_purchases::create([
            'added_by' => Auth::user()->id,			
			'inv_num' => $invoiceNo,
			'inv_date' => $data['inv_date'],
			'seller_name' => $data['seller_name'],
			'seller_contact' => $data['seller_contact'],
			'seller_email' => $data['seller_email'],
			'seller_addone' => $data['seller_addone'],
			'seller_addtwo' => isset($data['seller_addtwo'])?$data['seller_addtwo']:"",
			'seller_country' => $data['seller_country'],
			'seller_state' => $data['seller_state'],
			'seller_city' => $data['seller_city'],
			'seller_pin' => $data['seller_pin'],
			'contact_name' => isset($data['contact_name'])?$data['contact_name']:"",
			'contact_no' => isset($data['contact_no'])?$data['contact_no']:"",			
			'v_name' => $data['v_name'],
			'note_type' => $data['note_type'],
			'note_date' => $data['note_date'],
			'reason_issuance' => $data['reason_issuance'],
			'otherIssuance' => $otherIssuance,
			
			'v_num' => $data['v_num'],
			'credit_debit_amount' => isset($data['credit_debit_amount'])?$data['credit_debit_amount']:0,
			'adjusted_amount' => isset($data['adjusted_amount'])?$data['adjusted_amount']:0,            
			'terms_delivery' => isset($data['terms_delivery'])?$data['terms_delivery']:"", 
			'challan_no' => $data['challan_no'],
			'challan_date' => $data['challan_date'],			
			'doc_no' => $data['doc_no'],
			'doc_date' => $data['doc_date'],
			'term_condition' => isset($data['term_condition'])?$data['term_condition']:"",			
			'created_at' => date('Y-m-d H:i:s'),
			'inv_number' => $data['inv_num'],
			'date_of_payment' => $data['date_of_payment'],
			'mode_of_pay' => $data['mode_of_pay'],
			'other_payment' => $data['other_payment'],
			'pay_status' => $data['pay_status'],
        ]);
    }

     
	
	public function save_purchase_invoice_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validatorPurchaseCredit($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertSales = $this->createPurchaseCredit($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if($file = $request->hasFile('voucher_doc')) {
				$file = $request->file('voucher_doc') ;
				$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/purchase-credit-debit' ;
				$file->move($destinationPath1,$fileName1);
				$voucher_doc = $fileName1 ;

				$update = DB::table('voucher_purchases')
				->where('id', $sId)
				->update(
					 array(
						'voucher_doc' => $voucher_doc,
					 )
				);
			}
			
			if ($insertSales){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					//'redirect' => url('/edit-purchase-credit-debit/'.base64_encode($sId)),
					'redirect' => url('/purchase-credit-debit'),
					'message' => 'Record added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Record add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function items_purchase_list_credit_debit($sid)
	{
		
		$vouchers_values = DB::table('voucher_purchase_values')
								->select(DB::raw('voucher_purchase_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($vouchers_values as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['sid'] = $val->sid;
			$array[$val->id]['prod_id'] = $val->prod_id;
			$array[$val->id]['quantity'] = $val->quantity;
			$array[$val->id]['rate'] = $val->rate;
			$array[$val->id]['disc'] = $val->disc;
			$array[$val->id]['disc_amt'] = $val->disc_amt;
			$array[$val->id]['tax_amt'] = $val->tax_amt;
			$array[$val->id]['amount'] = $val->amount;
			$array[$val->id]['tax_type'] = $val->tax_type;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$val->id]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$val->id]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$val->id]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$val->id]['item_name'] = "";
				$array[$val->id]['base_unit'] = "";
				$array[$val->id]['sec_unit'] = "";
			} 
		}
		$vouchers_values = json_decode(json_encode($array));
		return $vouchers_values;
	}
	
	public function edit_purchase_invoice_credit_debit($sId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/purchase-credit-debit');
		}
		$sId = base64_decode($sId);
		$sales = DB::table('voucher_purchases')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		
		//echo "<pre>";print_r($sales);exit;
		$countries = Country::where('id', '>', '0')->get();		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();
		//echo "<pre>";print_r($sales);exit;

		//$vouchers_values = $this->items_purchase_list_credit_debit($sId);
		return view('pages.edit-purchase-credit-debit')->with([	
			'products' => $products,
			'sales' => $sales,
			'custData'=>$custData,
			'countries' => $countries,
			'states_seller' => $states_seller,
			'cities_seller' => $cities_seller,
			//'vouchers_values' => $vouchers_values,
			'sId' => $sId
		]); 
    }
	
	public function view_purchase_invoice_credit_debit($sId)  {  
		$sId = base64_decode($sId);
		$sales = DB::table('voucher_purchases')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		
		//echo "<pre>";print_r($sales);exit;
		$countries = Country::where('id', '>', '0')->get();		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();

		//$vouchers_values = $this->items_purchase_list_credit_debit($sId);
		return view('pages.view-purchase-credit-debit')->with([	
			'products' => $products,
			'sales' => $sales,
			'custData'=>$custData,
			'countries' => $countries,
			'states_seller' => $states_seller,
			'cities_seller' => $cities_seller,
			//'vouchers_values' => $vouchers_values,
			'sId' => $sId
		]); 
    }
	
	public function update_purchase_invoice_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$sId = $request->id;
		
		$validation = $this->validatorPurchaseCredit($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project			
			if($file = $request->hasFile('voucher_doc')) {
				$file = $request->file('voucher_doc') ;
				$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/purchase-credit-debit' ;
				$file->move($destinationPath1,$fileName1);
				$voucher_doc = $fileName1 ;

				$update = DB::table('voucher_purchases')
				->where('id', $sId)
				->update(
					 array(
						'voucher_doc' => $voucher_doc,
					 )
				);
			}
			if($request->reason_issuance == 'other'){
				$otherIssuance = $request->otherIssuance;
			}else{
				$otherIssuance = "";
			}
			$update = DB::table('voucher_purchases')
					->where('id', $sId)
					->update(
						 array(								
								'inv_number' => $request->inv_num,
								'inv_date' => $request->inv_date,
								'seller_name' => $request->seller_name,
								'seller_contact' => $request->seller_contact,
								'seller_email' => $request->seller_email,
								'seller_addone' => $request->seller_addone,
								'seller_addtwo' => isset($request->seller_addtwo)?$request->seller_addtwo:"",
								'seller_country' => $request->seller_country,
								'seller_state' => $request->seller_state,
								'seller_city' => $request->seller_city,
								'seller_pin' => $request->seller_pin, 
								'contact_name' => isset($request->contact_name)?$request->contact_name:"",
								'contact_no' => isset($request->contact_no)?$request->contact_no:"",
								'v_name' => $request->v_name,
								'note_type' => $request->note_type,
								'note_date' => $request->note_date,
								'reason_issuance' => $request->reason_issuance,
								'otherIssuance' => $otherIssuance,
								
								'v_num' => $request->v_num,
								'credit_debit_amount' => isset($request->credit_debit_amount)?$request->credit_debit_amount:0,
								'adjusted_amount' => isset($request->adjusted_amount)?$request->adjusted_amount:0,            
								'terms_delivery' => isset($request->terms_delivery)?$request->terms_delivery:"", 
								'challan_no' => $request->challan_no,
								'challan_date' => $request->challan_date,			
								'doc_no' => $request->doc_no,
								'doc_date' => $request->doc_date,
								'term_condition' => isset($request->term_condition)?$request->term_condition:"",
								'date_of_payment' => $request->date_of_payment,
								'mode_of_pay' => $request->mode_of_pay,
								'other_payment' => $request->other_payment,
								'pay_status' => $request->pay_status,
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/purchase-credit-debit'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	
	
	public function purchase_items_display_creditdebit(Request $request)
    {
		//$this->middleware('auth'); 
		
		$sid = $request->sId;
		$uid = Auth::user()->id;
		$prod_id = $request->prod_id;
		
		$product = DB::table('items')
								->select(DB::raw('items.id,items.item_name,items.selling_price,items.disc_sell,items.disc_sell_type'))
								->where('id', '=', $prod_id)
								->get();
		$quantity = 1;
		$rate = $product[0]->selling_price;
		$disc = 0;
		if($product[0]->disc_sell_type == "percentage")
		{
			$disc_amt = (($product[0]->selling_price*$product[0]->disc_sell)/100);
		}else{
			$disc_amt = $product[0]->disc_sell;
		}
		$tax_amt = 0;
		$amount = ($product[0]->selling_price - $disc_amt) * $quantity;
		$tax_type = "N/A";
		
		$values = array('sid' => $sid,'uid' => $uid,'prod_id' => $prod_id,'quantity' => $quantity,'rate' => $rate,'disc' => $disc,'disc_amt' => $disc_amt,'tax_amt'=>$tax_amt,'amount'=>$amount,'tax_type'=>$tax_type);
		$insertInvoice = DB::table('voucher_purchase_values')->insert($values);
		
		
		$vouchers_values = $this->items_purchase_list_credit_debit($sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-purchase-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);  
    }
	
	public function delPurchaseItemCreditDebit(Request $request)
    {
        $delSalesItem = DB::table('voucher_purchase_values')->where('id', $request->id)->delete();
		$vouchers_values = $this->items_purchase_list_credit_debit($request->sid);
		
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-sales-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);  
		
    }
	
	public function update_purchase_item_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$salesData = DB::table('voucher_purchase_values')
								->select(DB::raw('voucher_purchase_values.sid,voucher_purchase_values.quantity'))
								->where('id', '=', $request->id)
								->get();
								
		$amount = ($request->rate - $request->disc_amt) * $salesData[0]->quantity;
		$update = DB::table('voucher_purchase_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $request->rate,
							'disc_amt' => $request->disc_amt,
							'amount' => $amount,
							'tax_type' => $request->tax_type
					 )
				);
		
		$sales_data = DB::table('voucher_purchase_values')
								->select(DB::raw('voucher_purchase_values.sid'))
								->where('id', '=', $request->id)
								->get();
		$vouchers_values = $this->items_purchase_list_credit_debit($sales_data[0]->sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-purchase-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);
    }
	
	public function update_purchase_item_quantity_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$sales_data = DB::table('voucher_purchase_values')
								->select(DB::raw('voucher_purchase_values.sid,voucher_purchase_values.rate,voucher_purchase_values.disc_amt'))
								->where('id', '=', $request->id)
								->get();
		$productRate = ($sales_data[0]->rate - $sales_data[0]->disc_amt);
		
		$rate = $productRate * $request->quantity;
		$update = DB::table('voucher_purchase_values')
				->where('id', $id)
				->update(
					 array(
							'quantity' => $request->quantity,
							//'rate' => $rate,
							'amount' => $rate 
					 )
				);
				
		$vouchers_values = $this->items_purchase_list_credit_debit($sales_data[0]->sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-purchase-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);
    }
	
	public function update_purchase_item_rate_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		$prod_id = $request->prod_id;
		
		$sales_data = DB::table('voucher_purchase_values')
								->select(DB::raw('voucher_purchase_values.sid,voucher_purchase_values.quantity,voucher_purchase_values.disc_amt'))
								->where('id', '=', $request->id)
								->get();

		$rate = $request->rate;
		$update = DB::table('voucher_purchase_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $rate,
							'amount' => ($rate - $sales_data[0]->disc_amt) * $sales_data[0]->quantity
					 )
				);
		
		$vouchers_values = $this->items_purchase_list_credit_debit($sales_data[0]->sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-purchase-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);
    }
	
	public function update_purchase_invoice_final_creditdebit(Request $request)  {  
	
		//print_r($_FILES);		
		$signature_name = $request->signature_name;

		if($file = $request->hasFile('signature')) {
			$file = $request->file('signature') ;
			
			$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
			$destinationPath1 = public_path().'/uploads/invoice-signature' ;
			
			$file->move($destinationPath1,$fileName1);
			$signature = $fileName1 ;
			
			//Update file
			$update = DB::table('voucher_purchases')
			->where('id', $request->id)
			->update(
				 array(
						'signature' => $signature,
						'signature_name' => $signature_name,
						'status' => 1,
						
				 )
			);
		}else{
			$update = DB::table('voucher_purchases')
				->where('id', $request->id)
				->update(
					 array(
							'signature_name' => $signature_name,
							'status' => 1,
							
					 )
				);
		}

		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/purchase-credit-debit'),
			'message' => 'Record successfully updated',
		);
		return response()->json($msg);			
	}
	
	public function delPurchaseCreditDebit(Request $request)
    {
        $delInvoice = DB::table('voucher_purchases')->where('id', $request->id)->delete();
        $delInvoiceItemValue = DB::table('voucher_purchase_values')->where('sid', $request->id)->delete();
		if($delInvoice){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/purchase-credit-debit'),
				'message' => 'Asset voucher deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/purchase-credit-debit'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
	//Activate sales credit
	public function activatePurchaseCreditDebitStatus(Request $request)
    {
        $user = Voucher_purchases::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/purchase-credit-debit'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	//Paid purchase credit
	public function paidPurchaseCreditDebit(Request $request)
    {
        $user = Voucher_purchases::find($request->id);
        $user->is_paid = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/purchase-credit-debit'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);
    }
	
	public function getPdfPurchaseCreditDebit($sid)
	{
		$sid = base64_decode($sid);
		$vouchers = DB::table('voucher_purchases')
								->select(DB::raw('voucher_purchases.*'))
								->where('id', '=', $sid)
								->get();
		$vouchers = $vouchers[0];	
		$v_num = $vouchers->v_num;
		$sales_values = DB::table('voucher_purchase_values')
								->select(DB::raw('voucher_purchase_values.*'))
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
			}else{
				$array[$k]['item_name'] = "";
				$array[$k]['base_unit'] = "";
				$array[$k]['sec_unit'] = "";
			} 
			$array[$k]['inv_num'] = $v_num;
			$array[$k]['added_by'] = $vouchers->added_by;
			$array[$k]['signature'] = $vouchers->signature;
			$array[$k]['signature_name'] = $vouchers->signature_name;
		}
		$sales_values = json_decode(json_encode($array));
		
		$pdf = \PDF::loadView('pages.purchase-invoice-credit-debit-pdf', compact('sales_values'))->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
		$pdfName = 'Purchase-Inv-CreditDebit-'.$v_num.'.pdf';
		return $pdf->stream($pdfName);
	}
	//End purchase credit debit
	
    public function RecurringInvoiceIndex()
    {
        //$this->middleware('auth');
        return view('pages.purchase-recurring-invoice')->with([

        ]);
    }
    public function addRecurringInvoice()
    {
        //$this->middleware('auth');
        return view('pages.add-purchase-recurring-invoice')->with([

        ]);
    }
}
