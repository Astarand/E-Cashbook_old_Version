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


class PaymentManagementController extends Controller
{
    public function PaymentManagementIndex()
    {
        return view('pages.superadmin.payment-index');
    }
    public function PaymentManagementCA($CaId)
    {   
        $caId = base64_decode($CaId);
        $ca_user = DB::table('users')
                        ->where('id', $caId)
                        ->where('status', 1)
                        ->get();
        $company_attached = DB::table('users')
                            ->where('ca_add_by', $ca_user[0]->id)
                            ->where('status', 1)
                            ->get();

        $com_name = DB::table('company_profiles')
                            ->where('userId', $CaId)
                            ->first();

                if ($com_name && isset($com_name->comp_name)) {
                    $comp_name = $com_name->comp_name;
                } else {
                    $comp_name = $ca_user[0]->name;
                }
        
        //-------- Total Earning ------------- 
        $users = DB::table('users')
                            ->where('ca_add_by', $caId)
                            ->where('status', 1)
                            ->pluck('id'); 

                    
                    $idsString = implode(',', $users->toArray());
                    // Fetch the sum of paid_amount and calculate total earnings
                    $result = DB::table('subscribers')
                            ->whereIn('uid', explode(',', $idsString)) 
                            ->where('status', 1) 
                            ->selectRaw('SUM(paid_amount) as total_paid_amount, SUM(paid_amount * 0.10) as total_commission') // Calculate sum of paid_amount and 10% commission
                            ->first(); 

                // Get the total earnings (sum of commission)
                $totalEarnings = $result->total_commission;

        //------****** Total Payout -------------
        $totalPayout = DB::table('payment_ca')
                                        
                    ->where('uid', $caId) 
                    ->where('status', 1) 
                    ->sum('payment_amount'); 

        $user_data = array(
            'id' => $ca_user[0]->id,
            'name' => $ca_user[0]->name,
            'company_name' => $comp_name,
            'email' => $ca_user[0]->email,
            'phone' => $ca_user[0]->phone,
            'company_count' => $company_attached->count(),
            'totalEarnings' => $totalEarnings,
            'totalPayout' => $totalPayout,
            'balance_amount' => $totalEarnings - $totalPayout,
            
        );

        $ca_payment_data = DB::table('payment_ca')
                            ->where('uid', $caId)
                            ->where('status', 1)
                            ->get();
        
        
        
        return view('pages.superadmin.payment-ca', compact('user_data', 'ca_payment_data'));
    }
    public function getca_transaction_data(Request $request){
        
        $userId = Auth::user()->id;
        // $userType = $request->input('customer');
        if (Auth::user()->u_type == 3) {
            
            $ca_customers = array();

            $customers = DB::table('users')
                        ->where('u_type', 1)
                        ->where('status', 1)
                        ->get();
            
                foreach($customers as $cus){
                    $totalEarnings = "";
                    $idsString = "";
                    $uid = $cus->id;

                    $users = DB::table('users')
                            ->where('ca_add_by', $uid)
                            ->where('status', 1)
                            ->pluck('id'); 

                    //-------- Total Earning -------------   
                    $idsString = implode(',', $users->toArray());
                    // Fetch the sum of paid_amount and calculate total earnings
                    $result = DB::table('subscribers')
                            ->whereIn('uid', explode(',', $idsString)) 
                            ->where('status', 1) 
                            ->selectRaw('SUM(paid_amount) as total_paid_amount, SUM(paid_amount * 0.10) as total_commission') // Calculate sum of paid_amount and 10% commission
                            ->first(); 

                // Get the total earnings (sum of commission)
                $totalEarnings = $result->total_commission;

                //------****** Total Payout -------------
                $totalPayout = DB::table('payment_ca')
                            
                            ->where('uid', $uid) 
                            ->where('status', 1) 
                            ->sum('payment_amount'); 

                    $latestPayment = DB::table('payment_ca')
                            ->where('uid', $uid)
                            ->latest('created_at')
                            ->first();
                        
                    $status = $latestPayment ? 'Payment Done' : 'Payment Not Success';



                    $ca_customers[] = [
                        'id' => $cus->id,
                        'name' => $cus->name,
                        'email' => $cus->email,
                        'idsString' => $idsString,
                        'total_earning' => number_format($totalEarnings, 2),
                        'total_payout' => number_format($totalPayout, 2),
                        'balance_amount' => number_format($totalEarnings - $totalPayout, 2),
                        'status' => $status,
                    ];
                }

            
        }
        
        return response()->json($ca_customers);
    }
    public function getcus_transaction_data(Request $request){
        // $customers = array();
        // $customers = DB::table('subscribers')
        //         ->where('utype', 2)
        //         ->leftJoin('users', 'subscribers.uid', '=', 'users.id')
        //         ->leftJoin('plans', 'subscribers.pid', '=', 'plans.id')
        //         ->select('subscribers.*', 'users.*', 'plans.*')
        //         ->get();
        
        // return response()->json($customers);

        $userId = Auth::user()->id;
        // $userType = $request->input('customer');
        if (Auth::user()->u_type == 3) {
            $users = array();
            $customers = array();
            

            $users = User::where('status', 1)
                        ->whereIn('u_type', [2])
                        ->get();

                $customers = [];

                foreach ($users as $user) {

                    $subscriber = DB::table('subscribers')
                                ->where('uid', $user->id)
                                ->where('status', '1')
                                ->latest('created_at')
                                ->first();

                        $com_name = DB::table('company_profiles')
                                ->where('userId', $user->id)
                                ->first();

                        if ($com_name && isset($com_name->comp_name)) {
                            $comp_name = $com_name->comp_name;
                        } else {
                            $comp_name = $user->name;
                        }
                                
                                

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
                                'payment_status' => ($subscriber->payment_status=='SUCCESS') ? 'Payment Done': 'Payment Not Success',
                                'user_id' => $user->id,
                                'company_name' => $comp_name,
                                'package_name' => $plan_data->plan_name,
                                'subscription_type' => $plan_data->plan_type,
                                'ca_add_by' => $user->ca_add_by,
                            ];
                        }
                }

            
        }
        
        return response()->json($customers);
    }

    public function payment_ca_data(Request $request){
        $uid = $request->input('uid');
        $customers = DB::table('users')
                        ->where('ca_add_by', $uid)
                        ->where('status', 1)
                        ->get()
                        ->toArray();
        // Extract 'id' from each item in the array
        $idArray = array_column($customers, 'id');

        // Convert the array of 'id' into comma-separated string
        $idString = implode(',', $idArray);
        

        $data = $request->only([
            'payment_date',
            'uid',
            'fortnight_for',
            'transaction_id',
            'payment_amount',
            'mode_of_payment',
            'account_holder_name',
            'account_number_UPI_ID',
            'bank_name',
            'remarks',
            'status',
        ]);
        $data['add_company_id'] = $idString;

        // Insert data into the database
        DB::table('payment_ca')->insert($data);
        return response()->json(['message' => 'Payment data saved successfully', 'data'=>$data]);
        
    
    }

    

    public function getcomp_tran_invoice($usId){
        
        $usId = base64_decode($usId);
        $query = DB::table('users')
            ->leftJoin('subscribers', 'users.id', '=', 'subscribers.uid')
            ->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
            ->leftJoin('plans', 'subscribers.pid', '=', 'plans.id')
            ->select(
                'users.*',
                'subscribers.*',
                'company_profiles.comp_name',
                'plans.*'
            )
            ->where('users.id', $usId)
            ->where('users.status', 1)
            ->where('subscribers.status', '1')
            ->latest('subscribers.created_at')
            ->first();
    
        
        $comp_name = $query->comp_name ?? $query->name;
    
        
        $response = [
            'user' => $query,
            'company_name' => $comp_name
        ];
    
        
        // $data = response()->json($response);
        $data = json_decode(json_encode($response));

        $pdf = \PDF::loadView('pages.superadmin.comp_tran_invoice', compact('data'))
			->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
			$pdfName = 'Sales-Inv.pdf';
			return $pdf->stream($pdfName);
    }
    
    
    
    
}

