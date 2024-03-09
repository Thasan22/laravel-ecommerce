<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::latest()->get();
        return view('backend.category.category', compact('categories'));
    }

    // STORE DATA
    function categoryInsert(Request $request){
        $categoryStore = new Category();
        $categoryStore->category = $request->category;
        $categoryStore->category_slug = Str::slug($request->category);
        $categoryStore->save();
        return back();
    }


    // EDIT
    function categoryEdit($id){
        $categories = Category::latest()->paginate(2);
        $findCategory = Category::find($id);
        return view('backend.category.category', compact('categories','findCategory'));
    }
    // UPDATE DATA
    function categoryUpdate(Request $req, $id){
        $categoryUpdate = Category::find($id);
        $categoryUpdate->category = $req->category;
        $categoryUpdate->category_slug = Str::slug($req->category);
        $categoryUpdate->save();
        return back();

    }


    // DELETE DATA
    function categoryDelete($id){
        Category::find($id)->delete();
        return back();
    }
}
