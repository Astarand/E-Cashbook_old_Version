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
use App\Busi_agents;
use App\Ca_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;


class CommissionController extends Controller
{
    public function Index()
    {
        $title = 'Earning';
		$userId = Auth::user()->id;
        if(Auth::user()->u_type ==1){ //CA
			$earning =  DB::table('subscribers')
							->select(DB::raw('subscribers.*,company_profiles.comp_name,company_profiles.comp_email,plans.plan_name,plans.plan_type'))
							->leftJoin('company_profiles', 'subscribers.uid', '=', 'company_profiles.userId')
                            ->leftJoin('plans', 'subscribers.pid', '=', 'plans.id')
							->where('subscribers.uid', '=', $userId)
							->orderBy('subscribers.id', 'DESC')->paginate(10);
							
			
		}
        // echo "<pre>"; print_r($earning);exit;
		$earning_pagination = $earning;
        $array = array();
		foreach($earning as $k=>$val)
		{
			$array[$val->id]['id'] = $val->uid;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['comp_email'] = $val->comp_email;
			$array[$val->id]['paid_amount'] = $val->paid_amount;
            $array[$val->id]['plan_name'] = $val->plan_name;
            $array[$val->id]['plan_type'] = $val->plan_type;	
            $array[$val->id]['total_earning'] = ($val->paid_amount * 10/100);					
			$array[$val->id]['created_at'] = $val->created_at;
			$array[$val->id]['status'] = $val->status;
		}
		$earning = json_decode(json_encode($array));
       
       return view('pages.ca.commission')->with([
        'title' =>$title, 
        'earning' =>$earning,       
        'earning_pagination' =>$earning_pagination,
        ]); 
       
    }

    
    public function CommissonPayout()
    {
        return view('pages.ca.commission-payout');
    }

}

