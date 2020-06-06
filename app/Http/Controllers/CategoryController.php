<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $items_per_page = 10;

    public function index($id) 
    {
        //show items has category_id with id chose

        $items = \App\item::where('category_id','=',$id)->paginate($this->items_per_page);
        return view('shop')->with(compact('items'));

    }
    public function store(Request $request)
    {
        //add new category in table categories

        $category = new  \App\category;
 
        $category->name = $request['name'];
        $category->save();
        return redirect()->back();
    }
    public function edit()
    {
        //retrieve all categories and pass to editcategories view

        $categories = \App\category::all();

        return view('editcategory',[
            'categories'=>$categories
        ]);
    }
    public function update(Request $request, $id)
    {
        //update name of category by passed id

        $category = \App\category::findorfail($id);
        $category->name=$request['name'];
        $category->save();
        return redirect('editcategory');
    }
    public function destroy($id)
    {
        //delete category from table categories by passed id
        
        $category = \App\category::findorfail($id);
        $category->delete();
        return redirect('editcategory');

    }
}
