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
use Carbon\Carbon;

class CustomerAssignmentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function Index()
    {
		$customerLists = DB::table('users')
					->select(DB::raw('users.*,ca_assigns.ca_assign_status,ca_assigns.ca_current_status,ca_assigns.request_for,
					company_profiles.comp_logo,company_profiles.comp_name,company_profiles.comp_bill_addone,
					company_profiles.comp_bill_country,company_profiles.comp_bill_state,
					company_profiles.comp_bill_city,company_profiles.comp_bill_pin'))
					->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
					->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
					->where('users.u_type','=',2) 
					->where('ca_assigns.ca_assign_status','=',1)
					->where('ca_assigns.ca_current_status','=',0)
					->where('ca_assigns.ca_id','=',Auth::user()->id)
					->orderBy('created_at','desc')->paginate(10);
		
		//echo "<pre>"; print_r($customerLists);exit;			
		$customerLists_pagination = $customerLists;
		
        $customers = DB::table('users')
					->select(DB::raw('users.*,ca_assigns.ca_assign_status,ca_assigns.ca_current_status,
					company_profiles.comp_logo,company_profiles.comp_name,company_profiles.exact_comp_nature,company_profiles.comp_bill_addone,
					company_profiles.comp_bill_country,company_profiles.comp_bill_state,
					company_profiles.comp_bill_city,company_profiles.comp_bill_pin'))
					->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
					->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
					->where('users.u_type','=',2) 
					->where('ca_assigns.ca_assign_status','=',1)
					->where('ca_assigns.ca_current_status','=',1)
					->where('ca_assigns.ca_id','=',Auth::user()->id)
					/* ->orwhere([
						['users.ca_add_by', '=', Auth::user()->id],
					]) */
					->orderBy('created_at','desc')->paginate(10);
				
		$customers_pagination = $customers;
		//echo "<pre>"; print_r($customers);exit;
		
		$array = array();
		foreach($customers as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['u_type'] = $val->u_type;
			$array[$val->id]['ca_add_by'] = $val->ca_add_by;
			$array[$val->id]['name'] = $val->name;
			$array[$val->id]['email'] = $val->email;
			$array[$val->id]['phone'] = $val->phone;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['comp_logo'] = $val->comp_logo;
			$array[$val->id]['exact_comp_nature'] = $val->exact_comp_nature;
			$array[$val->id]['comp_bill_addone'] = isset($val->comp_bill_addone)?$val->comp_bill_addone:"";
			$array[$val->id]['comp_bill_pin'] = isset($val->comp_bill_pin)?$val->comp_bill_pin:"";
			$array[$val->id]['created_at'] = $val->created_at;
			$array[$val->id]['ca_assign_status'] = $val->ca_assign_status;
			$array[$val->id]['ca_current_status'] = $val->ca_current_status;
		}
		$customers = json_decode(json_encode($array));
		
		$array2 = array();
		foreach($customerLists as $k=>$val)
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
			$array2[$val->id]['request_for'] = $val->request_for;
		}
		$customerLists = json_decode(json_encode($array2));
        return view('pages.ca.customerassignment')->with([
			'customerLists' =>$customerLists,
			'customerLists_pagination' => $customerLists_pagination,
			'customers' =>$customers,
			'customers_pagination' => $customers_pagination
        ]);
    }
	
	public function viewCustomerDet(Request $request)
    {
        if(Auth::user()->u_type ==2){
			return redirect('/');
		}
		$custId = ($request->id);
		$customers = DB::table('users')
					->select(DB::raw('users.*,company_profiles.*'))
					->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
					->where('users.id','=',$custId)
					->get();
		$customers = $customers[0];
		//echo "<pre>";print_r($customers);exit;
        echo json_encode($customers);
    }
	
	//Accept customer
	public function acceptCustomerStatus(Request $request)
    {
		$dataCheck = DB::table('ca_assigns')
							->select(DB::raw('ca_assigns.comp_id'))
							->where('comp_id','=',$request->id)
							->where('ca_assign_status','=',1)
							->get()->toArray();
		if(!empty($dataCheck)){
			$update = DB::table('ca_assigns')
				->where('comp_id','=',$request->id)
				->where('ca_assign_status','=',1)
				->update(
					array(
							'ca_current_status' => $request->status,
					)
				);
		
			//Add notification
			$from_uid = Auth::user()->id;
			$to_uid = $request->id;
			$utype = Auth::user()->u_type;
			$noti_title = "CA Activity";
			if($request->status ==1){
				$msg = "Assign request activated";
				$msg1 = "Your request for a CA / Professional accountant assignment has been activated";
				$msg2 = " Please grant permission to your CA/professional accountant for smooth accounts management.";
			}else if($request->status ==2){
				$msg = "Assign request deactive";
				$msg1 = "Your request for a CA / Professional accountant assignment has been deactive";
				$msg2 = "";	
			}else if($request->status ==3){
				$msg = "Assign request rejected";
				$msg1 = "Your request for a CA / Professional accountant assignment has been rejected";
				$msg2 = "";
			}
			$url ="";
			$notifications = Helper::addNotification($to_uid,$noti_title,$msg,$url);
			
			//Start send mail
				$userDet = DB::table('users')
								->select(DB::raw('users.name,users.email'))
								->where('id', $to_uid)
								->get();
				$name = $userDet[0]->name;
				$email = $userDet[0]->email;
				
				$caDet = DB::table('users')
								->select(DB::raw('users.name'))
								->where('id', $from_uid)
								->get();
				$caName = $caDet[0]->name;
				$body = '<html lang="en">
								<head>
								<title>Assign Request Confirmation</title>
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
										<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">Assign Request Confirmation</h1>
										<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
									</div>
									<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
										<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;"> '.$msg1.' by '.$caName .$msg2.'</p></td>
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
				$emailSubject = "Assign request confirmation";
				$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);					
				//End send mail
		}
        
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/customerassignment'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
    
    public function AssignmentDetails($custId)
    {
        if(Auth::user()->u_type ==2){
			return redirect('/');
		}
		
		//echo "<pre>";print_r($customers);exit;
        // return view('pages.ca.assignment-details')->with([
			
        // ]);

		//echo "<pre>";print_r($clientId);exit;
		$clientId = base64_decode($custId);
		$client = DB::table('company_profiles')
								->where('userId', '=', $clientId)
								->get();

		$client = $client[0];
		$agents = DB::table('busi_agents')
							->select(DB::raw('busi_agents.id,busi_agents.agent_name'))
							->where('added_by','=',Auth::user()->id)
							->get()->toArray();
		
		//echo "<pre>";print_r($client);exit;
        return view('pages.ca.view_customer')->with([
			'client' => $client,
			'agents'=>$agents,		
			'clientId' => $clientId

        ]);
    }
	
	public function getAssignRequestChart(Request $request)
	{
		if($request->type == "monthly")
		{
			$userId = Auth::user()->id;
			$users = DB::table('users')
					->select(DB::raw('users.id,ca_assigns.created_at,
						SUM(IF((ca_assigns.ca_current_status = "0"), 1, 0)) as pending, 
						SUM(IF((ca_assigns.ca_current_status = 1), 1, 0)) as active,
						SUM(IF((ca_assigns.ca_current_status = 2), 1, 0)) as inactive,
						SUM(IF((ca_assigns.ca_current_status = 3), 1, 0)) as rejected'))
					->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
					->whereYear('ca_assigns.created_at', date('Y'))
					->where('users.u_type','=',2) 
					->where('ca_assigns.ca_id','=',$userId)
					//->where('ca_assigns.ca_assign_status','=',1)
					//->where('ca_assigns.ca_current_status','=',1)
					->get()
					->groupBy(function ($date) {
						return Carbon::parse($date->created_at)->format('m');
					});

			$usermcount = [];
			$userArr = [];
	
			//echo "<pre>";print_r($users);//exit;
			foreach ($users as $key => $value) {
				//$usermcount[(int)$key] = count($value);
				foreach ($value as $k => $v) {
					$usermcount[(int)$key]['active'] =  $v->active;
					$usermcount[(int)$key]['rejected'] =  $v->rejected;
				}
			}
			//echo "<pre>";print_r($usermcount);//exit;
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

			for ($i = 1; $i <= 12; $i++) {
				if (!empty($usermcount[$i])) {
					//$userArr[$i]['count'] = $usermcount[$i];
					$userArr[$i]['active'] = $usermcount[$i]['active'];
					$userArr[$i]['rejected'] = $usermcount[$i]['rejected'];
				} else {
					//$userArr[$i]['count'] = 0;
					$userArr[$i]['active'] = 0;
					$userArr[$i]['rejected'] = 0;
				}
				$userArr[$i]['month'] = $month[$i - 1];
			}
			//echo "<pre>";print_r($userArr);//exit;
			
			$arr1 = array();
			$arr2 = array();
			$arr3 = array();
			foreach ($userArr as $newaarr) {
				array_push($arr1, $newaarr['active']);
				array_push($arr2, $newaarr['rejected']);
				array_push($arr3, $newaarr['month']);
			}
			$active = implode(",",$arr1);
			$rejected = implode(",",$arr2);
			$month = implode(",",$arr3);
			
			$response['active'] = $active;
			$response['rejected'] = $rejected;
			$response['categories'] = $month;
			//echo "<pre>";print_r($response);exit;
			return response()->json(($response));
		}
		else if($request->type == "yearly")
		{
			$userId = Auth::user()->id;
			$users = DB::table('users')
					->select(DB::raw('users.id,ca_assigns.created_at,YEAR(ca_assigns.created_at) as year,
						SUM(IF((ca_assigns.ca_current_status = "0"), 1, 0)) as pending, 
						SUM(IF((ca_assigns.ca_current_status = 1), 1, 0)) as active,
						SUM(IF((ca_assigns.ca_current_status = 2), 1, 0)) as inactive,
						SUM(IF((ca_assigns.ca_current_status = 3), 1, 0)) as rejected'))
					->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
					->where('users.u_type','=',2) 
					->where('ca_assigns.ca_id','=',$userId)
					//->where('ca_assigns.ca_assign_status','=',1)
					//->where('ca_assigns.ca_current_status','=',1)
					->groupBy('year')
					->orderBy('year','desc')
					->take(5) //last 5 years
					->get();

			$userArr = [];
			$year = [];
			//echo "<pre>";print_r($users);exit;
			foreach ($users as $key => $v) {
				$userArr[(int)$key]['active'] =  $v->active;
				$userArr[(int)$key]['rejected'] =  $v->rejected;
				$userArr[(int)$key]['year'] =  $v->year;
			}
			$arr1 = array();
			$arr2 = array();
			$arr3 = array();
			foreach ($userArr as $newaarr) {
				array_push($arr1, $newaarr['active']);
				array_push($arr2, $newaarr['rejected']);
				array_push($arr3, $newaarr['year']);
			}
			$active = implode(",",$arr1);
			$rejected = implode(",",$arr2);
			$year = implode(",",$arr3);
			
			$response['active'] = $active;
			$response['rejected'] = $rejected;
			$response['categories'] = $year;
			//echo "<pre>";print_r($response);exit;
			return response()->json(($response));
		}
	}
}
