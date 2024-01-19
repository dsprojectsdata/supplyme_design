<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Log;
use DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index()
    {
        $categories =Category::orderBy('id','desc')->get();
        $category = $this->buildCategoryTree($categories);

        return view('SuperAdmin.category.index', compact('category'));
    }

    private function buildCategoryTree($categories, $parentId = 0)
    {
        $tree = array();

        foreach ($categories as $categ) {
            if ($categ->parent_id == $parentId) {
                $tree[] = array(
                    'id' => $categ->id,
                    'name' => $categ->name,
                    'category_type' => $categ->category_type,
                    'children' => $this->buildCategoryTree($categories, $categ->id)
                );
            }
        }

        return $tree;
    }





    public function create(){
        $category = Category::where('parent_id','0')->get();
        return view('SuperAdmin.category.create',compact('category'));
    }

    public function store(Request $request){
        $validator = $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
        ]); 
        if($request->parent_id == 0){
            $cat = new Category();
            $cat->parent_id = $request->parent_id;
            $cat->name = $request->name;
            $cat->status = $request->status;
             $cat->category_type = $request->category_type;
            $cat->save();
        }
        else{
            Log::info('parent name is coming  : ' .$request->parent_id);
            $cat = new Category();
            $cat->parent_id = $request->parent_id;
            $cat->name = $request->name;
            $cat->status = $request->status;
            $cat->category_type = $request->category_type;
            $cat->save();
            Log::info('parent id ready to save');
        }
        return redirect()->route('category.index')->with('success' , 'category store successfully');
        
    }
    
    public function edit(Request $request,$id){
        $id = $request->id;
        $categories = Category::all();
        $category =  Category::find($id);
        return view('SuperAdmin.category.edit',compact('category','categories'));
    }


    public function update(Request $request,$id){
        $updateCatgry = Category::find($id);
        $updateCatgry->name = $request->name;
        $updateCatgry->parent_id = $request->parent_id ?? '0';
        $updateCatgry->status = $request->status;
        $updateCatgry->category_type = $request->category_type;
        $updateCatgry->update();
        log::info('update by request');
        if($request->parent_id){
            return redirect()->route('category.index')->with('success' , 'sub category edit successfully');
        }
        else{
             return redirect()->route('category.index')->with('success' , 'category edit successfully');
        }
       
    }

    
   

    public function categoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $subCategory = Category::where('parent_id',$id)->first();
        if ($subCategory !== null) {
            return redirect()->route('category.index')->with('danger', 'Cannot delete category with children.');
        }
        else {
            $category->delete();
        }
        return redirect()->route('category.index')->with('danger', 'Category deleted successfully');
    }

}