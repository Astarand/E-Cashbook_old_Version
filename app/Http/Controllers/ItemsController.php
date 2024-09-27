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
use App\Items;
use App\Item_unit_logs;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class ItemsController extends Controller
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
		$title = 'Items';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$items =  DB::table('items')
							->select(DB::raw('items.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'items.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'items.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('item_date', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca-employee
			$items =  DB::table('items')
							->select(DB::raw('items.*,company_profiles.comp_name,ca_assigns.ca_id,users.id as uid'))
							->leftJoin('company_profiles', 'items.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'items.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('item_date', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$items =  DB::table('items')
							->select(DB::raw('items.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'items.added_by', '=', 'company_profiles.userId')
							->where('added_by', '=', $userId)
							->orderBy('item_date', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$items =  DB::table('items')
							->select(DB::raw('items.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'items.added_by', '=', 'company_profiles.userId')
							->orderBy('item_date', 'DESC')->paginate(10);
		}
		$items_pagination = $items;
		//echo "<pre>"; print_r($items);exit;
		return view('pages.items')->with([
			'title' =>$title,
			'items'=>$items,
			'items_pagination' =>$items_pagination,
		]); 
    }
	
	public function item_history($itemId)
    {
		$itemId = base64_decode($itemId);
		$title = 'Items';
		$userId = Auth::user()->id;
		$itemsLogs =  DB::table('item_unit_logs')
							->select(DB::raw('item_unit_logs.*'))
							->where('item_unit_logs.itemId', '=', $itemId)
							->orderBy('item_unit_logs.id', 'DESC')->paginate(10);
		$items_pagination = $itemsLogs;
		//echo "<pre>"; print_r($itemsLogs);exit;
		return view('pages.item-history')->with([
			'items'=>$itemsLogs,
			'items_pagination' =>$items_pagination,
		]); 
    }
	
	public function additem()
    {
		//$this->middleware('auth'); 
		return view('pages.additem')->with([
				
		]); 
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		if($data['item_type'] =="manufacturing"){
			return Validator::make($data, [
				'item_type' => 'required',
				'item_name' => 'required',
				'hsn_code' => 'required',
				// 'opening_stock_bal' => 'required',
				// 'item_bill_no' => 'required',
				// 'item_actual_no' => 'required',
				// 'item_date' => 'required',
				// 'selling_price' => 'required',
				// 'purchase_price' => 'required',
				// 'disc_sell' => 'required',
				//'min_wholesale_quantity' => 'required'
			]);
		}
		else if($data['item_type'] =="reseller"){
			return Validator::make($data, [
				'item_type' => 'required',
				'item_name' => 'required',
				'hsn_code' => 'required',
				// 'opening_stock_bal' => 'required',
				// 'item_bill_no' => 'required',
				// 'item_actual_no' => 'required',
				// 'item_date' => 'required',
				// 'selling_price' => 'required',
				// 'purchase_price' => 'required',
				// 'disc_sell' => 'required',
				// 'min_wholesale_quantity' => 'required'
			]);
		}else if($data['item_type'] =="service"){
			return Validator::make($data, [
				'item_type' => 'required',
				'item_name' => 'required',
				'sac_code' => 'required',
				// 'opening_stock_bal' => 'required',
				// 'item_bill_no' => 'required',
				// 'item_actual_no' => 'required',
				// 'item_date' => 'required',
				// 'selling_price' => 'required',
				// 'purchase_price' => 'required',
				// 'disc_sell' => 'required',
				// 'min_wholesale_quantity' => 'required'
			]);
		}
			
    }
	

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		if($data['base_unit'] == 'Other'){
			$baseUnitOther = $data['base_unit_other'];
		}else{
			$baseUnitOther = "";
		}
		if($data['item_type'] == "manufacturing")
		{
			//start for opening stock
			if($data['opening_stock'] !=""){
				$data['opening_stock'] = str_replace(" ","-",$data['opening_stock']);
				$openingStock_array = array_values(array_filter(explode(",",$data['opening_stock'])));
				$openingStockAmt_array = array_values(array_filter(explode(",",$data['opening_stock_amt'])));
				$openingStockAmt_temp = array();
			
				foreach($openingStock_array as $k=>$v){
					$openingStockAmt_temp[$v] = isset($openingStockAmt_array[$k])?$openingStockAmt_array[$k]:0;
				}
				$openingStock = json_encode($openingStock_array);
				$openingStockAmt = json_encode($openingStockAmt_temp);
			}else{
				$openingStock = "";
				$openingStockAmt = "";
			}
			
			
			//start for purchase stock
			if($data['purchase_stock'] !=""){
				$data['purchase_stock'] = str_replace(" ","-",$data['purchase_stock']);
				$purchaseStock_array = array_values(array_filter(explode(",",$data['purchase_stock'])));
				$purchaseStockAmt_array = array_values(array_filter(explode(",",$data['purchase_stock_amt'])));
				$purchaseStockAmt_temp = array();
			
				foreach($purchaseStock_array as $k=>$v){
					$purchaseStockAmt_temp[$v] = isset($purchaseStockAmt_array[$k])?$purchaseStockAmt_array[$k]:0;
				}
				$purchaseStock = json_encode($purchaseStock_array);
				$purchaseStockAmt = json_encode($purchaseStockAmt_temp);
			}else{
				$purchaseStock = "";
				$purchaseStockAmt = "";
			}
			
			
			//start for closing stock
			if($data['closing_stock'] !=""){
				$data['closing_stock'] = str_replace(" ","-",$data['closing_stock']);
				$closingStock_array = array_values(array_filter(explode(",",$data['closing_stock'])));
				$closingStockAmt_array = array_values(array_filter(explode(",",$data['closing_stock_amt'])));
				$closingStockAmt_temp = array();
			
				foreach($closingStock_array as $k=>$v){
					$closingStockAmt_temp[$v] = isset($closingStockAmt_array[$k])?$closingStockAmt_array[$k]:0;
				}
				$closingStock = json_encode($closingStock_array);
				$closingStockAmt = json_encode($closingStockAmt_temp);
			}else{
				$closingStock = "";
				$closingStockAmt = "";
			}
			
			$resellerStock = "";
			$resellerStockAmt = "";
		}
		else if($data['item_type'] == "reseller") //start for reseller stock
		{
			if($data['reseller_stock'] !=""){
				$data['reseller_stock'] = str_replace(" ","-",$data['reseller_stock']);
				$resellerStock_array = array_values(array_filter(explode(",",$data['reseller_stock'])));
				$resellerStockAmt_array = array_values(array_filter(explode(",",$data['reseller_stock_amt'])));
				$resellerStockAmt_temp = array();
			
				foreach($resellerStock_array as $k=>$v){
					$resellerStockAmt_temp[$v] = isset($resellerStockAmt_array[$k])?$resellerStockAmt_array[$k]:0;
				}
				$resellerStock = json_encode($resellerStock_array);
				$resellerStockAmt = json_encode($resellerStockAmt_temp);
			}else{
				$resellerStock = "";
				$resellerStockAmt = "";
			}
		
			$openingStock = "";
			$openingStockAmt = "";
			$purchaseStock = "";
			$purchaseStockAmt = "";
			$closingStock = "";
			$closingStockAmt = "";
		}
		else{
			$openingStock = "";
			$openingStockAmt = "";
			$purchaseStock = "";
			$purchaseStockAmt = "";
			$closingStock = "";
			$closingStockAmt = "";
			$resellerStock = "";
			$resellerStockAmt = "";
		}
		//echo "<pre>";print_r($openingStock);//exit;
		//echo "<pre>";print_r($openingStockAmt);exit;
        // return Items::create([
        $item =  Items::create([
            'added_by' => Auth::user()->id,
            'item_type' => $data['item_type'],
            'item_name' => $data['item_name'],
            'base_unit' => isset($data['base_unit'])?$data['base_unit']:"",
            'sec_unit' => isset($data['sec_unit'])?$data['sec_unit']:"",
			'base_unit_other' => $baseUnitOther,
			'sac_code' => ($data['sac_code'] && ($data['item_type']=='service'))?$data['sac_code']:"",
            'hsn_code' => ($data['hsn_code'] && $data['item_type']!='service')?$data['hsn_code']:"",
            'opening_stock_bal' => isset($data['opening_stock_bal'])?$data['opening_stock_bal']:0,
            'opening_stock' => $openingStock,
            'opening_stock_amt' => $openingStockAmt,
			'purchase_stock' => $purchaseStock,
            'purchase_stock_amt' => $purchaseStockAmt,
            'closing_stock' => $closingStock,
            'closing_stock_amt' => $closingStockAmt,
            'reseller_stock' => $resellerStock,
            'reseller_stock_amt' => $resellerStockAmt,
			/*'opening_stock_name' => isset($data['opening_stock_name'])?$data['opening_stock_name']:"",
			'op_stock_oth_amt' => isset($data['op_stock_oth_amt'])?$data['op_stock_oth_amt']:0,
			'purchase_stock_name' => isset($data['purchase_stock_name'])?$data['purchase_stock_name']:"",
			'pu_stock_oth_amt' => isset($data['pu_stock_oth_amt'])?$data['pu_stock_oth_amt']:0,
			'closing_stock_name' => isset($data['closing_stock_name'])?$data['closing_stock_name']:"",
			'cl_stock_oth_amt' => isset($data['cl_stock_oth_amt'])?$data['cl_stock_oth_amt']:0,
			'reseller_stock_name' => isset($data['reseller_stock_name'])?$data['reseller_stock_name']:"",
			're_stock_oth_amt' => isset($data['re_stock_oth_amt'])?$data['re_stock_oth_amt']:0,*/
			'item_bill_no' => $data['item_bill_no'],
            'item_actual_no' => $data['item_actual_no'],
            'item_date' => isset($data['item_date'])?$data['item_date']:date('Y-m-d'),
            'selling_price' => $data['selling_price'],
            'selling_tax' => $data['selling_tax'],
            'wholesale_price' => isset($data['wholesale_price'])?$data['wholesale_price']:"",
            'wholesale_tax' => $data['wholesale_tax'],
            'purchase_price' => $data['purchase_price'],
            'purchase_tax' => $data['purchase_tax'],
            'disc_sell' => isset($data['disc_sell'])?$data['disc_sell']:"",
            'disc_sell_type' => $data['disc_sell_type'],
            'min_wholesale_quantity' => isset($data['min_wholesale_quantity'])?$data['min_wholesale_quantity']:"",
            'item_tax' => isset($data['item_tax'])?$data['item_tax']:"",
            'prod_desc' => isset($data['prod_desc'])?$data['prod_desc']:"",
            'prod_image' => isset($data['prod_image'])?$data['prod_image']:"",            
			'created_at' => date('Y-m-d H:i:s'),
        ]);
			$formattedItemId = 'PID-' . str_pad($item->id, 6, '0', STR_PAD_LEFT);

			// Update the item with the formatted item_id
			$item->item_id = $formattedItemId;
			$item->save();

			return $item;
    }

     
	
	public function save_add_item(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertItem = $this->create($request->all());
			$itemId = DB::getPdo()->lastInsertId();
			$item_base_unit = isset($request->base_unit)?$request->base_unit:"";
			$item_sec_unit = isset($request->sec_unit)?$request->sec_unit:"";
			$item_unit_other = isset($request->base_unit_other)?$request->base_unit_other:"";
			$values = array('itemId' => $itemId,'item_base_unit' => $item_base_unit,'item_sec_unit' => $item_sec_unit,'item_unit_other'=>$item_unit_other);
			DB::table('item_unit_logs')->insert($values);
			//update prod_image
			$arr = [];
			if ($request->totalImages > 0) {
				for($i=0; $i < $request->totalImages; $i++){
					if ($request->hasFile('prod_image' . $i)) {
							$file = $request->file('prod_image' . $i); 
							$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
							$destinationPath1 = public_path().'/uploads/items-image' ;
							$file->move($destinationPath1,$fileName);
							$arr[] = $fileName;
						
						$image = implode(",", $arr);
					}
				}
			}
			else{
					$image = '';
			}
			
			if ($insertItem){
				$updateImage = DB::table('items')
							->where('id', $itemId)
							->update(
								 array(
										'prod_image' => $image, 
								 )
							);
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/items'),
					'message' => 'Item added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Item add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_item($itemId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/items');
		}
		$itemId = base64_decode($itemId);
		$item = DB::table('items')
								->where('id', '=', $itemId)
								->get();
		$item = $item[0];
		//echo "<pre>";print_r($item);exit;
		return view('pages.edit-item')->with([		
			'item' => $item,
			'itemId' => $itemId
		]); 
    }
	
	public function view_item($itemId)  {  
        
		$itemId = base64_decode($itemId);
		$item = DB::table('items')
								->where('id', '=', $itemId)
								->get();
		$item = $item[0];
		//echo "<pre>";print_r($item);exit;
		return view('pages.view-item')->with([		
			'item' => $item,
			'itemId' => $itemId
		]); 
    }
	
	public function update_item(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$itemId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update item
			$arr = [];
			if ($request->totalImages > 0) {
				for($i=0; $i < $request->totalImages; $i++){
					if ($request->hasFile('prod_image' . $i)) {
							$file = $request->file('prod_image' . $i); 
							$fileName = date("YmdHis") . '-' . $file->getClientOriginalName() ;
							$destinationPath1 = public_path().'/uploads/items-image' ;
							$file->move($destinationPath1,$fileName);
							$arr[] = $fileName;
						
						$image = implode(",", $arr);
					}
				}
				$updateImage = DB::table('items')
							->where('id', $itemId)
							->update(
								 array(
									'prod_image' => $image, 
								 )
							);
			}
			
			
			if($request->base_unit == 'Other'){
				$baseUnitOther = $request->base_unit_other;
			}else{
				$baseUnitOther = "";
			}
			
			if($request->item_type == "manufacturing")
			{
				//start for opening stock
				if($request->opening_stock !=""){
					$openingStock_array = array_values(array_filter(explode(",",$request->opening_stock)));
					$openingStockAmt_array = array_values(array_filter(explode(",",$request->opening_stock_amt)));
					$openingStockAmt_temp = array();
				
					foreach($openingStock_array as $k=>$v){
						$openingStockAmt_temp[$v] = $openingStockAmt_array[$k];
					}
					$openingStock = json_encode($openingStock_array);
					$openingStockAmt = json_encode($openingStockAmt_temp);
				}else{
					$openingStock = "";
					$openingStockAmt = "";
				}
				
				
				//start for purchase stock
				if($request->purchase_stock !=""){
					$purchaseStock_array = array_values(array_filter(explode(",",$request->purchase_stock)));
					$purchaseStockAmt_array = array_values(array_filter(explode(",",$request->purchase_stock_amt)));
					$purchaseStockAmt_temp = array();
				
					foreach($purchaseStock_array as $k=>$v){
						$purchaseStockAmt_temp[$v] = $purchaseStockAmt_array[$k];
					}
					$purchaseStock = json_encode($purchaseStock_array);
					$purchaseStockAmt = json_encode($purchaseStockAmt_temp);
				}else{
					$purchaseStock = "";
					$purchaseStockAmt = "";
				}
				
				
				//start for closing stock
				if($request->closing_stock !=""){
					$closingStock_array = array_values(array_filter(explode(",",$request->closing_stock)));
					$closingStockAmt_array = array_values(array_filter(explode(",",$request->closing_stock_amt)));
					$closingStockAmt_temp = array();
				
					foreach($closingStock_array as $k=>$v){
						$closingStockAmt_temp[$v] = $closingStockAmt_array[$k];
					}
					$closingStock = json_encode($closingStock_array);
					$closingStockAmt = json_encode($closingStockAmt_temp);
				}else{
					$closingStock = "";
					$closingStockAmt = "";
				}
				
				$resellerStock = "";
				$resellerStockAmt = "";
			}
			else if($request->item_type == "reseller") //start for reseller stock
			{
				if($request->reseller_stock !=""){
					$resellerStock_array = array_values(array_filter(explode(",",$request->reseller_stock)));
					$resellerStockAmt_array = array_values(array_filter(explode(",",$request->reseller_stock_amt)));
					$resellerStockAmt_temp = array();
				
					foreach($resellerStock_array as $k=>$v){
						$resellerStockAmt_temp[$v] = $resellerStockAmt_array[$k];
					}
					$resellerStock = json_encode($resellerStock_array);
					$resellerStockAmt = json_encode($resellerStockAmt_temp);
				}else{
					$resellerStock = "";
					$resellerStockAmt = "";
				}
			
				$openingStock = "";
				$openingStockAmt = "";
				$purchaseStock = "";
				$purchaseStockAmt = "";
				$closingStock = "";
				$closingStockAmt = "";
			}
			else{
				$openingStock = "";
				$openingStockAmt = "";
				$purchaseStock = "";
				$purchaseStockAmt = "";
				$closingStock = "";
				$closingStockAmt = "";
				$resellerStock = "";
				$resellerStockAmt = "";
			}
			
			
			$update = DB::table('items')
					->where('id', $itemId)
					->update(
						 array(
								'item_type' => $request->item_type,
								'item_name' => $request->item_name,
								'base_unit' => isset($request->base_unit)?$request->base_unit:"",
								'sec_unit' => isset($request->sec_unit)?$request->sec_unit:"",
								'base_unit_other' => $baseUnitOther,
								'sac_code' => ($request->sac_code && $request->item_type=='service')?$request->sac_code:"",
								'hsn_code' => ($request->hsn_code && $request->item_type!='service')?$request->hsn_code:"",
								'opening_stock_bal' => isset($request->opening_stock_bal)?$request->opening_stock_bal:0,
								'opening_stock' => $openingStock,
								'opening_stock_amt' => $openingStockAmt,
								'purchase_stock' => $purchaseStock,
								'purchase_stock_amt' => $purchaseStockAmt,
								'closing_stock' => $closingStock,
								'closing_stock_amt' => $closingStockAmt,
								'reseller_stock' => $resellerStock,
								'reseller_stock_amt' => $resellerStockAmt,
								'item_bill_no' => $request->item_bill_no,
								'item_actual_no' => $request->item_actual_no,
								'item_date' => isset($request->item_date)?$request->item_date:date('Y-m-d'),
								'selling_price' => $request->selling_price,
								'selling_tax' => $request->selling_tax,
								'wholesale_price' => $request->wholesale_price,
								'wholesale_tax' => isset($request->wholesale_tax)?$request->wholesale_tax:"",
								'purchase_price' => $request->purchase_price,
								'purchase_tax' => $request->purchase_tax,
								'disc_sell' => isset($request->disc_sell)?$request->disc_sell:"",
								'disc_sell_type' => $request->disc_sell_type,
								'min_wholesale_quantity' => isset($request->min_wholesale_quantity)?$request->min_wholesale_quantity:"",
								'item_tax' => isset($request->item_tax)?$request->item_tax:"",
								'prod_desc' => isset($request->prod_desc)?$request->prod_desc:""
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/items'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function update_stock_other(Request $request)  
	{  	
		//echo $request->other_rowid;
		//echo "<pre>";print_r($request->opening_stock);//exit;
		//echo "<pre>";print_r($request->opening_stock_amt);exit;
		$opening_stock = str_replace(" ","-",$request->opening_stock);
		if($opening_stock !=""){
			$name_array = explode(",",$opening_stock);
			$name_array = array_values(array_filter($name_array));
			$amt_array = explode(",",$request->opening_stock_amt);
			$amt_array = array_values(array_filter($amt_array));
			$other_temp = array();
		
			foreach($name_array as $k=>$v){
				$other_temp[$v] = isset($amt_array[$k])?$amt_array[$k]:0;
			}
			$opening_stock = json_encode($name_array);
			$opening_stock_amt = json_encode($other_temp);
		}
		
		if($request->other_rowid =="manufacturing_stock1"){
			$update = DB::table('items')
			->where('id', $request->id)
			->update(
				 array(
						'item_type' => $request->item_type,
						'opening_stock' => $opening_stock,
						'opening_stock_amt' => $opening_stock_amt,
				 )
			);	
		}else if($request->other_rowid =="manufacturing_stock2"){
			$update = DB::table('items')
					->where('id', $request->id)
					->update(
						 array(
								'item_type' => $request->item_type,
								'purchase_stock' => $opening_stock,
								'purchase_stock_amt' => $opening_stock_amt,
						 )
					);
		}else if($request->other_rowid =="manufacturing_stock3"){
			$update = DB::table('items')
					->where('id', $request->id)
					->update(
						 array(
								'item_type' => $request->item_type,
								'closing_stock' => $opening_stock,
								'closing_stock_amt' => $opening_stock_amt,
						 )
					);
		}else if($request->other_rowid == "reseller_stock4"){
			$update = DB::table('items')
					->where('id', $request->id)
					->update(
						 array(
								'item_type' => $request->item_type,
								'reseller_stock' => $opening_stock,
								'reseller_stock_amt' => $opening_stock_amt,
						 )
					);
		}
		
		if ($update){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Stock updated successfully'
			);
			return response()->json($msg);	
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Data has not changed!'
			);
			return response()->json($msg);	
		}

    }
	
	protected function create_baseUnitLog(array $data)
    {
        return  Item_unit_logs ::create([
            'itemId' => $data['prodId'],                                           
            'item_base_unit' => isset($data['base_unit'])?$data['base_unit']:"",                                           
            'item_sec_unit' => isset($data['sec_unit'])?$data['sec_unit']:"",                                           
            'item_unit_other' => isset($data['base_unit_other'])?$data['base_unit_other']:"",                                           
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_baseUnit(Request $request)  
	{  
				
		$insertBaseUnitLog = $this->create_baseUnitLog($request->all());
		if ($insertBaseUnitLog){
			$update = DB::table('items')
					->where('id', $request->prodId)
					->update(
						 array(
								'base_unit' => isset($request->base_unit)?$request->base_unit:"",
								'sec_unit' => isset($request->sec_unit)?$request->sec_unit:"",
								'base_unit_other' => isset($request->base_unit_other)?$request->base_unit_other:"",
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Unit added successfully'
			);
			return response()->json($msg);	
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Unit add failed'
			);
			return response()->json($msg);	
		}

    }
	
	public function delItem(Request $request)
    {
        $delItem = DB::table('items')->where('id', $request->id)->delete();
        $delItemUnitLog = DB::table('item_unit_logs')->where('itemId', $request->id)->delete();
		if($delItem){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/items'),
				'message' => 'Item deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/items'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
}
