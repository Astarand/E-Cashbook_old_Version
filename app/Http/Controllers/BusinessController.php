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
use Illuminate\Support\Carbon;


class BusinessController extends Controller
{   
    
    public function BusinessCA($CaId){
        
        $caId = base64_decode($CaId);

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
			
			$customerNo = DB::table('users')
                        ->where('status', '=', 1)
                        ->where('ca_add_by', '=', $caId)
                        ->where('u_type', '=', 2)
                        ->count();
			$array['company_attach'] = $customerNo;
			
			$states = State::where('country_id', '=', ($val->comp_bill_country !="")?$val->comp_bill_country:0)->get();
			$cities = City::where('state_id', '=', ($val->comp_bill_state !="")?$val->comp_bill_state:0)->get();
			$array['state'] = isset($states[0]->name)?$states[0]->name:"";
			$array['city'] = isset($cities[0]->name)?$cities[0]->name:"";
			$array['comp_bill_pin'] = ($val->comp_bill_pin !="")?$val->comp_bill_pin:"";
			$array['ca_spec'] = ($val->ca_spec !="")?$val->ca_spec:"";
			$array['status'] = $val->status;
			$array['created_at'] = $val->created_at;
		}
		
		//echo "<pre>"; print_r($users);exit;
		
		$customers = DB::table('users')
                    ->select('users.*', 'ca_profiles.*', 'subscribers.*', 'plans.*', 'company_profiles.comp_name')
                    ->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
                    ->leftJoin('subscribers', 'users.id', '=', 'subscribers.uid')
                    ->leftJoin('plans', 'subscribers.pid', '=', 'plans.id')
                    ->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
                    ->where('users.ca_add_by', '=', $caId)
                    ->where('users.status', '=', 1)
                    ->where('subscribers.status', '=', 1)   
                    ->orderBy('users.id', 'DESC')
                    ->paginate(10);		
		
		$customers_pagination = $customers;

        //--------- calciate the total commision ----------

        $totalCommission = 0;

        foreach ($customers->items() as $customer) {
            $paidAmount = $customer->paid_amount;
            $commission = $paidAmount * 0.10; // 10% commission

            $totalCommission += $commission;
        }
        $array['totalCommission'] = $totalCommission;
        

        // echo '<pre>';
        // print_r($customers);
        //exit;
        
        // return view('pages.superadmin.business_ca');
        $users = json_decode(json_encode($array));
        return view('pages.superadmin.business_ca')->with([
			'users'=>$users,
			'customers'=>$customers,
			'customers_pagination' => $customers_pagination
        ]);

    }
    public function EarningIndex()
    {
      // echo('Hello');exit;
        
        // $currentWeekStartDate = now()->startOfWeek()->toDateString();
        // $currentWeekEndDate = now()->endOfWeek()->toDateString();

        // // Calculate previous week's start and end dates
        // $previousWeekStartDate = now()->startOfWeek()->subWeek()->toDateString();
        // $previousWeekEndDate = now()->endOfWeek()->subWeek()->toDateString();

        // // Retrieve sales data for the current week
        // $currentWeekSalesData = DB::table('sales')
        //     ->where('status', 1)
        //     ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
        //     ->get();

        // // Calculate total amount for the current week
        // $currentWeekTotalAmount = $currentWeekSalesData->sum('total_amt');

        // // Retrieve sales data for the previous week
        // $previousWeekSalesData = DB::table('sales')
        //     ->where('status', 1)
        //     ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
        //     ->get();

        // // Calculate total amount for the previous week
        // $previousWeekTotalAmount = $previousWeekSalesData->sum('total_amt');

        // // Calculate percentage difference
        // $percentageDifference = 0;
        // if ($previousWeekTotalAmount != 0) {
        //     $percentageDifference = (($currentWeekTotalAmount - $previousWeekTotalAmount) / $previousWeekTotalAmount) * 100;
        // }

        // if ($percentageDifference > 0) {
        //     $percentageDifference = '+' . number_format($percentageDifference, 2) . '%';
        // } elseif ($percentageDifference < 0) {
        //     $percentageDifference = '-'.number_format(abs($percentageDifference), 2) . '%';
        // }
        

        // $salesData = DB::table('sales')
        //                         ->where('status', 1)
        //                         ->get();
        //                 $totalInvoices = count($salesData);
        //                 $totalAmount = $salesData->sum('total_amt');

        // $totalCustomer = DB::table('customers')->where('status', 1)->count();

        // //--------------- Customers -------------

        // $currentWeekCustomerData = DB::table('customers')
        //                         ->where('status', 1)
        //                         ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
        //                         ->get()
        //                         ->count();
        
                                
                                
        // $previousWeekcustomersData = DB::table('customers')
        //                         ->where('status', 1)
        //                         ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
        //                         ->get()
        //                         ->count();
        

        // // Calculate percentage difference
        // $percentageDifferenceCustomer = 0;
        // if ($previousWeekcustomersData != 0) {
        //     $percentageDifferenceCustomer = (($currentWeekCustomerData - $previousWeekcustomersData) / $previousWeekcustomersData) * 100;
        // }

        
        // if ($percentageDifferenceCustomer > 0) {
        //     $percentageDifferenceCustomer = '+' . number_format($percentageDifferenceCustomer, 2) . '%';
        // } elseif ($percentageDifferenceCustomer < 0) {
        //     $percentageDifferenceCustomer = '-'.number_format(abs($percentageDifferenceCustomer), 2) . '%';
        // }

        // //--------- Invoice -------------
        // $currentWeekInvoice  = $currentWeekSalesData->count();
        // $previousWeekInvoice = $previousWeekSalesData->count();
        // // Calculate percentage difference
        // $percentageDifferenceInvoive = 0;
        // if ($previousWeekInvoice != 0) {
        //     $percentageDifferenceInvoive = (($currentWeekInvoice - $previousWeekInvoice) / $previousWeekInvoice) * 100;
        // }

        
        // if ($percentageDifferenceInvoive > 0) {
        //     $percentageDifferenceInvoive = '+' . number_format($percentageDifferenceInvoive, 2) . '%';
        // } elseif ($percentageDifferenceInvoive < 0) {
        //     $percentageDifferenceInvoive = '-'.number_format(abs($percentageDifferenceInvoive), 2) . '%';
        // }
        
        
        //return view('pages.superadmin.business', compact('totalAmount', 'totalInvoices', 'totalCustomer', 'percentageDifference', 'percentageDifferenceCustomer', "percentageDifferenceInvoive"));
        return view('pages.superadmin.business');
    }

    public function getBusinessEarning(Request $request)
    {
        

        $userId = Auth::user()->id;
        // $userType = $request->input('customer');
        if (Auth::user()->u_type == 3) {
            $users = array();
            $customers = array();
            

            $users = User::where('status', 1)
                        ->whereIn('u_type', [1, 2])
                        ->get();

                $customers = [];

                foreach ($users as $user) {
                    $subscriber = DB::table('subscribers')
                        ->where('uid', $user->id)
                        ->where('status', '1')
                        ->latest('created_at')
                        ->first();

                        if ($subscriber && !empty($subscriber->id) && !empty($subscriber->paid_amount)) {
                            $plan_id = $subscriber->pid;

                            $plan_data = DB::table('plans')
                                    ->where('id', $plan_id)
                                    ->first();
                                    
                            $customers[] = [
                                'id' => $subscriber->id,
                                'paid_amount' => $subscriber->paid_amount,
                                'start_at' => $subscriber->start_at,
                                'end_at' => $subscriber->end_at,
                                'transaction_id' => $subscriber->transaction_id,
                                'merchantTransactionId' => $subscriber->merchantTransactionId,
                                'user_id' => $user->id,
                                'company_name' => $user->company_name,
                                'package_name' => $plan_data->plan_name,
                                'subscription_type' => $plan_data->plan_type,
                            ];
                        }
                }

            $subData = json_decode(json_encode($customers));
        }
        
        return response()->json($customers);
        
    }

    public function getCaFirm(Request $request){
        $userId = Auth::user()->id;
        // $userType = $request->input('customer');
        if (Auth::user()->u_type == 3) {
            $users = array();
            $customers = array();
            

            $users = User::where('status', 1)
                        // ->where('status', 1)
                        ->whereIn('u_type', [1])
                        ->get();

                $customers = [];

                foreach ($users as $user) {
                    //----- Total Company attached -------
                    $attach_company = User::where('status', 1)
                                    ->where('ca_add_by', $user->id)
                                    ->get();
                        $total_subscriber = 0;
                        $total_trial = 0; 
                        $total_amount = 0;
                        
                        foreach ($attach_company as $val) {
                            $subscriber = DB::table('subscribers')
                                            ->where('uid', $val->id)
                                            ->where('status', 1)
                                            ->latest()
                                            ->first();
                        
                            if ($subscriber !== null) { 
                                $tot_amount = $subscriber->paid_amount;

                                $commissionRate = 10; ///-------------- Commission Rate ----------
                                $total_amount = number_format($tot_amount * ($commissionRate / 100), 2);

                                $total_subscriber++;
                            } else {

                                $total_trial++;
                            }
                            
                        }   

                    
                    $customers[] = [
                        
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'company_attach' => count($attach_company),
                        'total_subscriber' => $total_subscriber,
                        'total_trial' => $total_trial,
                        'Commission' => $total_amount,
                        
                    ];
                }

            $subData = json_decode(json_encode($customers));
        }
        
        return response()->json($customers);
    }

    public function getCardData(Request $request){

        $currentWeekStartDate = now()->startOfWeek()->toDateString();
        $currentWeekEndDate = now()->endOfWeek()->toDateString();

        // Calculate previous week's start and end dates
        $previousWeekStartDate = now()->startOfWeek()->subWeek()->toDateString();
        $previousWeekEndDate = now()->endOfWeek()->subWeek()->toDateString();

        $startDate = $request->input('startDate');
        $endDate   = $request->input('endDate');

        //------------- Total Company ----------- 
        $company_data = DB::table('company_profiles')                    
                    ->whereBetween('created_at', [$startDate, $endDate]) 
                    ->get();
        $total_company = count($company_data);

        // Retrieve  data for the current week
        $currentWeekCompanyProfileData = DB::table('company_profiles')
                                        
                                        ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                        ->get();

        // Calculate total amount for the current week
        $currentWeekTotalCompanyProfile = count($currentWeekCompanyProfileData);

        // Retrieve  data for the previous week
        $previousWeekCompanyProfileData = DB::table('company_profiles')
                                        
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->get();

        // Calculate total amount for the previous week
        $previousWeekTotalCompanyProfile = count($previousWeekCompanyProfileData);

        // Calculate percentage difference
            $percentageDifferenceCompanyProfile = 0;
            if ($previousWeekTotalCompanyProfile != 0) {
                $percentageDifferenceCompanyProfile = (($currentWeekTotalCompanyProfile - $previousWeekTotalCompanyProfile) / $previousWeekTotalCompanyProfile) * 100;
            } elseif ($currentWeekTotalCompanyProfile != 0) {
                // If previous week's total is 0 but current week's total is not, consider it a 100% increase
                $percentageDifferenceCompanyProfile = 100;
            }

            // Format the percentage difference
            if ($percentageDifferenceCompanyProfile > 0) {
                $percentageDifferenceCompanyProfile = '+' . number_format($percentageDifferenceCompanyProfile, 2) . '%';
            } elseif ($percentageDifferenceCompanyProfile < 0) {
                $percentageDifferenceCompanyProfile = '-'.number_format(abs($percentageDifferenceCompanyProfile), 2) . '%';
            }
        
        

        //------------------ Total Ca -------------------
        $ca_data = DB::table('users')
                    ->where('status', 1)
                    ->where('u_type', 1)
                    ->whereBetween('created_at', [$startDate, $endDate]) 
                    ->get();

        $total_ca = count($ca_data); 

        // Retrieve  data for the current week
        $currentWeekCompanyUser = DB::table('users')
                                    ->where('status', 1)
                                    ->where('u_type', 1)    
                                    ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                    ->get();

        // Calculate total amount for the current week
        $currentWeekTotalCaUsers = count($currentWeekCompanyUser);

        // Retrieve  data for the previous week
        $previousWeekUsers = DB::table('users')
                                        ->where('status', 1)
                                        ->where('u_type', 1)
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->get();

        // Calculate total amount for the previous week
        $previousWeekTotalUsers = count($previousWeekUsers);
        $percentageDifferenceUsers = $this->difference_calculation($previousWeekTotalUsers, $currentWeekTotalCaUsers);


        
        
        //---------------------- Total Direct Attached -------------

        $direct_atta = DB::table('users')
                        ->where('status', 1)
                        ->where('u_type', 2)
                        ->where('ca_add_by', 0)
                        ->whereBetween('created_at', [$startDate, $endDate]) 
                        ->get();

        $total_direct_attached = count($direct_atta); 

        // Retrieve  data for the current week
        $currentWeekDirectAttached = DB::table('users')
                                        ->where('status', 1)
                                        ->where('u_type', 2)
                                        ->where('ca_add_by', 0)
                                        ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                        ->get();

        // Calculate total amount for the current week
        $currentWeekTotalDirectAttached = count($currentWeekDirectAttached);

        // Retrieve  data for the previous week
        $previousWeekDirectAttached = DB::table('users')
                                        ->where('status', 1)
                                        ->where('u_type', 2)
                                        ->where('ca_add_by', 0)
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->get();

        // Calculate total amount for the previous week
        $previousWeekTotalDirectAttached = count($previousWeekDirectAttached);

        $percentageDifferenceDirectAttached = $this->difference_calculation($previousWeekTotalDirectAttached, $currentWeekTotalDirectAttached);

        

        
        
        
        
        //----------- Total attached by ca ------- 

        $added_ca = DB::table('users')
                        ->where('status', 1)
                        
                        ->whereNotIn('ca_add_by', [0])
                        ->whereBetween('created_at', [$startDate, $endDate]) 
                        ->get();

        $total_added_ca = count($added_ca);

        // Retrieve  data for the current week
        $currentWeekAttachedCa = DB::table('users')
                                        ->where('status', 1)
                                        ->whereNotIn('ca_add_by', [0])
                                        ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                        ->get();

        // Calculate total amount for the current week
        $currentWeekAttachedCa = count($currentWeekAttachedCa);

        // Retrieve  data for the previous week
        $previousWeekAttachedCa = DB::table('users')
                                        ->where('status', 1)
                                        ->whereNotIn('ca_add_by', [0])
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->get();

        // Calculate total amount for the previous week
        $previousWeekAttachedCa = count($previousWeekAttachedCa);

        $percentageDifferentAttachedCa = $this->difference_calculation($previousWeekAttachedCa, $currentWeekAttachedCa);

        


        
        //-------------------------- Total subscriber -----------

        $subscribers = DB::table('subscribers')
                    ->where('status', 1)
                    ->whereBetween('created_at', [$startDate, $endDate]) 
                    ->get();
        $total_subscribers = count($subscribers); 
        // Retrieve  data for the current week
        $currentWeekSubscribers = DB::table('subscribers')
                                    ->where('status', 1)
                                    ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                    ->get();

        // Calculate total amount for the current week
        $currentWeekSubscriber = count($currentWeekSubscribers);

        // Retrieve  data for the previous week
        $previousWeekSubscribers = DB::table('subscribers')
                                        ->where('status', 1)
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->get();

        // Calculate total amount for the previous week
        $previousWeekSubscriber = count($previousWeekSubscribers);

        $percentageDiffercenceSubscriber = $this->difference_calculation($previousWeekSubscriber, $currentWeekSubscriber);

        //--------------------- Total Trial User -----------

        $trial_user = DB::table('subscribers')
                    ->where('status', 0)
                    ->whereBetween('created_at', [$startDate, $endDate]) 
                    ->get();
        $total_trial_user = count($trial_user); 

        // Retrieve  data for the current week
        $currentWeekTrialUser = DB::table('subscribers')
                                    ->where('status', 0)
                                    ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                    ->get();

        // Calculate total amount for the current week
        $currentWeekTrialUser = count($currentWeekTrialUser);

        // Retrieve  data for the previous week
        $previousWeekTrialUser = DB::table('subscribers')
                                        ->where('status', 0)
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->get();

        // Calculate total amount for the previous week
        $previousWeekTrialUser = count($previousWeekTrialUser);

        $percentageDiffercenceTrialUser = $this->difference_calculation($previousWeekTrialUser, $currentWeekTrialUser);

        //---------------------- Total Erning -----------------

        $totalEarning = $subscribers->sum('paid_amount'); 
        $totalEarningCurrent = $currentWeekSubscribers->sum('paid_amount');  // Current Week Calcualtion
        $totalEarningPrevoius = $previousWeekSubscribers->sum('paid_amount');  //  Previous week Calculation

        $percentageDiffercenceTotalEarning = $this->difference_calculation($totalEarningPrevoius, $totalEarningCurrent);

        //------------ Ca Earning And NetAmount ------------
        $totalNetAmount = 0;
        $totalCaEarning = 0; 
        foreach ($subscribers as $subscriber) {
            if ($subscriber->utype == 1) {
                $totalCaEarning += $subscriber->paid_amount;
            }

            
            $discountPercentage = 10;
            $totalNetAmount += $subscriber->paid_amount - (($subscriber->paid_amount * $discountPercentage) / 100); 
        }

            // Fetch total net amount for the current week
            $currentWeekTotalNetAmount = DB::table('subscribers')
                                        ->where('utype', 1)
                                        ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                        ->sum(DB::raw('paid_amount - (paid_amount * 10 / 100)'));

            // Fetch total net amount for the previous week
            $previousWeekTotalNetAmount = DB::table('subscribers')
                                        ->where('utype', 1)
                                        ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                        ->sum(DB::raw('paid_amount - (paid_amount * 10 / 100)'));

            $percentageDiffercenceNetProfit = $this->difference_calculation($previousWeekTotalNetAmount, $currentWeekTotalNetAmount); //--------Net Profit -------

            // Fetch total CA earning for the current week
            $currentWeekTotalCaEarning = DB::table('subscribers')
                                ->where('utype', 1)
                                ->whereBetween('created_at', [$currentWeekStartDate, $currentWeekEndDate])
                                ->sum('paid_amount');

            // Fetch total CA earning for the previous week
            $previousWeekTotalCaEarning = DB::table('subscribers')
                                ->where('utype', 1)
                                ->whereBetween('created_at', [$previousWeekStartDate, $previousWeekEndDate])
                                ->sum('paid_amount');
            $percentageDiffercenceCaEarning = $this->difference_calculation($previousWeekTotalCaEarning, $currentWeekTotalCaEarning); //--------ca Earninga -------
        
        

        $responseData = [
            'total_company' => $total_company,
            'total_ca' => $total_ca,
            'total_direct_attached' => $total_direct_attached,
            'total_added_ca' => $total_added_ca,
            'total_subscribers' => $total_subscribers,
            'total_trial_user' => $total_trial_user,
            'total_Net_Amount' => number_format($totalNetAmount,2),
            'total_Ca_Earning' => $totalCaEarning,
            'total_Earning' => $totalEarning,
            'percentageDifferenceCompanyProfile' => $percentageDifferenceCompanyProfile,
            'percentageDifferenceUsers_ca' => $percentageDifferenceUsers,
            'percentageDifferenceDirectAttached' => $percentageDifferenceDirectAttached,
            'percentageDifferentAttachedCa' => $percentageDifferentAttachedCa,
            'percentageDiffercenceSubscriber' => $percentageDiffercenceSubscriber,
            'percentageDiffercenceTrialUser' => $percentageDiffercenceTrialUser,
            'percentageDiffercenceTotalEarning' => $percentageDiffercenceTotalEarning,
            'percentageDiffercenceNetProfit' => $percentageDiffercenceNetProfit,
            'percentageDiffercenceCaEarning' => $percentageDiffercenceCaEarning,
        ];
    
        // Return the data as a JSON response
        return response()->json($responseData);

        
    }

    public function difference_calculation($previousWeekTotalDirectAttached, $currentWeekTotalDirectAttached){
        // Calculate percentage difference
        $percentageDifferenceDirectAttached = 0;
        if ($previousWeekTotalDirectAttached != 0) {
            $percentageDifferenceDirectAttached = (($currentWeekTotalDirectAttached - $previousWeekTotalDirectAttached) / $previousWeekTotalDirectAttached) * 100;
        } elseif ($currentWeekTotalDirectAttached != 0) {
            // If previous week's total is 0 but current week's total is not, consider it a 100% increase
            $percentageDifferenceDirectAttached = 100;
        }

        // Format the percentage difference
        if ($percentageDifferenceDirectAttached > 0) {
            $percentageDifferenceDirectAttached = '+' . number_format($percentageDifferenceDirectAttached, 2) . '%';
        } elseif ($percentageDifferenceDirectAttached < 0) {
            $percentageDifferenceDirectAttached = '-'.number_format(abs($percentageDifferenceDirectAttached), 2) . '%';
        }
        return $percentageDifferenceDirectAttached;

    }
}
