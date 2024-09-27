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
use App\Busi_agents;
use App\Ca_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;


class GSTController extends Controller
{
    public function Index()
    {
        return view('pages.gst');
    }

}

