<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class CartController extends Controller
{
    public function showCart()
    {
        $items_ids = Session::has('items_ids') ? Session::get('items_ids') : array();
        $items=array();
        foreach ($items_ids as $id){
        array_push($items,\App\item::find($id));
        }
        return view('cart',[
            'items'=>$items ?? 'Doesnot exist'
        ]);
        // return $items_ids;
    }
    public function removeItem($itemid)
    {
        $items_ids = Session::get('items_ids'); 
        unset($items_ids[$itemid]); 
        return $items_ids;
        Session::forget('items_ids');
        Session::put('items_ids', $items_ids);
        $items=array();
        foreach ($items_ids as $id){
        array_push($items,\App\item::find($id));
        }
        // return view('cart',[
        //     'items'=>$items ?? 'Doesnot exist'
        // ]);
        return $items;

    }
}
