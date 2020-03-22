<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $category = new  \App\category;
 
        $category->name = $request['name'];
        $category->save();
        return redirect('home');
    }
    public function edit()
    {
        $categories = \App\category::all();

        return view('editcategory',[
            'categories'=>$categories
        ]);
    }
    public function update(Request $request, $id)
    {
        
        $category = \App\category::find($id);
        $category->name=$request['name'];
        $category->save();
        return redirect('editcategory');
    }
    public function destroy($id)
    {
        $category = \App\category::find($id);

        $category->delete();
        return redirect('editcategory');

    }
}
