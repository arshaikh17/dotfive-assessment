<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\User_access_right;
use App\User;
use App\Traits\Sanitize;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User_access_right::where('access_key','=','admin')
            ->where('user_id','=',Auth::user()->id)
            ->count();

        if($admin == 1)
        {
            $users_with_rights = array();
            $users = User::all();
            foreach($users as $user)
            {
                if($user->id != Auth::user()->id)
                {
                    $rights = array();
                    $rights = User_access_right::where('user_id','=',$user->id)
                        ->get();

                    $user_with_rights = array();
                    $user_with_rights['user'] = $user;
                    foreach($rights as $r)
                    {
                        $user_with_rights['rights'][$r->access_key] = $r->access_value;
                        
                    }
                    $users_with_rights[] = $user_with_rights;
                }
            }
            return view('home', compact('admin', 'users_with_rights'));    
        }
        return view('home', compact('admin'));
    }

    
}
