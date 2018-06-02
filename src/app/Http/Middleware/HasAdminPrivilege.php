<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User_access_right;
class HasAdminPrivilege
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
        $admin = User_access_right::where('access_key','=','admin')
            ->where('user_id','=',Auth::user()->id)
            ->first();

        if(count($admin) == 1)
        {
            if($admin->access_value == 1)
            {
                return $next($request);
            }
        }
        else
        {
            return redirect()->to('/home')->withErrors(['status' => 'You do not have privilege to do such task']);
        }
    }
}
