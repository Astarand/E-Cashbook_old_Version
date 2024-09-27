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
use App\Expenses;
use App\Expense_cats;
use App\Expense_cat_options;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class ExpensesController extends Controller
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
        $title = 'Expenses';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$expenses =  DB::table('expenses')
							->select(DB::raw('expenses.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'expenses.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$expenses =  DB::table('expenses')
							->select(DB::raw('expenses.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
							->where('expenses.added_by', '=', $userId)
							->orderBy('expenses.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$expenses =  DB::table('expenses')
							->select(DB::raw('expenses.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$expenses_pagination = $expenses;
		
		$array = array();
		foreach($expenses as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['exp_invno'] = $val->exp_invno;
			$array[$val->id]['expense_date'] = $val->expense_date;
			$array[$val->id]['expense_cat'] = $val->expense_cat;
			$array[$val->id]['expense_type'] = $val->expense_type;
			$array[$val->id]['expense_amt'] = $val->expense_amt;
			$array[$val->id]['approved_by'] = $val->approved_by;
			$array[$val->id]['status'] = $val->status;

		}
		$expenses = json_decode(json_encode($array));
		
		
		if(Auth::user()->u_type ==1){ //ca
							
			$monthWiseExpenses = Expenses::select(
									DB::raw("DATE_FORMAT(expense_date, '%Y-%m') as 'month'"),
									DB::raw("(COUNT(*)) as count"),
									DB::raw("sum(expense_amt) as expense_amt"),
									DB::raw('expenses.added_by,company_profiles.comp_name,ca_assigns.ca_id')
								)->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
									->leftJoin('ca_assigns', 'expenses.added_by', '=', 'ca_assigns.comp_id')
									->where('ca_assigns.ca_id','=',$userId)
									->where('ca_assigns.ca_assign_status','=',1)
									->orderBy('expense_date')
									->groupBy(DB::raw("DATE_FORMAT(expense_date, '%m-%Y')"))
									->get();
									
		}elseif(Auth::user()->u_type ==2){ //user
			$monthWiseExpenses = Expenses::select(
									DB::raw("DATE_FORMAT(expense_date, '%Y-%m') as 'month'"),
									DB::raw("(COUNT(*)) as count"),
									DB::raw("sum(expense_amt) as expense_amt"),
									DB::raw('expenses.added_by,company_profiles.comp_name')
								)->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
									->where('expenses.added_by', '=', $userId)
									->orderBy('expense_date')
									->groupBy(DB::raw("DATE_FORMAT(expense_date, '%m-%Y')"))
									->get();
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$monthWiseExpenses = Expenses::select(
									DB::raw("DATE_FORMAT(expense_date, '%Y-%m') as 'month'"),
									DB::raw("(COUNT(*)) as count"),
									DB::raw("sum(expense_amt) as expense_amt"),
									DB::raw('expenses.added_by,company_profiles.comp_name')
								)->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
									->orderBy('expense_date')
									->groupBy(DB::raw("DATE_FORMAT(expense_date, '%m-%Y')"))
									->get();
		}
		
		
		//echo "<pre>"; print_r($monthWiseExpenses);exit;
		//echo "<pre>"; print_r($expenses);exit;
		return view('pages.expenses')->with([
			'title' =>$title,
			'expenses'=>$expenses,
			'monthWiseExpenses'=>$monthWiseExpenses,
			'expenses_pagination' =>$expenses_pagination,
		]); 
    }
	
	public function getExpenseOptions(Request $request)
    {
		
		$id = $request->id; 
		$response = [];
		if($id !="")
		{
			$expCat = Expense_cats::query()
					->where('cat_name', '=', $id) 
					->get()->toArray();
			$result = Expense_cat_options::query()
					->where('cat_id', '=', $expCat[0]['id']) 
					->get()->toArray();
			
			//echo "<pre>";print_r($result);exit;
			 foreach($result as $row){
			   $response[] = array("id"=>$row['opt_val'], "name"=>$row['opt_val']);
			}
		}
		echo json_encode($response); 
    }

    public function addexpenses()
    {
        //$this->middleware('auth');
        return view('pages.addexpenses')->with([

        ]);
    }
	
		//Start for purchase invoice
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'expense_date' => 'required',
				'pur_of_expense' => 'required',
				'mode_of_expense' => 'required',
				'expense_cat' => 'required',
				'expense_amt' => 'required',
				//'expense_msg' => 'required',
				'exp_invno' => 'required',
				'approved_by' => 'required',
				'designation' => 'required',
				'approved_date' => 'required',
			]);
			
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Expenses::create([
            'added_by' => Auth::user()->id,
            'expense_date' => $data['expense_date'],
			'pur_of_expense' => $data['pur_of_expense'],
			'mode_of_expense' => $data['mode_of_expense'],
			'expense_cat' => $data['expense_cat'],
			'expense_type' => isset($data['expense_type'])?$data['expense_type']:"",
			'expense_amt' => $data['expense_amt'],
			//'expense_msg' => $data['expense_msg'],                    
			'exp_invno' => $data['exp_invno'],                    
			'approved_by' => $data['approved_by'],                    
			'designation' => $data['designation'],                    
			'approved_date' => $data['approved_date'], 
			'spec_note' => isset($data['spec_note'])?$data['spec_note']:"",			
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_expenses(Request $request)  {  
            
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertExpenses = $this->create($request->all());
			$eId = DB::getPdo()->lastInsertId();
			
			if($file = $request->hasFile('exp_inv_doc')) {
				$file = $request->file('exp_inv_doc') ;				
				$fileName2 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/expense-invoice' ;				
				$file->move($destinationPath1,$fileName2);
				$exp_inv_doc = $fileName2 ;
				
				$update = DB::table('expenses')
				->where('id', $eId)
				->update(
					 array(
							'exp_inv_doc' => $exp_inv_doc,
					 )
				);
			}
			
			if ($insertExpenses){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/expenses'),
					'message' => 'Expenses added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Expenses add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_expenses($eId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/expenses');
		}
		$eId = base64_decode($eId);
		$expenses = DB::table('expenses')
								->where('id', '=', $eId)
								->get();
		$expenses = $expenses[0];
		
		$expCat = Expense_cats::query()
					->where('cat_name', '=', $expenses->expense_cat) 
					->get()->toArray();
		$expenseCatOpt = Expense_cat_options::query()
				->where('cat_id', '=', $expCat[0]['id']) 
				->get();
		
		
		
		return view('pages.edit-expenses')->with([	
			'expenses' => $expenses,
			'expenseCatOpt' => $expenseCatOpt,
			'eId' => $eId
		]); 
    }
	
	public function view_expenses($eId)  {  
        
		$eId = base64_decode($eId);
		$expenses = DB::table('expenses')
								->where('id', '=', $eId)
								->get();
		$expenses = $expenses[0];
		
		$expCat = Expense_cats::query()
					->where('cat_name', '=', $expenses->expense_cat) 
					->get()->toArray();
		$expenseCatOpt = Expense_cat_options::query()
				->where('cat_id', '=', $expCat[0]['id']) 
				->get();
		
		
		
		return view('pages.view-expenses')->with([	
			'expenses' => $expenses,
			'expenseCatOpt' => $expenseCatOpt,
			'eId' => $eId
		]); 
    }
	
	public function update_expenses(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$eId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			
			if($file = $request->hasFile('exp_inv_doc')) {
				$file = $request->file('exp_inv_doc') ;
				
				$fileName2 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/expense-invoice' ;
				
				$file->move($destinationPath1,$fileName2);
				$exp_inv_doc = $fileName2 ;
				
				$update = DB::table('expenses')
				->where('id', $eId)
				->update(
					 array(
							'exp_inv_doc' => $exp_inv_doc,
					 )
				);
			}
			$update = DB::table('expenses')
					->where('id', $eId)
					->update(
						 array(
								'expense_date' => $request->expense_date,
								'pur_of_expense' => $request->pur_of_expense,
								'mode_of_expense' => $request->mode_of_expense,
								'expense_cat' => $request->expense_cat,
								'expense_type' => $request->expense_type,
								'expense_amt' => $request->expense_amt,
								//'expense_msg' => $request->expense_msg,
								'exp_invno' => $request->exp_invno,                    
								'approved_by' => $request->approved_by,                    
								'designation' => $request->designation,                    
								'approved_date' => $request->approved_date, 
								'spec_note' => isset($request->spec_note)?$request->spec_note:"",
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/expenses'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function delExpenses(Request $request)
    {
        $delExpenses = DB::table('expenses')->where('id', $request->id)->delete();
		if($delExpenses){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/expenses'),
				'message' => 'Record deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/expenses'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
    public function viewmonthexpenses($monthWise,$added_by)
    {
		$monthWise = base64_decode($monthWise);
		$added_by = base64_decode($added_by);
		$monthWise = explode("-",$monthWise);
		$year = $monthWise[0];
		$month = $monthWise[1];
		
		$title = 'Monthly Expenses';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$expenses =  DB::table('expenses')
							->select(DB::raw('expenses.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'expenses.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->where('expenses.added_by','=',$added_by)
							->whereYear('expense_date', '=', $year)
							->whereMonth('expense_date', '=', $month)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$expenses =  DB::table('expenses')
							->select(DB::raw('expenses.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
							->where('expenses.added_by','=',$added_by)
							->whereYear('expense_date', '=', $year)
							->whereMonth('expense_date', '=', $month)
							->orderBy('expenses.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$expenses =  DB::table('expenses')
							->select(DB::raw('expenses.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'expenses.added_by', '=', 'company_profiles.userId')
							->where('expenses.added_by','=',$added_by)
							->whereYear('expense_date', '=', $year)
							->whereMonth('expense_date', '=', $month)
							->orderBy('id', 'DESC')->paginate(10);
		}
		$expenses_pagination = $expenses;
		
		$array = array();
		foreach($expenses as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['expense_date'] = $val->expense_date;
			$array[$val->id]['pur_of_expense'] = $val->pur_of_expense;
			$array[$val->id]['mode_of_expense'] = $val->mode_of_expense;
			$array[$val->id]['expense_cat'] = $val->expense_cat;
			$array[$val->id]['expense_type'] = $val->expense_type;
			$array[$val->id]['expense_amt'] = $val->expense_amt;
			$array[$val->id]['expense_msg'] = $val->expense_msg;
			$array[$val->id]['status'] = $val->status;

		}
		$expenses = json_decode(json_encode($array));
		
 
		//echo "<pre>"; print_r($monthWiseExpenses);exit;
		//echo "<pre>"; print_r($expenses);exit;
		return view('pages.viewmonthexpenses')->with([
			'title' =>$title,
			'expenses'=>$expenses,
			'expenses_pagination' =>$expenses_pagination,
		]); 
    }

}
