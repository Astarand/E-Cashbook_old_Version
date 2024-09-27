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
use App\Depertments;
use App\Designations;
use App\Employees;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class AdminEmployeeController extends Controller
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
    public function Index()
    {
		$title = 'Employees';
		$userId = Auth::user()->id;
		$employees = DB::table('users')
					->select(DB::raw('users.id,users.name,users.phone,users.status,users.u_type,employees.dept_id,employees.desig_id'))
					->leftJoin('employees', 'users.id', '=', 'employees.empId')
					->where('users.u_type','=',3) 
					->where('employees.added_by','=',$userId) 
					->orderBy('users.created_at','desc')->paginate(10);
					
		$employees_pagination = $employees;
		
		$array = array();
		foreach($employees as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['u_type'] = $val->u_type;
			$array[$val->id]['name'] = $val->name;
			$array[$val->id]['phone'] = $val->phone;
			$array[$val->id]['status'] = $val->status;
			
			$dept_name = Depertments::where('id', '=', $val->dept_id)->get();
			$array[$val->id]['dept_name'] = $dept_name[0]->dept_name;
			$desig_name = Designations::where('id', '=', $val->desig_id)->get();
			$array[$val->id]['desig_name'] = $desig_name[0]->designation_name;
		}
		$employees = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($employees);exit;
		return view('pages.superadmin.admin-employee')->with([
			'title' =>$title,
			'employees'=>$employees,
			'employees_pagination' =>$employees_pagination,
		]); 
    }
	
	public function getAdminDesignationOptions(Request $request)
    {
		
		$id = $request->id; 
		$response = [];
		if($id !="")
		{
			$deptCat = Depertments::query()
					->where('id', '=', $id) 
					->get()->toArray();
			$result = Designations::query()
					->where('dept_id', '=', $deptCat[0]['id']) 
					->get()->toArray();
			
			//echo "<pre>";print_r($result);exit;
			 foreach($result as $row){
			   $response[] = array("id"=>$row['id'], "name"=>$row['designation_name']);
			}
		}
		echo json_encode($response); 
    }

	public function AddAdminEmployee()
    {
		$countries = Country::where('id', '>', '0')->get();	
		$depts = Depertments::where('id', '>', '0')->get();	
		return view('pages.superadmin.addadminemployee')->with([
			'countries'=>$countries,
			'depts' => $depts
		]);
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'name' => 'required|min:3',
			'email' => 'required|email',
            'phone' => 'required|min:10',
            'password' => 'required',
			'dept_id' => 'required',
            'desig_id' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'qualification' => 'required',
            'c_addr_lineone' => 'required',
            'c_emp_country' => 'required',
            'c_emp_state' => 'required',
            'c_emp_city' => 'required',
            'c_emp_pincode' => 'required',
            'p_addr_lineone' => 'required',
            'p_emp_country' => 'required',
            'p_emp_state' => 'required',
            'p_emp_city' => 'required',
            'p_emp_pincode' => 'required',
            'basic_sal' => 'required',
            'hra' => 'required',
            'convayance' => 'required',
            'special_bonus' => 'required',
            'provident_fund' => 'required',
            'esi' => 'required',
            'loan' => 'required',
            'ptax' => 'required',
            'tds' => 'required',
            'total_deduction' => 'required',
            'total_addition' => 'required',
            'net_sal' => 'required',
            'net_sal_word' => 'required',
        ]
		);
    }
	
	protected function updateValidator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
			'name' => 'required|min:3',
			'email' => 'required|email',
            'phone' => 'required|min:10',
			'dept_id' => 'required',
            'desig_id' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'qualification' => 'required',
            'c_addr_lineone' => 'required',
            'c_emp_country' => 'required',
            'c_emp_state' => 'required',
            'c_emp_city' => 'required',
            'c_emp_pincode' => 'required',
            'p_addr_lineone' => 'required',
            'p_emp_country' => 'required',
            'p_emp_state' => 'required',
            'p_emp_city' => 'required',
            'p_emp_pincode' => 'required',
            'basic_sal' => 'required',
            'hra' => 'required',
            'convayance' => 'required',
            'special_bonus' => 'required',
            'provident_fund' => 'required',
            'esi' => 'required',
            'loan' => 'required',
            'ptax' => 'required',
            'tds' => 'required',
            'total_deduction' => 'required',
            'total_addition' => 'required',
            'net_sal' => 'required',
            'net_sal_word' => 'required',
        ]
		);
    }
	
	protected function createUser(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return User::create([
			'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'u_type' => 3,
            'password' => Hash::make($data['password']),
            'status' => 1,
            'userStatus' => 1,
            'isActive' => 1,
			'emp_permission' => implode(",",$data['emp_permission']),
        ]);
    }


	
	public function save_admin_employee(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		
		$emp_permission = ($request->emp_permission);
		
		if(empty($emp_permission) )
		{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Please set employee permission'
			);
			return response()->json($msg);	
		}
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			
			$user = User::where('email','=',$request->email)->get();
			$user = @$user[0];
			if(!empty($user))
			{
				$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Email already exists'
					);
					return response()->json($msg);	
			}
			$insertEmployee = $this->createUser($request->all());
			$empId = DB::getPdo()->lastInsertId();
			$added_by = Auth::user()->id;
			
			$emp = new Employees;
			$emp->added_by = $added_by;
			$emp->empId = $empId;
			$emp->dept_id = $request->dept_id;
			$emp->desig_id = $request->desig_id;
			$emp->dob = $request->dob;
			$emp->gender = $request->gender;
			$emp->qualification = $request->qualification;
			$emp->c_addr_lineone = $request->c_addr_lineone;
			$emp->c_addr_linetwo = isset($request->c_addr_linetwo)?$request->c_addr_linetwo:"";
			$emp->c_emp_country = $request->c_emp_country;
			$emp->c_emp_state = $request->c_emp_state;
			$emp->c_emp_city = $request->c_emp_city;
			$emp->c_emp_pincode = $request->c_emp_pincode;
			
			$emp->p_addr_lineone = $request->p_addr_lineone;
			$emp->p_addr_linetwo = isset($request->p_addr_linetwo)?$request->p_addr_linetwo:"";
			$emp->p_emp_country = $request->p_emp_country;
			$emp->p_emp_state = $request->p_emp_state;
			$emp->p_emp_city = $request->p_emp_city;
			$emp->p_emp_pincode = $request->p_emp_pincode;
			$emp->basic_sal = $request->basic_sal;
			$emp->hra = $request->hra;
			$emp->convayance = $request->convayance;
			$emp->special_bonus = $request->special_bonus;
			$emp->provident_fund = $request->provident_fund;
			$emp->esi = $request->esi;
			$emp->loan = $request->loan;
			$emp->ptax = $request->ptax;
			$emp->tds = $request->tds;
			$emp->total_deduction = $request->total_deduction;
			$emp->total_addition = $request->total_addition;
			$emp->net_sal = $request->net_sal;
			$emp->net_sal_word = $request->net_sal_word;
			$emp->save();
			
			if ($insertEmployee){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/admin-employee'),
					'message' => 'Employee added successfully'
				);
				return response()->json($msg);	
			}
			else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Enter all details for employee'
					);
					return response()->json($msg);	
			}
		}	
    }
	
	public function edit_admin_employee($empId)  {  
        
		$empId = base64_decode($empId);
		$userId = Auth::user()->id;
		$employee = DB::table('users')
					->select(DB::raw('users.*,employees.*'))
					->leftJoin('employees', 'users.id', '=', 'employees.empId')
					->where('users.u_type','=',3) 
					->where('employees.added_by','=',$userId)
					->get();

		$employee = $employee[0];
		$countries = Country::where('id', '>', '0')->get();
        $c_states = State::where('country_id', '=', $employee->c_emp_country)->get();
		$c_cities = City::where('state_id', '=', $employee->c_emp_state)->get();
		
		$p_states = State::where('country_id', '=', $employee->p_emp_country)->get();
		$p_cities = City::where('state_id', '=', $employee->p_emp_state)->get();
		
		$depts = Depertments::where('id', '>', '0')->get();	
		$desigs = Designations::where('dept_id', '=', $employee->dept_id)->get();

		 
		 
		 return view('pages.superadmin.edit-admin-employee')->with([
				'countries'=>$countries,
				'c_states'=>$c_states,
				'c_cities'=>$c_cities,
				'p_states'=>$p_states,
				'p_cities'=>$p_cities,
				'employee' => $employee,
				'depts' => $depts,
				'desigs' => $desigs,
				'empId' => $empId
			]); 
    }
	
	public function view_admin_employee($empId)  {  
        
		$empId = base64_decode($empId);
		$userId = Auth::user()->id;
		$employee = DB::table('users')
					->select(DB::raw('users.*,employees.*'))
					->leftJoin('employees', 'users.id', '=', 'employees.empId')
					->where('users.u_type','=',3) 
					->where('employees.added_by','=',$userId)
					->get();

		$employee = $employee[0];
		$countries = Country::where('id', '>', '0')->get();
        $c_states = State::where('country_id', '=', $employee->c_emp_country)->get();
		$c_cities = City::where('state_id', '=', $employee->c_emp_state)->get();
		
		$p_states = State::where('country_id', '=', $employee->p_emp_country)->get();
		$p_cities = City::where('state_id', '=', $employee->p_emp_state)->get();

		$depts = Depertments::where('id', '>', '0')->get();	
		$desigs = Designations::where('dept_id', '=', $employee->dept_id)->get();

		 return view('pages.superadmin.view-admin-employee')->with([
				'countries'=>$countries,
				'c_states'=>$c_states,
				'c_cities'=>$c_cities,
				'p_states'=>$p_states,
				'p_cities'=>$p_cities,
				'employee' => $employee,
				'depts' => $depts,
				'desigs' => $desigs,
				'empId' => $empId
			]); 
    }
	
	public function update_admin_employee(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$empId = $request->id;
		
		$emp_permission = ($request->emp_permission);
		
		if(empty($emp_permission) )
		{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Please set employee permission'
			);
			return response()->json($msg);	
		}
		
		$validation = $this->updateValidator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update employee
			if($request->password!= "" && ($request->password != $request->conf_password))
			{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Password not matched!'
				);
				return response()->json($msg);
			}
			else if($request->password!= "" && ($request->password == $request->conf_password))
			{
				$updateUser = DB::table('users')
					->where('id', $empId)
					->update(
						 array(
								'name' => $request->name,
								'phone' => $request->phone,
								'password' => Hash::make($request->password),
								'emp_permission' => implode(",",$request->emp_permission),
						 )
					);
			}else{
				$updateUser = DB::table('users')
					->where('id', $empId)
					->update(
						 array(
								'name' => $request->name,
								'phone' => $request->phone,
								'emp_permission' => implode(",",$request->emp_permission),
						 )
					);
			}		
			$update = DB::table('employees')
					->where('empId', $empId)
					->update(
						 array(
								'dept_id' => $request->dept_id,
								'desig_id' => $request->desig_id,
								'dob' => $request->dob,
								'gender' => $request->gender,
								'qualification' => $request->qualification,
								'c_addr_lineone' => $request->c_addr_lineone,
								'c_addr_linetwo' => isset($request->c_addr_linetwo)?$request->c_addr_linetwo:"",
								'c_emp_country' => $request->c_emp_country,
								'c_emp_state' => $request->c_emp_state,
								'c_emp_city' => $request->c_emp_city,
								'c_emp_pincode' => $request->c_emp_pincode,
								
								'p_addr_lineone' => $request->p_addr_lineone,
								'p_addr_linetwo' => isset($request->p_addr_linetwo)?$request->p_addr_linetwo:"",
								'p_emp_country' => $request->p_emp_country,
								'p_emp_state' => $request->p_emp_state,
								'p_emp_city' => $request->p_emp_city,
								'p_emp_pincode' => $request->p_emp_pincode,
								'basic_sal' => $request->basic_sal,
								'hra' => $request->hra,
								'convayance' => $request->convayance,
								'special_bonus' => $request->special_bonus,
								'provident_fund' => $request->provident_fund,
								'esi' => $request->esi,
								'loan' => $request->loan,
								'ptax' => $request->ptax,
								'tds' => $request->tds,
								'total_deduction' => $request->total_deduction,
								'total_addition' => $request->total_addition,
								'net_sal' => $request->net_sal,
								'net_sal_word' => $request->net_sal_word
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/admin-employee'),
				'message' => 'Record details updated'
			);
			return response()->json($msg);
		}	
    }
	
	//Activate employee
	public function changeAdminEmployeeStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/admin-employee'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	//Delete employee
	public function delAdminEmployee(Request $request)
    {
        $delUser = DB::table('users')->where('id', $request->id)->delete();
		$delEmployee = DB::table('employees')->where('empId', $request->id)->delete();
		if($delEmployee){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/admin-employee'),
				'message' => 'Employee deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/admin-employee'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
	public function add_admin_depertment(Request $request)  {  
            
		$dept_name = ($request->dept_name);
		if(empty($dept_name) )
		{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Please enter depertment'
			);
			return response()->json($msg);	
		}
		$deptData = Depertments::where('dept_name','=',$request->dept_name)->get();
		$deptData = @$deptData[0];
		if(!empty($deptData))
		{
			$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Depertment already exists'
				);
				return response()->json($msg);	
		}
		
		$dept = new Depertments;
		$dept->dept_name = $dept_name;
		$dept->save();
		
		$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Depertment added successfully'
			);
			return response()->json($msg);
    }
	
	public function add_admin_designation(Request $request)  {  
            
		$dept_id = ($request->dept_id);
		$designation_name = ($request->designation_name);
		if(empty($dept_id) || empty($designation_name) )
		{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Please enter required fields'
			);
			return response()->json($msg);	
		}
		$desigData = DB::table('designations')
						->where('dept_id', $dept_id)
						->where('designation_name', $designation_name)
						->get(); 
		$desigData = @$desigData[0];
		if(!empty($desigData))
		{
			$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Designation already exists'
				);
				return response()->json($msg);	
		}
		
		$desig = new Designations;
		$desig->dept_id = $dept_id;
		$desig->designation_name = $designation_name;
		$desig->save();
		
		$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Designation added successfully'
			);
			return response()->json($msg);
    }

}
