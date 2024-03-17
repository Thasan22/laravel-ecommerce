<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SlugGenerator;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    use SlugGenerator;

    function category(){
        $categories = Category::with('subCategories')->latest()->get();

        $parentCategories = $categories->where('category_id', null)->flatten();

        return view('backend.category.category', compact('categories', 'parentCategories'));
    }

    // STORE DATA
    function categoryInsert(Request $request){


        $slug = $this->createSlug(Category::class, $request->category);

        $categoryStore = new Category();
        $categoryStore->category = $request->category;
        $categoryStore->category_id = $request->category_id;
        $categoryStore->category_slug = $slug;
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
