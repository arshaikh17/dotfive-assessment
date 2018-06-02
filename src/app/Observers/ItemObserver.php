<?php
namespace App\Observers;

use App\Notifications\NewItem;
use App\Item;
use Auth;
class ItemObserver
{

    /**
     * Called whenever a post is created
     * @param Job $post
     */

    public function created(Item $item)
    {
        $user = Auth::user();
        //dd($user->followers);
        foreach ($user->followers as $follower) {
            $follower->notify(new NewItem($item));
        }
    }
}