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
use App\Statutorys;
use App\Task_managements;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
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
	
	public function home_page()
    {
		
		return view('pages.home')->with([
				
			]); 
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		//$this->middleware('auth'); 
		
		if(Auth::user() && Auth::user()->u_type == 1){
			$custPayment = DB::table('task_managements')
				->select(DB::raw('task_managements.id,
					SUM(IF((task_managements.total_amount >=0), total_amount, 0)) as totalAmount,
					SUM(IF((task_managements.advance_payment >=0), advance_payment, 0)) as totalAdvance,
					SUM(IF((task_managements.due_amount >=0), due_amount, 0)) as totalDue,
					SUM(IF((task_managements.gov_fees >=0), gov_fees, 0)) as totalGovFees'))	
				->where('task_managements.added_by','=',Auth::user()->id)
				->get();
			$employees = DB::table('users')
				->select(DB::raw('users.id,
					SUM(IF((users.is_online = 0 || users.is_online = 1), 1, 0)) as totalEmp,
					SUM(IF((users.is_online =1), 1, 0)) as totalPresent,
					SUM(IF((users.is_online =0), 1, 0)) as totalAbsent'))
				->where('users.u_type','=',4)
				->where('users.ca_add_by','=',Auth::user()->id)
				->get();
			//echo "<pre>";print_r($custPayment);exit;
			return view('pages.ca.cahome')->with([
				'custPayment' =>$custPayment,	
				'employees' =>$employees	
			]);  
		}else if(Auth::user() && Auth::user()->u_type == 2){
			$userId = Auth::user()->id;
			$statutory =  DB::table('statutorys')
							->select(DB::raw('statutorys.*'))
							->where('statutorys.compId','=',$userId)
							->orderBy('id', 'DESC')->offset(0)->limit(3)->get();
			$statutoryTwo =  DB::table('statutorys')
							->select(DB::raw('statutorys.*'))
							->where('statutorys.compId','=',$userId)
							->orderBy('id', 'DESC')->offset(3)->limit(6)->get();
			$banks = DB::table('banks')
				->select(DB::raw('banks.id,
					SUM(IF((banks.id >0), 1, 0)) as totalBankAccount,
					SUM(IF((banks.curr_bal >=0), curr_bal, 0)) as totalBalance'))
				->where('banks.added_by','=',$userId)
				->get();
			$loans = DB::table('loans')
				->select(DB::raw('loans.id,
					SUM(IF((loans.credit_limit >=0), credit_limit, 0)) as totalLoan'))
				->where('loans.added_by','=',$userId)
				->get();

				//--------------- Bank Details select (Dashboard)-----------
				$allBanks =  DB::table('banks')
							->where('added_by','=',$userId)
							->get();
				//--------------- Statutory Status ------------
				$statutory_data = DB::table('statutorys')
							->select(DB::raw('statutorys.*, company_profiles.comp_name, ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'statutorys.compId', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'statutorys.compId', '=', 'ca_assigns.comp_id')
							// ->where('ca_assigns.ca_id', '=', $userId) // Uncomment if needed
							->where('ca_assigns.ca_assign_status', '=', 1)
							->orderBy('id', 'DESC')
							->take(10)
							->get();
				
				

				
				
			return view('pages.home')->with([
				'statutory' => $statutory,
				'statutoryTwo' => $statutoryTwo,
				'banks' => $banks,
				'loans' => $loans,
				'allBanks' => $allBanks,
				'statutory_data' => $statutory_data
			]);
		}else if(Auth::user() && Auth::user()->u_type == 3){
			$statutory =  DB::table('statutorys')
							->select(DB::raw('statutorys.*'))
							->orderBy('id', 'DESC')->offset(0)->limit(3)->get();
			$statutoryTwo =  DB::table('statutorys')
							->select(DB::raw('statutorys.*'))
							->orderBy('id', 'DESC')->offset(3)->limit(6)->get();
			//On-boarding CA
			$onboardCa =  DB::table('users')
							->select(DB::raw('users.id as uid,users.*,ca_profiles.*'))
							->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
							->where('users.u_type', '=', 1)
							->orderBy('users.id', 'DESC')
							->limit(3)->get();
			$array = array();
			foreach($onboardCa as $k=>$val)
			{
				$array[$val->id]['id'] = $val->uid;
				$array[$val->id]['comp_logo'] = ($val->comp_logo !="")?$val->comp_logo:$val->avatar;
				$array[$val->id]['comp_name'] = ($val->comp_name !="")?$val->comp_name:$val->name;
				$array[$val->id]['comp_email'] = ($val->comp_email !="")?$val->comp_email:$val->email;			
				$array[$val->id]['comp_phone'] = ($val->comp_phone !="")?$val->comp_phone:$val->phone;
				
				$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
				$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
				$array[$val->id]['state'] = isset($states[0]->name)?$states[0]->name:"";
				$array[$val->id]['city'] = isset($cities[0]->name)?$cities[0]->name:"";
				$array[$val->id]['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
				$array[$val->id]['isCaActive'] = $val->isCaActive;
				$array[$val->id]['status'] = $val->status;
				$array[$val->id]['created_at'] = $val->created_at;
			}
			$onboardCa = json_decode(json_encode($array));
			
			//On-boarding Customer
			$onboardCust =  DB::table('users')
							->select(DB::raw('users.id as uid,users.*,company_profiles.*'))
							->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
							->where('users.u_type', '=', 2)
							->orderBy('users.id', 'DESC')->limit(3)->get();
			
		
			$array2 = array();
			foreach($onboardCust as $k=>$val)
			{
				$array2[$val->id]['id'] = $val->uid;
				$array2[$val->id]['comp_logo'] = ($val->comp_logo !="")?$val->comp_logo:$val->avatar;
				$array2[$val->id]['comp_name'] = ($val->comp_name !="")?$val->comp_name:$val->name;
				$array2[$val->id]['comp_email'] = ($val->comp_email !="")?$val->comp_email:$val->email;			
				$array2[$val->id]['comp_phone'] = ($val->comp_phone !="")?$val->comp_phone:$val->phone;
				
				$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
				$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
				$array2[$val->id]['state'] = isset($states[0]->name)?$states[0]->name:"";
				$array2[$val->id]['city'] = isset($cities[0]->name)?$cities[0]->name:"";
				$array2[$val->id]['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
				$array2[$val->id]['status'] = $val->status;
				$array2[$val->id]['created_at'] = $val->created_at;
			}
			$onboardCust = json_decode(json_encode($array2));
							
			$employees = DB::table('users')
				->select(DB::raw('users.id,
					SUM(IF((users.is_online = 0 || users.is_online = 1), 1, 0)) as totalEmp,
					SUM(IF((users.is_online =1), 1, 0)) as totalPresent,
					SUM(IF((users.is_online =0), 1, 0)) as totalAbsent'))
				->where('users.u_type','=',3)
				->where('users.id','!=',1)
				->where('users.ca_add_by','=',Auth::user()->id)
				->get();
			return view('pages.superadmin.home')->with([
				'statutory' => $statutory,
				'statutoryTwo' => $statutoryTwo,	
				'employees' =>$employees,
				'onboardCa' => $onboardCa,	
				'onboardCust' => $onboardCust,	
				
			]); 
		}else if(Auth::user() && Auth::user()->u_type == 4){
			
			$userId = Auth::user()->id;
			
			$tasks = DB::table('task_managements')
					->select(DB::raw('task_managements.id,
						SUM(IF((task_managements.project_status = 1), 1, 0)) as pending,
						SUM(IF((task_managements.project_status = 2), 1, 0)) as ongoing,
						SUM(IF((task_managements.project_status = 3), 1, 0)) as completed'))
					->where('task_managements.emp_id','=',$userId)
					->get();
			return view('pages.employee.emp-home')->with([
				'tasks' => $tasks	
			]); 
		}
		else{
			return redirect('/userlogin');
		}
    }
	public function login(Request $request)
    {
		$title = 'Login';
		if(!Auth::user()){
			 return view('pages.login')->with([
				'title' =>$title
			]); 
		}
		
    }
	
	public function register(Request $request)
    {
		$title = 'Register';
		$states = State::where('country_id', '=', 101)->get();				
		 return view('pages.register')->with([
			'title' =>$title,
			'states'=>$states	
		]); 
		
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
            //'username' => 'required|max:255|unique:users',
            //'company_name' => 'required|min:3',
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:users',
			'state_id' => 'required',
			'city_id' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required|min:10|max:10'			
        ]
		);
    }

    protected function create(array $data)
    {
		//print_r($data);exit;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'password' => Hash::make($data['password']),
			'phone' => $data['phone'],
			'u_type' => $data['u_type'],
			'status'   =>  0,
			'userStatus'   => 1,
			'isActive'   => 1,
			'is_online'   => 0,
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     public function registerUser(Request $request)  {  
        $validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
            
            $user = $this->create($request->all()); 
						
			if ($user){
					
					$user = User::where('id','=',$user->id)->get();
					$user = @$user[0];
					
						
					//echo "<pre>";print_r($user);exit;
					if(!empty($user)){

						//$id = $user->id;
						
						//Start send mail

						   $name = $user->name;
						   $password = $request->password;
						   $email = $user->email;
						   $u_type = $user->u_type;
						   $emp_permission = $user->emp_permission;
						   $isCaActive = $user->isCaActive;
						   $id = $user->id;
						   $verifyUrl = url('/').'/verify_email/'.base64_encode($id).'/'.$email;
						   
						   $body = '<html lang="en">
											<head>
											<title>Verify Email</title>
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
													<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">Verify Your Account</h1>
													<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
												</div>
												<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
													<table cellpadding="0" cellspacing="0" border="0" width="100%">
														<tr>
															<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
														</tr>
														
														<tr>
															<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">Username: '.$email.'</p></td>
														</tr>
														
														<tr>
															<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">Thank you for signing up.Please verify your email address to start your journey.</p></td>
														</tr>
														
														<tr>
															<td style="padding-bottom: 5px;">
															<p style="text-align: left;margin: 0;font-weight:600;">
															<a style="text-decoration:none;background: #ff481c;text-transform: uppercase;padding: 10px 25px;color: #fff;font-size: 18px;font-weight: bold;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;display: inline-block;text-align: center;margin-top: 20px;border: none;" href="'.$verifyUrl.'">Verify Now</a>
															</p>
															</td>
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
							$emailSubject = "Verify Email";
							$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);							
							//End send mail
							
							/*if(Auth()->attempt(['email' => $email,'password' => $password, 'u_type' => $u_type,'emp_permission' => $emp_permission, 'status' => 1,'isActive' => 1,'isCaActive' => $isCaActive]))
							{
							}*/
					}
					
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/'),
						'message' => 'Registration Successfull! Please verify Email Id'
					);
					return response()->json($msg);
				}
        }
    }
	
	public function verify_email($id,$email)  {  
		//die("fff");
		
		$id = base64_decode($id);
		$exists_data = DB::table('users')
							->where('id','=',$id)
							->where('email','=',$email)
							->where('status','=',0)
							->get()->toArray();
							
							//print_r($exists_data);exit;
		if(!empty($exists_data))
		{
			DB::table('users')
				->where('id', $id)  
				->where('email', $email)  
				->update(array('status' => 1));
			 $flag = 1;
			 $u_type = $exists_data[0]->u_type;
			 return view('pages.email-verify')->with(['flag'=>$flag,'u_type'=>$u_type]);
		}else{
			 $flag = 0;
			 $u_type = 0;
			 return view('pages.email-verify')->with(['flag'=>$flag,'u_type'=>$u_type]);
		}
	}
	
	public function test_email(Request $request)  {  
	
		$body = '<html lang="en">
						<head>
						<title>Test Email</title>
						<meta charset="utf-8">
						<meta name="viewport" content="width=device-width, initial-scale=1">
						</head>
						<body style="margin: 0;padding: 0;font-family: Arial, Helvetica, sans-serif;">
						<div style="width: 100%;display: block;position: relative;">
							Test Email
						</div>
						</body>
						</html> ';	
						
		$data_email = [
			'email' => "binaysamanta@gmail.com"
		];
		$emailSubject = "Test Email";
		
		try {
			Mail::send([], [], function ($message) use ($body,$data_email,$emailSubject) {
			  $message->to($data_email['email'])
				->subject($emailSubject)
				->from(env('MAIL_FROM_ADDRESS'))
				->setBody($body, 'text/html');
			});
			return 'Email sent successfully!';
		}catch (Exception $ex) {
			// Debug via $ex->getMessage();
			return $ex;
		}
		
		/* if(count(Mail::failures()) > 0){
			echo 'Failed to send email, please try again.';
		}else{
			echo 'Email sent successfully!';
		} */
	}
	
	public function loginUser(Request $request)
	{
		
		//print_r($request->all());exit;
		 $email = $request->email;
		 $password = $request->password;
		 
		// $remember = ($request->remember) ? true : false;
		 $remember = $request->remember; 
		 if($remember=='true')
			{
				 $minutes = 3600*24*15;
				 Cookie::queue(Cookie::make('loginId', $email, $minutes));
				 Cookie::queue(Cookie::make('loginPass', $password, $minutes));
			}
			else{
				Cookie::queue(Cookie::forget('loginId'));
				Cookie::queue(Cookie::forget('loginPass'));
			}
		
		$userCheck = $quotes =  DB::table('users')
						->select(DB::raw('users.id,users.u_type,users.emp_permission,users.status,users.isActive,users.isdeleted,users.isCaActive'))
						->where('email','=',$email)
						->get()->toArray();
		if(empty($userCheck)){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'User not exists !',
				'sendActive' => 0
			);
			return response()->json($msg);
		}
		if(!empty($userCheck) && ($userCheck[0]->status==0) ){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'Account email not verified !',
				'sendActive' => 1
			);
			return response()->json($msg);
		}
		if(!empty($userCheck) && ($userCheck[0]->status==1) && ($userCheck[0]->isActive==0) ){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'Account inactive.Please contact with site Admin !',
			);
			return response()->json($msg);
		}
		if(Auth()->attempt(['email' => $email,'password' => $password, 'u_type' => $userCheck[0]->u_type,'emp_permission' => $userCheck[0]->emp_permission, 'status' => 1,'isActive' => 1,'isCaActive' => $userCheck[0]->isCaActive]))
		{
			$id = Auth::user()->id;
				$update = DB::table('users')
					->where('id', $id)
					->update(
						array(
							'is_online' => 1,
						)
					);
			$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/'),
					'message' => 'Login Successful'
				);
			return response()->json($msg);
		}
		else
		{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'Login Fail !',
				'sendActive' => 0
			);
			return response()->json($msg);
		}
	}
	
	public function forgotpassword(Request $request)
    {
		$title = 'Forgot Password';		
		 return view('pages.forgotpassword')->with([
			'title' =>$title
		]); 
		
    }
	
	public function save_forgotpassword(Request $request)
	{
		
		//print_r($request->all());exit;
		$email = $request->email;
		$userCheck = DB::table('users')
						->select(DB::raw('users.id,users.name,users.u_type,users.status,users.isActive,users.isdeleted'))
						->where('email','=',$email)
						->get()->toArray();
		if(empty($userCheck)){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'User not exists !',
				'sendActive' => 0
			);
			return response()->json($msg);
		}
		else if(!empty($userCheck) && ($userCheck[0]->status==0) ){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'Account email not verified !',
				'sendActive' => 1
			);
			return response()->json($msg);
		}
		else if(!empty($userCheck) && ($userCheck[0]->status==1) && ($userCheck[0]->isActive==0) ){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'message' => 'Account inactive.Please contact with site Admin !',
			);
			return response()->json($msg);
		}
		else
		{
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
				 }
			$pass_fog=(implode($pass));
			
			$hashed_random_password = Hash::make($pass_fog);
			$updatePass = DB::table('users')
						->where('email', $email)  
						->update(array('password' => $hashed_random_password));
						
			if($updatePass){
				//Start send mail
			   $name = $userCheck[0]->name;
			   $email = $request->email;
			   
			   $body = '<html lang="en">
								<head>
								<title>New Password</title>
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
										<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">New Password</h1>
										<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
									</div>
									<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
										<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">New Password: '.$pass_fog.'</p></td>
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
				$emailSubject = "New Password";
				$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);				
				//End send mail
				if($sendMail){
					$msg = array(
							'status' => 'success',
							'class' => 'succ',
							'redirect' => url('/'),
							'message' => 'Password sent to your register Email'
						);
					return response()->json($msg);
				}
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'message' => 'Action failed !',
					'sendActive' => 1
				);
				return response()->json($msg);
			}
		}
		
	}
	
	
	
	public function logout(Request $request) {
	  //$this->guard()->logout();
      //$request->session()->flush();
      //$request->session()->regenerate();
	  $id = Auth::user()->id;
				$update = DB::table('users')
					->where('id', $id)
					->update(
						array(
							'is_online' => 0,
						)
					);
	  Auth::logout();

	  $request->session()->invalidate();
      $request->session()->regenerateToken();
	  return redirect('/');
	}
	
	public function about_us(Request $request)
    {
		$title = 'About Us';		
		 return view('pages.about')->with([
			'title' =>$title
		]); 
		
    }
	public function pagenotfound()
	{
		return view('errors.pagenotfound');
	}
}
