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
            'name' => 'required|unique:categories'
        ]);
        Category::create($request->all());
        return response()->json(['message'=>'Category added successfully']);
    }
}
