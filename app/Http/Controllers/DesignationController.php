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

class DesignationController extends Controller
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
		return view('pages.designation')->with([
				
		]); 
    }
	
	public function adddesignation()
    {
		//$this->middleware('auth'); 
		return view('pages.adddesignation')->with([
				
		]); 
    }
	
}
