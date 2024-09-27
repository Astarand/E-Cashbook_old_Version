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

class CaRequestController extends Controller
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
		$title = 'CA Requested';
		//$userId = Auth::user()->id;
		//$customers = DB::table('Customers')->where('userId', '=', $userId)->orderBy('id', 'DESC')->paginate(10);
		
		$ca_details = DB::table('ca_details')
					->select(DB::raw('ca_details.*,users.name'))
					->leftJoin('users', 'ca_details.uId', '=', 'users.id')
					->where('users.u_type','=',2)->orderBy('created_at','desc')->paginate(10);
		
		$ca_pagination = $ca_details;
		//echo "<pre>"; print_r($ca_details);exit;
		
		$array = array();
		foreach($ca_details as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['uId'] = $val->uId;
			$array[$val->id]['utype'] = $val->utype;
			$array[$val->id]['assign_ca_firm'] = $val->assign_ca_firm;
			$array[$val->id]['ca_name'] = $val->ca_name;
			$array[$val->id]['ca_email'] = $val->ca_email;
			$array[$val->id]['ca_phone'] = $val->ca_phone;
			$array[$val->id]['ca_addr_one'] = $val->ca_addr_one;
			$array[$val->id]['ca_addr_two'] = $val->ca_addr_two;
			$array[$val->id]['ca_pincode'] = $val->ca_pincode;
			
			$array[$val->id]['ca_status'] = $val->ca_status;
			$array[$val->id]['is_email'] = $val->is_email;
			$array[$val->id]['is_whatsapp'] = $val->is_whatsapp;
			$array[$val->id]['created_at'] = $val->created_at;

			$state = State::where('id', '=', isset($val->ca_state)?$val->ca_state:0)->get();
			$array[$val->id]['ca_state'] = $state[0]->name;
			
			$city = City::where('id', '=', isset($val->ca_city)?$val->ca_city:0)->get();
			$array[$val->id]['ca_city'] = $city[0]->name;
			
		}
		$ca_details = json_decode(json_encode($array));
		return view('pages.ca-request')->with([
			'title' =>$title,
			'ca_details'=>$ca_details,
			'ca_pagination' =>$ca_pagination,
		]); 
    }

	//Completed action
	public function completeStatus(Request $request)
    {
        $user = Ca_details::find($request->id);
        $user->ca_status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/ca-requested'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	public function isEmailStatus(Request $request)
    {
        $user = Ca_details::find($request->id);
        $user->is_email = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/ca-requested'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	public function isWhatsappStatus(Request $request)
    {
        $user = Ca_details::find($request->id);
        $user->is_whatsapp = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/ca-requested'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	public function get_ca_set_permission(Request $request)
    {
		
		$ca_details = DB::table('ca_details')
					->select(DB::raw('ca_details.ca_set_permission'))
					->where('ca_details.id','=',$request->id)->get();
		$ca_details = isset($ca_details[0]->ca_set_permission)?$ca_details[0]->ca_set_permission:"";
		$ca_details = explode(',', $ca_details);

		echo json_encode($ca_details); 
    }
	
}
