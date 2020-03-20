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
}
