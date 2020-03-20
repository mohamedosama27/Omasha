<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class OrderController extends Controller
{
    public function showAll()
    {
        $orders = \App\order::all();

        return view('vieworders',[
            'orders'=>$orders ?? 'Doesnot exist'
        ]);
       
    }
    public function create(Request $request)
    {
        $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();

        $order = new  \App\order;
        $order->user_id = auth()->id();
        $order->address=$request['address'];
        $order->save();
        $order = \App\order::find($order->id);
        $totalprice=0;
        foreach($selcteditems as $selecteditem)
        {
            $totalprice+=$selecteditem->Quantity*$selecteditem->item->price;
            DB::table('item_order')->insert(
                ['item_id' => $selecteditem->item->id,
                 'order_id' => $order->id,
                'quantity' =>$selecteditem->Quantity]
            );
       
        }
        $order->total_price=$totalprice;
        $order->save();
        Session::put('number_of_items',0 );
        Session::put('selcteditems',array());
             return redirect('home');
    }


 
}
