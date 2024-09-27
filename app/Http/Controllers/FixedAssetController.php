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
use App\Assets;
use App\Asset_vouchers;
use App\Asset_series;
use App\Vendor;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class FixedAssetController extends Controller
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
        //die('hhh');
        //$this->middleware('auth');
		$title = 'Assets';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$assets =  DB::table('assets')
							->select(DB::raw('assets.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'assets.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'assets.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$assets =  DB::table('assets')
							->select(DB::raw('assets.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'assets.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'assets.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			
			$assets =  DB::table('assets')
							// ->select(DB::raw('assets.*,company_profiles.comp_name'))
							// ->leftJoin('company_profiles', 'assets.added_by', '=', 'company_profiles.userId')
							->where('added_by', '=', $userId)
							->orderBy('id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$assets =  DB::table('assets')
							->select(DB::raw('assets.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'assets.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$assets_pagination = $assets;
		//echo "<pre>"; print_r($assets);exit;
		return view('pages.assets')->with([
			'title' =>$title,
			'assets'=>$assets,
			'assets_pagination' =>$assets_pagination,
		]); 
    }

    public function addFixedAsset()
    {
        //$this->middleware('auth');
        return view('pages.addasset')->with([

        ]);
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'date' => 'required',
				'asset_name' => 'required',
				'assetType' => 'required',
				'purchase_date' => 'required',
				'purchase_cost' => 'required',
				'purchase_by' => 'required',
				'purchase_date_audit' => 'required',
				
			]);
			
    }

	protected function create(array $data)
	{
		// Generate new asset ID (example format: Ast00001)
		//$lastAsset = Assets::latest()->first();
		
		$lastAsset = DB::table('assets')
				->orderBy('asset_id', 'desc')
				->first();

			if ($lastAsset) {
				// Extract the numeric part from the asset ID, assuming the ID format is 'astXXXXX'
				$lastId = intval(substr($lastAsset->asset_id, 3)); // Convert to integer to avoid issues with leading zeros
				// Increment the numeric part and format it with leading zeros
				$newId = 'ast' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
			} else {
				// Initial asset ID if no assets exist
				$newId = 'ast00001';
			}

		
	
		// Create new asset record
		return Assets::create([
			'asset_id' => $newId, // Assuming 'asset_id' is the column name for the asset ID
			'added_by' => Auth::user()->id,
			'date' => $data['date'],
			'asset_name' => $data['asset_name'],
			'assetType' => $data['assetType'],
			'tangible_assets' => $data['tangible_assets_data'],
			'assets_description' => $data['assets_description'],
			'purchase_date' => $data['purchase_date'],
			'purchase_cost' => $data['purchase_cost'],
			'shop_name' => $data['shop_name'],
			'invoice_number' => $data['invoice_number'],
			'serial_number' => $data['serial_number'],                      
			'location_for' => $data['location_for'],                      
			'department_for' => $data['department_for'],                      
			'warranty_information' => $data['warranty_information'],                      
			'maintenance_schedule' => $data['maintenance_schedule'],                      
			'insurance_details' => $data['insurance_details'],                      
			'purchase_by' => $data['purchase_by'],                      
			'purchase_date_audit' => $data['purchase_date_audit'],                      
			'approve_by' => $data['approve_by'],                      
			'approve_date' => $data['approve_date'],   
			'documentation' => isset($data['documentation']) ? $data['documentation'] : null,
			'attachment' => isset($data['attachment']) ? $data['attachment'] : null,                   
		]);
	}


		
		public function save_add_asset(Request $request) {
			// Validate input
			$validation = $this->validator($request->all());
			if ($validation->fails()) {
				return response()->json($validation->errors()->toArray());
			} else {
				// Handle file uploads
				$documentationPath = null;
				$documentationName = "";
				if ($request->hasFile('documentation')) {
					$documentationFile = $request->file('documentation');
					$documentationName = rand().'_'.time() . '_' . $documentationFile->getClientOriginalName();
					$documentationPath = $documentationFile->storeAs('uploads\assets', $documentationName, 'public');
				}
		
				$attachmentPath = null;
				
				$attachmentName="";
				if ($request->hasFile('attachment')) {
					$attachmentFile = $request->file('attachment');
					$attachmentName = rand().'_'.time() . '_' . $attachmentFile->getClientOriginalName();
					$attachmentPath = $attachmentFile->storeAs('uploads\assets', $attachmentName, 'public');
				}
		
				// Create asset with file paths
				$data = $request->all();
				$data['documentation'] = $documentationName;
				$data['attachment'] = $attachmentName;
		
				$insertAsset = $this->create($data);
				$projId = DB::getPdo()->lastInsertId();
		
				if ($insertAsset) {
					$msg = array(
						'status' => 'success',
						'class' => 'succ',
						'redirect' => url('/show-assets'),
						'message' => 'Asset added successfully'
					);
					return response()->json($msg);
				} else {
					$msg = array(
						'status' => 'error',
						'class' => 'err',
						'redirect' => url('/show-assets'),
						'message' => 'Asset add failed'
					);
					return response()->json($msg);
				}
			}
		}
	
	
	public function edit_asset($assetId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/assets');
		}
		$assetId = base64_decode($assetId);
		$asset = DB::table('assets')
								->where('id', '=', $assetId)
								->get();
		$asset = $asset[0];
		//echo "<pre>";print_r($asset);exit;
		return view('pages.edit-asset')->with([		
			'asset' => $asset,
			'assetId' => $assetId
		]); 
    }
	
	
	public function view_asset($assetId)  {  
 
		$assetId = base64_decode($assetId);
		$asset = DB::table('assets')
								->where('id', '=', $assetId)
								->get();
		$asset = $asset[0];
		//echo "<pre>";print_r($asset);exit;
		return view('pages.view-asset')->with([		
			'asset' => $asset,
			'assetId' => $assetId
		]); 
    }
	
	public function update_asset(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$assetId = $request->input('assetId');
		
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{

			
			//start update project
			$update = DB::table('assets')
					->where('id', $assetId)
					->update(array(
						'date' => $request->input('date'),
						'asset_name' => $request->input('asset_name'),
						'assetType' => $request->input('assetType'),
						'tangible_assets' => $request->input('tangible_assets'),
						'assets_description' => $request->input('assets_description'),
						'purchase_date' => $request->input('purchase_date'),
						'purchase_cost' => $request->input('purchase_cost'),
						'shop_name' => $request->input('shop_name'),
						'invoice_number' => $request->input('invoice_number'),
						'serial_number' => $request->input('serial_number'),
						'location_for' => $request->input('location_for'),
						'department_for' => $request->input('department_for'),
						'warranty_information' => $request->input('warranty_information'),
						'maintenance_schedule' => $request->input('maintenance_schedule'),
						'insurance_details' => $request->input('insurance_details'),
						'purchase_by' => $request->input('purchase_by'),
						'purchase_date_audit' => $request->input('purchase_date_audit'),
						'approve_by' => $request->input('approve_by'),
						'approve_date' => $request->input('approve_date'),
						'tangible_assets' => $request->input('tangible_assets_data')
					));

				if ($request->hasFile('documentation')) {
					$documentationFile = $request->file('documentation');
					$documentationName = rand().'_'.time() . '_' . $documentationFile->getClientOriginalName();
					$documentationPath = $documentationFile->storeAs('uploads\assets', $documentationName, 'public');

					$update = DB::table('assets')
							->where('id', $assetId)
							->update(array(
								'documentation' => $documentationName,
							));

				}
		
				$attachmentPath = null;
				if ($request->hasFile('attachment')) {
					$attachmentFile = $request->file('attachment');
					$attachmentName = rand().'_'.time() . '_' . $attachmentFile->getClientOriginalName();
					$attachmentPath = $attachmentFile->storeAs('uploads\assets', $attachmentName, 'public');
					$update = DB::table('assets')
							->where('id', $assetId)
							->update(array(
								'attachment' => $attachmentName,
							));
				}
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/show-assets'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function delAsset(Request $request)
    {
        $delAsset = DB::table('assets')->where('id', $request->id)->delete();
		if($delAsset){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/assets'),
				'message' => 'Asset deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/assets'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
    public function AssetVoucherIndex()
    {
		
		$title = 'Asset Vouchers';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$asset_vouchers =  DB::table('asset_vouchers')
							->select(DB::raw('asset_vouchers.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'asset_vouchers.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'asset_vouchers.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$asset_vouchers =  DB::table('asset_vouchers')
							->select(DB::raw('asset_vouchers.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'asset_vouchers.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'asset_vouchers.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$asset_vouchers =  DB::table('asset_vouchers')
							->select(DB::raw('asset_vouchers.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'asset_vouchers.added_by', '=', 'company_profiles.userId')
							->where('added_by', '=', $userId)
							->orderBy('id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$asset_vouchers =  DB::table('asset_vouchers')
							->select(DB::raw('asset_vouchers.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'asset_vouchers.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$asset_vouchers_pagination = $asset_vouchers;
		//echo "<pre>"; print_r($asset_vouchers);exit;
		$array = array();
		foreach($asset_vouchers as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['v_type'] = $val->v_type;
			$array[$val->id]['voucher_no'] = $val->voucher_no;
			$array[$val->id]['voucher_name'] = $val->voucher_name;
			$array[$val->id]['invoice_date'] = $val->invoice_date;
			$array[$val->id]['total_cost'] = $val->total_cost;

			if($val->series_id >0){
				$series = Asset_series::where('id', '=', $val->series_id)->get();
				$array[$val->id]['series_name'] = isset($series[0]->series_name)?$series[0]->series_name:"";
			}else{
				$array[$val->id]['series_name'] = "";
			} 
			if($val->vendor_id >0){
				$vendor = Vendor::where('id', '=', $val->vendor_id)->get();
				$array[$val->id]['vendor_name'] = isset($vendor[0]->vendor_name)?$vendor[0]->vendor_name:"";
			}else{
				$array[$val->id]['vendor_name'] = "";
			} 
		}
		
		$asset_vouchers = json_decode(json_encode($array));
			
		//echo "<pre>"; print_r($asset_vouchers);exit;
		return view('pages.asset-voucher')->with([
			'title' =>$title,
			'asset_vouchers'=>$asset_vouchers,
			'asset_vouchers_pagination' =>$asset_vouchers_pagination
		]); 
    }
    public function addAssetVoucher()
    {
        //$this->middleware('auth');
		$vendors = DB::table('vendors')
							->select(DB::raw('vendors.id,vendors.vendor_name'))
							//->where('uid','=',Auth::user()->id)
							->get()->toArray();
		$assetSeries = DB::table('asset_series')
							->select(DB::raw('asset_series.id,asset_series.series_name'))
							->get()->toArray();
        return view('pages.add-asset-voucher')->with([
			'vendors'=>$vendors,
			'assetSeries'=>$assetSeries
        ]);
    }
	
	protected function validator_voucher(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			return Validator::make($data, [
				'v_type' => 'required',
				'voucher_no' => 'required',
				'voucher_name' => 'required',
				// 'branch_name' => 'required',
				// 'series_id' => 'required',
				'invoice_date' => 'required',
				// 'vendor_id' => 'required',
				'inv_voucher_no' => 'required',
				'total_cost' => 'required'
			]);
			
    }

    protected function create_voucher(array $data)
    {
		//echo "<pre>";print_r($data);exit;
        return Asset_vouchers::create([
            'added_by' => Auth::user()->id,
            'v_type' => $data['v_type'],
            'branch_name' => $data['branch_name'],
            'voucher_no' => $data['voucher_no'],
            'voucher_name' => $data['voucher_name'],
            'branch_name' => $data['branch_name'],
            'series_id' => $data['series_id'],
            'invoice_date' => $data['invoice_date'],
            'vendor_id' => $data['vendor_id'],
            'inv_voucher_no' => $data['inv_voucher_no'],
            'total_cost' => $data['total_cost'],                                           
			'warranty_information' => date('Y-m-d H:i:s'),
			'warranty_information' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_add_voucher(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validator_voucher($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertAssetVoucher = $this->create_voucher($request->all());
			$projId = DB::getPdo()->lastInsertId();
			
			if ($insertAssetVoucher){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/asset-voucher'),
					'message' => 'Asset voucher added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Asset voucher add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_asset_voucher($vId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/asset-voucher');
		}
		$vId = base64_decode($vId);
		$assetvoucher = DB::table('asset_vouchers')
								->where('id', '=', $vId)
								->get();
		$assetvoucher = $assetvoucher[0];
		$vendors = DB::table('vendors')
							->select(DB::raw('vendors.id,vendors.vendor_name'))
							//->where('uid','=',Auth::user()->id)
							->get()->toArray();
		$assetSeries = DB::table('asset_series')
							->select(DB::raw('asset_series.id,asset_series.series_name'))
							->get()->toArray();
		//echo "<pre>";print_r($assetvoucher);exit;
		return view('pages.edit-asset-voucher')->with([		
			'assetvoucher' => $assetvoucher,
			'vendors'=>$vendors,
			'assetSeries'=>$assetSeries,
			'vId' => $vId
		]); 
    }
	
	public function view_asset_voucher($vId)  {  

		$vId = base64_decode($vId);
		$assetvoucher = DB::table('asset_vouchers')
								->where('id', '=', $vId)
								->get();
		$assetvoucher = $assetvoucher[0];
		$vendors = DB::table('vendors')
							->select(DB::raw('vendors.id,vendors.vendor_name'))
							//->where('uid','=',Auth::user()->id)
							->get()->toArray();
		$assetSeries = DB::table('asset_series')
							->select(DB::raw('asset_series.id,asset_series.series_name'))
							->get()->toArray();
		//echo "<pre>";print_r($assetvoucher);exit;
		return view('pages.view-asset-voucher')->with([		
			'assetvoucher' => $assetvoucher,
			'vendors'=>$vendors,
			'assetSeries'=>$assetSeries,
			'vId' => $vId
		]); 
    }
	
	public function update_voucher(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$vId = $request->id;
		
		$validation = $this->validator_voucher($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update project
			$update = DB::table('asset_vouchers')
					->where('id', $vId)
					->update(
						 array(
								'v_type' => $request->v_type,
								'voucher_no' => $request->voucher_no,
								'voucher_name' => $request->voucher_name,
								'branch_name' => $request->branch_name,
								'series_id' => $request->series_id,
								'invoice_date' => $request->invoice_date,
								'vendor_id' => $request->vendor_id,
								'inv_voucher_no' => $request->inv_voucher_no,
								'total_cost' => $request->total_cost
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/asset-voucher'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function delAssetVoucher(Request $request)
    {
        $delAssetVoucher = DB::table('asset_vouchers')->where('id', $request->id)->delete();
		if($delAssetVoucher){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/asset-voucher'),
				'message' => 'Asset voucher deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/asset-voucher'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
	//Adde series
	
	protected function create_series(array $data)
    {
        return  Asset_series ::create([
            'series_name' => $data['series_name'],                                           
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_add_series_name(Request $request)  
	{  
		$Series = DB::table('asset_series')
								->where('series_name', '=', $request->series_name)
								->get();
		if(sizeof($Series) == 0)
		{			
			$insertSeries = $this->create_series($request->all());
			if ($insertSeries){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/'),
					'message' => 'Series added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Series add failed'
				);
				return response()->json($msg);	
			}
		}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Series already exists!'
				);
				return response()->json($msg);
		}

    }

}
