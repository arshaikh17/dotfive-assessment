<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User_access_right;
class HasAddPrivilege
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
        $right = User_access_right::where('access_key','=','add')
            ->where('user_id','=',Auth::user()->id)
            ->first();

        if(count($right) == 1)
        {
            if($right->access_value == 1)
            {
                return $next($request);
            }
            else
            {
                return redirect()->to('/home')->withErrors(['status' => 'You do not have privilege to do such task']);
            }
        }
        else
        {
            return redirect()->to('/home')->withErrors(['status' => 'You do not have privilege to do such task']);
        }
    }
}
