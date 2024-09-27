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
use App\Projects;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class ProjectController extends Controller
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
		//return view('pages.project')->with([
				
		//]); 
		$title = 'Projects';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$projects =  DB::table('projects')
							->select(DB::raw('projects.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'projects.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'projects.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$projects =  DB::table('projects')
							->select(DB::raw('projects.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'projects.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'projects.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$projects =  DB::table('projects')
							->select(DB::raw('projects.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'projects.added_by', '=', 'company_profiles.userId')
							->where('added_by', '=', $userId)
							->orderBy('id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$projects =  DB::table('projects')
							->select(DB::raw('projects.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'projects.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$projects_pagination = $projects;
		//echo "<pre>"; print_r($projects);exit;
		return view('pages.project')->with([
			'title' =>$title,
			'projects'=>$projects,
			'projects_pagination' =>$projects_pagination,
		]); 
    }
    public function addproject()
    {
		//$this->middleware('auth'); 
		return view('pages.addproject')->with([
				
		]); 
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'proj_name' => 'required',
				'proj_cat' => 'required',
				'proj_status' => 'required',
				'client_name' => 'required',
				'client_contact' => 'required',
				'client_email' => 'required',
				'proj_start_date' => 'required',
				
				'proj_cost' => 'required',
				'proj_details' => 'required',
			]);
			
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Projects::create([
            'added_by' => Auth::user()->id,
            'proj_name' => $data['proj_name'],
            'proj_cat' => $data['proj_cat'],
            'proj_status' => $data['proj_status'],
            'client_name' => $data['client_name'],
            'client_contact' => $data['client_contact'],
            'client_email' => $data['client_email'],
            'proj_start_date' => $data['proj_start_date'],
            'proj_end_date' => $data['proj_end_date'],
            'proj_cost' => $data['proj_cost'],
            'proj_details' => $data['proj_details'],                      
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_add_project(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertProject = $this->create($request->all());
			$projId = DB::getPdo()->lastInsertId();
			
			if ($insertProject){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/projects'),
					'message' => 'Project added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Project add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_project($projId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/projects');
		}
		$projId = base64_decode($projId);
		$project = DB::table('projects')
								->where('id', '=', $projId)
								->get();
		$project = $project[0];
		//echo "<pre>";print_r($project);exit;
		return view('pages.edit-project')->with([		
			'project' => $project,
			'projId' => $projId
		]); 
    }
	
	public function view_project($projId)  {  
        
		$projId = base64_decode($projId);
		$project = DB::table('projects')
								->where('id', '=', $projId)
								->get();
		$project = $project[0];
		//echo "<pre>";print_r($project);exit;
		return view('pages.view-project')->with([		
			'project' => $project,
			'projId' => $projId
		]); 
    }
	
	public function update_project(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$projId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			$update = DB::table('projects')
					->where('id', $projId)
					->update(
						 array(
								'proj_name' => $request->proj_name,
								'proj_cat' => $request->proj_cat,
								'proj_status' => $request->proj_status,
								'client_name' => $request->client_name,
								'client_contact' => $request->client_contact,
								'client_email' => $request->client_email,
								'proj_start_date' => $request->proj_start_date,
								'proj_end_date' => $request->proj_end_date,
								'proj_cost' => $request->proj_cost,
								'proj_details' => $request->proj_details
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/projects'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	//Activate Project
	public function changeProjectStatus(Request $request)
    {
        $user = Projects::find($request->id);
        $user->proj_status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/projects'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	public function delProject(Request $request)
    {
        $delProject = DB::table('projects')->where('id', $request->id)->delete();
		if($delProject){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/projects'),
				'message' => 'Project deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/projects'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
}
