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
use App\Plans;
use App\Subscribers;
use Helper;
use Image;
use Session;
use Illuminate\Support\Facades\Cookie;
//use Ixudra\Curl\Facades\Curl;

class SubscriptionBuyController extends Controller
{
    public function index($planId)
    {
		$title = 'Buy Subcription';
		$planId = base64_decode($planId);
		$plans = DB::table('plans')
					->select(DB::raw('plans.id,plans.plan_name,plans.plan_type,plans.monthly_price,plans.yearly_price,plans.plan_title,plans.plan_desc,plans.plan_included'))
					->where('plans.id', '=', $planId)
					->where('plans.isactive', '=', 1)
					->get();
		
		$array = array();
		foreach($plans as $k=>$val)
		{
			$array['id'] = $val->id;
			$array['plan_name'] = $val->plan_name;
			$array['plan_type'] = $val->plan_type;
			$array['amount'] = ($val->monthly_price !=0)?$val->monthly_price:$val->yearly_price;
			$array['plan_title'] = $val->plan_title;
			$array['plan_desc'] = $val->plan_desc;	
			$array['plan_included'] = $val->plan_included;	
		}
		
		$plans = json_decode(json_encode($array));
		//echo "<pre>"; print_r($plans);exit;
		
		return view('pages.payment.payment-form')->with([
			'title' =>$title,
			'plans'=>$plans,
		]);
        
    }
	
	// PhonePe Integration
    public function submitPaymentForm(Request $request)
    {
        $userId = Auth::user()->id;
		$u_type = Auth::user()->u_type;
		$pid = $request->input('pid');
		//user data
		$users =  DB::table('users')
							->select(DB::raw('users.name,users.email,users.phone'))
							->where('users.id', '=', $userId)
							->get();
		$name = $users[0]->name;
		$email = $users[0]->email;
		$phone = $users[0]->phone;
		//plans data
		$planData = DB::table('plans')
								->select(DB::raw('plans.plan_type,plans.monthly_price,plans.yearly_price'))
								->where('plans.id', '=', $pid)
								->where('plans.isactive', '=', 1)
								->get();
		$amount = ($planData[0]->monthly_price !=0)?$planData[0]->monthly_price:$planData[0]->yearly_price;
		
		if($planData[0]->plan_type =="Monthly"){
			$start_at = date("Y-m-d");
			$end_at = date('Y-m-d', strtotime($start_at. ' + 30 days'));
		}else if($planData[0]->plan_type =="Yearly"){
			$start_at = date("Y-m-d");
			$end_at = date('Y-m-d', strtotime($start_at. ' + 365 days'));
		}
		
        $request->validate([
            'amount'=>'required'
        ],[
            'amount'=>'Amount is Required'
        ]);
		
		//custom logic
		$maxid = DB::table('subscribers')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$maxid = isset($maxid[0]->id)?$maxid[0]->id:0;
		$order_id = Helper::invoice_num($maxid+1,7,"");		
		$uatMode = env('UAT_MODE');
		if($uatMode)
		{
			$payUrl = env('UAT_URL').'pay';
			$merchantId = env('merchantId_UAT');
			$saltKey = env('saltKey_UAT');
		}
		else
		{
			$payUrl = env('PROD_URL').'pay';
			$merchantId = env('merchantId_PROD');
			$saltKey = env('saltKey_PROD');
		}
 
        $data = array (
          'merchantId' => $merchantId,
          'merchantTransactionId' => $order_id, //'MT7850590068188103',
          'merchantUserId' => 'MUID'.$userId,
          'amount' => $amount*100,
          'redirectUrl' => route('phonepe-callback'),
          'redirectMode' => 'POST',
          'callbackUrl' => route('phonepe-callback'),
          'mobileNumber' => $phone, //'9999999999',
		  'message'=>"payment for subscription",
		  'email'=>$email,
		  'shortName'=>$name,
          'paymentInstrument' => 
          array (
            'type' => 'PAY_PAGE',
          ),
        );

        $encode = base64_encode(json_encode($data));
        $saltIndex = 1;
        $string = $encode.'/pg/v1/pay'.$saltKey;
        $sha256 = hash('sha256',$string);
        $finalXHeader = $sha256.'###'.$saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $payUrl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'X-VERIFY: '.$finalXHeader
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);
		
		$subscribersData = [
			'uid' => $userId,
			'utype' => $u_type,
			'pid' => $pid,
			'paid_amount' => $amount,
			'start_at' => $start_at,
			'end_at' => $end_at,
			'merchantTransactionId' => $order_id,
			'payment_status' => 'PAYMENT_PENDING',
			'response_msg'=>$response,
			'providerReferenceId'=>'',
			'merchantOrderId'=>'',
			'checksum'=>''
		];
		Subscribers::create($subscribersData);

        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);

    }

    public function callback(Request $request)
    {
		$uatMode = env('UAT_MODE');
		if($uatMode)
		{
			$url = env('UAT_URL');
			$saltKey = env('saltKey_UAT');
		}else{
			$url = env('PROD_URL');
			$saltKey = env('saltKey_PROD');
		}
        $input = $request->all();
        $saltIndex = 1;
		//echo "<pre>";print_r($input);exit;
        $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url.'status/'.$input['merchantId'].'/'.$input['transactionId'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'accept: application/json',
            'X-VERIFY: '.$finalXHeader,
            'X-MERCHANT-ID: '.$input['merchantId']
            //'X-MERCHANT-ID: '.$input['transactionId']
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        //dd(json_decode($response));
		$response = json_decode($response);
		//echo "<pre>";print_r($response);
		if($response->code == 'PAYMENT_SUCCESS')
		{
			$responseData = $response->data;
			$merchantId =	$responseData->merchantId;
			$merchantTransactionId = $responseData->merchantTransactionId;			
			$transactionId = $responseData->transactionId;			
			$merchantOrderId =	isset($responseData->merchantOrderId)?$responseData->merchantOrderId:"";			
			$providerReferenceId =	isset($responseData->providerReferenceId)?$responseData->providerReferenceId:"";
			//$checksum =	$responseData->checksum;
			$paymentInstrument = json_encode($responseData->paymentInstrument);
			$payment_status =	$responseData->responseCode;
			$amount=($responseData->amount/100);
			if($responseData->state == "COMPLETED"){
				$status=1;
			}else{
				$status=0;
			}
		   
		   //Transaction completed, You can add transaction details into database
	 
	 
		   $data = [
				'transaction_id' => $transactionId,
				'providerReferenceId' => $providerReferenceId,
				'paymentInstrument' => $paymentInstrument,
				'payment_status' => $payment_status,
				'status' => $status,
			];
			if($merchantOrderId !=''){
				$data['merchantOrderId']=$merchantOrderId;
			}
			//echo "<pre>";print_r($data);
			Subscribers::where('merchantTransactionId', $merchantTransactionId)->update($data); 
			 
			//return view('confirm_payment',compact('providerReferenceId', 'transactionId'));
			Session::flash('amount', $amount); 
			Session::flash('merchantTransactionId', $merchantTransactionId); 
			Session::flash('transactionId', $transactionId); 
			Session::flash('providerReferenceId', $providerReferenceId); 
			return redirect()->route( 'payment-success' )->with( [ 'amount' => $amount,'transactionId' => $transactionId,'providerReferenceId' => $providerReferenceId, ] );
			
	 
		}else{
			//HANDLE YOUR ERROR MESSAGE HERE
			//dd('ERROR : ' .$request->code. ', Please Try Again Later.');
			Session::flash('amount', 0); 
			Session::flash('merchantTransactionId', "");
			Session::flash('transactionId', ""); 
			Session::flash('providerReferenceId', ""); 
			return redirect()->route( 'payment-error' )->with( [ 'amount' => 0,'transactionId' => "",'providerReferenceId' => "", ] );
			
		} 
       
    }
	
	public function payment_success()
    {
		$title = 'Payment success';		
		return view('pages.payment.payment-success')->with([
			'title' =>$title,
		]);
        
    }
	
	public function payment_error()
    {
		$title = 'Payment failed';		
		return view('pages.payment.payment-error')->with([
			'title' =>$title,
		]);
        
    }
    
}
