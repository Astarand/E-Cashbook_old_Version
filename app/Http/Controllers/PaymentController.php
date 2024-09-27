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
use App\Payments;
use App\Payment_cats;
use App\Payment_cat_options;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class PaymentController extends Controller
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
      $title = 'Payments';
		$custId = Auth::user()->id;
		//$payment = DB::table('payments')->where('custId', '=', $custId)->orderBy('id', 'DESC')->paginate(10);
	//	$payment_pagination = $payment;
        //$this->middleware('auth');

        $payment =  DB::table('payments')
							->select(DB::raw('payments.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'payments.custId', '=', 'company_profiles.userId')
							->where('payments.custId', '=', $custId)
							->orderBy('payments.id', 'DESC')->paginate(10);
              $payment_pagination = $payment;

              $array = array();
          foreach($payment as $k=>$val)
          {
            $array[$val->id]['id'] = $val->id;
            $array[$val->id]['payment_date'] = $val->payment_date;
            $array[$val->id]['pay_voucher_no'] = $val->pay_voucher_no;
            $array[$val->id]['purpose_of_payment'] = $val->purpose_of_payment;
            $array[$val->id]['mode_of_payment'] = $val->mode_of_payment;
            $array[$val->id]['payment_type'] = $val->payment_type;
            $array[$val->id]['amount'] = $val->amount;
            $array[$val->id]['message'] = $val->message;
            

          }
		    $payment = json_decode(json_encode($array));

        $monthWisePayment = Payments::select(
          DB::raw("DATE_FORMAT(payment_date, '%Y-%m') as 'month'"),
          DB::raw("(COUNT(*)) as count"),
          DB::raw("sum(amount) as amount"),
          DB::raw('payments.custId,company_profiles.userId')
        )->leftJoin('company_profiles', 'payments.custId', '=', 'company_profiles.userId')
          ->where('payments.custId', '=', $custId)
          ->orderBy('payment_date')
          ->groupBy(DB::raw("DATE_FORMAT(payment_date, '%m-%Y')"))
          ->get();


        return view('pages.payment')->with([

            'title' =>$title,
            'payment'=>$payment,
            'monthWisePayment'=>$monthWisePayment,
            'payment_pagination' =>$payment_pagination,

        ]);
    }
	
	public function getPaymentOptions(Request $request)
    {
		
		$id = $request->id; 
		$response = [];
		if($id !="")
		{
			$payCat = Payment_cats::query()
					->where('cat_name', '=', $id) 
					->get()->toArray();
			$result = Payment_cat_options::query()
					->where('cat_id', '=', $payCat[0]['id']) 
					->get()->toArray();
			
			//echo "<pre>";print_r($result);exit;
			 foreach($result as $row){
			   $response[] = array("id"=>$row['opt_val'], "name"=>$row['opt_val']);
			}
		}
		echo json_encode($response); 
    }

    public function addpayment()
    {
        //$this->middleware('auth');
		$userId = Auth::user()->id;
		$custData = DB::table('customers')
								->select(DB::raw('customers.id,customers.cust_name'))
								->where('customers.userId','=',$userId)
								->where('customers.status','=',1)
								->get();
		$payVoucherNo = DB::table('payments')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$payVoucherNo = isset($payVoucherNo[0]->id)?$payVoucherNo[0]->id:0;
		$payVoucherNo = Helper::invoice_num($payVoucherNo+1,7,"PV-");	
        return view('pages.addpayment')->with([
			'custData'=> $custData,
			'payVoucherNo'=>$payVoucherNo,
        ]);
    }

    protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		if($data['mode_of_payment'] == 'Cash'){
			$cash_type = "required";
		}else{
			$cash_type = "";
		}
        return Validator::make($data, [
          'payment_date' =>  'required',
          'purpose_of_payment' =>  'required',
          'mode_of_payment' =>  'required',
          'cash_type' =>  $cash_type,
          'customerId' =>  'required',
          'bankname' =>  'required',
          'pay_voucher_no' =>  'required',
          'common_narration' =>  'required',
          'payment_type' =>  'required',
          'payment_type_opt' =>  'required',
          'amount' =>  'required|numeric',
          'message' =>  'required'
        ]
		);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		$payVoucherNo = DB::table('payments')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$payVoucherNo = isset($payVoucherNo[0]->id)?$payVoucherNo[0]->id:0;
		$payVoucherNo = Helper::invoice_num($payVoucherNo+1,7,"PV-");
		
		if($data['mode_of_payment'] == 'Cash'){
			$cash_type = $data['cash_type'];
		}else{
			$cash_type = "";
		}
        return Payments::create([
            'custId' => Auth::user()->id,
            'payment_date' => $data['payment_date'],
            'purpose_of_payment' => $data['purpose_of_payment'],
            'mode_of_payment' => $data['mode_of_payment'],
            'cash_type' => $cash_type,
            'customerId' => $data['customerId'],
            'pay_voucher_no' => $payVoucherNo,
			'bankname' => $data['bankname'],
			'common_narration' => $data['common_narration'],
            'payment_type' => $data['payment_type'],
            'payment_type_opt' => $data['payment_type_opt'],
            'amount' => $data['amount'],
            'message' => $data['message'],
            
        ]);
    }

    public function savepayment(Request $request)  {  
            
      //echo "<pre>";print_r($request->all());exit;
          
          $validation = $this->validator($request->all());
              if ($validation->fails())  {  
                  return response()->json($validation->errors()->toArray());
              }
              else{
            $insertPayment = $this->create($request->all());
           
              if ($insertPayment){
                $msg = array(
                  'status' => 'success',
                  'class' => 'succ',
                  'redirect' => url('/payment'),
                  'message' => 'Payment details updated'
                );
                return response()->json($msg);	
              }
            
                $msg = array(
                  'status' => 'error',
                  'class' => 'err',
                  'redirect' => url('/'),
                  'message' => 'Please Enter all details for payment'
                );
                return response()->json($msg);	
             
           
        }
    }

    public function edit_payment($paymentId)  {  
        
	  if(Auth::user()->u_type ==1){
		return redirect('/payment');
	  }
	  $userId = Auth::user()->id;
	  $paymentId = base64_decode($paymentId);
	  $payment = DB::table('payments')
				  ->where('id', '=', $paymentId)
				  ->get();
	  $payment = $payment[0];
	  $payCat = Payment_cats::query()
					->where('cat_name', '=', $payment->payment_type) 
					->get()->toArray();
	  $paymentCatOpt = Payment_cat_options::query()
				->where('cat_id', '=', $payCat[0]['id']) 
				->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.id,customers.cust_name'))
								->where('customers.userId','=',$userId)
								->where('customers.status','=',1)
								->get();
	  return view('pages.edit-payment')->with([	
		'payment' => $payment,
		'paymentCatOpt' => $paymentCatOpt,
		'paymentId' => $paymentId,
		'custData' => $custData
	  ]); 
	  }

      public function update_payment(Request $request)  {  
            
        //echo "<pre>";print_r($request->all());exit;
        $payId = $request->payId;
        
        $validation = $this->validator($request->all());
            if ($validation->fails())  {  
                return response()->json($validation->errors()->toArray());
            }
            else{
				
				if($request->mode_of_payment == 'Cash'){
					$cash_type = $request->cash_type;
				}else{
					$cash_type = "";
				}
          $update = DB::table('payments')
              ->where('id', $payId)
              ->update(
                 array(
                    'custId' => Auth::user()->id,
                    'payment_date' => $request->payment_date,
                    'purpose_of_payment' => $request->purpose_of_payment,
                    'mode_of_payment' => $request->mode_of_payment,
					
					'cash_type' => $cash_type,
					'customerId' => $request->customerId,
					'pay_voucher_no' => $request->pay_voucher_no,
					'bankname' => $request->bankname,
					'common_narration' => $request->common_narration,
					
                    'payment_type' => $request->payment_type,
                    'payment_type_opt' => $request->payment_type_opt,
                    'amount' => $request->amount,
                    'message' => $request->message,
                 )
              );
             
          $msg = array(
            'status' => 'success',
            'class' => 'succ',
            'redirect' => url('/payment'),
            'message' => 'Record updated successfully'
          );
          return response()->json($msg);
          //end update item
          
        }	
        }

        public function delPayment(Request $request)
          {
            //echo "<pre>";print_r($request);exit;
              $delPayment = DB::table('payments')->where('id', $request->id)->delete();
            if($delPayment){
              $msg = array(
                'status' => 'success',
                'class' => 'succ',
                'redirect' => url('/payment'),
                'message' => 'Record deleted successfully.'
              );
              return response()->json($msg);
            }else{
              $msg = array(
                'status' => 'error',
                'class' => 'err',
                'redirect' => url('/payment'),
                'message' => 'Delete action failed!'
              );
              return response()->json($msg);
            }
        }
    
      public function view_payment($paymentId)  {  
        
		$userId = Auth::user()->id;
        $paymentId = base64_decode($paymentId);
        $payment = DB::table('payments')
                    ->where('id', '=', $paymentId)
                    ->get();
        $payment = $payment[0];
        
		$payCat = Payment_cats::query()
					->where('cat_name', '=', $payment->payment_type) 
					->get()->toArray();
		$paymentCatOpt = Payment_cat_options::query()
				->where('cat_id', '=', $payCat[0]['id']) 
				->get();
        $custData = DB::table('customers')
								->select(DB::raw('customers.id,customers.cust_name'))
								->where('customers.userId','=',$userId)
								->where('customers.status','=',1)
								->get();
        
        return view('pages.view-payment')->with([	
          'payment' => $payment,     
		  'paymentCatOpt' => $paymentCatOpt,
          'paymentId' => $paymentId,
          'custData' => $custData,
        ]); 
        }


  public function viewmonthpayment($monthWise,$custId)
    {
		$monthWise = base64_decode($monthWise);
		$custId = base64_decode($custId);
		$monthWise = explode("-",$monthWise);
		$year = $monthWise[0];
		$month = $monthWise[1];
		
		$title = 'Monthly Payment';
		$custId = Auth::user()->id;
		
			$payment =  DB::table('payments')
							->select(DB::raw('payments.*,company_profiles.userId'))
							->leftJoin('company_profiles', 'payments.custId', '=', 'company_profiles.userId')
							->where('payments.custId','=',$custId)
							->whereYear('payment_date', '=', $year)
							->whereMonth('payment_date', '=', $month)
							->orderBy('payments.id', 'DESC')->paginate(10);
		
		$payment_pagination = $payment;
		
		$array = array();
    foreach($payment as $k=>$val)
    {
      $array[$val->id]['id'] = $val->id;
      $array[$val->id]['payment_date'] = $val->payment_date;
      $array[$val->id]['purpose_of_payment'] = $val->purpose_of_payment;
      $array[$val->id]['mode_of_payment'] = $val->mode_of_payment;
      $array[$val->id]['payment_type'] = $val->payment_type;
      $array[$val->id]['amount'] = $val->amount;
      $array[$val->id]['message'] = $val->message;
      

    }
    $payment = json_decode(json_encode($array));
		
		return view('pages.viewmonthpayment')->with([
			'title' =>$title,
			'payment'=>$payment,
			'payment_pagination' =>$payment_pagination,
		]); 
    }
    

}
