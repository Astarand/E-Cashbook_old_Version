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
use App\Loans;
use App\Banks;
use App\Bank_trans;
use App\Loan_ins;
use App\Cash_credit_debits;
use App\Cash_hands;
use App\Bank_statements;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CashController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
	public function BankIndex()
    {
		//$this->middleware('auth');
		$title = 'Banks';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$banks =  DB::table('banks')
							->select(DB::raw('banks.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'banks.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'banks.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$banks =  DB::table('banks')
							->select(DB::raw('banks.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'banks.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'banks.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$banks =  DB::table('banks')
							->select(DB::raw('banks.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'banks.added_by', '=', 'company_profiles.userId')
							->where('banks.added_by', '=', $userId)
							->orderBy('banks.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$banks =  DB::table('banks')
							->select(DB::raw('banks.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'banks.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$banks_pagination = $banks;
		
		$array = array();
		foreach($banks as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['bank_name'] = $val->bank_name;
			$array[$val->id]['bank_branch'] = $val->bank_branch;
			$array[$val->id]['accholder_name'] = $val->accholder_name;
			$array[$val->id]['bank_ac_no'] = $val->bank_ac_no;
			$array[$val->id]['ifsc_code'] = $val->ifsc_code;
			$array[$val->id]['swift_code'] = $val->swift_code;
			$array[$val->id]['upi_id'] = $val->upi_id;
			$array[$val->id]['curr_bal'] = $val->curr_bal;			
			$array[$val->id]['status'] = $val->status;

			$totalTransaction =  DB::table('bank_trans')
							->select(DB::raw('SUM(bank_trans.tran_amt) as totalTransaction'))
							->where('bankId', '=', $val->id)
							->get();

			$cashLimit = ($val->curr_bal);
			$totalTransaction = ($totalTransaction[0]->totalTransaction);
			$outstanding = ($cashLimit - $totalTransaction);
			$availableLimit = ($cashLimit - $outstanding);
			
			$array[$val->id]['outstanding'] = $outstanding;
			$array[$val->id]['availableLimit'] = $availableLimit;

			
		}
		$banks = json_decode(json_encode($array));
		return view('pages.banks')->with([
			'title' =>$title,
			'banks'=>$banks,
			'banks_pagination' =>$banks_pagination
			

		]);
    }

	protected function validatorBank(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'bank_name' => 'required',
				'bank_branch' => 'required',
				'accholder_name' => 'required',
				'bank_ac_no' => 'required',
				'ifsc_code' => 'required',
				
				'curr_bal' => 'required'
			]);
			
    }

	protected function createBank(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Banks::create([
            'added_by' => Auth::user()->id,
            'bank_name' => $data['bank_name'],
			'bank_branch' => $data['bank_branch'],
			'accholder_name' => $data['accholder_name'],
			'bank_ac_no' => $data['bank_ac_no'],
			'ifsc_code' => $data['ifsc_code'],
			'swift_code' => $data['swift_code'], 
			'upi_id'  => $data['upi_id'],  
			'curr_bal' => $data['curr_bal'],      
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }



	public function addBank()
    {
		//$this->middleware('auth');
		return view('pages.addbank')->with([

		]);
    }

	public function save_bank(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validatorBank($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertBank = $this->createBank($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if ($insertBank){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/banks'),
					'message' => 'Bank account added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Bank add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }

	public function edit_bank($bankId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/banks');
		}
		$bankId = base64_decode($bankId);
		$bank = DB::table('banks')
								->where('id', '=', $bankId)
								->get();
		$bank = $bank[0];
		return view('pages.edit-bank')->with([	
			'bank' => $bank,
			'bankId' => $bankId
		]); 
    }

	public function update_bank(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$bankId = $request->id;
		
		$validation = $this->validatorBank($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			$update = DB::table('banks')
					->where('id', $bankId)
					->update(
						 array(
								'bank_name' => $request->bank_name,
								'bank_branch' => $request->bank_branch,
								'accholder_name' => $request->accholder_name,
								'bank_ac_no' => $request->bank_ac_no,
								'ifsc_code' => $request->ifsc_code,
								'swift_code' => $request->swift_code, 
								'upi_id'  => $request->upi_id, 
								'curr_bal' => $request->curr_bal								     
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/banks'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			
		}	
    }

    public function BankStatement($bankId)
    {
		$title = 'Banks';
		$userId = Auth::user()->id;
		
		$bankId = base64_decode($bankId);
		$bank = DB::table('banks')
								->where('id', '=', $bankId)
								->get();
		$bank = $bank[0];
		
		$totaltransaction =  DB::table('bank_trans')
							->select(DB::raw('SUM(bank_trans.tran_amt) as totaltransaction'))
							->where('bankId', '=', $bankId)
							->get();

		$cashLimit = ($bank->curr_bal);
		$totaltransaction = ($totaltransaction[0]->totaltransaction);
		$outstanding = ($cashLimit - $totaltransaction);
		$availableLimit = ($cashLimit - $outstanding);
		
		
		if(Auth::user()->u_type ==1){ //ca
			$bank_trans =  DB::table('bank_trans')
							->select(DB::raw('bank_trans.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'bank_trans.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'bank_trans.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->where('bank_trans.bankId','=',$bankId)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$bank_trans =  DB::table('bank_trans')
							->select(DB::raw('bank_trans.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'bank_trans.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'bank_trans.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->where('bank_trans.bankId','=',$bankId)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$bank_trans =  DB::table('bank_trans')
							->select(DB::raw('bank_trans.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'bank_trans.added_by', '=', 'company_profiles.userId')
							->where('bank_trans.added_by', '=', $userId)
							->where('bank_trans.bankId','=',$bankId)
							->orderBy('bank_trans.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$bank_trans =  DB::table('bank_trans')
							->select(DB::raw('bank_trans.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'bank_trans.added_by', '=', 'company_profiles.userId')
							->where('bank_trans.bankId','=',$bankId)
							->orderBy('id', 'DESC')->paginate(10);
		}
		$bank_trans_pagination = $bank_trans;
		
		$array = array();
		foreach($bank_trans as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['tran_date'] = $val->tran_date;
			$array[$val->id]['payment_mode'] = $val->payment_mode;
			$array[$val->id]['tran_amt'] = $val->tran_amt;
			$array[$val->id]['message'] = $val->message;
			$array[$val->id]['purpose'] = $val->purpose;
		}
		$bank_trans = json_decode(json_encode($array));
		
        //$this->middleware('auth');
        return view('pages.bank-statement')->with([

			'bank' => $bank,
			'outstanding' => $outstanding,
			'availableLimit' => $availableLimit,
			'bank_trans' => $bank_trans,
			'bankId' => $bankId,
			'bank_trans_pagination' => $bank_trans_pagination,

        ]);
    }

    public function AddBankTransaction($bankId)
    {
		$bankId = base64_decode($bankId);
        //$this->middleware('auth');
        return view('pages.add-bank-transaction')->with([
			'bankId' => $bankId
        ]);
    }

	protected function validatorTransaction(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'tran_date' => 'required',
				'payment_mode' => 'required',
				'tran_amt' => 'required',
				'tran_type' => 'required',
				//'purpose' => 'required',
				'curr_amt' => 'required',
				'message' => 'required',
				'tran_doc' => 'required'
			]);
			
    }

    protected function createTransaction(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Bank_trans::create([
            'added_by' => Auth::user()->id,
            'bankId' => $data['bankId'],
            'tran_date' => $data['tran_date'],
			'payment_mode' => $data['payment_mode'],
			'tran_amt' => $data['tran_amt'],
			'tran_type' => $data['tran_type'],
			'purpose' => isset($data['purpose'])?$data['purpose']:"",
			'curr_amt' => $data['curr_amt'],
			'message' => $data['message'],
			'tarn_doc' => "",        
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function save_transaction(Request $request)  {  
            
		//echo "<pre>";print_r($request);exit;
		
		$bankId = $request->bankId;
		$validation = $this->validatorTransaction($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertTransaction = $this->createTransaction($request->all());
			$tranId = DB::getPdo()->lastInsertId();
			
			if ($insertTransaction){
			
				if($file = $request->hasFile('tran_doc')) {
					$file = $request->file('tran_doc') ;
					
					$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
					$destinationPath1 = public_path().'/uploads/bank' ;
					
					$file->move($destinationPath1,$fileName);
					$tran_doc = $fileName;
					
					//Update file
					$update = DB::table('bank_trans')
					->where('id', $tranId)
					->update(
						 array(
								'tran_doc' => $tran_doc,
						 )
					);
				}
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/bank-statement/'.base64_encode($bankId)),
					'message' => 'Transaction added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Transaction add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_transaction($tranId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/banks');
		}
		$tranId = base64_decode($tranId);
		$tranData = DB::table('bank_trans')
								->where('id', '=', $tranId)
								->get();
		$tranData = $tranData[0];
		return view('pages.edit-bank-transaction')->with([	
			'tranData' => $tranData,
			'tranId' => $tranId
		]); 
    }
	public function view_transaction($tranId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/banks');
		}
		$tranId = base64_decode($tranId);
		$tranData = DB::table('bank_trans')
								->where('id', '=', $tranId)
								->get();
		$tranData = $tranData[0];
		return view('pages.view-bank-transaction')->with([	
			'tranData' => $tranData,
			'tranId' => $tranId
		]); 
    }
	
	public function update_transaction(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$tranId = $request->id;
		$bankId = $request->bankId;
		$validation = $this->validatorTransaction($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			
			$update = DB::table('bank_trans')
					->where('id', $tranId)
					->update(
						 array(
								'tran_date' => $request->tran_date,
								'payment_mode' => $request->payment_mode,
								'purpose' => $request->purpose,
								'tran_amt' => $request->tran_amt,
								'curr_amt' => $request->curr_amt,
								'message' => $request->message,
						 )
					);
			if($file = $request->hasFile('tran_doc')) {
					$file = $request->file('tran_doc') ;
					
					$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
					$destinationPath1 = public_path().'/uploads/banks' ;
					
					$file->move($destinationPath1,$fileName);
					$tran_doc = $fileName;
					
					//Update file
					$update = DB::table('bank_trans')
					->where('id', $tranId)
					->update(
						 array(
								'tran_doc' => $tran_doc,
						 )
					);
			}
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/bank-statement/'.base64_encode($bankId)),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			
		}	
    }
	
	//Start loan section
    public function LoanIndex()
    {
		$title = 'Loans';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$loans =  DB::table('loans')
							->select(DB::raw('loans.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'loans.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'loans.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$loans =  DB::table('loans')
							->select(DB::raw('loans.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'loans.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'loans.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$loans = DB::table('loans')
					->select('loans.*', 'company_profiles.comp_name', 'banks.bank_name as bank_name')
					->leftJoin('company_profiles', 'loans.added_by', '=', 'company_profiles.userId')
					->leftJoin('banks', 'loans.bank_name', '=', 'banks.id')
					->where('loans.added_by', '=', $userId)
					->orderBy('loans.id', 'DESC')
					->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$loans =  DB::table('loans')
							->select(DB::raw('loans.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'loans.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$loans_pagination = $loans;
		
		$array = array();
		
		


		foreach($loans as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['bank_name'] = $val->bank_name;
			$array[$val->id]['branch'] = $val->branch;
			$array[$val->id]['app_name'] = $val->app_name;
			$array[$val->id]['loan_ac_no'] = $val->loan_ac_no;
			$array[$val->id]['bank_code'] = $val->bank_code;
			$array[$val->id]['credit_limit'] = $val->credit_limit;
			$array[$val->id]['status'] = $val->status;

			$totalInstallment =  DB::table('loan_ins')
							->select(DB::raw('SUM(loan_ins.ins_amt) as totalInstallment,loan_ins.updated_at'))
							->where('loanId', '=', $val->id)
							->get();
			//echo "<pre>"; print_r($totalInstallment);
			$loanAsOn = (isset($totalInstallment) && ($totalInstallment[0]->updated_at!=""))? date("d-m-Y",strtotime($totalInstallment[0]->updated_at)):"";
			$creditLimit = ($val->credit_limit);
			$totalInstallment = ($totalInstallment[0]->totalInstallment);
			$outstanding = ($creditLimit - $totalInstallment);
			$availableLimit = ($creditLimit - $outstanding);
			
			$array[$val->id]['outstanding'] = $outstanding;
			$array[$val->id]['availableLimit'] = $availableLimit;
			$array[$val->id]['loanAsOn'] = $loanAsOn;
			
			
		}
		$loans = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($loans);exit;
		return view('pages.loans')->with([
			'title' =>$title,
			'loans'=>$loans,
			'loans_pagination' =>$loans_pagination,
		]); 
    }
	
    public function addLoan()
    {	
		$userId = Auth::user()->id;
		$banks =  DB::table('banks')
							->where('added_by', '=', $userId)
							->get();
        return view('pages.addloan')->with([
			'banks' => $banks
        ]);
    }
	
	protected function validatorLoan(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'bank_name' => 'required',
				'branch' => 'required',
				'app_name' => 'required',
				'loan_ac_no' => 'required',
				'bank_code' => 'required',
				'credit_limit' => 'required'
			]);
			
    }

    protected function createLoan(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Loans::create([
            'added_by' => Auth::user()->id,
            'bank_name' => $data['bank_name'],
			'branch' => $data['branch'],
			'app_name' => $data['app_name'],
			'loan_ac_no' => $data['loan_ac_no'],
			'bank_code' => $data['bank_code'],
			'credit_limit' => $data['credit_limit'],        
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function save_loan(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validatorLoan($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertLoan = $this->createLoan($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if ($insertLoan){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/loans'),
					'message' => 'Loan added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Loan add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_loan($loanId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/loans');
		}
		$loanId = base64_decode($loanId);
		$loan = DB::table('loans')
								->where('id', '=', $loanId)
								->get();
		$loan = $loan[0];
		return view('pages.edit-loan')->with([	
			'loan' => $loan,
			'loanId' => $loanId
		]); 
    }
	
	public function update_loan(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$loanId = $request->id;
		
		$validation = $this->validatorLoan($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			$update = DB::table('loans')
					->where('id', $loanId)
					->update(
						 array(
								'bank_name' => $request->bank_name,
								'branch' => $request->branch,
								'app_name' => $request->app_name,
								'loan_ac_no' => $request->loan_ac_no,
								'bank_code' => $request->bank_code,
								'credit_limit' => $request->credit_limit,  
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/loans'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			
		}	
    }
	
    public function LoanStatement($loanId)
    {
		$title = 'Loans';
		$userId = Auth::user()->id;
		
		$loanId = base64_decode($loanId);
		$loan = DB::table('loans')
								->where('id', '=', $loanId)
								->get();
		$loan = $loan[0];
		
		$totalInstallment =  DB::table('loan_ins')
							->select(DB::raw('SUM(loan_ins.ins_amt) as totalInstallment'))
							->where('loanId', '=', $loanId)
							->get();

		$creditLimit = ($loan->credit_limit);
		$totalInstallment = ($totalInstallment[0]->totalInstallment);
		$outstanding = ($creditLimit - $totalInstallment);
		$availableLimit = ($creditLimit - $outstanding);
		
		
		if(Auth::user()->u_type ==1){ //ca
			$loan_ins =  DB::table('loan_ins')
							->select(DB::raw('loan_ins.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'loan_ins.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'loan_ins.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->where('loan_ins.loanId','=',$loanId)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$loan_ins =  DB::table('loan_ins')
							->select(DB::raw('loan_ins.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'loan_ins.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'loan_ins.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->where('loan_ins.loanId','=',$loanId)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$loan_ins =  DB::table('loan_ins')
							->select(DB::raw('loan_ins.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'loan_ins.added_by', '=', 'company_profiles.userId')
							->where('loan_ins.added_by', '=', $userId)
							->where('loan_ins.loanId','=',$loanId)
							->orderBy('loan_ins.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$loan_ins =  DB::table('loan_ins')
							->select(DB::raw('loan_ins.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'loan_ins.added_by', '=', 'company_profiles.userId')
							->where('loan_ins.loanId','=',$loanId)
							->orderBy('id', 'DESC')->paginate(10);
		}
		$loan_ins_pagination = $loan_ins;
		
		$array = array();
		foreach($loan_ins as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['ins_date'] = $val->ins_date;
			$array[$val->id]['payment_mode'] = $val->payment_mode;
			$array[$val->id]['ins_amt'] = $val->ins_amt;
			$array[$val->id]['message'] = $val->message;
		}
		$loan_ins = json_decode(json_encode($array));
		
		return view('pages.loan-statement')->with([	
			'loan' => $loan,
			'outstanding' => $outstanding,
			'availableLimit' => $availableLimit,
			'loan_ins' => $loan_ins,
			'loanId' => $loanId,
			'loan_ins_pagination' => $loan_ins_pagination,
		]); 
    }

    public function AddLoanInstallment($loanId)
    {
		$loanId = base64_decode($loanId);
        return view('pages.add-loan-installment')->with([
			'loanId' => $loanId
        ]);
    }
	
	protected function validatorInstallment(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'ins_date' => 'required',
				'payment_mode' => 'required',
				'ins_amt' => 'required',
				'curr_amt' => 'required',
				'message' => 'required',
				'ins_doc' => 'required'
			]);
			
    }

    protected function createInstallment(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Loan_ins::create([
            'added_by' => Auth::user()->id,
            'loanId' => $data['loanId'],
            'ins_date' => $data['ins_date'],
			'payment_mode' => $data['payment_mode'],
			'ins_amt' => $data['ins_amt'],
			'curr_amt' => $data['curr_amt'],
			'message' => $data['message'],
			'ins_doc' => $data['ins_doc'],        
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function save_installment(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('ins_doc'));exit;
		
		$loanId = $request->loanId;
		$validation = $this->validatorInstallment($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertInstallment = $this->createInstallment($request->all());
			$insId = DB::getPdo()->lastInsertId();
			
			if ($insertInstallment){
			
				if($file = $request->hasFile('ins_doc')) {
					$file = $request->file('ins_doc') ;
					
					$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
					$destinationPath1 = public_path().'/uploads/loans' ;
					
					$file->move($destinationPath1,$fileName);
					$ins_doc = $fileName;
					
					//Update file
					$update = DB::table('loan_ins')
					->where('id', $insId)
					->update(
						 array(
								'ins_doc' => $ins_doc,
						 )
					);
				}
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/loan-statement/'.base64_encode($loanId)),
					'message' => 'Installment added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Installment add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_installment($insId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/loans');
		}
		$insId = base64_decode($insId);
		$insData = DB::table('loan_ins')
								->where('id', '=', $insId)
								->get();
		$insData = $insData[0];
		return view('pages.edit-loan-installment')->with([	
			'insData' => $insData,
			'insId' => $insId
		]); 
    }
	public function view_installment($insId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/loans');
		}
		$insId = base64_decode($insId);
		$insData = DB::table('loan_ins')
								->where('id', '=', $insId)
								->get();
		$insData = $insData[0];
		return view('pages.view-loan-installment')->with([	
			'insData' => $insData,
			'insId' => $insId
		]); 
    }
	
	public function update_installment(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$insId = $request->id;
		$loanId = $request->loanId;
		$validation = $this->validatorInstallment($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			
			$update = DB::table('loan_ins')
					->where('id', $insId)
					->update(
						 array(
								'ins_date' => $request->ins_date,
								'payment_mode' => $request->payment_mode,
								'ins_amt' => $request->ins_amt,
								'curr_amt' => $request->curr_amt,
								'message' => $request->message,
						 )
					);
			if($file = $request->hasFile('ins_doc')) {
					$file = $request->file('ins_doc') ;
					
					$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
					$destinationPath1 = public_path().'/uploads/loans' ;
					
					$file->move($destinationPath1,$fileName);
					$ins_doc = $fileName;
					
					//Update file
					$update = DB::table('loan_ins')
					->where('id', $insId)
					->update(
						 array(
								'ins_doc' => $ins_doc,
						 )
					);
			}
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/loan-statement/'.base64_encode($loanId)),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			
		}	
    }
	public function delInstallment(Request $request)
    {
		$loan = DB::table('loan_ins')
								->where('id', '=', $request->id)
								->get();
		$loanId = $loan[0]->loanId;
		
        $delInstallment = DB::table('loan_ins')->where('id', $request->id)->delete();
		if($delInstallment){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/loan-statement/'.base64_encode($loanId)),
				'message' => 'Installment deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/loan-statement/'.base64_encode($loanId)),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	//End loan section

    public function CashIndex()
    {
        $title = 'Cash Management';
		$userId = Auth::user()->id;
		
		$format="Y";
		$today = date('Y-m-d');
		$date=date_create($today);
		$financial_year = "";
		if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
			$financial_year = (date_format($date,$format)) . '-' . (date_format($date,$format)+1);
		} else {
			//On or Before March (FY is previous year - current year)
			$financial_year = (date_format($date,$format)-1) . '-' . date_format($date,$format);
		}
		$financial_year = explode("-",$financial_year);
		
		$financialStart = carbon::parse($financial_year[0]."-04-01");
		$financialEnd = carbon::parse($financial_year[1]."-03-31");
		$totalCredit =  DB::table('cash_credit_debits')
							->select(DB::raw('SUM(cash_credit_debits.cd_amount) as totalCredit'))
							->where('cash_credit_debits.cd_type','=',"cr")
							->WhereBetween('cd_date', [$financialStart, $financialEnd])
							->get();
		$totalCredit = $totalCredit[0]->totalCredit;
		
		$totalDebit =  DB::table('cash_credit_debits')
							->select(DB::raw('SUM(cash_credit_debits.cd_amount) as totalDebit'))
							->where('cash_credit_debits.cd_type','=',"dr")
							->WhereBetween('cd_date', [$financialStart, $financialEnd])
							->get();
		$totalDebit = $totalDebit[0]->totalDebit;
		
		if(Auth::user()->u_type ==1){ //ca
			$cash_credit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'cash_credit_debits.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->where('cash_credit_debits.cd_type','=',"cr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
			$cash_debit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'cash_credit_debits.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->where('cash_credit_debits.cd_type','=',"dr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
			$cashInHandData = 0;
			$cashInHandDate = "";
			$cashAsOnDate = "";
							
		}else if(Auth::user()->u_type ==4){ //ca employee
			$cash_credit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'cash_credit_debits.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->where('cash_credit_debits.cd_type','=',"cr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
			$cash_debit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'cash_credit_debits.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->where('cash_credit_debits.cd_type','=',"dr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
			$cashInHandData = 0;
			$cashInHandDate = "";
			$cashAsOnDate = "";
							
		}elseif(Auth::user()->u_type ==2){ //user
			$cash_credit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->where('cash_credit_debits.added_by', '=', $userId)
							->where('cash_credit_debits.cd_type','=',"cr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
							
			$cash_debit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->where('cash_credit_debits.added_by', '=', $userId)
							->where('cash_credit_debits.cd_type','=',"dr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
							
			$cashAsOnDate =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.cd_date'))
							->where('cash_credit_debits.added_by', '=', $userId)
							->orderBy('cash_credit_debits.cd_date', 'DESC')
							->get();				
			$cashInHand =  DB::table('cash_hands')
							->select(DB::raw('cash_hands.amount_in_hand,cash_hands.updated_at'))
							->where('cash_hands.added_by', '=', $userId)
							->get();
			$cashInHandData = (isset($cashInHand) && (count($cashInHand)>0))?$cashInHand[0]->amount_in_hand:0;
			$cashInHandDate = (isset($cashInHand) && (count($cashInHand)>0))? date("d-m-Y",strtotime($cashInHand[0]->updated_at)):"";
			$cashAsOnDate = (isset($cashAsOnDate) && (count($cashAsOnDate)>0))? date("d-m-Y",strtotime($cashAsOnDate[0]->cd_date)):"";
			//echo $cashAsOnDate;exit;
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$cash_credit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->where('cash_credit_debits.cd_type','=',"cr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
							
			$cash_debit =  DB::table('cash_credit_debits')
							->select(DB::raw('cash_credit_debits.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'cash_credit_debits.added_by', '=', 'company_profiles.userId')
							->where('cash_credit_debits.cd_type','=',"dr")
							->orderBy('cash_credit_debits.cd_date', 'DESC')->paginate(10);
							
			$cashInHandData = 0;
			$cashInHandDate = "";
			$cashAsOnDate = "";
		}
		$cash_credit_pagination = $cash_credit;
		$cash_debit_pagination = $cash_debit;
		
		$array = array();
		foreach($cash_credit as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['cd_date'] = $val->cd_date;
			$array[$val->id]['particulars'] = $val->particulars;
			$array[$val->id]['cd_amount'] = $val->cd_amount;
			$array[$val->id]['comp_name'] = $val->comp_name;
		}
		$cash_credit = json_decode(json_encode($array));
		
		$array2 = array();
		foreach($cash_debit as $k=>$val)
		{
			$array2[$val->id]['id'] = $val->id;
			$array2[$val->id]['cd_date'] = $val->cd_date;
			$array2[$val->id]['particulars'] = $val->particulars;
			$array2[$val->id]['cd_amount'] = $val->cd_amount;
			$array2[$val->id]['comp_name'] = $val->comp_name;
		}
		$cash_debit = json_decode(json_encode($array2));
		
		return view('pages.cash')->with([	
			'cash_credit' => $cash_credit,
			'cash_debit' => $cash_debit,
			'totalCredit' => $totalCredit,
			'totalDebit' => $totalDebit,
			'cashInHand' => $cashInHandData,
			'cashInHandDate' => $cashInHandDate,
			'cashAsOnDate' => $cashAsOnDate,
			'cash_credit_pagination' => $cash_credit_pagination,
			'cash_debit_pagination' => $cash_debit_pagination,
		]); 
    }
	
    public function CashCredit()
    {
		return view('pages.add-cash-credit')->with([	
			
		]); 
    }
	
	protected function validatorCash(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'cd_date' => 'required',
				'particulars' => 'required',
				'cd_amount' => 'required',
			]);
			
    }

    protected function createCashCredit(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Cash_credit_debits::create([
            'added_by' => Auth::user()->id,
            'cd_date' => $data['cd_date'],
			'particulars' => $data['particulars'],
			'cd_amount' => $data['cd_amount'],
			'cd_type' => "cr",       
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function save_cash_credit(Request $request)  {  
 
		$validation = $this->validatorCash($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertData = $this->createCashCredit($request->all());
			$cId = DB::getPdo()->lastInsertId();
			
			if ($insertData){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/cash'),
					'message' => 'Record added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Record add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_cash_credit($cId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/cash');
		}
		$cId = base64_decode($cId);
		$cashData = DB::table('cash_credit_debits')
								->where('id', '=', $cId)
								->get();
		$cashData = $cashData[0];
		return view('pages.edit-cash-credit')->with([	
			'cashData' => $cashData,
			'cId' => $cId
		]); 
    }
	
	public function view_cash_credit($cId)  {  
		$cId = base64_decode($cId);
		$cashData = DB::table('cash_credit_debits')
								->where('id', '=', $cId)
								->get();
		$cashData = $cashData[0];
		return view('pages.view-cash-credit')->with([	
			'cashData' => $cashData,
			'cId' => $cId
		]); 
    }
	
	public function update_cash_credit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$cId = $request->id;
		
		$validation = $this->validatorCash($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{

			$update = DB::table('cash_credit_debits')
					->where('id', $cId)
					->update(
						 array(
								'cd_date' => $request->cd_date,
								'particulars' => $request->particulars,
								'cd_amount' => $request->cd_amount, 
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/cash'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			
		}	
    }
	
    public function CashDebit()
    {
        //$this->middleware('auth');
        return view('pages.add-cash-debit')->with([

        ]);
    }
	
	protected function createCashDebit(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Cash_credit_debits::create([
            'added_by' => Auth::user()->id,
            'cd_date' => $data['cd_date'],
			'particulars' => $data['particulars'],
			'cd_amount' => $data['cd_amount'],
			'cd_type' => "dr",       
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function save_cash_debit(Request $request)  {  
 
		$validation = $this->validatorCash($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertData = $this->createCashDebit($request->all());
			$cId = DB::getPdo()->lastInsertId();
			
			if ($insertData){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/cash'),
					'message' => 'Record added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Record add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_cash_debit($cId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/cash');
		}
		$cId = base64_decode($cId);
		$cashData = DB::table('cash_credit_debits')
								->where('id', '=', $cId)
								->get();
		$cashData = $cashData[0];
		return view('pages.edit-cash-debit')->with([	
			'cashData' => $cashData,
			'cId' => $cId
		]); 
    }
	
	public function view_cash_debit($cId)  {  
		$cId = base64_decode($cId);
		$cashData = DB::table('cash_credit_debits')
								->where('id', '=', $cId)
								->get();
		$cashData = $cashData[0];
		return view('pages.view-cash-debit')->with([	
			'cashData' => $cashData,
			'cId' => $cId
		]); 
    }
	
	public function update_cash_debit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$cId = $request->id;
		
		$validation = $this->validatorCash($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{

			$update = DB::table('cash_credit_debits')
					->where('id', $cId)
					->update(
						 array(
								'cd_date' => $request->cd_date,
								'particulars' => $request->particulars,
								'cd_amount' => $request->cd_amount, 
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/cash'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			
		}	
    }
	
	protected function createCashHand(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Cash_hands::create([
            'added_by' => Auth::user()->id,
            'amount_in_hand' => $data['amount_in_hand'],        
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	
	public function update_cashinhand(Request $request)
	{
		$added_by = Auth::user()->id;
		$getData = DB::table('cash_hands')
								->where('added_by', '=', $added_by)
								->get()->toArray();
		if(count($getData) == 0 )
		{
			
			$insertCashHand = $this->createCashHand($request->all());
		}else{

		$update = DB::table('cash_hands')
					->where('added_by', $added_by)
					->update(
						 array(
								'amount_in_hand' => $request->amount_in_hand
						 )
					);
		}
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/cash'),
			'message' => 'Record updated successfully'
		);
		return response()->json($msg);
	}
	
	public function bank_statement_upload()
    {
		$userId = Auth::user()->id;
		$banks =  DB::table('banks')
						->select(DB::raw('banks.id,banks.bank_name'))
						->where('banks.added_by', '=', $userId)
						->get();
		return view('pages.bank-statement-upload')->with([
			'banks' => $banks,
		]);
    }
	
	protected function validator_attachment(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		
		return Validator::make($data, [
			'bank_id' => 'required',
			'startdate' => 'required',
			'enddate' => 'required',
			'bankstatement' => 'required|mimes:xlsx,xls|max:1024',
		]);
		
    }
	
	protected function createBankStatement(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Bank_statements::create([
            'added_by' => Auth::user()->id,
			'bank_id' => $data['bank_id'],
            'startdate' => $data['startdate'],
			'enddate' => $data['enddate'],      
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
	
	public function uploadBank_statement(Request $request)
	{
		$added_by = Auth::user()->id;
		$validation = $this->validator_attachment($request->all());
		if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//die("sdzfgsdfg");
			$the_file = $request->file('bankstatement');
			
		   $spreadsheet = IOFactory::load($the_file->getRealPath());
           $sheet        = $spreadsheet->getActiveSheet();
           $row_limit    = $sheet->getHighestDataRow();
           $column_limit = $sheet->getHighestDataColumn();
           $row_range    = range( 2, $row_limit );
           $column_range = range( 'F', $column_limit );
           $startcount = 2;
           $data = array();
		   if(count($row_range) ==0){
			   $msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/bank-statement-upload'),
					'message' => 'Bank statement uploaded failed!'
				);
				return response()->json($msg);
		   }else{
				$insertData = $this->createBankStatement($request->all());
				$statement_id = DB::getPdo()->lastInsertId();
				foreach ( $row_range as $row ) {
				   /*$data[] = [
					   'slno' =>$sheet->getCell( 'A' . $row )->getValue(),
					   'cd_date' => $sheet->getCell( 'B' . $row )->getValue(),
					   'debit' => $sheet->getCell( 'C' . $row )->getValue(),
					   'credit' => $sheet->getCell( 'D' . $row )->getValue(),
				   ];*/
				   $cd_date = $sheet->getCell( 'B' . $row )->getValue();
				   $cd_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cd_date)->format('Y-m-d');
				   $particulars =   $sheet->getCell( 'C' . $row )->getValue();
				   $debit =   $sheet->getCell( 'D' . $row )->getValue();
				   $credit =  $sheet->getCell( 'E' . $row )->getValue();
				   $cd_type = "";
				   $cd_amount = 0;
				   if($debit =="")
				   {
					   $cd_type = "cr";
					   $cd_amount = $credit;
				   }
				   if($credit =="")
				   {
					   $cd_type = "dr";
					   $cd_amount = $debit;
				   }
				   
				   $data[] = [
					   'added_by' => $added_by,
					   'statement_id' => $statement_id,
					   'cd_date' => $cd_date,
					   'cd_type' => $cd_type,
					   'cd_amount' => $cd_amount,
					   'particulars' => $particulars,
				   ];
				   
				   $startcount++;
				}
			   //echo "<pre>";print_r($data); exit;
			   DB::table('cash_credit_debits')->insert($data);
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/bank-statement-upload'),
					'message' => 'Bank statement uploaded successfully'
				);
				return response()->json($msg);
		   }
		}
		
	}
	
	public function tally_credit_debit(Request $request)
	{
		$uid = Auth::user()->id;
		$id = $request->id;
		$type = $request->type;
		$cash_credit = DB::table('cash_credit_debits')
					->select(DB::raw('cash_credit_debits.added_by,cash_credit_debits.cd_amount,cash_credit_debits.cd_date'))
					->where('cash_credit_debits.id', '=', $id) 
					->get();
		$added_by = $cash_credit[0]->added_by;
		$cd_amount = $cash_credit[0]->cd_amount;
		$createdAt = date("Y-m-d",strtotime($cash_credit[0]->cd_date));
		if($type == "credit"){			
			//tally data from sales data with date
			$salesRec = DB::table('sales')
					->select(DB::raw('sales.id,sales.inv_num,sales.created_at'))
					->where('sales.added_by', '=', $added_by) 
					->whereDate('sales.created_at', '=', $createdAt)
					->get();
			//echo "<pre>";print_r($salesRec);exit;
			$salesAmount = 0;
			if($salesRec->count() !=0){
				$sid = $salesRec[0]->id;
				//$salesDate = date("Y-m-d",strtotime($salesRec[0]->created_at));
				$salesItems = DB::table('sales_values')
						->select(DB::raw('SUM(sales_values.amount) amount'))
						->where('sales_values.sid', '=', $sid) 
						->where('sales_values.uid', '=', $added_by) 
						->get();
				$salesAmount = $salesItems[0]->amount;
				
				$array = array();
				foreach($salesRec as $k=>$val)
				{
					$array[$val->inv_num]['inv_num'] = $val->inv_num;
					$array[$val->inv_num]['created_at'] = date("d-m-Y",strtotime($val->created_at));
					
					$saleItms =  DB::table('sales_values')
							->select(DB::raw('sales_values.amount'))							
							->where('sales_values.sid', '=', $val->id) 
							->where('sales_values.uid', '=', $added_by) 
							->get();
					$array[$val->inv_num]['amount'] = $saleItms;
				}
				$saleItms = json_decode(json_encode($array));
				//echo "<pre>";print_r($saleItms);//exit;
				$pUrl = url('/').'/sales-invoice';
				$html = '<table border="1" class="table table-center table-hover datatable">';
				$html .= '<thead class="thead-light">';
				$html .= '<tr>';
				$html .= '<th>Date</th>';
				$html .= '<th>Inv no.</th>';
				$html .= '<th>Amount</th>';
				$html .= '<th>Action</th>';
				$html .= '</tr>';
				$html .= '</thead>';

				foreach($saleItms as $row) {
					$html .= '<tr>';
					$html .= '<td>' . $row->created_at . '</td>';
					$html .= '<td>' . $row->inv_num . '</td>';
					$html .= '<td><table>';
					foreach($row->amount as $value) {
						$html .= '<tr><td>₹' . $value->amount . '</td></tr>';
					}
					$html .= '</table></td>';
					$html .= '<td><a href="'.$pUrl.'">click</a></td>';
					$html .= '</tr>';
				}
				$html .= '</table>';
				return $html;
			}
			else{
				echo "<h5>Record is failed to matched in sales data</h5>";
			}
		}
		else if($type == "debit"){			
			//tally data from purchases data with date
			$purRec = DB::table('purchases')
					->select(DB::raw('purchases.id,purchases.inv_num,purchases.created_at'))
					->where('purchases.added_by', '=', $added_by) 
					->whereDate('purchases.created_at', '=', $createdAt)
					->get();
			$purAmount = 0;
			if($purRec->count() !=0){
				$sid = $purRec[0]->id;
				$purItems = DB::table('purchase_values')
						->select(DB::raw('SUM(purchase_values.amount) amount'))
						->where('purchase_values.sid', '=', $sid) 
						->where('purchase_values.uid', '=', $added_by) 
						->get();
				$purAmount = $purItems[0]->amount;
		
				$array = array();
				foreach($purRec as $k=>$val)
				{
					$array[$val->inv_num]['inv_num'] = $val->inv_num;
					$array[$val->inv_num]['created_at'] = date("d-m-Y",strtotime($val->created_at));
					
					$purItms =  DB::table('purchase_values')
							->select(DB::raw('purchase_values.amount'))							
							->where('purchase_values.sid', '=', $val->id) 
							->where('purchase_values.uid', '=', $added_by) 
							->get();
					$array[$val->inv_num]['amount'] = $purItms;
				}
				$purItemsRec = json_decode(json_encode($array));
				//echo "<pre>";print_r($purItemsRec);//exit;
				$sUrl = url('/').'/purchase-invoice';
				$html = '<table border="1" class="table table-center thead-light table-hover datatable">';
				$html .= '<thead class="thead-light">';
				$html .= '<tr>';
				$html .= '<th>Date</th>';
				$html .= '<th>Inv no.</th>';
				$html .= '<th>Amount</th>';
				$html .= '<th>Action</th>';
				$html .= '</tr>';
				$html .= '</thead>';

				foreach($purItemsRec as $row) {
					$html .= '<tr>';
					$html .= '<td>' . $row->created_at . '</td>';
					$html .= '<td>' . $row->inv_num . '</td>';
					$html .= '<td><table>';
					foreach($row->amount as $value) {
						$html .= '<tr><td>₹' . $value->amount . '</td></tr>';
					}
					$html .= '</table></td>';
					$html .= '<td><a href="'.$sUrl.'">click</a></td>';
					$html .= '</tr>';
				}
				$html .= '</table>';
				return $html;
			}
			else{
				echo "<h5>Record is failed to matched in purchases data</h5>";
			}
		}
	}
}
