<?php
namespace App\Observers;

use App\Notifications\NewCategory;
use App\Notifications\UpdateCategory;
use App\Category;
use Auth;
class CategoryObserver
{

    /**
     * Called whenever a post is created
     * @param Job $post
     */

    public function created(Category $category)
    {
        $user = Auth::user();
        //dd($user->followers);
        foreach ($user->followers as $follower) {
            $follower->notify(new NewCategory($category));
        }
    }

    public function updated(Category $category)
    {
        $user = Auth::user();
        foreach($user->followers as $follower)
        {
            $follower->notify(new UpdateCategory());
        }
    }
}