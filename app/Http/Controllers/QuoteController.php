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
use App\Task_quotes;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class QuoteController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function Index()
    {
        $title = 'Quote';
		$userId = Auth::user()->id;
		$quotes = DB::table('task_quotes')->where('userId', '=', $userId)->orderBy('id', 'DESC')->paginate(10);
        $quotes_pagination = $quotes;
        //$this->middleware('auth');
        return view('pages.ca.quote')->with([
            'title' =>$title,
			'quotes'=>$quotes,
			'quotes_pagination' =>$quotes_pagination,

        ]);
    }

    protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'task_cat' => 'required',
			//'task_sub_cat' => 'required',
			'govfee' => 'required',
            'service_charge' => 'required',
        ]
		);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return  Task_quotes::create([
            'userId' => Auth::user()->id,
            'utype' => '2',
            'task_cat' => $data['task_cat'],
            //'task_sub_cat' => $data['task_sub_cat'],
            'govfee' => $data['govfee'],
            'service_charge' => $data['service_charge'],
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
    public function AddQuote()
    {
        //$this->middleware('auth');
        return view('pages.ca.addquote')->with([

        ]);
    }
    public function save_quote(Request $request)  {  
            
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertQuote = $this->create($request->all());
			$quoteId = DB::getPdo()->lastInsertId();
			
			if ($insertQuote){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/quote'),
					'message' => 'Quote added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Quote add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }

    public function edit_quote($quoteId)  {  
        
		$quoteId = base64_decode($quoteId);
		$quote = DB::table('task_quotes')
								->where('id', '=', $quoteId)
								->get();

		$quote = $quote[0];
		 return view('pages.ca.editquote')->with([				
				'quote' => $quote,		
				'quoteId' => $quoteId
			]); 
    }

    public function update_quote(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$quoteId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update Quote
			$update = DB::table('task_quotes')
					->where('id', $quoteId)
					->update(
						 array(

                                'task_cat' => $request->task_cat,
                                //'task_sub_cat' => $request->task_sub_cat,
                                'govfee' => $request->govfee,
                                'service_charge' =>$request->service_charge,
								
						 )
					);
			if ($update){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/quote'),
					'message' => 'Record details updated'
				);
				return response()->json($msg);	
			}
			else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Update not success!'
					);
					return response()->json($msg);	
			}
		}	
    }

    //Delete Quote
	public function delQuote(Request $request)
    {
        $delQuote = DB::table('task_quotes')->where('id', $request->id)->delete();
		if($delQuote){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/quote'),
				'message' => 'Quote deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/quote'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
}
