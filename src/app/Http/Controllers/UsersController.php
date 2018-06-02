<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowed;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\User_access_right;
use App\Traits\Sanitize;
class UsersController extends Controller
{    
    use Sanitize;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasAdminPrivilege', ['only'=>['InvokePrivilege']]);
    }

    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('users.index', compact('users'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        if ($follower->id == $user->id) {
            return back()->withError("You can't follow yourself");
        }
        if(!$follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            // sending a notification
            $user->notify(new UserFollowed($follower));

            return back()->withSuccess("You are now friends with {$user->name}");
        }
        return back()->withError("You are already following {$user->name}");
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        if($follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);
            return back()->withSuccess("You are no longer friends with {$user->name}");
        }
        return back()->withError("You are not following {$user->name}");
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function ReadNotification(Request $request)
    {
        $id = $request->read;
        $now = date("Y-m-d h:i:s");
           // dd($now);
        DB::table('notifications')
            ->where('id','=',$id)
            ->update(
                [
                    'read_at' => $now
                ]);

        return redirect()->back();
    }

    public function InvokePrivilege(Request $request)
    {
        $user_id = $this->sanitize_number($request->user);
        $access_value = $this->sanitize_number($request->trigger_val);
        $access_key = $this->sanitize_string($request->privilege);

        User_access_right::where('user_id','=',$user_id)
            ->where('access_key','=',$access_key)
            ->update(
                [
                    'access_value' => $access_value
                ]);

        return redirect()->back()->with('status', 'Privilege invoked');
    }
}
