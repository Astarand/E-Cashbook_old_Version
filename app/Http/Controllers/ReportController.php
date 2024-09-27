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
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProfitLossExport;

class ReportController extends Controller
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
	
    public function profit_loss()
    {
		//$this->middleware('auth');
		return view('pages.reports.profit-loss')->with([

		]);
    }
	
	public function gen_profit_loss(Request $request)
    {
		$fromDate = $request->fromDate;
		$toDate = $request->toDate;
		$dataArr = array(
			'fromDate'=>$fromDate,
			'toDate'=>$toDate
		); //array with size 65345
		$header = []; 
		$today = date("d-m-Y");
		return Excel::download(new ProfitLossExport($dataArr), 'profit-loss-'.$today.'.xlsx');
    }
	
	

}
