<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all_categories(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function save_category(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:categories|min:5'
        ]);
        Category::create($request->all());
        return response()->json(['message'=>'Category added successfully']);
    }

    public function update_category(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|unique:categories,name,'.$id
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json(['message'=>'Category updated successfully']);
    }

    public function delete_category($id){
        $category = Category::findOrFail($id);
        if(count($category->posts) > 0){
            foreach($category->posts as $post){
                $post->delete();
            }
            
        }
        $category->delete();
        return response()->json(['message'=>'Category deleted successfully']);
    }
}
