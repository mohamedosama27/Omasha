<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use Session;
class ItemController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $items = \App\item::all();

        return view('home',[
            'items'=>$items ?? 'Doesnot exist'
        ]);
       
    }

    public function AddToCart(Request $request,$id)
    {
        // $items = \App\item::find($id);
        // $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // $cart = new cart($oldCart);
        // $cart->add($items,$items->id);
        // $request->session()->put('cart',$cart);
        // dd($cart);
    //     $quantity = Session::has('cartQuantity') ? Session::get('cartQuantity') : 0;
    //     echo $quantity;
    //     $request->session()->put('cartQuantity',$quantity);
    //     dd(        $request->session()->put('cartQuantity',$quantity)
    // );

    $number_of_items = Session::has('number_of_items') ? Session::get('number_of_items') : 0;
    $items_ids = Session::has('items_ids') ? Session::get('items_ids') : array();
    array_push($items_ids,$id);
    $number_of_items++;
    Session::put('number_of_items',$number_of_items );
    Session::put('items_ids',$items_ids );

    // return Session::get('items_ids');
    //     Session::flush();
        return redirect('home');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }
}
