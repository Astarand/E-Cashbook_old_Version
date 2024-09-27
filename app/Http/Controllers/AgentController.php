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

class AgentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function Index()
    {
        $title = 'Agents';
		$userId = Auth::user()->id;
		$agents = DB::table('busi_agents')->where('added_by', '=', $userId)->orderBy('id', 'DESC')->paginate(10);
		$agents_pagination = $agents;
        return view('pages.ca.agent')->with([
			'title' =>$title,
			'agents'=>$agents,
			'agents_pagination' =>$agents_pagination,
        ]);
    }
    public function AddAgent()
    {
        $countries = Country::where('id', '>', '0')->get();	
        return view('pages.ca.addagent')->with([
			'countries'=>$countries,
        ]);
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'agent_name' => 'required|min:3',
			'agent_email' => 'required|email',
			'agent_phone' => 'required|min:10',
            'agent_whats_no' => 'required|min:10',
        ]
		);
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Busi_agents::create([
            'added_by' => Auth::user()->id,
            'agent_id' => '',
            'agent_name' => $data['agent_name'],
            'agent_email' => $data['agent_email'],
            'agent_phone' => $data['agent_phone'],
            'agent_whats_no' => $data['agent_whats_no'],
            'company_name' => isset($data['company_name'])?$data['company_name']:"",
			'company_website' => isset($data['company_website'])?$data['company_website']:"",
			
			'address_lineone' => isset($data['address_lineone'])?$data['address_lineone']:"",
			'address_linetwo' => isset($data['address_linetwo'])?$data['address_linetwo']:"",
			'agent_country' => $data['agent_country'],
			'agent_state' => $data['agent_state'],
			'agent_city' => $data['agent_city'],
			'agent_pincode' => $data['agent_pincode'],
			'status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_agent(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$agent = Busi_agents::where('agent_email','=',$request->agent_email)->get();
			$agent = @$agent[0];
			if(!empty($agent))
			{
				$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Email already exists'
					);
					return response()->json($msg);	
			}
			$insertAgent = $this->create($request->all());
			$agentId = DB::getPdo()->lastInsertId();		

			$update = DB::table('busi_agents')
				->where('id', $agentId)
				->update(
					 array(
							'agent_id' => str_pad($agentId, 8, '0', STR_PAD_LEFT),
					 )
				);
			
			if ($insertAgent){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/agent'),
					'message' => 'Agent added successfully'
				);
				return response()->json($msg);	
			}
			else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Enter all details for agent'
					);
					return response()->json($msg);	
			}
		}	
    }
	
	public function edit_agent($agentId)  {  
        
		$agentId = base64_decode($agentId);
		$agent = DB::table('busi_agents')
								->where('id', '=', $agentId)
								->get();

		$agent = $agent[0];
		$countries = Country::where('id', '>', '0')->get();
        $states = State::where('country_id', '=', $agent->agent_country)->get();
		$cities = City::where('state_id', '=', $agent->agent_state)->get();

		 
		 
		 return view('pages.ca.edit-agent')->with([
				'countries'=>$countries,
				'states'=>$states,
				'cities'=>$cities,
				'agent' => $agent,		
				'agentId' => $agentId
			]); 
    }
	
	public function update_agent(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$agentId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update agent
			$update = DB::table('busi_agents')
					->where('id', $agentId)
					->update(
						 array(
								'agent_name' => $request->agent_name,
								'agent_email' => $request->agent_email,
								'agent_phone' => $request->agent_phone,
								'agent_whats_no' => $request->agent_whats_no,
								'company_name' => isset($request->company_name)?$request->company_name:"",
								'company_website' => isset($request->company_website)?$request->company_website:"",
								
								'address_lineone' => isset($request->address_lineone)?$request->address_lineone:"",
								'address_linetwo' => isset($request->address_linetwo)?$request->address_linetwo:"",
								'agent_country' => $request->agent_country,
								'agent_state' => $request->agent_state,
								'agent_city' => $request->agent_city,
								'agent_pincode' => $request->agent_pincode,
						 )
					);
			if ($update){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/agent'),
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
	
	//Activate agent
	public function changeAgentStatus(Request $request)
    {
        $user = Busi_agents::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/agent'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	//Delete agent
	public function delAgent(Request $request)
    {
        $delCust = DB::table('busi_agents')->where('id', $request->id)->delete();
		if($delCust){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/agent'),
				'message' => 'Agent deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/agent'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
    public function AgentDetails($agentId)
    {
        $agentId = base64_decode($agentId);
		
		if(Auth::user()->u_type ==2){
			return redirect('/');
		}
		$agent = DB::table('busi_agents')
					->select(DB::raw('busi_agents.*'))
					->where('busi_agents.id','=',$agentId)
					->get();
		$agent = $agent[0];
		
		$customers = DB::table('users')
					->select(DB::raw('users.*,ca_assigns.ca_assign_status,ca_assigns.ca_current_status,
					company_profiles.comp_logo,company_profiles.comp_name,company_profiles.comp_bill_addone,
					company_profiles.comp_bill_country,company_profiles.comp_bill_state,
					company_profiles.comp_bill_city,company_profiles.comp_bill_pin'))
					->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
					->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
					->where('users.u_type','=',2) 
					->where('ca_assigns.ca_assign_status','=',1)
					//->where('ca_assigns.ca_current_status','!=',0)
					->where('users.ca_add_by', '=', Auth::user()->id)
					->orderBy('created_at','desc')->paginate(10);
		
		//echo "<pre>"; print_r($customers);exit;			
		$customers_pagination = $customers;
		//echo "<pre>"; print_r($customers);exit;
		
		$array = array();
		foreach($customers as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['u_type'] = $val->u_type;
			$array[$val->id]['ca_add_by'] = $val->ca_add_by;
			$array[$val->id]['name'] = $val->name;
			$array[$val->id]['email'] = $val->email;
			$array[$val->id]['phone'] = $val->phone;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['comp_logo'] = $val->comp_logo;
			$array[$val->id]['comp_bill_addone'] = isset($val->comp_bill_addone)?$val->comp_bill_addone:"";
			$array[$val->id]['comp_bill_pin'] = isset($val->comp_bill_pin)?$val->comp_bill_pin:"";
			$array[$val->id]['created_at'] = $val->created_at;
			$array[$val->id]['ca_assign_status'] = $val->ca_assign_status;
			$array[$val->id]['ca_current_status'] = $val->ca_current_status;
		}
		$customers = json_decode(json_encode($array));
		//echo "<pre>";print_r($customers);exit;
        return view('pages.ca.agent-view')->with([
			'agent' =>$agent,
			'customers' => $customers,
			'customers_pagination' => $customers_pagination
        ]);
    }
}
