<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB; 
use App\User; 
use Hash; 


class ResetPasswordController extends Controller

{

    public function create()
    {
    	//$this->middleware('auth');
		$title = 'Reset Password';
		
		if (Auth::user()){
			return view('resetPassword')->with([
				'title' =>$title
			]);
		}else{
			return redirect('/');
		}
    }


    public function store(Request $request)
    {

    	 $request->validate([
          'current_password' => 'required',
          'new_password' => 'required|string|min:6|same:confirm_password',
          'confirm_password' => 'required',

        ]);

    	$user = \Auth::user();
		//echo "<pre>";print_r($user);exit;
    	if (!\Hash::check($request->current_password, $user->password)) {

            return back()->with('error', 'Current password does not match!');

        }

        $user->password = \Hash::make($request->new_password);

        $user->save();

        return back()->with('success', 'Password successfully changed!');

    }
	
	

}