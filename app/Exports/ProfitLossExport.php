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

//class ProfitLossExport implements FromCollection, WithHeadings

class ProfitLossExport implements FromView
{
   
	protected $data;

	function __construct($data) {
		$this->data = $data;	
	}
   public function view(): View
    {
		//echo "<pre>";print_r($this->data);exit;
		$fromDate = $this->data['fromDate'];
		$toDate = $this->data['toDate'];
		$users = DB::table('users')
						->select(DB::raw('users.id,users.name,users.email'))
						->where('users.id','=',Auth::user()->id)
						->whereBetween('created_at',[ $fromDate,$toDate])
						->get();
			
		//$users = json_decode(json_encode($array));
		//echo "<pre>";print_r($users);exit; 
		
		 return view('pages.reports.profit-loss-export', [
			'users' => $users
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