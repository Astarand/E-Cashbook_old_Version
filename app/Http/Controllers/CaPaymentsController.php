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
use App\Task_managements;
use App\Company_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class CaPaymentsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function Index()
    {

		$title = 'Payment List of Customers';
		$userId = Auth::user()->id;
		if(Auth::user() && Auth::user()->u_type == 1){
			$payments = DB::table('users')
						->select(DB::raw('users.name,users.phone,users.u_type,task_managements.id,task_managements.company_id,task_managements.total_amount,task_managements.advance_payment,task_managements.due_amount'))					
						->leftJoin('task_managements', 'users.id', '=', 'task_managements.company_id')                   					
						->where('task_managements.added_by','=',$userId) 
						->orderBy('task_managements.created_at','desc')->paginate(10);
		}else if(Auth::user() && Auth::user()->u_type == 4){
			$payments = DB::table('users')
						->select(DB::raw('users.name,users.phone,users.u_type,task_managements.id,task_managements.company_id,task_managements.total_amount,task_managements.advance_payment,task_managements.due_amount'))					
						->leftJoin('task_managements', 'users.id', '=', 'task_managements.company_id')                   					
						->where('task_managements.emp_id','=',$userId) 
						->orderBy('task_managements.created_at','desc')->paginate(10);

		}
        
        $payments_pagination = $payments;
        
       
       $array = array();
		foreach($payments as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['company_id'] = $val->company_id;
			$array[$val->id]['u_type'] = $val->u_type;
			$array[$val->id]['total_amount'] = $val->total_amount;
			$array[$val->id]['advance_payment'] = $val->advance_payment;
            $array[$val->id]['due_amount'] = $val->due_amount;
			$compData = DB::table('company_profiles')
						->select(DB::raw('company_profiles.comp_name,company_profiles.comp_phone'))					                  					
						->where('company_profiles.userId','=',$val->id) 
						->get();
            $array[$val->id]['comp_name'] = isset($compData[0]->comp_name)?$compData[0]->comp_name:$val->name;
            $array[$val->id]['comp_phone'] = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:$val->phone;
			
		}
		$payments = json_decode(json_encode($array));
        //echo "<pre>"; print_r($payments);exit;
        return view('pages.ca.capayments')->with([
            'title' =>$title,
			'payments'=>$payments,
			'payments_pagination' =>$payments_pagination,

        ]);
    }
}
