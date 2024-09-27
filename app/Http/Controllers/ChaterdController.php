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
use App\Ca_profiles;
use App\Ca_details;
use App\Ca_assigns;
use App\Country;
use App\State;
use App\City;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class ChaterdController extends Controller
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
		$states = State::where('country_id', '=', 101)->get();
		return view('pages.ca')->with([
			'states'=>$states,	
		]); 
    }
	
	public function choose_ca(Request $request)
    {
		//$this->middleware('auth'); 
		$chooseca = $request->chooseca;
		$ca_state = $request->ca_state;
		$ca_city = $request->ca_city;
		$ca_pincode = $request->ca_pincode;
		$states = State::where('id', '=', $ca_state)->get();
		$city = City::where('id', '=', $ca_city)->get();
		
		if($chooseca == 2){
			$ca_details = DB::table('users')
					->select(DB::raw('users.*,ca_profiles.comp_logo,ca_profiles.comp_name,
					ca_profiles.comp_bill_addone,ca_profiles.comp_bill_country,ca_profiles.comp_bill_state,
					ca_profiles.comp_bill_city,ca_profiles.comp_bill_pin,ca_profiles.ca_spec'))
					->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
					->where('users.u_type','=',1) 
					->orderBy('created_at','desc')->paginate(10);
		}else{
		$ca_details = DB::table('users')
					->select(DB::raw('users.*,ca_profiles.comp_logo,ca_profiles.comp_name,
					ca_profiles.comp_bill_addone,ca_profiles.comp_bill_country,ca_profiles.comp_bill_state,
					ca_profiles.comp_bill_city,ca_profiles.comp_bill_pin,ca_profiles.ca_spec'))
					->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
					->where('users.u_type','=',1) //CA added by admin
					->where('users.state_id','=',(int)$ca_state)
					// ->where('users.city_id','=',(int)$ca_city)
					//->orwhere('users.pincode','=',(int)$ca_pincode)
					->orderBy('created_at','desc')->paginate(10);
		}
					
		$ca_pagination = $ca_details;
		//echo "<pre>"; print_r($ca_details);exit;
		
		$array = array();
		foreach($ca_details as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['u_type'] = $val->u_type;
			$array[$val->id]['name'] = $val->name;
			$array[$val->id]['email'] = $val->email;
			$array[$val->id]['phone'] = $val->phone;
			$array[$val->id]['addr_one'] = $val->addr_one;
			$array[$val->id]['addr_two'] = $val->addr_two;
			$array[$val->id]['pincode'] = $val->pincode;
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['comp_logo'] = $val->comp_logo;
			$array[$val->id]['comp_bill_addone'] = isset($val->comp_bill_addone)?$val->comp_bill_addone:"";
			$array[$val->id]['comp_bill_pin'] = isset($val->comp_bill_pin)?$val->comp_bill_pin:"";
			$array[$val->id]['ca_spec'] = $val->ca_spec;

			$state = State::where('id', '=', isset($val->comp_bill_state)?$val->comp_bill_state:0)->get();
			$array[$val->id]['ca_state'] = isset($state[0]->name)?$state[0]->name:"";
			
			$city = City::where('id', '=', isset($val->comp_bill_city)?$val->comp_bill_city:0)->get();
			$array[$val->id]['ca_city'] = isset($city[0]->name)?$city[0]->name:"";
			
			//$ca_assign_status = Ca_assigns::where('ca_id', '=', $val->id)->get();
			//$array[$val->id]['ca_assign_status'] = isset($ca_assign_status[0]->ca_assign_status)?$ca_assign_status[0]->ca_assign_status:0;
			
			//$array[$val->id]['ca_assign_status'] = isset($val->ca_assign_status)?$val->ca_assign_status:0;
			$ca_assign_status = DB::table('ca_assigns')
					->select('ca_assigns.ca_assign_status', 'ca_assigns.request_for')
					->where('ca_assigns.ca_id', '=', $val->id)
					->where('ca_assigns.comp_id', '=', Auth::user()->id)
					->get();
			$array[$val->id]['ca_assign_status'] = isset($ca_assign_status[0]->ca_assign_status)?$ca_assign_status[0]->ca_assign_status:0;
			$array[$val->id]['request_for'] = isset($ca_assign_status[0]->request_for) ? $ca_assign_status[0]->request_for : null;
			
		}
		$ca_details = json_decode(json_encode($array));
		//echo "<pre>"; print_r($ca_details);exit;
		return view('pages.choose-ca')->with([
			'ca_details'=>$ca_details,
			'ca_pagination' =>$ca_pagination,
		]);  
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'ca_name' => 'required',
			'ca_email' => 'required|email',
			'ca_phone' => 'required|min:10',
            'ca_addr_one' => 'required',
            'ca_state' => 'required',
			'ca_city' => 'required',
            'ca_pincode' => 'required'
        ]);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Ca_details::create([
            'uId' => Auth::user()->id,
            'utype' => Auth::user()->u_type,
            'assign_ca_firm' => $data['assign_ca_firm'],
            'ca_name' => $data['ca_name'],
            'ca_email' => $data['ca_email'],
            'ca_phone' => $data['ca_phone'],
            'ca_addr_one' => $data['ca_addr_one'],
            'ca_addr_two' => isset($data['ca_addr_two'])?$data['ca_addr_two']:"",
			'ca_state' => $data['ca_state'],
			'ca_city' => $data['ca_city'],
			'ca_pincode' => $data['ca_pincode'],
			'ca_set_permission' => $data['ca_set_permission'],
        ]);
    }

     
	
	public function register_ca(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			
			if($request->ca_set_permission ==""){
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Please check at least 1 permission'
				);
				return response()->json($msg);
			}
			$uId = Auth::user()->id;
			$utype = Auth::user()->u_type;
			//$Ca_details = DB::table('Ca_details')->where('uId', '=', $uId)->where('utype', '=', $utype)->get();
			$Ca_details = DB::table('Ca_details')->where('ca_email', '=', $request->ca_email)->get();
			$Ca_details = isset($Ca_details)?$Ca_details:[];
			if(sizeof($Ca_details) == 0)
			{
				$insertCa = $this->create($request->all());
				$caId = DB::getPdo()->lastInsertId();
				
				if ($insertCa){
						$msg = array(
							'status' => 'success',
							'class' => 'succ',
							'redirect' => url('/'),
							'message' => 'CA details submitted successfully'
						);
						return response()->json($msg);
				}else{
						$msg = array(
							'status' => 'error',
							'class' => 'err',
							'redirect' => url('/'),
							'message' => 'Assign failed!'
						);
						return response()->json($msg);
				}
			}else{
						$msg = array(
							'status' => 'error',
							'class' => 'err',
							'redirect' => url('/'),
							'message' => 'CA email already exists!'
						);
						return response()->json($msg);
			}
		}	
    }
	
	protected function create_ca_assign(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Ca_assigns::create([
            'comp_id' => Auth::user()->id,
            'utype' => Auth::user()->u_type,
            'ca_id' => $data['ca_id'],
            'set_permission' => $data['set_permission'],
            'request_for' => $data['request_for'],
			'ca_assign_status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function assign_ca(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$comp_id = Auth::user()->id;
		$utype = Auth::user()->u_type;
		$ca_id = $request->ca_id;
		$ca_assign_status = $request->ca_assign_status;
		$ca_assign_exists = DB::table('ca_assigns')
							->where('comp_id', '=', $comp_id)
							->where('ca_assign_status', '=', 1)
							->get();
		$ca_assign_exists = isset($ca_assign_exists)?$ca_assign_exists:[];
		//echo "<pre>";print_r($ca_assign_exists);//die;
		
		$ca_data = DB::table('ca_assigns')->where('comp_id', '=', $comp_id)->where('ca_id', '=', $ca_id)->get();
		$ca_data = isset($ca_data)?$ca_data:[];
		//echo "<pre>";print_r($ca_data);die;				
		if(sizeof($ca_assign_exists) == 0 && sizeof($ca_data) == 0)
		{
			$insertCa = $this->create_ca_assign($request->all());
			$caId = DB::getPdo()->lastInsertId();
			
			if ($insertCa){
				
					//Add notification
					$from_uid = Auth::user()->id;
					$to_uid = $ca_id;
					$utype = Auth::user()->u_type;
					$noti_title = "Assign CA";
					$msg = "Assign CA Requested";
					$url ="";
					$notifications = Helper::addNotification($to_uid,$noti_title,$msg,$url);
					//End notification
					
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/'),
						'message' => 'CA assigned successfully',
						'ca_assign_status' => 1
					);
					return response()->json($msg);
			}else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'CA Assign failed!'
					);
					return response()->json($msg);
			}
		}
		else if( (sizeof($ca_assign_exists) == 1 && sizeof($ca_data) == 1) || sizeof($ca_assign_exists) == 0 && sizeof($ca_data) == 1)
		{
					
					$cd1 = isset($ca_assign_exists[0]->ca_id)?$ca_assign_exists[0]->ca_id:0;
					$cd2 = isset($ca_data[0]->ca_id)?$ca_data[0]->ca_id:0;
					if(($cd1 == $cd2) || (sizeof($ca_assign_exists) == 0 && sizeof($ca_data) == 1))
					{
						$update = DB::table('ca_assigns')
						->where('comp_id', '=', $comp_id)
						->where('ca_id', '=', $ca_id)
						->update(
							 array(
									'ca_assign_status' => $ca_assign_status
							 )
						);
						
						if($update){
							//Add notification
							$from_uid = Auth::user()->id;
							$to_uid = $ca_id;
							$utype = Auth::user()->u_type;
							if($ca_assign_status ==0){
								$noti_title = "Un-Assign CA";
								$msg = "Un-Assign CA";
							}else if($ca_assign_status ==1){
								$noti_title = "Assign CA";
								$msg = "Assign CA Requested";
							}
							$url ="";
							$notifications = Helper::addNotification($to_uid,$noti_title,$msg,$url);
							//End notification
							
							$ca_data = DB::table('ca_assigns')->where('comp_id', '=', $comp_id)->where('ca_id', '=', $ca_id)->get();
							$ca_data = isset($ca_data)?$ca_data:[];
							
							$msg = array(
								'status' => 'success',
								'class' => 'succ',
								'redirect' => url('/'),
								'message' => 'CA assigned successfully',
								'ca_assign_status' => $ca_data[0]->ca_assign_status
							);
							return response()->json($msg);
						}else{
							$msg = array(
								'status' => 'error',
								'class' => 'err',
								'redirect' => url('/'),
								'message' => 'CA Assign failed!'
							);
							return response()->json($msg);
						}
					}else{
						$msg = array(
							'status' => 'error',
							'class' => 'err',
							'redirect' => url('/'),
							'message' => 'CA already assigned!'
						);
						return response()->json($msg);
					}
		}
		else if(sizeof($ca_assign_exists) == 1 && sizeof($ca_data) == 0)
		{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'CA already assigned!'
			);
			return response()->json($msg);
		}
		
    }
	
}
