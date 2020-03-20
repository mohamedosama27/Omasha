<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\cart;

class CartController extends Controller
{
    public function showCart()
    {   
        $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
        return view('cart',[
            'items'=>$selcteditems ?? 'Doesnot exist'
        ]);
    }
    public function removeItem($id)
    {
        $selcteditems = Session::get('selcteditems'); 
        $number_of_items = Session::has('number_of_items') ? Session::get('number_of_items') : 0;

        for($i=0;$i<sizeof($selcteditems);$i++)
        {
            if($selcteditems[$i]->item->id == $id)
            {
                $number_of_items-=$selcteditems[$i]->Quantity;
                unset($selcteditems[$i]);
                $selcteditems = array_values($selcteditems);
                Session::put('selcteditems', $selcteditems);
                Session::put('number_of_items',$number_of_items );

            }
        }
        return redirect('cart');

    }
    public function AddToCart(Request $request,$id)
    {
    $number_of_items = Session::has('number_of_items') ? Session::get('number_of_items') : 0;
    $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
    $found=false;
    foreach($selcteditems as $selcteditem)
    {
        if($selcteditem->item->id == $id)
        {
            $selcteditem->Quantity+=1;
            $found=true;
        }
    }
    if($found==false)
    {
        $item = new cart($id);
        array_push($selcteditems,$item);
    }
    
    $number_of_items++;
    Session::put('number_of_items',$number_of_items );
    Session::put('selcteditems',$selcteditems);

     //return Session::get('selcteditems');
       return redirect('home');

    }
    public function decrementItem($id)
    {
        $selcteditems = Session::get('selcteditems'); 
        $number_of_items = Session::has('number_of_items') ? Session::get('number_of_items') : 0;

        for($i=0;$i<sizeof($selcteditems);$i++)
        {
            if($selcteditems[$i]->item->id == $id && $selcteditems[$i]->Quantity > 1)
            {
                $number_of_items-=1;
                $selcteditems[$i]->Quantity-=1;
                Session::put('selcteditems', $selcteditems);
                Session::put('number_of_items',$number_of_items );

            }
        }
        return redirect('cart');

    }
    public function incrementItem($id)
    {
        $selcteditems = Session::get('selcteditems'); 
        $number_of_items = Session::has('number_of_items') ? Session::get('number_of_items') : 0;

        for($i=0;$i<sizeof($selcteditems);$i++)
        {
            if($selcteditems[$i]->item->id == $id)
            {
                $number_of_items+=1;
                $selcteditems[$i]->Quantity+=1;
                Session::put('selcteditems', $selcteditems);
                Session::put('number_of_items',$number_of_items );

            }
        }
        return redirect('cart');

    }
}
