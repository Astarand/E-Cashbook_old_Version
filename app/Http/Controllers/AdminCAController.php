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
use App\Ca_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class AdminCAController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function caportal()
    {
        $title = 'CA Lists';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==3){ //admin
			$users =  DB::table('users')
							->select(DB::raw('users.id as uid,users.*,ca_profiles.*'))
							->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
							->where('users.u_type', '=', 1)
							->orderBy('users.id', 'DESC')->paginate(10);
		}
		$users_pagination = $users;		
		$array = array();
		foreach($users as $k=>$val)
		{
			$array[$val->id]['id'] = $val->uid;
			$array[$val->id]['comp_logo'] = ($val->comp_logo !="")?$val->comp_logo:$val->avatar;
			$array[$val->id]['comp_name'] = ($val->comp_name !="")?$val->comp_name:$val->name;
			$array[$val->id]['comp_email'] = ($val->comp_email !="")?$val->comp_email:$val->email;			
			$array[$val->id]['comp_phone'] = ($val->comp_phone !="")?$val->comp_phone:$val->phone;
			
			$customerNo =  DB::table('ca_assigns')
							->select(DB::raw('ca_assigns.id'))
							->where('ca_id', '=', $val->uid)
							->where('ca_assign_status', '=', 1)
							->where('ca_assign_status', '=', 1)
							->get();
			$array[$val->id]['customerNo'] = count($customerNo);
			
			$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
			$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
			$array[$val->id]['state'] = isset($states[0]->name)?$states[0]->name:"";
			$array[$val->id]['city'] = isset($cities[0]->name)?$cities[0]->name:"";
			$array[$val->id]['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
			$array[$val->id]['isCaActive'] = $val->isCaActive;
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['created_at'] = $val->created_at;
		}
		$users = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($users);exit;
		return view('pages.superadmin.ca')->with([
			'title' =>$title,
			'users'=>$users,
			'users_pagination' =>$users_pagination,
		]); 
       
    }
	
	public function caStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/caportal'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
    public function cadetails($caId)
    {
        $caId = base64_decode($caId);
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==3){ //admin
			$users =  DB::table('users')
							->select(DB::raw('users.id as uid,users.*,ca_profiles.*'))
							->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
							->where('users.id', '=', $caId)
							->where('users.u_type', '=', 1)
							->orderBy('users.id', 'DESC')->paginate(10);
		}
		
		$array = array();
		foreach($users as $k=>$val)
		{
			$array['id'] = $val->uid;
			$array['comp_logo'] = ($val->comp_logo !="")?$val->comp_logo:$val->avatar;
			$array['comp_name'] = ($val->comp_name !="")?$val->comp_name:$val->name;
			$array['comp_email'] = ($val->comp_email !="")?$val->comp_email:$val->email;			
			$array['comp_phone'] = ($val->comp_phone !="")?$val->comp_phone:$val->phone;
			$array['comp_website'] = ($val->comp_website !="")?$val->comp_website:"";
			
			$customerNo =  DB::table('ca_assigns')
							->select(DB::raw('ca_assigns.id'))
							->where('ca_id', '=', $val->uid)
							->where('ca_assign_status', '=', 1)
							->where('ca_assign_status', '=', 1)
							->get();
			$array['customerNo'] = count($customerNo);
			
			$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
			$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
			$array['state'] = isset($states[0]->name)?$states[0]->name:"";
			$array['city'] = isset($cities[0]->name)?$cities[0]->name:"";
			$array['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
			$array['ca_spec'] = ($val->ca_spec !="")?$val->ca_spec:"";
			$array['status'] = $val->status;
			$array['created_at'] = $val->created_at;
		}
		$users = json_decode(json_encode($array));
		//echo "<pre>"; print_r($users);exit;
		
		$customers = DB::table('users')
					->select(DB::raw('users.*,ca_assigns.ca_assign_status,ca_assigns.ca_current_status,
					company_profiles.comp_logo,company_profiles.comp_name,company_profiles.comp_bill_addone,
					company_profiles.comp_bill_country,company_profiles.comp_bill_state,
					company_profiles.comp_bill_city,company_profiles.comp_bill_pin'))
					->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
					->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
					->where('users.u_type','=',2) 
					->where('ca_assigns.ca_assign_status','=',1)
					->where('ca_assigns.ca_current_status','!=',0)
					->orwhere([
						['users.ca_add_by', '=', $caId],
						['users.u_type', '!=', 4],
					])
					->orderBy('created_at','desc')->paginate(10);
		
		$customers_pagination = $customers;
		
		$array2 = array();
		foreach($customers as $k=>$val)
		{
			$array2[$val->id]['id'] = $val->id;
			$array2[$val->id]['u_type'] = $val->u_type;
			$array2[$val->id]['ca_add_by'] = $val->ca_add_by;
			$array2[$val->id]['name'] = $val->name;
			$array2[$val->id]['email'] = $val->email;
			$array2[$val->id]['phone'] = $val->phone;
			$array2[$val->id]['comp_name'] = $val->comp_name;
			$array2[$val->id]['comp_logo'] = $val->comp_logo;
			$array2[$val->id]['comp_bill_addone'] = isset($val->comp_bill_addone)?$val->comp_bill_addone:"";
			$array2[$val->id]['comp_bill_pin'] = isset($val->comp_bill_pin)?$val->comp_bill_pin:"";
			$array2[$val->id]['created_at'] = $val->created_at;
			$array2[$val->id]['ca_assign_status'] = $val->ca_assign_status;
			$array2[$val->id]['ca_current_status'] = $val->ca_current_status;
		}
		
		$customers = json_decode(json_encode($array2));
		//echo "<pre>"; print_r($customers);exit;
        return view('pages.superadmin.caprofile')->with([
			'users'=>$users,
			'customers'=>$customers,
			'customers_pagination' => $customers_pagination
        ]);
    }
	
	//Assign and un-assign CA
	public function assign_unassign_ca(Request $request)
    {
        $user = User::find($request->id);
        $user->isCaActive = $request->iscaactive;
        $user->save();
		//ca details
		$caDetails =  DB::table('users')
					->select(DB::raw('users.id as comp_id,users.email,users.name,users.u_type'))
					->where('users.id','=',$request->id) 					
					->get();
		$userDetails =  DB::table('ca_assigns')
					->select(DB::raw('ca_assigns.comp_id,users.email,users.name,users.u_type'))
					->leftJoin('users', 'ca_assigns.comp_id', '=', 'users.id')
					->where('ca_assigns.ca_id','=',$request->id) 					
					->where('ca_assigns.ca_assign_status','=',1) 
					->where('ca_assigns.ca_current_status','=',1) 
					->get();	
		$obj_merged = array_merge($userDetails->toArray(), $caDetails->toArray()); 
		//echo "<pre>"; print_r($obj_merged);exit;
		//Start send mail
		if(!empty($obj_merged)){
			foreach($obj_merged as $val){
			   $name = $val->name;
			   $email = $val->email;		   
				
				if($val->u_type ==1){
				   if($request->iscaactive == 0){
					$emailTitle = "Account Un-Assigned";
					$emailSubject = $emailTitle;
					$emailText = "Account has been un-assigned.Please contact admin.";
				   }else{
					$emailTitle = "Account Assigned";
					$emailSubject = $emailTitle;
					$emailText = "Account has been assigned.";
				   }
				}else{
					if($request->iscaactive == 0){
					$emailTitle = "CA Un-Assigned";
					$emailSubject = $emailTitle;
					$emailText = "CA has been un-assigned.Please contact CA.";
				   }else{
					$emailTitle = "CA Assigned";
					$emailSubject = $emailTitle;
					$emailText = "CA has been assigned.";
				   }
				}
			   
			   //Add notification
				$from_uid = Auth::user()->id;
				$to_uid = $val->comp_id;
				$utype = Auth::user()->u_type;
				$noti_title = $emailTitle;
				$msg = $emailText;
				$url ="";
				$notifications = Helper::addNotification($to_uid,$noti_title,$msg,$url);
				//End notification
			   
			   $body = '<html lang="en">
							<head>
							<title>'.$emailTitle.'</title>
							<meta charset="utf-8">
							<meta name="viewport" content="width=device-width, initial-scale=1">
							
							</head>
							<body style="margin: 0;padding: 0;font-family: Arial, Helvetica, sans-serif;">
								
							<div style="width: 100%;display: block;position: relative;">
								<div style="display: block;">
									<a href="">
										<img src="'.asset('public/assets/img/logo.png').'" alt="logo" style="margin: 0 auto;padding: 20px 0;height: auto;max-width: 100%;display: block;">
									</a>
								</div>
								
								<div class="main-wraper" style="max-width: 600px;margin: 0 auto;position: relative;">
								<div style="margin-top: 50px;display: block;">
									<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">'.$emailTitle.'</h1>
									<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
								</div>
								<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr>
											<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
										</tr>										
										<tr>
											<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">'.$emailText.'</p></td>
										</tr>
									</table>
									
								</div>
							</div>
							<div class="ft" style="background: #76bed0;display: block;">
									<p style="text-align: center;color: #ffffff;font-size: 14px;padding:5px 0;">Copyright © '.date("Y").' E-cashbook</p>
								</div>
							</div>    

							</body>
							</html> ';	
			
				$data_email = [
					'email' => $email
				];
				$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);
				
			}
		}
		//End send mail
							
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/caportal'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
}
