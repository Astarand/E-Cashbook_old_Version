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
use App\Ca_details;
use App\Country;
use App\State;
use App\City;
use App\Customers;
use App\Customer_banks;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class OurCaController extends Controller
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
		$title = 'Our CA';
		//$userId = Auth::user()->id;
		//$customers = DB::table('Customers')->where('userId', '=', $userId)->orderBy('id', 'DESC')->paginate(10);
		
		$ca_details = DB::table('users')
					->select(DB::raw('users.*'))
					->where('users.u_type','=',1)->orderBy('created_at','desc')->paginate(10);
		
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
			$array[$val->id]['isCaActive'] = $val->isCaActive;
			$array[$val->id]['created_at'] = $val->created_at;

			$state = State::where('id', '=', isset($val->state_id)?$val->state_id:0)->get();
			$array[$val->id]['ca_state'] = isset($state[0]->name)?$state[0]->name:"";
			
			$city = City::where('id', '=', isset($val->city_id)?$val->city_id:0)->get();
			$array[$val->id]['ca_city'] = isset($city[0]->name)?$city[0]->name:"";
			
		}
		$ca_details = json_decode(json_encode($array));
		return view('pages.our-ca')->with([
			'title' =>$title,
			'ca_details'=>$ca_details,
			'ca_pagination' =>$ca_pagination,
		]); 
    }

	//Completed action
	public function updateCaStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/our-ca'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	public function add_ca()
    {
		//$this->middleware('auth'); 
		$states = State::where('country_id', '=', 101)->get();
		return view('pages.add-ca')->with([
			'states'=>$states,	
		]); 
    }
	
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'phone' => 'required|min:10',
            'addr_one' => 'required',
            'ca_state' => 'required',
			'ca_city' => 'required',
            'pincode' => 'required'
        ]);
    }
	
	protected function validator_edit(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'name' => 'required',
			'phone' => 'required|min:10',
            'addr_one' => 'required',
            'ca_state' => 'required',
			'ca_city' => 'required',
            'pincode' => 'required'
        ]);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return User::create([
            'u_type' => 1,
            //'assign_ca_firm' => 'ourca',
            'name' => $data['name'],
            'email' => $data['email'],
			'password' => Hash::make($data['phone']),
            'phone' => $data['phone'],
            'addr_one' => $data['addr_one'],
            'addr_two' => isset($data['addr_two'])?$data['addr_two']:"",
			'state_id' => $data['ca_state'],
			'city_id' => $data['ca_city'],
			'pincode' => $data['pincode'],
			'status' => 1,
			'userStatus' =>1,
			'isActive' =>1
        ]);
    }

     
	
	public function register_our_ca(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//$uId = Auth::user()->id;
			//$utype = Auth::user()->u_type;
			$Ca_details = DB::table('users')->where('email', '=', $request->email)->get();
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
							'message' => 'CA added successfully'
						);
						return response()->json($msg);
				}else{
						$msg = array(
							'status' => 'error',
							'class' => 'err',
							'redirect' => url('/'),
							'message' => 'Added failed!'
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
	
	public function edit_ca($caId)  {  
        
		$caId = base64_decode($caId);
		$ca = DB::table('users')
								->where('id', '=', $caId)
								->get();

		$ca = $ca[0];
		$states = State::where('country_id', '=', '101')->get();
        $states_bill = State::where('id', '=', $ca->state_id)->get();
		$cities_bill = City::where('id', '=', $ca->city_id)->get();
		
		 
		 
		 return view('pages.edit-ca')->with([
				'states'=>$states,
				'states_bill'=>$states_bill,
				'cities_bill'=>$cities_bill,
				'ca' => $ca
			]); 
    }
	
	public function update_ca(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$caId = $request->id;
		
		$validation = $this->validator_edit($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update ca
			$update = DB::table('users')
					->where('id', $caId)
					->update(
						 array(
								'name' => $request->name,
								'phone' => $request->phone,
								'addr_one' => $request->addr_one,
								'addr_two' => $request->addr_two,
								'state_id' => $request->ca_state,
								'city_id' => $request->ca_city,
								'pincode' => $request->pincode,
						 )
					);

			if($update){
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/our-ca'),
						'message' => 'CA details updated'
					);
					return response()->json($msg);
			}else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'CA update failed!'
					);
					return response()->json($msg);
			}
			//end update customers
		}	
    }
	
}
