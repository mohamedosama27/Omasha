<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    protected $items_per_page = 10;

    public function index($id)
    {
        //show items has category_id with id chose

        $items = \App\item::whereJsonContains('category_ids', $id)->paginate($this->items_per_page);
        return view('shop')->with(compact('items'));

    }
    public function store(Request $request)
    {
        //add new category in table categories

        $category = new \App\category;

        $category->name = $request['name'];
        $category->name_ar = $request['name_ar'];
        $category->is_child = $request['is_child_category'] ? true : false;
        if ($category->is_child) {
            $category->parent_category_id = $request['parent_category'];
        }
        $category->save();
        $file = $request->file('img');
        $name = 'category' . $category->id . '.' . $file->getClientOriginalExtension();
        $file->move("images", $name);
        $image = new \App\image;

        $image->name = $name;
        $image->category_id = $category->id;

        $image->save();
        return redirect()->back();
    }
    public function edit()
    {
        //retrieve all categories and pass to editcategories view

        $parentCategories = \App\category::where('is_child', false)->get();
        $childCategories = \App\category::where('is_child', true)->get();

        return view('editcategory', [
            'parentCategories' => $parentCategories,
            'childCategories' => $childCategories
        ]);
    }
    public function update(Request $request, $id)
    {
        //update name of category by passed id

        $category = \App\category::findorfail($id);
        // if (!$category->image) {
        //     $request->validate([
        //         'img' => ['required']
        //     ], [
        //         'img.required' => 'The image is required'
        //     ]);
        // }

        $category->name = $request['name'];
        $category->name_ar = $request['name_ar'];
        if ($category->is_child) {
            $category->parent_category_id = $request['parent_category_id'];
        }
        $category->save();
        if ($request->file('img')) {
            if ($category->image) {
                $this->deleteImage($category->image->id);
            }
            $file = $request->file('img');
            $name = 'category' . $category->id . '.' . $file->getClientOriginalExtension();
            $file->move("images", $name);
            $image = new \App\image;

            $image->name = $name;
            $image->category_id = $category->id;

            $image->save();
        }

        return redirect('editcategory');
    }
    public function destroy($id)
    {
        //delete category from table categories by passed id

        $category = \App\category::findorfail($id);
        $this->deleteImage($category->image->id);
        $category->delete();
        return redirect('editcategory');

    }

    public function deleteImage($id)
    {
        //delete image from images table with passed id

        $image = \App\image::find($id);
        if ($image) {
            DB::table('images')->where('id', '=', $id)->delete();
            echo $image->name;
            if (\File::exists(public_path('images/' . $image->name))) {

                \File::delete(public_path('images/' . $image->name));

            } else {

                echo 'File does not exists.';

            }
        }

        return redirect()->back();

    }
}
