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
use App\Company_profiles;
use App\Company_banks;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class CompanyProfileController extends Controller
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
		$userId = Auth::user()->id;
		$compDetails = DB::table('company_profiles')->where('userId', '=', $userId)->get();
		$compDetails = isset($compDetails[0])?$compDetails[0]:"";
		
		$bankDetails = DB::table('company_banks')->where('uid', '=', $userId)->get();
		$bankDetails = isset($bankDetails)?$bankDetails:[];
		//echo "<pre>";print_r($bankDetails);die;
		
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($compDetails->comp_bill_country)?$compDetails->comp_bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($compDetails->comp_bill_state)?$compDetails->comp_bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($compDetails->comp_ship_country)?$compDetails->comp_ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($compDetails->comp_ship_state)?$compDetails->comp_ship_state:0)->get();
		//echo "<pre>";print_r($states_bill);die;
		return view('pages.companyprofile')->with([
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'compDetails' => $compDetails,		
			'bankDetails' => $bankDetails		
		]); 
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
            'comp_name' => 'required|min:3',
            // 'comp_gst_no' => 'required',
            'comp_email' => 'required|email',
            'comp_phone' => 'required|min:10',
            'comp_pan_no' => 'required'			
        ]
		);
    }

    protected function create(array $data)
    {
		//print_r($data);exit;
        return Company_profiles::create([
            'userId' => Auth::user()->id,
			'gst_reg'=> $data['gst_reg'],
            'gst_no' => $data['gst_no'],
			'comp_tran_type' => $data['comp_tran_type'],
            'comp_name' => $data['comp_name'],
			'comp_type' => $data['comp_type'],
			'cin' => $data['cin'],
			'inc_date' => $data['inc_date'],
            'comp_email' => $data['comp_email'],
			'comp_phone' => $data['comp_phone'],
			'comp_tan' => $data['comp_tan'],
			'comp_pan_no' => $data['comp_pan_no'],
			'comp_website' => $data['comp_website'],
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     public function update_compdet(Request $request)  {  
		//print_r($request);exit;
        $validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
            
			$userId = Auth::user()->id;
			$dataCheck = DB::table('company_profiles')
							->select(DB::raw('company_profiles.id'))
							->where('userId','=',$userId)
							->get()->toArray();
			if(empty($dataCheck)){
				 $update = $this->create($request->all());
			}else{
				$update = DB::table('company_profiles')
					->where('userId', $userId)
					->update(
						 array(
								'gst_reg' => $request->gst_reg,
								'gst_no' => $request->gst_no,
								'comp_tran_type'=> $request->comp_tran_type,
								'comp_name' => $request->comp_name,
								'comp_type' => $request->comp_type,
								'cin' => $request->cin,
								'inc_date' => $request->inc_date,
								'comp_tan' => $request->comp_tan,
								'comp_email' => $request->comp_email,
								'comp_phone' => $request->comp_phone,
								'comp_pan_no' => $request->comp_pan_no,
								'comp_website' => $request->comp_website,
								
								'comp_bill_gst_no' => $request->comp_bill_gst_no,
								'comp_bill_name' => $request->comp_bill_name,
								'comp_bill_addone' => $request->comp_bill_addone,
								'comp_bill_addtwo' => $request->comp_bill_addtwo,
								'comp_bill_country' => $request->comp_bill_country,
								'comp_bill_state' => $request->comp_bill_state,
								'comp_bill_city' => $request->comp_bill_city,
								'comp_bill_pin' => $request->comp_bill_pin,
								
								'comp_ship_gst_no' => $request->comp_ship_gst_no,
								'comp_ship_name' => $request->comp_ship_name,
								'comp_ship_addone' => $request->comp_ship_addone,
								'comp_ship_addtwo' => $request->comp_ship_addtwo,
								'comp_ship_country' => $request->comp_ship_country,
								'comp_ship_state' => $request->comp_ship_state,
								'comp_ship_city' => $request->comp_ship_city,
								'comp_ship_pin' => $request->comp_ship_pin,
						 )
					);
			}						
			if ($update){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/'),
					'message' => 'Company details updated'
				);
				return response()->json($msg);	
					
			}
        }
    }
	
	//Company business details update
	
	protected function validator_businessdet(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
        return Validator::make($data, [
            'comp_nature' => 'required',
            'exact_comp_nature' => 'required',
            // 'turnover_last_year' => 'required',
            'start_date' => 'required',
        ]
		);
    }

    protected function create_businessdet(array $data)
    {
		//print_r($data);exit;
        return Company_profiles::create([
            'userId' => Auth::user()->id,
            'comp_nature' => $data['comp_nature'],
            'exact_comp_nature' => $data['exact_comp_nature'],
            'turnover_last_year' => $data['turnover_last_year'],
			'start_date'=> $data['start_date'],
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     public function update_businessdet(Request $request)  {  
        $validation = $this->validator_businessdet($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
            
			$userId = Auth::user()->id;
			$dataCheck = DB::table('company_profiles')
							->select(DB::raw('company_profiles.id'))
							->where('userId','=',$userId)
							->get()->toArray();
			if(empty($dataCheck)){
				 $update = $this->create_businessdet($request->all());
			}else{
				$update = DB::table('company_profiles')
					->where('userId', $userId)
					->update(
						 array(
								'comp_nature' => $request->comp_nature,
								'exact_comp_nature' => $request->exact_comp_nature,
								'turnover_last_year' => $request->turnover_last_year,
								'start_date'=> $request->start_date,
						 )
					);
			}						
			if ($update){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/'),
					'message' => 'Company business details updated'
				);
				return response()->json($msg);	
					
			}
        }
    }
	
	//Start update bank details
	
	protected function validator_bank(array $data)
    {
		echo "<pre>"; print_r($data);exit;
        
    }

    protected function create_bank(array $data)
    {
		echo "<pre>"; print_r($data);exit;
        
    }

     public function update_bankdet(Request $request)  {  
            
			
			$userId = Auth::user()->id;
			$bank_name = array_filter($request->bank_name);
			$bank_branch = array_filter($request->bank_branch);
			$bank_holder_name = array_filter($request->bank_holder_name);
			$ac_no = array_filter($request->ac_no);
			$ifsc_code = array_filter($request->ifsc_code);
			$ac_upid = array_filter($request->ac_upid);
			
			if(!empty($bank_name) && !empty($bank_branch) && !empty($bank_holder_name) && !empty($ac_no) && !empty($ifsc_code) )
			{
				$delBank = DB::table('company_banks')->where('uid', $userId)->delete();
				
				foreach ($bank_name as $index => $value) {
							
					$insertBank = DB::table('company_banks')->insertGetId([
									'uid' => $userId,
									'bank_name' => isset($bank_name[$index])?$bank_name[$index]:"",
									'bank_branch' => isset($bank_branch[$index])?$bank_branch[$index]:"",
									'bank_holder_name' => isset($bank_holder_name[$index])?$bank_holder_name[$index]:"",
									'ac_no' => isset($ac_no[$index])?$ac_no[$index]:"",
									'ifsc_code' => isset($ifsc_code[$index])?$ifsc_code[$index]:"",
									'ac_upid' => isset($ac_upid[$index])?$ac_upid[$index]:"",
									
								]);
				}
				if ($insertBank){
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/'),
						'message' => 'Bank details updated'
					);
					return response()->json($msg);	
				}
			}else{
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Enter all details for bank'
					);
					return response()->json($msg);	
			}
									
			

    }
	
	//Start update company attachment
	// protected function validator_attachment(array $data)
    // {
	// 	//echo "<pre>";print_r($data);exit;
	// 	$inc_certificate='';
	// 	$pan_doc='';
	// 	$gst_doc='';
	// 	$trade_doc='';
	// 	$pf_doc='';
	// 	$ptex_doc='';
	// 	$first_diraadh_doc='';
	// 	$firstpan_doc='';
	// 	$first_dirphoto_doc='';
	// 	$second_aadha_doc='';
	// 	$second_pan_doc='';
	// 	$second_dirphoto_doc='';
	// 	$other_logo_doc ='';
	// 	$signature_doc ='';
	// 	$stamp_doc ='';
		
	// 	if($data['inc_certificate'] =='' || $data['inc_certificate'] =='undefined')
	// 	{
	// 		$inc_certificate = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}
	// 	else{
	// 		$inc_certificate = '';
	// 	}

	// 	if($data['pan_doc'] =='' || $data['pan_doc'] =='undefined')
	// 	{
	// 		$pan_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}
	// 	else{
	// 		$pan_doc = '';
	// 	}

	// 	if($data['gst_doc'] =='' || $data['gst_doc'] =='undefined')
	// 	{
	// 		$gst_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$gst_doc = '';
	// 	}

	// 	if($data['trade_doc'] =='' || $data['trade_doc'] =='undefined')
	// 	{
	// 		$trade_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$trade_doc = '';
	// 	}

	// 	if($data['pf_doc'] =='' || $data['pf_doc'] =='undefined')
	// 	{
	// 		$pf_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$pf_doc = '';
	// 	}

	// 	if($data['ptex_doc'] =='' || $data['ptex_doc'] =='undefined')
	// 	{
	// 		$ptex_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$ptex_doc = '';
	// 	}

	// 	if($data['first_diraadh_doc'] =='' || $data['first_diraadh_doc'] =='undefined')
	// 	{
	// 		$first_diraadh_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$first_diraadh_doc = '';
	// 	}


	// 	if($data['firstpan_doc'] =='' || $data['firstpan_doc'] =='undefined')
	// 	{
	// 		$firstpan_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$firstpan_doc = '';
	// 	}

	// 	if($data['first_dirphoto_doc'] =='' || $data['first_dirphoto_doc'] =='undefined')
	// 	{
	// 		$first_dirphoto_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$first_dirphoto_doc = '';
	// 	}

	// 	if($data['second_aadha_doc'] =='' || $data['second_aadha_doc'] =='undefined')
	// 	{
	// 		$second_aadha_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$second_aadha_doc = '';
	// 	}
	// 	if($data['second_pan_doc'] =='' || $data['second_pan_doc'] =='undefined')
	// 	{
	// 		$second_pan_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$second_pan_doc = '';
	// 	}

	// 	if($data['second_dirphoto_doc'] =='' || $data['second_dirphoto_doc'] =='undefined')
	// 	{
	// 		$second_dirphoto_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$second_dirphoto_doc = '';
	// 	}
		
	// 	if($data['other_logo_doc'] =='' || $data['other_logo_doc'] =='undefined')
	// 	{
	// 		$other_logo_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$other_logo_doc = '';
	// 	}
	// 	if($data['signature_doc'] =='' || $data['signature_doc'] =='undefined')
	// 	{
	// 		$signature_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$signature_doc = '';
	// 	}
	// 	if($data['stamp_doc'] =='' || $data['stamp_doc'] =='undefined')
	// 	{
	// 		$stamp_doc = 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024';
	// 	}else{
	// 		$stamp_doc = '';
	// 	}
	// 	if($data['gstdocstate'] ==''){
	// 		return Validator::make($data, [

	// 			'inc_certificate'=> $inc_certificate,
	// 			'pan_doc'=> $pan_doc,
	// 			'gst_doc'=>$gst_doc,				
	// 			'trade_doc'=> $trade_doc,
	// 			'pf_doc'=> $pf_doc,
	// 			'ptex_doc'=> $ptex_doc,
	// 			'first_diraadh_doc'=> $first_diraadh_doc,
	// 			'firstpan_doc'=> $firstpan_doc,
	// 			'first_dirphoto_doc'=> $first_dirphoto_doc,
	// 			'second_aadha_doc'=> $second_aadha_doc,
	// 			'second_pan_doc'=> $second_pan_doc,
	// 			'second_dirphoto_doc'=> $second_dirphoto_doc,
	// 			'other_logo_doc' => $other_logo_doc,
	// 			'signature_doc' => $signature_doc,
	// 			'stamp_doc' => $stamp_doc,
				
				
	// 		]);
	// 	}else{
			
	// 		return Validator::make($data, [

	// 		]);
	// 	}
    // }

	protected function validator_attachment(array $data)
	{
		return Validator::make($data, [
			'inc_certificate' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'pan_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'gst_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'trade_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'pf_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'ptex_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'first_diraadh_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'firstpan_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'first_dirphoto_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'second_aadha_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'second_pan_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'second_dirphoto_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'other_logo_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'signature_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
			'stamp_doc' => 'image|mimes:jpeg,png,jpg,pdf,PDF|max:1024',
		]);
	}
	
	public function update_comp_attachment(Request $request)  {  
	
		//print_r($_FILES);		
		//$validation = $this->validator_attachment($request->all());
		// if ($validation->fails())  {  
        //     return response()->json($validation->errors()->toArray());
        // }
        // else{
				$userId = Auth::user()->id;
				$dataCheck = DB::table('company_profiles')
							->select(DB::raw('company_profiles.id,company_profiles.gst_doc'))
							->where('userId','=',$userId)
							->get()->toArray();
							
				if(empty($dataCheck)){
					 $msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/'),
						'message' => 'Please update company details'
					);
					return response()->json($msg);
				}else{
					
						if($file = $request->hasFile('inc_certificate')) {
						$file = $request->file('inc_certificate') ;
						
						$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName1);
						$inc_certificate = $fileName1 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							array(
									'inc_certificate' => $inc_certificate,
							)
						);
					}
					
					if($file = $request->hasFile('pan_doc')) {
						$file = $request->file('pan_doc') ;
						
						$fileName2 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName2);
						$pan_doc = $fileName2 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'pan_doc' => $pan_doc,
							 )
						);
					}
					if($file = $request->hasFile('gst_doc')) {
						$file = $request->file('gst_doc') ;
						
						$fileName3 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName3);
						$gst_doc = $fileName3 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'gst_doc' => $gst_doc,
							 )
						);
					}
					
					
					
					if($file = $request->hasFile('trade_doc')) {
						$file = $request->file('trade_doc') ;
						
						$fileName4 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName4);
						$trade_doc = $fileName4 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'trade_doc' => $trade_doc,
							 )
						);
					}

					if($file = $request->hasFile('pf_doc')) {
						$file = $request->file('pf_doc') ;
						
						$fileName5 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName5);
						$pf_doc = $fileName5 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'pf_doc' => $pf_doc,
							 )
						);
					}

					if($file = $request->hasFile('ptex_doc')) {
						$file = $request->file('ptex_doc') ;
						
						$fileName6 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName6);
						$ptex_doc = $fileName6 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'ptex_doc' => $ptex_doc,
							 )
						);
					}

					if($file = $request->hasFile('first_diraadh_doc')) {
						$file = $request->file('first_diraadh_doc') ;
						
						$fileName7 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName7);
						$first_diraadh_doc = $fileName7 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'first_diraadh_doc' => $first_diraadh_doc,
							 )
						);
					}

					if($file = $request->hasFile('firstpan_doc')) {
						$file = $request->file('firstpan_doc') ;
						
						$fileName8 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName8);
						$firstpan_doc = $fileName8 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'firstpan_doc' => $firstpan_doc,
							 )
						);
					}

					if($file = $request->hasFile('first_dirphoto_doc')) {
						$file = $request->file('first_dirphoto_doc') ;
						
						$fileName9 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName9);
						$first_dirphoto_doc = $fileName9 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'first_dirphoto_doc' => $first_dirphoto_doc,
							 )
						);
					}

					if($file = $request->hasFile('second_aadha_doc')) {
						$file = $request->file('second_aadha_doc') ;
						
						$fileName10 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName10);
						$second_aadha_doc = $fileName10 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'second_aadha_doc' => $second_aadha_doc,
							 )
						);
					}

					if($file = $request->hasFile('second_pan_doc')) {
						$file = $request->file('second_pan_doc') ;
						
						$fileName11 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName11);
						$second_pan_doc = $fileName11 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'second_pan_doc' => $second_pan_doc,
							 )
						);
					}

					if($file = $request->hasFile('second_dirphoto_doc')) {
						$file = $request->file('second_dirphoto_doc') ;
						
						$fileName12 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName12);
						$second_dirphoto_doc = $fileName12 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'second_dirphoto_doc' => $second_dirphoto_doc,
							 )
						);
					}


					if($file = $request->hasFile('other_logo_doc')) {
						$file = $request->file('other_logo_doc') ;
						
						$fileName13 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName13);
						$other_logo_doc = $fileName13 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'other_logo_doc' => $other_logo_doc,
							 )
						);
					}
					if($file = $request->hasFile('signature_doc')) {
						$file = $request->file('signature_doc') ;
						
						$fileName14 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName14);
						$signature_doc = $fileName14 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'signature_doc' => $signature_doc,
							 )
						);
					}
					if($file = $request->hasFile('stamp_doc')) {
						$file = $request->file('stamp_doc') ;
						
						$fileName15 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath1 = public_path().'/uploads/company-files' ;
						
						$file->move($destinationPath1,$fileName15);
						$stamp_doc = $fileName15 ;
						
						//Update file
						$update = DB::table('company_profiles')
						->where('userId', $userId)
						->update(
							 array(
									'stamp_doc' => $stamp_doc,
							 )
						);
					}
					
					//update chk_agree
					$update = DB::table('company_profiles')
							->where('userId', $userId)
							->update(
								 array(
										'chk_agree' => $request->chk_agree,
								 )
							);
							
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/'),
						'message' => 'Document successfully updated',
						'gstdocstate' => "gstdocstate"
					);
					return response()->json($msg);
					
				}
		
		//}
	
	}
	
	//Start update company profile
	protected function validator_profile(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		$comp_logo ='';
		
		if($data['comp_logo'] =='undefined')
		{
			$comp_logo = 'required|image|mimes:jpeg,png,jpg|max:1024';
		}
		else{
			$comp_logo = '';
		}
		
        return Validator::make($data, [
			
			'comp_logo' => $comp_logo,
        ]);
    }
	
	public function update_comp_logo(Request $request)  {  
	
		//print_r($_FILES);		
		$validation = $this->validator_profile($request->all());
		if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
				$userId = Auth::user()->id;
				$dataCheck = DB::table('company_profiles')
							->select(DB::raw('company_profiles.id'))
							->where('userId','=',$userId)
							->get()->toArray();
				if(empty($dataCheck)){
					if($file = $request->hasFile('comp_logo')) {
						$file = $request->file('comp_logo') ;
						
						$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
						$destinationPath_thumb = public_path().'/uploads/profile' ;
						
						$img = Image::make($file->getRealPath());
						$img->fit(243, 168, function ($constraint) {
							$constraint->aspectRatio();
						})->save($destinationPath_thumb.'/'.$fileName1);
						$comp_logo = $fileName1 ;
						
						//Insert logo file
						$insertLogo = Company_profiles::create([
									'userId' => Auth::user()->id,
									'comp_logo' => $comp_logo,
									'created_at' => date('Y-m-d H:i:s'),
								]);
					}
					if($insertLogo){
						$msg = array(
							'status' => 'success',
							'class' => 'succ',
							'redirect' => url('/'),
							'message' => 'Logo successfully updated',
							'image_name' => $comp_logo
						);
						return response()->json($msg);
					}else{
						$msg = array(
							'status' => 'error',
							'class' => 'err',
							'redirect' => url('/'),
							'message' => 'Logo update failed!'
						);
						return response()->json($msg);
					}
				}else{
					
						if($file = $request->hasFile('comp_logo')) {
							$file = $request->file('comp_logo') ;
							
							$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
							$destinationPath_thumb = public_path().'/uploads/profile' ;
							
							$img = Image::make($file->getRealPath());
							$img->fit(243, 168, function ($constraint) {
								$constraint->aspectRatio();
							})->save($destinationPath_thumb.'/'.$fileName1);
							$comp_logo = $fileName1 ;
							
							//Update file
							$update = DB::table('company_profiles')
							->where('userId', $userId)
							->update(
								 array(
										'comp_logo' => $comp_logo,
								 )
							);
						}
						
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/'),
						'message' => 'Logo successfully updated',
						'image_name' => $comp_logo
					);
					return response()->json($msg);
					
				}
		
		}
	
	}
	
	
	public function delete_comp_logo(Request $request)  {  
	
		$userId = Auth::user()->id;
		$dataCheck = DB::table('company_profiles')
					->select(DB::raw('company_profiles.id'))
					->where('userId','=',$userId)
					->get()->toArray();
		if(empty($dataCheck)){
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Please upload new Logo'
				);
				return response()->json($msg);
		}else{
			
			$update = DB::table('company_profiles')
				->where('userId', $userId)
				->update(
					 array(
							'comp_logo' => "",
					 )
				);
			
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Logo deleted successfully'
			);
			return response()->json($msg);
			
		}
	
	}
	
	public function getState(Request $request)
    {
		
		 $id = $request->id; 
					
			$result =State::query()
				   ->where('country_id', '=', $id) 
				   ->get()->toArray();
			
				$response = [];
		//echo "<pre>";print_r($result);exit;
		 foreach($result as $row){
		   $response[] = array("id"=>$row['id'], "name"=>$row['name']);
		}
		echo json_encode($response); 

    }
	
	public function getCity(Request $request)
    {
		
		  $id = $request->id; 
					
			$result =City::query()
				   ->where('state_id', '=', $id) 
				   ->get()->toArray();
			
				$response = [];
		//echo "<pre>";print_r($result);exit;
		 foreach($result as $row){
		   $response[] = array("id"=>$row['id'], "name"=>$row['name']);
		}
		echo json_encode($response); 
    }
	
	
}
