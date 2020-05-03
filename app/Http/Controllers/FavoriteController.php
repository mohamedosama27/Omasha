<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function addToFavorites(Request $request)
    {
        if(\Auth::check())
        {

        \Auth::user()->favorites()->attach($request->id);
        return response()->json(['message'=>'Added Successfully']);

        }
        else{
            return response()->json(['message'=>'You must log in']);

        }

    }
    function show()
    {
        $items = \Auth::user()->favorites()->get();
        return view('favorites',[
            'items'=>$items,
        ]);
    }

    public function remove($id)
    {

        \Auth::user()->favorites()->detach($id);
        return redirect('favorites');

    }


}
