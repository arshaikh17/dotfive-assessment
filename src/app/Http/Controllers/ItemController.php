<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Sanitize;
use App\Notifications\UpdateItem;
use App\Item;
use App\Category;
use Auth;

class ItemController extends Controller
{
   	use Sanitize;

    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('hasAddPrivilege', ['only'=>['CreateItem']]);
        $this->middleware('hasUpdatePrivilege', ['only'=>['UpdateItem']]);
    }

    private function items()
    {
        $items = Item::select('item_id','item_name', 'item_slug', 'category_name', 'category_slug', 'items.category_id')
            ->join('categories AS c', 'c.category_id', 'items.category_id')
            ->get();

        return $items;
    }
    public function Item()
    {
    	$items = $this->items();

    	$categories = Category::all();
        //dd(getCats($category_parent=0, $categories));
    	return view('item.item', compact('items', 'categories'));
    }

    public function CreateItem(Request $request)
    {
    	$item_name = $this->sanitize_string($request->item_name);
		$category_id = $this->sanitize_number($request->category_id);
    	$item = new Item;
    	$item->item_name = $item_name;
    	$item->category_id = $category_id;
    	$item->save();


    	return redirect()->back()->with('status' , "New item updated");
    }

    public function UpdateItem(Request $request)
    {
        $item_id = $this->sanitize_number($request->item_id);
        $item_name = $this->sanitize_string($request->item_name);

        //Verify the item
        $item = Item::where('item_id','=',$item_id)
            ->first();
        if(count($item) == 0)
        {
            return redirect()->back()->withErrors(['status' => "Item not found"]);
        }
        $previous = $item;
        Item::where('item_id','=',$item_id)
            ->update(
                [
                    'item_name' => $item_name
                ]);

        $item = Item::where('item_id','=',$item_id)
            ->first();
        $user = Auth::user();
        foreach($user->followers as $follower)
        {
            $follower->notify(new UpdateItem($item, $previous));
        }

        return redirect()->back()->with('status' , "Item updated");
    }

    public function getItems()
    {
        return $this->items();
    }

}
