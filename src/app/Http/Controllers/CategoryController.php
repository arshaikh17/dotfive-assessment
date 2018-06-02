<?php

namespace App\Http\Controllers;

use App\Notifications\UpdateCategory;
use App\Notifications\CategoryMoved;

use Illuminate\Http\Request;
use App\Category;

use App\Traits\Sanitize;
use Auth;

class CategoryController extends Controller
{
	use Sanitize;

    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('hasAddPrivilege', ['only'=>['CreateCategory', 'CreateSubCategory']]);
        $this->middleware('hasUpdatePrivilege', ['only'=>['UpdateCategory', 'MoveCategory']]);
    }

    public function Category()
    {
    	$categories = Category::all();
    	$render = $this->getCats($category_parent = 0,$categories);
    	return view('category.category', compact('categories', 'render'));
    }

    public function CreateCategory(Request $request)
    {
    	$category_name = $this->sanitize_string($request->category_name);

    	$category = new Category;
    	$category->category_name = $category_name;
    	$category->category_parent_id = 0;
    	$category->save();

    	return redirect()->back()->with('status' , "New category updated");
    }

    public function UpdateCategory(Request $request)
    {
    	$category_id = $this->sanitize_number($request->category_id);
    	$category_name = $this->sanitize_string($request->category_name);

    	//Verify the category
    	$category = Category::where('category_id','=',$category_id)
    		->first();
    	if(count($category) == 0)
    	{
    		return redirect()->back()->withErrors(['status' => "Category not found"]);
    	}
        $previous = $category;
    	Category::where('category_id','=',$category_id)
    		->update(
    			[
    				'category_name' => $category_name
    			]);

        $category = Category::where('category_id','=',$category_id)
            ->first();
        $user = Auth::user();
        foreach($user->followers as $follower)
        {
            $follower->notify(new UpdateCategory($category, $previous));
        }

    	return redirect()->back()->with('status' , "Category updated");
    }

    public function CreateSubCategory(Request $request)
    {
    	$category_id = $this->sanitize_number($request->category_id);
    	$category_name = $this->sanitize_string($request->category_name);

    	//Verify the category
    	$check = Category::where('category_id','=',$category_id)
    		->count();
    	if($check == 0)
    	{
    		return redirect()->back()->withErrors(['status' => "Category not found"]);
    	}

    	$category = new Category;
    	$category->category_name = $category_name;
    	$category->category_parent_id = $category_id;
    	$category->save();

    	return redirect()->back()->with('status' , "Category created");
    }

    public function MoveCategory(Request $request)
    {
        $category_id = $this->sanitize_number($request->category_id);
        $category_old = $this->sanitize_number($request->category_old);

        Category::where('category_id','=',$category_old)
            ->update(
                [
                    'category_parent_id' => $category_id
                ]);

        $category = Category::where('category_id','=',$category_old)
            ->first();

        $new_category = Category::where('category_id','=',$category_id)
            ->first();
        $user = Auth::user();
        foreach($user->followers as $follower)
        {
            $follower->notify(new CategoryMoved($category, $new_category));
        }
        return redirect()->back()->with('status' , "Category moved");
    }


    function getCats($category_parent=0, $cats) {

        if (count($cats)>0) {
        $list_items = array();
        foreach ( $cats as $cat )
        {
            if ( $cat->category_parent_id !== $category_parent )
            {
                continue;
            }
            $list_items[] = '<li class="category">';
            $list_items[] = '<a href="#" class="category-link" data-id="' . $cat->category_id . '">';
            $list_items[] = $cat->category_name;
            $list_items[] = '</a>';
            $list_items[] = $this->getCats( $cat->category_id, $cats );
            $list_items[] = '</li>';

        }
        $list_items = implode( '', $list_items );
        if ( '' == trim( $list_items ) )
        {
            return '';
        }
        return '<ul class="categories">' . $list_items . '</ul>';
        }
        else
        {
            return '<ul><li>No categories in database</li></ul>';
        }
    }

    public function getRestOfCategories(Request $request, $id)
    {
        if($request->ajax())
        {
            $categories = Category::where('category_id', '!=', $id)
                ->get();

            return $categories;
        }
    }

    public function getCategoryTree()
    {
        $categories = Category::all();

        return $this->getCats($category_parent = 0,$categories);
    }
}
