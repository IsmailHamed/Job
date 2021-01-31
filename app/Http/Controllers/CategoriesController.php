<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Category;
class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
        $category = Category::all();
        $arr = Array('Categories' => $category);

        return view('Categories.Index',$arr);
    }

    // GET: Categories/Create
    public function Create(Request $request)
    {
        if($request->isMethod('GET')){
            return view('Categories.Create');
        }else{
            $request->validate([
                'categoryName' => 'required|max:255',
                'categoryDescription' => 'required|max:255',
            ]);
            $category = new Category();
            $category->categoryName = $request->input('categoryName');
            $category->categoryDescription = $request->input('categoryDescription');
            $category->save();
            return redirect()->route('Categories.Index')->with('success','You have successfully add new category.');
        }
    }
    public function Delete($id){
        $category=Category::find($id);
        if(!is_null($category)){
            $category->delete();
        }
        return redirect()->route('Categories.Index');
    }
    public function Edit(Request $request,$id){
        $category=Category::find($id);
        if(!is_null($category)){
            if($request->isMethod("GET")){
            $arr = Array('Category' => $category);
            return view('Categories.Edit',$arr);
            }else{
                $category->categoryName = $request->input('categoryName');
                $category->categoryDescription = $request->input('categoryDescription');
                $category->save();
            }
        }
        return redirect()->route('Categories.Index')->with('success','You have successfully edit category.');
    }
    public function Details($id){
        $category=Category::find($id);
        if(!is_null($category)){
            $arr = Array('Category' => $category);
            return view('Categories.Details',$arr);
        }else{

            return redirect()->route('Categories.Index');
        }
    }

}
