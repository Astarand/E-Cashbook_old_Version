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
use App\Plans;
use App\Subscribers;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;


class SubscriptionController extends Controller
{
    public function Plans()
    {
		$title = 'Plans';
		$plans = DB::table('plans')
					->select(DB::raw('plans.*'))
					->orderBy('plans.id','asc')->get();
		//echo "<pre>"; print_r($plans);exit;
		
		return view('pages.superadmin.plans')->with([
			'title' =>$title,
			'plans'=>$plans,
		]);
        
    }
    public function AddPlans()
    {
        return view('pages.superadmin.addplans');
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
            'plan_name' => 'required|min:3',
            'plan_type' => 'required',
            'plan_desc' => 'required',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
            'service' => 'required|numeric',
            'appointment' => 'required|numeric',			
            'staffs' => 'required|numeric',			
            //'gallery' => 'required|numeric',			
            //'additional' => 'required|numeric',			
        ]
		);
    }

    protected function createPlan(array $data)
    {
		//print_r($data);exit;
        return Plans::create([
            'plan_name' => $data['plan_name'],
            'plan_type' => $data['plan_type'],
            'monthly_price' => $data['monthly_price'],
            'yearly_price' => $data['yearly_price'],
            'plan_desc' => $data['plan_desc'],
			'service' => isset($data['service'])?$data['service']:0,
			'service_status' => (isset($data['service_status']) && $data['service_status']=="on")?1:0,
			'service_unlimited' => (isset($data['service_unlimited']) && $data['service_unlimited']=="on")?1:0,
			
			'appointment' => isset($data['appointment'])?$data['appointment']:0,
			'appointment_status' => (isset($data['appointment_status']) && $data['appointment_status']=="on")?1:0,
			'appointment_unlimited' => (isset($data['appointment_unlimited']) && $data['appointment_unlimited']=="on")?1:0,
			
			'staffs' => isset($data['staffs'])?$data['staffs']:0,
			'staffs_status' => (isset($data['staffs_status']) && $data['staffs_status']=="on")?1:0,
			'staffs_unlimited' => (isset($data['staffs_unlimited']) && $data['staffs_unlimited']=="on")?1:0,
			
			'gallery' => isset($data['gallery'])?$data['gallery']:0,
			'gallery_status' => (isset($data['gallery_status']) && $data['gallery_status']=="on")?1:0,
			'gallery_unlimited' => (isset($data['gallery_unlimited']) && $data['gallery_unlimited']=="on")?1:0,
			
			'additional' => isset($data['additional'])?$data['additional']:0,
			'additional_status' => (isset($data['additional_status']) && $data['additional_status']=="on")?1:0,
			'additional_unlimited' => (isset($data['additional_unlimited']) && $data['additional_unlimited']=="on")?1:0,

			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function save_plan(Request $request)  {  
            
		//echo "<pre>";print_r($request);exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertPlan = $this->createPlan($request->all());
			$cId = DB::getPdo()->lastInsertId();
			if ($insertPlan){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/plans'),
					'message' => 'Plans added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Plans add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_plan($pId)  {  
        
		if(Auth::user()->u_type !=3){
			return redirect('/');
		}
		$pId = base64_decode($pId);
		$planData = DB::table('plans')
								->where('id', '=', $pId)
								->get();
		$planData = $planData[0];
		//echo "<pre>";print_r($planData);exit;
		return view('pages.superadmin.editplans')->with([		
			'planData' => $planData,
			'pId' => $pId
		]); 
    }
	
	public function update_plan(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			
			$update = DB::table('plans')
					->where('id', $id)
					->update(
						 array(
								'plan_name' => $request->plan_name,
								'plan_type' => $request->plan_type,
								'monthly_price' => $request->monthly_price,
								'yearly_price' => $request->yearly_price,
								'plan_desc' => $request->plan_desc,
								'plan_included' => isset($request->plan_included)?($request->plan_included):"",
								'yearly_price' => $request->yearly_price,
								'service' => isset($request->service)?$request->service:0,
								'service_status' => (isset($request->service_status) && $request->service_status=="on")?1:0,
								'service_unlimited' => (isset($request->service_unlimited) && $request->service_unlimited=="on")?1:0,
								
								'appointment' => isset($request->appointment)?$request->appointment:0,
								'appointment_status' => (isset($request->appointment_status) && $request->appointment_status=="on")?1:0,
								'appointment_unlimited' => (isset($request->appointment_unlimited) && $request->appointment_unlimited=="on")?1:0,
								
								'staffs' => isset($request->staffs)?$request->staffs:0,
								'staffs_status' => (isset($request->staffs_status) && $request->staffs_status=="on")?1:0,
								'staffs_unlimited' => (isset($request->staffs_unlimited) && $request->staffs_unlimited=="on")?1:0,
								
								'gallery' => isset($request->gallery)?$request->gallery:0,
								'gallery_status' => (isset($request->gallery_status) && $request->gallery_status=="on")?1:0,
								'gallery_unlimited' => (isset($request->gallery_unlimited) && $request->gallery_unlimited=="on")?1:0,
								
								'additional' => isset($request->additional)?$request->additional:0,
								'additional_status' => (isset($request->additional_status) && $request->additional_status=="on")?1:0,
								'additional_unlimited' => (isset($request->additional_unlimited) && $request->additional_unlimited=="on")?1:0,
						 )
					);
			if($update){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/plans'),
					'message' => 'Record updated successfully'
				);
				return response()->json($msg);
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/plans'),
					'message' => 'Record update failed!'
				);
				return response()->json($msg);
			}
			
		}
	}
	
    public function Subscribers()
    {
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){
			$subData = DB::table('subscribers')
					->select(DB::raw('subscribers.*,plans.plan_name,plans.plan_type,plans.service,plans.service_unlimited,users.name'))
					->leftJoin('plans', 'plans.id', '=', 'subscribers.pid')
					->leftJoin('users', 'users.id', '=', 'subscribers.uid')
					->where('subscribers.uid','=',$userId)
					->orderBy('created_at','desc')->paginate(10);
		}
		if(Auth::user()->u_type ==2){
			$subData = DB::table('subscribers')
					->select(DB::raw('subscribers.*,plans.plan_name,plans.plan_type,plans.service,plans.service_unlimited,users.name'))
					->leftJoin('plans', 'plans.id', '=', 'subscribers.pid')
					->leftJoin('users', 'users.id', '=', 'subscribers.uid')
					->where('subscribers.uid','=',$userId)
					->orderBy('created_at','desc')->paginate(10);
		}if(Auth::user()->u_type ==3){ //admin
			$subData = DB::table('subscribers')
					->select(DB::raw('subscribers.*,plans.plan_name,plans.plan_type,plans.service,plans.service_unlimited,users.name'))
					->leftJoin('plans', 'plans.id', '=', 'subscribers.pid')
					->leftJoin('users', 'users.id', '=', 'subscribers.uid')
					->orderBy('created_at','desc')->paginate(10);
		}
		
		
		//echo "<pre>"; print_r($subData);exit;			
		$subData_pagination = $subData;
		//echo "<pre>"; print_r($subData);exit;
		
		$array = array();
		foreach($subData as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['uid'] = $val->uid;
			$array[$val->id]['utype'] = $val->utype;			
			$array[$val->id]['pid'] = $val->pid;
			$array[$val->id]['name'] = $val->name;
			$array[$val->id]['plan_name'] = $val->plan_name;
			$array[$val->id]['plan_type'] = $val->plan_type;
			$array[$val->id]['paid_amount'] = $val->paid_amount;
			$array[$val->id]['service'] = $val->service;
			$array[$val->id]['service_unlimited'] = $val->service_unlimited;	
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['start_at'] = $val->start_at;
			$array[$val->id]['end_at'] = $val->end_at;
			
			$array[$val->id]['transaction_id'] = $val->transaction_id;
			$array[$val->id]['payment_status'] = $val->payment_status;
			
			if($val->utype == 1){
				$users =  DB::table('ca_profiles')
							->select(DB::raw('ca_profiles.comp_logo'))
							->where('ca_profiles.userId', '=', $val->uid)
							->get();
			}else{
				$users =  DB::table('company_profiles')
							->select(DB::raw('company_profiles.comp_logo'))
							->where('company_profiles.userId', '=', $val->uid)
							->get();
			}
			$array[$val->id]['comp_logo'] = isset($users[0]->comp_logo)?$users[0]->comp_logo:"";
		}
		
		$subData = json_decode(json_encode($array));
		//echo "<pre>"; print_r($subData);exit;
		if(Auth::user()->u_type ==3){
			return view('pages.superadmin.subscribers')->with([
				'subData' =>$subData,
				'subData_pagination' => $subData_pagination
			]);
		}else{
			return view('pages.my-subscriber-plans')->with([
				'subData' =>$subData,
				'subData_pagination' => $subData_pagination
			]);

		}
        
    }
	
	public function subscriber_plans(Request $request)
    {
		if($request->expire =="" ){
			$expire = 1;
		}else{
			$expire = 0;
		}

		if(Auth::user() && (Auth::user()->u_type == 2 )){
			$title = 'Subscriber Plans';
			$plans = DB::table('plans')
						->select(DB::raw('plans.*'))
						->where('plans.plan_type', '=', "Monthly")
						->orderBy('plans.id','asc')->get();
			//echo "<pre>"; print_r($plans);exit;
			
			return view('pages.subscriber-plans')->with([
				'title' =>$title,
				'expire'=>$expire,
				'plans'=>$plans,
			]);
		}else if(Auth::user() && $expire==1 && (Auth::user()->u_type == 1 || Auth::user()->u_type == 4)){
			return redirect('/');
		}else{
			return redirect('/');
		}
        
    }
	
	public function ajax_show_plan(Request $request)
    {
		$plan_type = $request->plan_type;
		$title = 'Subscriber Plans';
		$plans = DB::table('plans')
					->select(DB::raw('plans.*'))
					->where('plans.plan_type', '=', $plan_type)
					->get();
		return view('pages.ajax_show_plan')->with([
			'plans'=>$plans,
		]);
    }
}
