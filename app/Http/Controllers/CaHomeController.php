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

class CaHomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function Index()
    {
        //$this->middleware('auth');
        return view('pages.ca.cahome')->with([

        ]);
    }
}
