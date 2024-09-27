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
use App\Company_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class AdminCustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function customerportal()
    {
        $title = 'Customer Lists';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==3){ //admin
			$users =  DB::table('users')
							->select(DB::raw('users.id as uid,users.*,company_profiles.*'))
							->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
							->where('users.u_type', '=', 2)
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
			
			$caAssignId =  DB::table('ca_assigns')
							->select(DB::raw('ca_assigns.ca_id'))
							->where('comp_id', '=', $val->uid)
							->where('ca_assign_status', '=', 1)
							->where('ca_assign_status', '=', 1)
							->get();
			$caAssignId = isset($caAssignId[0]->ca_id)?$caAssignId[0]->ca_id:0;
			$assignCaName =  DB::table('users')
							->select(DB::raw('users.name'))
							->where('id', '=', $caAssignId)
							->get();
			$array[$val->id]['assignCa'] = isset($assignCaName[0]->name)?$assignCaName[0]->name:"";
			
			$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
			$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
			$array[$val->id]['state'] = isset($states[0]->name)?$states[0]->name:"";
			$array[$val->id]['city'] = isset($cities[0]->name)?$cities[0]->name:"";
			$array[$val->id]['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['created_at'] = $val->created_at;
		}
		$users = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($users);exit;
		return view('pages.superadmin.customer')->with([
			'title' =>$title,
			'users'=>$users,
			'users_pagination' =>$users_pagination,
		]); 
    }
    public function customerprofile($cId)
    {
        $cId = base64_decode($cId);
		if(Auth::user()->u_type ==3){ //admin
			$users =  DB::table('users')
							->select(DB::raw('users.id as uid,users.*,company_profiles.*'))
							->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
							->where('users.id', '=', $cId)
							->where('users.u_type', '=', 2)
							->get();
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
			
			$caAssignId =  DB::table('ca_assigns')
							->select(DB::raw('ca_assigns.ca_id'))
							->where('comp_id', '=', $val->uid)
							->where('ca_assign_status', '=', 1)
							->where('ca_assign_status', '=', 1)
							->get();
			$assignCaName =  DB::table('users')
							->select(DB::raw('users.name'))
							->where('id', '=', $caAssignId[0]->ca_id)
							->get();
			$array['assignCa'] = isset($assignCaName[0]->name)?$assignCaName[0]->name:"";
			
			$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
			$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
			$array['state'] = isset($states[0]->name)?$states[0]->name:"";
			$array['city'] = isset($cities[0]->name)?$cities[0]->name:"";
			$array['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
			$array['status'] = $val->status;
			$array['created_at'] = $val->created_at;
		}
		$users = json_decode(json_encode($array));
		//echo "<pre>"; print_r($users);exit;
		
		//start payment
		if(Auth::user()->u_type ==3){ 
			$payments =  DB::table('payments')
							->select(DB::raw('payments.*'))
							->where('payments.custId', '=', $cId)
							->orderBy('payments.id', 'DESC')->paginate(10);
		}
		$payments_pagination = $payments;		
		$array2 = array();
		foreach($payments as $k=>$val)
		{
			$array2[$val->id]['id'] = $val->id;
			$array2[$val->id]['payment_date'] = $val->payment_date;
			$array2[$val->id]['mode_of_payment'] = $val->mode_of_payment;
			$array2[$val->id]['payment_type'] = $val->payment_type;			
			$array2[$val->id]['payment_type_opt'] = $val->payment_type_opt;		
			
			$array2[$val->id]['amount'] = $val->amount;
			$array2[$val->id]['cash_type'] = $val->cash_type;
			$array2[$val->id]['pay_voucher_no'] = $val->pay_voucher_no;
			$array2[$val->id]['created_at'] = $val->created_at;
		}
		$payments = json_decode(json_encode($array2));
		//echo "<pre>"; print_r($payments);exit;
        return view('pages.superadmin.customerprofile')->with([
			'users'=>$users,
			'payments'=>$payments,
			'payments_pagination'=>$payments_pagination,
        ]);
    }
}
