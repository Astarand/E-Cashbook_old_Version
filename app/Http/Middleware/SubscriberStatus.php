<?php

namespace App\Http\Middleware;
use Closure;

use Redirect;
use DB;
use Auth;
use Validator;
use App\User;
use Helper; 

class SubscriberStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$chkSubscriber = Helper::check_subscriber();
        if ($chkSubscriber) {
            return $next($request);
        }
		return redirect('/subscriber-plans?expire='.$chkSubscriber); //redirect()->route("subscriber-plans");
        //return response()->json('Your account is inactive');

    }
}
