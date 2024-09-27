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
use App\Company_profiles;
use App\Task_managements;
use App\Ca_details;
use App\Ca_assigns;
use App\Country;
use App\State;
use App\City;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class ClientController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function Index()
    {
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
						['users.ca_add_by', '=', Auth::user()->id],
						['users.u_type', '!=', 4],
					])
					->orderBy('created_at','desc')->paginate(10);
		
		//echo "<pre>"; print_r($customers);exit;			
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
			$array[$val->id]['comp_bill_addone'] = isset($val->comp_bill_addone)?$val->comp_bill_addone:"";
			$array[$val->id]['comp_bill_pin'] = isset($val->comp_bill_pin)?$val->comp_bill_pin:"";
			$array[$val->id]['created_at'] = $val->created_at;
			$array[$val->id]['ca_assign_status'] = $val->ca_assign_status;
			$array[$val->id]['ca_current_status'] = $val->ca_current_status;
			$array[$val->id]['compId'] = $val->compId;
			$array[$val->id]['isCaActive'] = $val->isCaActive;
		}
		
		$customers = json_decode(json_encode($array));
		//echo "<pre>"; print_r($customers);exit;
        return view('pages.ca.client')->with([
			'customers' =>$customers,
			'customers_pagination' => $customers_pagination
        ]);
    }
	
	//Activate customer
	public function changeCustomerStatus(Request $request)
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
			$update1 = DB::table('users')
				->where('id','=',$request->id)
				->update(
					 array(
						'isActive' => ($request->status == 1) ? 1 : 0,
					 )
				);
		
			//Add notification
			$from_uid = Auth::user()->id;
			$to_uid = $request->id;
			$utype = Auth::user()->u_type;
			$noti_title = "CA Activity";
			if($request->status ==1){
				$msg = "Assign request activated";
			}else if($request->status ==2){
				$msg = "Assign request deactive";
			}else if($request->status ==3){
				$msg = "Assign request rejected";
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
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;"> '.$msg.' by '.$caName.'</p></td>
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
			'redirect' => url('/client'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }

	protected function validatorclient(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
            'comp_name' => 'required|min:3',
            
            'comp_email' => 'required|email',
            'comp_phone' => 'required|min:10',
            
        ]
		);
    }

    protected function createClient(array $data)
    {
		//print_r($data);exit;
        return Company_profiles::create([
           // 'userId' => Auth::user()->id,
            'gst_no' => $data['comp_gst_no'],
            'comp_name' => $data['comp_name'],
            'comp_email' => $data['comp_email'],
			'comp_phone' => $data['comp_phone'],
			'comp_pan_no' => $data['comp_pan_no'],
			'comp_website' => $data['comp_website'],
			'agent_name' => $data['agent_name'],
			'compincorp' => implode(',', $data['compincorp']),
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

	protected function createClientuser(array $data)
    {
		//print_r($data);exit;
		$compId = DB::table('users')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$compId = isset($compId[0]->id)?$compId[0]->id:0;
		$compId = Helper::invoice_num($compId+1,7,"CID-");

        return User::create([            
            'name' => $data['comp_name'],
            'email' => $data['comp_email'],
			'password' => Hash::make($data['comp_phone']),
			'phone' => $data['comp_phone'],
			'u_type' =>'2',
			'status' =>'1',
			'userStatus' =>'1',
			'isActive' =>'1',
			'compId' => $compId,
			'ca_add_by'=>Auth::user()->id,
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

	public function comp_check_email(Request $request)
    {
        $request->validate([
            'comp_email' => 'required|email',
        ]);

        $email = $request->input('comp_email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['available' => !$exists]);
    }
	

	
    public function AddClient()
    {
		$agents = DB::table('busi_agents')
							->select(DB::raw('busi_agents.id,busi_agents.agent_name'))
							->where('added_by','=',Auth::user()->id)
							->get()->toArray();
		
		
        return view('pages.ca.addclient')->with([
			'agents' => $agents
        ]);
    }

	public function save_client(Request $request)  {  
        $email_id = $request->input('comp_email'); 
        $comp_phone = $request->input('comp_phone'); 
        
		
		//echo "<pre>";print_r($request->all());exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validatorclient($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertClient = $this->createClientuser($request->all());
			$cId = DB::getPdo()->lastInsertId();
			if($cId){
				$insertClient = $this->createClient($request->all());
				$id = DB::getPdo()->lastInsertId();
				$update = DB::table('company_profiles')
					->where('id', $id)
					->update(
						array(
							'userId' => $cId,
						)
					);
				//add in ca_assigns

				$user = new Ca_assigns;
				$user->comp_id = $cId;
				$user->utype = 2;
				$user->ca_id = Auth::user()->id;
				$user->ca_assign_status = 1;
				$user->ca_current_status = 1;
				$user->save();
			}

			if ($insertClient){
				//-------- Email Send ----------
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
										<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">Congratulations</h1>
										<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
									</div>
									<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
										<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Login User Name: '.$email_id.',</b></td>
											</tr>
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Login Password: '.$comp_phone.',</b></td>
											</tr>
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Login Url: https://ecashbook.in/,</b></td>
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
					'email' => $email_id
				];
				$emailSubject = "Congratulations";
				$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);

				//--------- End Email send -------





				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/client'),
					'message' => 'Client account added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'client add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }

	public function EditClient($clientId)
    {
		//echo "<pre>";print_r($clientId);exit;
		$clientId = base64_decode($clientId);
		$client = DB::table('company_profiles')
								->where('userId', '=', $clientId)
								->get();

		$client = $client[0];
		$agents = DB::table('busi_agents')
							->select(DB::raw('busi_agents.id,busi_agents.agent_name'))
							->where('added_by','=',Auth::user()->id)
							->get()->toArray();
		
		//echo "<pre>";print_r($client);exit;
        return view('pages.ca.editclient')->with([
			'client' => $client,
			'agents'=>$agents,		
			'clientId' => $clientId

        ]);
    }

	public function update_client(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$clientId = $request->id;
		
		$validation = $this->validatorclient($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update agent
			$update = DB::table('company_profiles')
					->where('userId', $clientId)
					->update(
						 array(

							'gst_no' => $request->comp_gst_no,
							'comp_name' => $request->comp_name,
							'comp_email' =>$request->comp_email,
							'comp_phone' => $request->comp_phone,
							'comp_pan_no' => $request->comp_pan_no,
							'comp_website' => $request->comp_website,
							'agent_name' => $request->agent_name,
							'compincorp' => implode(',', $request->compincorp),
								
						 )
					);
			if ($update){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/client'),
					'message' => 'Record details updated'
				);
				return response()->json($msg);	
			}
			else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Update not success!'
					);
					return response()->json($msg);	
			}
		}	
    }
	

    public function ClientDetails($custId)
    {
        if(Auth::user()->u_type ==2){
			return redirect('/');
		}
		$custId = base64_decode($custId);
		
		$customers = DB::table('users')
					->select(DB::raw('users.*,company_profiles.*'))
					->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
					->where('users.id','=',$custId)
					->get();
		$customers = $customers[0];
		// echo "<pre>";print_r($customers);exit;
		$taskDetails = DB::table('task_managements')
				->select(DB::raw('task_managements.id,
					SUM(IF((task_managements.project_status = 1), 1, 0)) as totalPending,
					SUM(IF((task_managements.project_status = 2), 1, 0)) as totalOngoing,
					SUM(IF((task_managements.project_status = 3), 1, 0)) as totalCompleted,
					SUM(IF((task_managements.project_status = 1 || task_managements.project_status = 2 || task_managements.project_status = 3), 1, 0)) as totalTask,
					SUM(IF((task_managements.total_amount >=0), total_amount, 0)) as totalAmount,
					SUM(IF((task_managements.advance_payment >=0), advance_payment, 0)) as totalRecurring,
					SUM(IF((task_managements.due_amount >=0), due_amount, 0)) as totalDue'))
				->where('task_managements.company_id','=',$custId)
				->get();
		//echo "<pre>";print_r($tasks);exit;
		
		$tasks = DB::table('users')
						->select(DB::raw('users.*,task_managements.*'))					
						->leftJoin('task_managements', 'users.id', '=', 'task_managements.company_id')                   					
						->where('task_managements.company_id','=',$custId) 
						->orderBy('users.created_at','desc')->paginate(10);
        
        $tasks_pagination = $tasks;

		$array2 = array();
		foreach($tasks as $k=>$val)
		{
			$array2[$val->id]['id'] = $val->id;
			$array2[$val->id]['u_type'] = $val->u_type;
            $array2[$val->id]['task_id'] = $val->task_id;
            $array2[$val->id]['task_date'] = $val->task_date;
            $array2[$val->id]['task_time'] = $val->task_time;
            $array2[$val->id]['task_category'] = $val->task_category;
            $array2[$val->id]['gov_fees'] = $val->gov_fees;
            $array2[$val->id]['services_charges'] = $val->services_charges;
            $array2[$val->id]['total_amount'] = $val->total_amount;
		}
		$tasks = json_decode(json_encode($array2));

		//-------Bank Details Fetch--------

		$customers_bank = DB::table('company_banks')
					->where('uid','=',$custId)
					->get();
		//echo "<pre>";print_r($tasks);exit;
		
        return view('pages.ca.client-view')->with([
			'customers' =>$customers,
			'taskDetails' => $taskDetails,
			'tasks' => $tasks,
			'tasks_pagination' => $tasks_pagination,
			'customers_bank' => $customers_bank,
			'custId' => $custId,
        ]);
    }

	public function payment_invoice_customer($payId,$cId){

		$payId = base64_decode($payId);
		$compId = base64_decode($cId);

		//----------Company Details -----------
		$companyDetails = DB::table('company_profiles')
					->where('userId','=',$compId)
					->get();
		//echo '<pre>'; print_r($companyDetails); exit;

		//---------Payment Details --------	

		$paymentDetails = DB::table('task_managements')
					->where('id','=',$payId)
					->where('company_id','=',$compId)
					->get();
		//echo '<pre>'; print_r($paymentDetails); exit;

			return view('pages.ca.invoice_payment')->with([
				
				
			]);
			// return view('pages.ca.client_invoice')->with([
			// 	'companyDetails' => $companyDetails,
			// 	'paymentDetails' => $paymentDetails,
			// 	'sid' => $payId
				
			// ]);
	}
}
