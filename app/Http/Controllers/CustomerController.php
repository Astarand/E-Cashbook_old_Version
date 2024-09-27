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
use App\Customers;
use App\Customer_banks;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		//$this->middleware('auth'); 
		$title = 'Customers';
		$userId = Auth::user()->id;
		//start search filter
		$data_arry = array();
		if($request->custName !="" ){
			$data_arry["custName"] = $request->custName;
		}
		if($request->custEmail !="" ){
			$data_arry["custEmail"] = $request->custEmail;
		}
		if($request->custPhone !="" ){
			$data_arry["custPhone"] = $request->custPhone;
		}
		if($request->allstatus =="on" ){
			$data_arry["allstatus"] = $request->allstatus;
		}
		if($request->activestatus =="on" ){
			$data_arry["activestatus"] = $request->activestatus;
		}
		if($request->inactivestatus =="on" ){
			$data_arry["inactivestatus"] = $request->inactivestatus;
		}
		//end search filter
		$customers = DB::table('customers')
					->where('userId', '=', $userId)
					//start search filter
					->where(function ($query) use ($data_arry) {
						if(isset($data_arry['custName'])) {
							$query->where('cust_name', 'LIKE', '%' . $data_arry['custName'] . '%');
						}
						if(isset($data_arry['custEmail'])) {
							$query->where('cust_email', 'LIKE', '%' . $data_arry['custEmail'] . '%');
						}
						if(isset($data_arry['custPhone'])) {
							$query->where('cust_phone', 'LIKE', '%' . $data_arry['custPhone'] . '%');
						}
						if(isset($data_arry['allstatus'])) {
							$query->whereIn('status', array(0, 1));
						}
						if(isset($data_arry['activestatus'])) {
							$query->where('status', '=', 1);
						}
						if(isset($data_arry['inactivestatus'])) {
							$query->where('status', '=', 0);
						}
						
					})
					//end search filter
					->orderBy('id', 'DESC')->paginate(10);
		$customers_pagination = $customers;
		//echo "<pre>"; print_r($customers);exit;
		return view('pages.customers')->with([
			'title' =>$title,
			'customers'=>$customers,
			'data_arry'=>$data_arry,
			'customers_pagination' =>$customers_pagination,
		]); 
    }
	
	public function addcustomer()
    {
		//$this->middleware('auth');
		$countries = Country::where('id', '>', '0')->get();		
		return view('pages.addcustomer')->with([
			'countries'=>$countries,	
		]); 
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			// 'cust_value' => 'required',
			// 'gst_reg' => 'required',
			'cust_pan' => 'required',
            //'cust_name' => 'required|min:3',
            //'cust_gst_no' => 'required',
			//'cust_gst_type' => 'required',
            'cust_email' => 'required|email',
            'cust_phone' => 'required|min:10',			
			// 'cont_email' => 'required|email',
            // 'cont_no' => 'required|min:10',
			// 'cont_notes' => 'required',
        ]
		);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        //return Customers::create([
		$customer = Customers::create([
            'userId' => Auth::user()->id,
            'utype' => Auth::user()->u_type,
            'cust_value' => $data['cust_value'],
			'gst_reg' => $data['gst_reg'],
            'cust_pan' => $data['cust_pan'],
            'cust_name' => isset($data['cust_name'])?$data['cust_name']:"",
			'comp_type' => $data['comp_type'],
			'cin' => $data['cin'],
			'inc_date' => $data['inc_date'],
            'cust_gst_no' => $data['cust_gst_no'],
            'cust_gst_type' => $data['cust_gst_type'],
			'cust_email' => $data['cust_email'],
			'cust_phone' => $data['cust_phone'],
			'cont_name' => $data['cont_name'],
			'cont_no' => $data['cont_no'],
			'cont_email' => $data['cont_email'],
			'cont_notes' => $data['cont_notes'],
			//'other_comp' => $data['other_comp'], // khokan
			
			'cust_bill_gstno' => $data['cust_bill_gstno'],
			'cust_bill_contact' => $data['cust_bill_contact'],
			'cust_bill_mobilno' => $data['cust_bill_mobilno'],
			'cust_bill_designa' => $data['cust_bill_designa'],

			'cust_bill_name' => $data['cust_bill_name'],
			'cust_bill_addone' => $data['cust_bill_addone'],
			'cust_bill_addtwo' => isset($data['cust_bill_addtwo'])?$data['cust_bill_addtwo']:"",
			'cust_bill_country' => $data['cust_bill_country'],
			'cust_bill_state' => $data['cust_bill_state'],
			'cust_bill_city' => $data['cust_bill_city'],
			'cust_bill_pin' => $data['cust_bill_pin'],

			'cust_ship_gstno' => $data['cust_ship_gstno'],
			'cust_ship_contact' => $data['cust_ship_contact'],
			'cust_ship_mobilno' => $data['cust_ship_mobilno'],
			'cust_ship_designa' => $data['cust_ship_designa'],
			
			'cust_ship_name' => $data['cust_ship_name'],
			'cust_ship_addone' => $data['cust_ship_addone'],
			'cust_ship_addtwo' => isset($data['cust_ship_addtwo'])?$data['cust_ship_addtwo']:"",
			'cust_ship_country' => $data['cust_ship_country'],
			'cust_ship_state' => $data['cust_ship_state'],
			'cust_ship_city' => $data['cust_ship_city'],
			'cust_ship_pin' => $data['cust_ship_pin'],
			'created_at' => date('Y-m-d H:i:s'),
			'status'=> '1',
        ]);

		 // Format the customer_id as CID-000010
		$formattedCustomerId = 'CID-' . str_pad($customer->id, 6, '0', STR_PAD_LEFT);

		// Update the customer with the formatted customer_id
		$customer->customer_id = $formattedCustomerId;
		$customer->save();
	
		return $customer;
    }

     
	
	public function add_customer(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertCustomer = $this->create($request->all());
			$custId = DB::getPdo()->lastInsertId();
			
			$userId = Auth::user()->id;
			$utype  = Auth::user()->u_type;
			$cust_bank_name   = array_filter($request->cust_bank_name);
			$cust_bank_branch = array_filter($request->cust_bank_branch);
			$cust_bank_holder_name = array_filter($request->cust_bank_holder_name);
			$cust_ac_no = array_filter($request->cust_ac_no);
			$cust_ifsc_code = array_filter($request->cust_ifsc_code);
			$cust_ac_upid = array_filter($request->cust_ac_upid);
			
			if(!empty($cust_bank_name) && !empty($cust_bank_branch) && !empty($cust_bank_holder_name) && !empty($cust_ac_no) && !empty($cust_ifsc_code) )
			{
				
				foreach ($cust_bank_name as $index => $value) {
							
					$insertBank = DB::table('customer_banks')->insertGetId([
									'custId' => $custId,
									'uid' => $userId,
									'utype' => $utype,
									'cust_bank_name' => isset($cust_bank_name[$index])?$cust_bank_name[$index]:"",
									'cust_bank_branch' => isset($cust_bank_branch[$index])?$cust_bank_branch[$index]:"",
									'cust_bank_holder_name' => isset($cust_bank_holder_name[$index])?$cust_bank_holder_name[$index]:"",
									'cust_ac_no' => isset($cust_ac_no[$index])?$cust_ac_no[$index]:"",
									'cust_ifsc_code' => isset($cust_ifsc_code[$index])?$cust_ifsc_code[$index]:"",
									'cust_ac_upid' => isset($cust_ac_upid[$index])?$cust_ac_upid[$index]:"",
									
								]);
				}
				if ($insertBank){
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/customers'),
						'message' => 'Bank details updated'
					);
					return response()->json($msg);	
				}
			}else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Enter all details for bank'
					);
					return response()->json($msg);	
			}
		}	
    }
	
	public function edit_customer($custId)  {  
        
		$custId = base64_decode($custId);
		$customer = DB::table('customers')
								->where('id', '=', $custId)
								->get();
		$bankDetails = DB::table('customer_banks')->where('custId', '=', $custId)->get();
		$bankDetails = isset($bankDetails)?$bankDetails:[];

		$customer = $customer[0];
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', $customer->cust_bill_country)->get();
		$cities_bill = City::where('state_id', '=', $customer->cust_bill_state)->get();
		
		$states_ship = State::where('country_id', '=', $customer->cust_ship_country)->get();
		$cities_ship = City::where('state_id', '=', $customer->cust_ship_state)->get();
		
		
		return view('pages.edit-customer')->with([
				'countries'=>$countries,
				'states_bill'=>$states_bill,
				'cities_bill'=>$cities_bill,
				'states_ship'=>$states_ship,
				'cities_ship'=>$cities_ship,
				'customer' => $customer,		
				'bankDetails' => $bankDetails,
				'custId' => $custId
			]); 
    }
	
	public function view_customer($custId)  {  
        
		$custId = base64_decode($custId);
		$customer = DB::table('customers')
								->where('id', '=', $custId)
								->get();
		$bankDetails = DB::table('customer_banks')->where('custId', '=', $custId)->get();
		$bankDetails = isset($bankDetails)?$bankDetails:[];

		$customer = $customer[0];
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', $customer->cust_bill_country)->get();
		$cities_bill = City::where('state_id', '=', $customer->cust_bill_state)->get();
		
		$states_ship = State::where('country_id', '=', $customer->cust_ship_country)->get();
		$cities_ship = City::where('state_id', '=', $customer->cust_ship_state)->get();
		 
		 
		 return view('pages.view-customer')->with([
				'countries'=>$countries,
				'states_bill'=>$states_bill,
				'cities_bill'=>$cities_bill,
				'states_ship'=>$states_ship,
				'cities_ship'=>$cities_ship,
				'customer' => $customer,		
				'bankDetails' => $bankDetails,
				'custId' => $custId
			]); 
    }
	
	public function update_customer(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$custId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update customers
			$update = DB::table('customers')
					->where('id', $custId)
					->update(
						 array(
						 		'cust_value' => $request->cust_value,
								'gst_reg'  => $request->gst_reg,
								'cust_pan' => $request->cust_pan,
								'cust_name' => $request->cust_name,
								'cust_gst_no' => $request->cust_gst_no,
								'cust_gst_type' => $request->cust_gst_type,
								'cust_email' => $request->cust_email,
								'cust_phone' => $request->cust_phone,
								'cont_name' => $request->cont_name,
								'cont_no' => $request->cont_no,
								'cont_email' => $request->cont_email,
								'cont_notes' => $request->cont_notes,
								'other_comp' => $request->other_comp,
								
								'cust_bill_gstno' 	=> $request->cust_bill_gstno,
								'cust_bill_contact' => $request->cust_bill_contact,
								'cust_bill_mobilno' => $request->cust_bill_mobilno,
								'cust_bill_designa' => $request->cust_bill_designa,
								'cust_bill_name' 	=> $request->cust_bill_name,
								'cust_bill_addone' 	=> $request->cust_bill_addone,
								'cust_bill_addtwo' 	=> $request->cust_bill_addtwo,
								'cust_bill_country' => $request->cust_bill_country,
								'cust_bill_state' 	=> $request->cust_bill_state,
								'cust_bill_city' 	=> $request->cust_bill_city,
								'cust_bill_pin' 	=> $request->cust_bill_pin,
								


								'cust_ship_gstno'   => $request->cust_ship_gstno,
								'cust_ship_contact' => $request->cust_ship_contact,
								'cust_ship_mobilno' => $request->cust_ship_mobilno,
								'cust_ship_designa' => $request->cust_ship_designa,
								'cust_ship_name' => $request->cust_ship_name,
								'cust_ship_addone' => $request->cust_ship_addone,
								'cust_ship_addtwo' => $request->cust_ship_addtwo,
								'cust_ship_country' => $request->cust_ship_country,
								'cust_ship_state' => $request->cust_ship_state,
								'cust_ship_city' => $request->cust_ship_city,
								'cust_ship_pin' => $request->cust_ship_pin,
						)
					);
			//end update customers
			
			$userId = Auth::user()->id;
			$utype = Auth::user()->u_type;
			$cust_bank_name = array_filter($request->cust_bank_name);
			$cust_bank_branch = array_filter($request->cust_bank_branch);
			$cust_bank_holder_name = array_filter($request->cust_bank_holder_name);
			$cust_ac_no = array_filter($request->cust_ac_no);
			$cust_ifsc_code = array_filter($request->cust_ifsc_code);
			$cust_ac_upid = array_filter($request->cust_ac_upid);
			
			if(!empty($cust_bank_name) && !empty($cust_bank_branch) && !empty($cust_bank_holder_name) && !empty($cust_ac_no) && !empty($cust_ifsc_code) )
			{
				$delBank = DB::table('customer_banks')->where('custId', $custId)->delete();
				foreach ($cust_bank_name as $index => $value) {
							
					$insertBank = DB::table('customer_banks')->insertGetId([
									'custId' => $custId,
									'uid' => $userId,
									'utype' => $utype,
									'cust_bank_name' => isset($cust_bank_name[$index])?$cust_bank_name[$index]:"",
									'cust_bank_branch' => isset($cust_bank_branch[$index])?$cust_bank_branch[$index]:"",
									'cust_bank_holder_name' => isset($cust_bank_holder_name[$index])?$cust_bank_holder_name[$index]:"",
									'cust_ac_no' => isset($cust_ac_no[$index])?$cust_ac_no[$index]:"",
									'cust_ifsc_code' => isset($cust_ifsc_code[$index])?$cust_ifsc_code[$index]:"",
									'cust_ac_upid' => isset($cust_ac_upid[$index])?$cust_ac_upid[$index]:"",
									
								]);
				}
				if ($insertBank){
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/customers'),
						'message' => 'Bank details updated'
					);
					return response()->json($msg);	
				}
			}else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Enter all details for bank'
					);
					return response()->json($msg);	
			}
		}	
    }
	
	//Activate customer
	public function changeStatus(Request $request)
    {
        $user = Customers::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/customers'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	//Delete customer
	public function delCustomer(Request $request)
    {
        $delCust = DB::table('customers')->where('id', $request->id)->delete();
		if($delCust){
			$delBank = DB::table('customer_banks')->where('custId', $request->id)->delete();
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/customers'),
				'message' => 'Customer deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/customers'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
}
