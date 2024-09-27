<?php

namespace App\Exports;
use App\Category;
use App\Brand;
use App\Product;
use App\PaymentTerm;
use Auth;
use DB;
use Helper; // Important
use Image;
use App\Budget;
use App\Product_assign_attribute;
use Validator;
use App\User;
use App\Country;
use App\State;
use App\City;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class InvoicesExport implements FromCollection, WithHeadings

class InvoicesExport implements FromView
{
   
   public function view(): View
    {
        //return User::all();
		
		if(Auth::user()->u_type ==1){
					$order_items =  DB::table('order_items')
													->select(DB::raw('order_items.*,products.*,order_products.order_id'))
													->leftJoin('order_products', 'order_products.id', '=', 'order_items.orderId')
													->leftJoin('products', 'order_items.prod_id', '=', 'products.id')
													//->where('order_items.orderId','=',$val->id)
													->where('order_items.seller_id','=',Auth::user()->id)
													->where('order_products.pay_status','=',1)
													->where('order_products.is_cancel','=',0)
													->where('order_products.is_return','=',0)
													->orderBy('order_items.id', 'DESC')->get();
				}else{
					$order_items =  DB::table('order_items')
													->select(DB::raw('order_items.*,products.*,order_products.order_id'))
													->leftJoin('order_products', 'order_products.id', '=', 'order_items.orderId')
													->leftJoin('products', 'order_items.prod_id', '=', 'products.id')
													//->where('order_items.orderId','=',$val->id)
													->where('order_products.pay_status','=',1)
													->where('order_products.is_cancel','=',0)
													->where('order_products.is_return','=',0)
													->orderBy('order_items.id', 'DESC')->get();
				}
			
			
			//$quotes_order = json_decode(json_encode($array));
			//echo "<pre>";print_r($order_items);exit; 
		
		 return view('order.order-export', [
			'order_items' => $order_items
		]);
    }
	
	public function headings(): array
    {
        return [
            'Name',
            'Surname',
            'Email',
            'Twitter',
        ];
    }
}