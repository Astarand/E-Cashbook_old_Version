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
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class AdminMessagesController extends Controller
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
    public function index($uid)
    {
		//$this->middleware('auth');
		$uid = base64_decode($uid);
		$msgToSend = DB::table('users')
						->select(DB::raw('users.name,users.u_type'))					                 					
						->where('users.id','=',$uid) 
						->get();
		if($msgToSend[0]->u_type == 1)
		{
			$company = DB::table('ca_profiles')
					->select(DB::raw('ca_profiles.comp_name'))					                 					
					->where('ca_profiles.userId','=',$uid) 
					->get();
			
		}if($msgToSend[0]->u_type == 2){
			$company = DB::table('company_profiles')
					->select(DB::raw('company_profiles.comp_name'))					                 					
					->where('company_profiles.userId','=',$uid) 
					->get();
		}
		//echo "<pre>"; print_r($company);exit;
		$comp_name = isset($company[0]->comp_name)?$company[0]->comp_name:$msgToSend[0]->name;
		
		return view('pages.superadmin.messages')->with([
			'comp_name' => $comp_name,
			'uid' => $uid,
		]);
    }
	
	public function send_message(Request $request)
    {
		$messageText = trim($request->messageText);
		$uid = $request->uid;
		
		if($messageText ==""){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Message is required'
			);
			return response()->json($msg);
		}else{
			
			$msgToSend = DB::table('users')
						->select(DB::raw('users.id,users.name,users.email,users.u_type'))					                 					
						->where('users.id','=',$uid) 
						->get();
			
			$array = array();
			foreach($msgToSend as $k=>$val)
			{
				if($val->u_type == 1)
				{
					$company = DB::table('ca_profiles')
							->select(DB::raw('ca_profiles.comp_name,ca_profiles.comp_email'))					                 					
							->where('ca_profiles.userId','=',$uid) 
							->get();
					
				}if($val->u_type == 2){
					$company = DB::table('company_profiles')
							->select(DB::raw('company_profiles.comp_name,company_profiles.comp_email'))					                 					
							->where('company_profiles.userId','=',$uid) 
							->get();
				}
				$comp_name = isset($company[0]->comp_name)?$company[0]->comp_name:$val->name;
				$email = isset($company[0]->comp_email)?$company[0]->comp_email:$val->email;
				
				//Add notification
				$from_uid = Auth::user()->id;
				$to_uid = $uid;
				$utype = Auth::user()->u_type;
				$noti_title = "Admin message";
				$msg = $messageText;
				$url ="";
				$notifications = Helper::addNotification($to_uid,$noti_title,$msg,$url);
				//End notification
				
				//Start send mail
				$name = $comp_name;
				$email = $email;
				$body = '<html lang="en">
								<head>
								<title>Admin Message</title>
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
										<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">Message From Admin</h1>
										<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
									</div>
									<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
										<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">Message from Admin below:</p></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">'.$messageText.'</p></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;">
												<p style="text-align: left;margin: 0;font-weight:600;">
												
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
				$emailSubject = "Message from Admin";
				$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);					
				//End send mail
				
			}
			
			if($notifications){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/'),
					'message' => 'Message sent successfully'
				);
				return response()->json($msg);
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Message send failed.Try again!'
				);
				return response()->json($msg);
			}
			//$tasksToSend = json_decode(json_encode($array));
			
			
			//echo "<pre>"; print_r($tasksToSend);exit;
		
		
		}
		
		
    }


}
