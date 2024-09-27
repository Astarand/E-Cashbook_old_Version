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
use App\Company_profiles;
use App\Statutorys;
use App\Ca_assigns;
use App\Chat_messages;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class StatutoryController extends Controller
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
    public function statutory()
    {
		
		$title = 'Statutory';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$statutory =  DB::table('statutorys')
							->select(DB::raw('statutorys.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'statutorys.compId', '=', 'company_profiles.userId')
							->where('statutorys.added_by', '=', $userId)
							->orderBy('statutorys.id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$statutory =  DB::table('statutorys')
							->select(DB::raw('statutorys.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'statutorys.compId', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'statutorys.added_by', '=', 'ca_assigns.ca_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->orderBy('statutorys.id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$statutory =  DB::table('statutorys')
							->select(DB::raw('statutorys.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'statutorys.compId', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'statutorys.compId', '=', 'ca_assigns.comp_id')
							//->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$statutory =  DB::table('statutorys')
							->select(DB::raw('statutorys.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'statutorys.compId', '=', 'company_profiles.userId')
							->orderBy('statutorys.id', 'DESC')->paginate(10);
		}
		$statutory_pagination = $statutory;
		//echo "<pre>"; print_r($statutory);exit;
		$array = array();
		foreach($statutory as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['added_by'] = $val->added_by;
			$array[$val->id]['compId'] = $val->compId;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['statutory_doc'] = $val->statutory_doc;
			$array[$val->id]['statutory_due_date'] = $val->statutory_due_date;
			$array[$val->id]['statutory_msg'] = $val->statutory_msg;
			$array[$val->id]['status'] = $val->status;
			
			if(Auth::user()->u_type ==1){
				$compId = $val->compId;
				$array[$val->id]['messages'] = DB::table('chat_messages')
										->where('c_qid', '=', $val->id)
										->where( function($q) use ($compId)
													{
														$q->where(function($q2) use ($compId){
															$q2->where('to_user_id', Auth::user()->id)->Where('from_user_id', $compId);
														});
													})
										->where('status', '=', 0)
										->get();
			}else{
				$caId = $val->added_by;
				$array[$val->id]['messages'] = DB::table('chat_messages')
										->where('c_qid', '=', $val->id)
										->where( function($q) use ($caId)
													{
														$q->where(function($q2) use ($caId){
															$q2->where('to_user_id', Auth::user()->id)->Where('from_user_id', $caId);
														});
													})
										->where('status', '=', 0)
										->get();
			}
		}
		$statutory = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($statutory);exit;
		return view('pages.statutory')->with([
			'title' =>$title,
			'statutory'=>$statutory,
			'statutory_pagination' =>$statutory_pagination,
		]); 
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'compId' => 'required',
				'statutory_doc' => 'required',
				// 'statutory_due_date' => 'required',
				'statutory_msg' => 'required'
			]);
			
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Statutorys::create([
            'added_by' => Auth::user()->id,
            'compId' => $data['compId'],
            'statutory_doc' => $data['statutory_doc'],
            'statutory_due_date' => $data['statutory_due_date'],
			'statutory_msg' => $data['statutory_msg'],                    
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_statutory(Request $request)  {  
            
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertExpenses = $this->create($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if ($insertExpenses){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/statutory'),
					'message' => 'Statutory added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Statutory add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function update_statutory(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$eId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			$update = DB::table('statutorys')
					->where('id', $eId)
					->update(
						 array(
								'statutory_doc' => $request->statutory_doc,
								'statutory_due_date' => $request->statutory_due_date,
								'statutory_msg' => $request->statutory_msg,
								'status' => $request->status,

						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/statutory'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function addstatutory()
    {						
		$companys = DB::table('company_profiles')
						->select(DB::raw('company_profiles.userId,company_profiles.comp_name,ca_assigns.ca_id'))
						->leftJoin('ca_assigns', 'company_profiles.userId', '=', 'ca_assigns.comp_id')
						->where('ca_assigns.ca_assign_status','=',1)
						->get();
        return view('pages.addstatutory')->with([
			'companys' => $companys,
        ]);
    }

    public function editstatutory($eId)
    {
        if(Auth::user()->u_type ==2){
			return redirect('/statutory');
		}
		$eId = base64_decode($eId);
		$statutory = DB::table('statutorys')
								->where('id', '=', $eId)
								->get();
		$statutory = $statutory[0];
		
		$companys = DB::table('company_profiles')
						->select(DB::raw('company_profiles.userId,company_profiles.comp_name,ca_assigns.ca_id'))
						->leftJoin('ca_assigns', 'company_profiles.userId', '=', 'ca_assigns.comp_id')
						->where('ca_assigns.ca_assign_status','=',1)
						->get();
		return view('pages.editstatutory')->with([	
			'statutory' => $statutory,
			'companys' => $companys,
			'eId' => $eId
		]); 
        
    }
	
	public function viewstatutory($eId)
    {
        
        $eId = base64_decode($eId);
		$statutory = DB::table('statutorys')
								->where('id', '=', $eId)
								->get();
		$statutory = $statutory[0];
		
		$companys = DB::table('company_profiles')
						->select(DB::raw('company_profiles.userId,company_profiles.comp_name,ca_assigns.ca_id'))
						->leftJoin('ca_assigns', 'company_profiles.userId', '=', 'ca_assigns.comp_id')
						->where('ca_assigns.ca_assign_status','=',1)
						->get();
		return view('pages.viewstatutory')->with([	
			'statutory' => $statutory,
			'companys' => $companys,
			'eId' => $eId
		]); 
    }
	
	//Start chat
	
	public function chat_response($caId,$uid,$id)
    {
		$caId = base64_decode($caId);
		$uid = base64_decode($uid);
		$id = base64_decode($id);
		$title = "Message Response";
		 if(Auth::user()->u_type ==1){ //CA

				$compId = $uid;
				$array['id'] = $id;
				$array['uid'] = $uid;
				$compName = DB::table('users')
									->select(DB::raw('users.name'))
									->where('id', '=', $compId)
									->get();
				$array['compName'] = $compName[0]->name;
				
				$array['messages'] = DB::table('chat_messages')
									->where('c_qid', '=', $id)
									->where( function($q) use ($compId)
											{
												$q->where(function($q2) use ($compId){
													$q2->where('from_user_id', Auth::user()->id)->Where('to_user_id', $compId);
												})->orWhere(function($q2) use ($compId){
													$q2->where('to_user_id', Auth::user()->id)->Where('from_user_id', $compId);
												});
											}) 

									->get(); 
									
				//chat status set 0 to 1 
				$message_update = DB::table('chat_messages')
							->where('c_qid', '=', $id)
							->where( function($q) use ($compId)
									{
										$q->where(function($q2) use ($compId){
											$q2->where('to_user_id', Auth::user()->id)->Where('from_user_id', $compId);
										});
									}) 

							->update(
								 array(
										'status' => 1,
								 )
							);
				//chat status set 0 to 1

				
			
			
			
			$quotes = json_decode(json_encode($array));
			//echo "<pre>";print_r($quotes);exit;
			
			return view('pages.chat-response')->with([
				'quotes' =>$quotes,
				//'countQuote' =>$countQuote,
				'title' =>$title
			]); 
			
		}else{
			
				$compId = $uid;
				$array['id'] = $id;
				$array['uid'] = $uid;

				$caId = DB::table('statutorys')
									->select(DB::raw('statutorys.added_by'))
									->where('id', '=', $id)
									->get()->toArray();
				$caId = $caId[0]->added_by;
				
				$caName = DB::table('users')
									->select(DB::raw('users.name'))
									->where('id', '=', $caId)
									->get();
				$array['caName'] = $caName[0]->name;
									
				$array['caid'] = $caId;
				//Get chat message from seller
				 $array['messages'] = DB::table('chat_messages')
									->where('c_qid', '=', $id)
									/* ->where( function($q) use ($caId)
											{
												$q->where(function($q2) use ($caId){
													$q2->where('from_user_id', Auth::user()->id)->Where('to_user_id', $caId);
												})->orWhere(function($q2) use ($caId){
													$q2->where('to_user_id', Auth::user()->id)->Where('from_user_id', $caId);
												});
											})  */
									
									 /* ->where([
										['from_user_id', '=', Auth::user()->id],
										['to_user_id', '=', $sellerId],
									])
									->orwhere([
										['from_user_id', '=', $sellerId],
										['to_user_id', '=', Auth::user()->id],
									])  */
									
									->get(); 
													
				//chat status set 0 to 1 
				$message_update = DB::table('chat_messages')
							->where('c_qid', '=', $id)
							->where( function($q) use ($caId)
									{
										$q->where(function($q2) use ($caId){
											$q2->where('to_user_id', Auth::user()->id)->Where('from_user_id', $caId);
										});
									}) 

							->update(
								 array(
										'status' => 1,
								 )
							);
				//chat status set 0 to 1

			$quotes = json_decode(json_encode($array));
			//echo "<pre>";print_r($quotes);exit;
			
			return view('pages.chat-response')->with([
				'quotes' =>$quotes,
				//'countQuote' =>$countQuote,
				'title' =>$title
			]); 
		}
		
		
    }
	
	//End chat

}
