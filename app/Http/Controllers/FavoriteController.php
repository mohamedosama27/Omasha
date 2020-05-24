<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function addToFavorites(Request $request)
    {
        //add item_id with current user_id in table item_user
        if(\Auth::check())
        {
           
            try {
        
                \Auth::user()->favorites()->attach($request->id);
                return response()->json(['message'=>'Added Successfully']);

            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['message'=>'Already Added']);
            }
        

        }
        else{
            return response()->json(['message'=>'You must log in']);

        }

    }
    function show()
    {
        //show current user favorites
        $items = \Auth::user()->favorites()->get();
        return view('favorites',[
            'items'=>$items,
        ]);
    }

    public function remove($id)
    {
        //remove record from table item_user when item_id and current user_id
        \Auth::user()->favorites()->detach($id);
        return redirect('favorites');

    }


}
