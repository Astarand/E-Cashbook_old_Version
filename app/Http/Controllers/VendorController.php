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
use App\Vendor;
use App\vendor_bank_details;
use App\Country;
use App\State;
use App\City;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class VendorController extends Controller
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
  

    public function index()
    {
		//$this->middleware('auth'); 
		$title = 'vendors';
		$userId = Auth::user()->id;
		//$vendors = DB::table('vendors')->where('userId', '=', $userId)->orderBy('id', 'DESC')->paginate(10);
		if(Auth::user()->u_type ==1){ //ca
			$vendors =  DB::table('vendors')
							->select(DB::raw('vendors.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'vendors.userId', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'vendors.userId', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$vendors =  DB::table('vendors')
							->select(DB::raw('vendors.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'vendors.userId', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'vendors.userId', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$vendors =  DB::table('vendors')
							->select(DB::raw('vendors.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'vendors.userId', '=', 'company_profiles.userId')
							->where('vendors.userId', '=', $userId)
							->orderBy('id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$vendors =  DB::table('vendors')
							->select(DB::raw('vendors.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'vendors.userId', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		
		$vendors_pagination = $vendors;
		//echo "<pre>"; print_r($customers);exit;
		return view('pages.vendor')->with([
			'title' =>$title,
			'vendors'=>$vendors,
			'vendors_pagination' =>$vendors_pagination,
		]); 
    }
	
	public function addvendor(Request $request)
  {

		$countries = Country::where('id', '>', '0')->get();	
    return view('pages.addvendor')->with([
      'countries'=>$countries,
				
		]); 
  }

  protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
          'vendor_priority' =>  'required|numeric',
          'vendor_name' =>  'required|min:3',
          'vendor_pan' =>  'required',
          
          
          'vendor_email' =>  'required|email',
          'vendor_phone' =>  'required|numeric|digits:10',
          'cont_per_name' =>  'required|min:3',
          'cont_per_number' =>  'required|numeric|digits:10',
          'cont_per_email' =>  'required|email'
        ]
		);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Vendor::create([
            'userId' => Auth::user()->id,
            'utype' => Auth::user()->u_type,
            'vendor_priority' => $data['vendor_priority'],
            'vendor_name' => $data['vendor_name'],
            'vendor_pan' => $data['vendor_pan'],
            'vendor_gstin' => $data['vendor_gstin'],
            'vendor_gst_type' => $data['vendor_gst_type'],
            'vendor_email' => $data['vendor_email'],
            'vendor_phone' => $data['vendor_phone'],
            'cont_per_name' => $data['cont_per_name'],
            'cont_per_number' => $data['cont_per_number'],
            'cont_per_email' => $data['cont_per_email'],
            'special_note' => $data['special_note'],
            
            'billing_name' => $data['billing_name'],
            'billing_address1' => $data['billing_address1'],
            'billing_address2' => isset($data['billing_address2'])?$data['billing_address2']:"",
            'billing_country' => $data['billing_country'],
            'billing_state' => $data['billing_state'],
            'billing_city' => $data['billing_city'],
            'billing_pincode' => $data['billing_pincode'],
            
            'shipping_name' => $data['shipping_name'],
            'shipping_address1' => $data['shipping_address1'],
            'shipping_address2' => isset($data['shipping_address2'])?$data['shipping_address2']:"",
            'shipping_country' => $data['shipping_country'],
            'shipping_state' => $data['shipping_state'],
            'shipping_city' => $data['shipping_city'],
            'shipping_pincode' => $data['shipping_pincode'],
            'status'=>0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function saveaddvendor(Request $request)  {  
            
    //echo "<pre>";print_r($request->all());exit;
      
      $validation = $this->validator($request->all());
          if ($validation->fails())  {  
              return response()->json($validation->errors()->toArray());
          }
          else{
        $insertVendors = $this->create($request->all());
        $vendorId = DB::getPdo()->lastInsertId();
        
        $userId = Auth::user()->id;
        $utype = Auth::user()->u_type;
        $bank_name = array_filter($request->bank_name);
        $bank_branch = array_filter($request->bank_branch);
        $acc_holder_name = array_filter($request->acc_holder_name);
        $acc_number = array_filter($request->acc_number);
        $acc_ifsc = array_filter($request->acc_ifsc);
        $acc_upi_id = array_filter($request->acc_upi_id);
       
        
        if(!empty($bank_name) && !empty($bank_branch) && !empty($acc_holder_name) && !empty($acc_number) && !empty($acc_ifsc) )
        {
          
          foreach ($bank_name as $index => $value) {
                
            $insertBank = DB::table('vendor_bank_details')->insertGetId([
                    'vendor_id' => $vendorId,
                    'uid' => $userId,
                    'utype' => $utype,
                    'bank_name' => isset($bank_name[$index])?$bank_name[$index]:"",
                    'bank_branch' => isset($bank_branch[$index])?$bank_branch[$index]:"",
                    'acc_holder_name' => isset($acc_holder_name[$index])?$acc_holder_name[$index]:"",
                    'acc_number' => isset($acc_number[$index])?$acc_number[$index]:"",
                    'acc_ifsc' => isset($acc_ifsc[$index])?$acc_ifsc[$index]:"",
                    'acc_upi_id' => isset($acc_upi_id[$index])?$acc_upi_id[$index]:"",
                    
                  ]);
          }
          if ($insertBank){
            $msg = array(
              'status' => 'success',
              'class' => 'succ',
              'redirect' => url('/vendors'),
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

    public function edit_vendor($vendorId)  {  
      
      $vendorId = base64_decode($vendorId);
      //echo $vendorId;exit;
      $vendor = DB::table('vendors')
                  ->where('id', '=', $vendorId)
                  ->get();
      $bankDetails = DB::table('vendor_bank_details')->where('vendor_id', '=', $vendorId)->get();
      $bankDetails = isset($bankDetails)?$bankDetails:[];
     // echo "<pre>";print_r($bankDetails);exit;
      $vendor = $vendor[0];
      
      $countries = Country::where('id', '>', '0')->get();
          $states_bill = State::where('country_id', '=', $vendor->billing_country)->get();
      $cities_bill = City::where('state_id', '=', $vendor->billing_state)->get();
      
      $states_ship = State::where('country_id', '=', $vendor->shipping_country)->get();
      $cities_ship = City::where('state_id', '=', $vendor->shipping_state)->get();
       
       
       return view('pages.edit-vendor')->with([
        'countries'=>$countries,
				'states_bill'=>$states_bill,
				'cities_bill'=>$cities_bill,
				'states_ship'=>$states_ship,
				'cities_ship'=>$cities_ship,
        'bankDetails' => $bankDetails,
        'vendor' => $vendor,
        ]); 
      }

      public function update_vendor(Request $request)  {  
            
       // echo "<pre>";print_r($request->all());exit('HHH');
        $vendorId = $request->id;
        
        $validation = $this->validator($request->all());
            if ($validation->fails())  {  
                return response()->json($validation->errors()->toArray());
            }
            else{
          //start update customers
          $update = DB::table('vendors')
              ->where('id', $vendorId)
              ->update(
                 array(
                    'vendor_priority' => $request->vendor_priority,
                    'vendor_name' => $request->vendor_name,
                    'vendor_pan' => $request->vendor_pan,
                    'vendor_gstin' => $request->vendor_gstin,
                    'vendor_gst_type' => $request->vendor_gst_type,
                    'vendor_email' => $request->vendor_email,
                    'vendor_phone' => $request->vendor_phone,
                    'cont_per_name' => $request->cont_per_name,
                    'cont_per_number' => $request->cont_per_number,
                    'cont_per_email' => $request->cont_per_email,
                    'special_note' => $request->special_note,
                    
                    'billing_name' => $request->billing_name,
                    'billing_address1' => $request->billing_address1,
                    'billing_address2' => $request->billing_address2,
                    'billing_country' => $request->billing_country,
                    'billing_city' => $request->billing_city,
                    'billing_state' => $request->billing_state,
                    'billing_pincode' => $request->billing_pincode,
                    
                    'shipping_name' => $request->shipping_name,
                    'shipping_address1' => $request->shipping_address1,
                    'shipping_address2' => $request->shipping_address2,
                    'shipping_country' => $request->shipping_country,
                    'shipping_city' => $request->shipping_city,
                    'shipping_state' => $request->shipping_state,
                    'shipping_pincode' => $request->shipping_pincode,
                 )
              );
          //end update customers
          
          $userId = Auth::user()->id;
          $utype = Auth::user()->u_type;
          $bank_name = array_filter($request->bank_name);
          $bank_branch = array_filter($request->bank_branch);
          $acc_holder_name = array_filter($request->acc_holder_name);
          $acc_number = array_filter($request->acc_number);
          $acc_ifsc = array_filter($request->acc_ifsc);
          $acc_upi_id = array_filter($request->acc_upi_id);
          
          if(!empty($bank_name) && !empty($bank_branch) && !empty($acc_holder_name) && !empty($acc_number) && !empty($acc_ifsc) )
          {
            $delBank = DB::table('vendor_bank_details')->where('vendor_id', $vendorId)->delete();
            foreach ($bank_name as $index => $value) {
                  
              $insertBank = DB::table('vendor_bank_details')->insertGetId([
                      'vendor_id' => $vendorId,
                      'uid' => $userId,
                      'utype' => $utype,
                      'bank_name' => isset($bank_name[$index])?$bank_name[$index]:"",
                      'bank_branch' => isset($bank_branch[$index])?$bank_branch[$index]:"",
                      'acc_holder_name' => isset($acc_holder_name[$index])?$acc_holder_name[$index]:"",
                      'acc_number' => isset($acc_number[$index])?$acc_number[$index]:"",
                      'acc_ifsc' => isset($acc_ifsc[$index])?$acc_ifsc[$index]:"",
                      'acc_upi_id' => isset($acc_upi_id[$index])?$acc_upi_id[$index]:"",
                      
                    ]);
            }
            if ($insertBank){
              $msg = array(
                'status' => 'success',
                'class' => 'succ',
                'redirect' => url('/vendors'),
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
      

        public function view_vendor($vendorId)  {  
      
          $vendorId = base64_decode($vendorId);
          //echo $vendorId;exit;
          $vendor = DB::table('vendors')
                      ->where('id', '=', $vendorId)
                      ->get();
          $bankDetails = DB::table('vendor_bank_details')->where('vendor_id', '=', $vendorId)->get();
          $bankDetails = isset($bankDetails)?$bankDetails:[];
         // echo "<pre>";print_r($bankDetails);exit;
          $vendor = $vendor[0];
          
          $countries = Country::where('id', '>', '0')->get();
          $states_bill = State::where('country_id', '=', $vendor->billing_country)->get();
          $cities_bill = City::where('state_id', '=', $vendor->billing_state)->get();
      
          $states_ship = State::where('country_id', '=', $vendor->shipping_country)->get();
          $cities_ship = City::where('state_id', '=', $vendor->shipping_state)->get();
           
           
           return view('pages.view-vendor')->with([
            'countries'=>$countries,
            'states_bill'=>$states_bill,
            'cities_bill'=>$cities_bill,
            'states_ship'=>$states_ship,
            'cities_ship'=>$cities_ship,
            'bankDetails' => $bankDetails,
            'vendor' => $vendor,
            ]); 
          }
  public function deleteVendor(Request $request)
  {
    //echo('vvvvvv');exit;
    $delVendor = DB::table('vendors')->where('id', $request->id)->delete();
		if($delVendor){
			$delBank = DB::table('vendor_bank_details')->where('vendor_id', $request->id)->delete();
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/vendors'),
				'message' => 'Vendors deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/vendors'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
  }
	
}
