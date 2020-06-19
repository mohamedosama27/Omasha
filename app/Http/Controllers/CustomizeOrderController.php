<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomizeOrderController extends Controller
{
    public function validation($request)
    {
 
       $request->validate([
         'contact_name' => ['required', 'string','max:255'],
         'email' => ['required', 'string', 'max:255'],
         'phone' => ['required', 'string', 'size:11'],
         'category' => ['required', 'string', 'max:255'],
         'quantity' => ['required','string', 'max:255'],
 
        ]);
 
    }
    public function showAll()
    {

        $customize_orders = \App\customize_order::orderBy('id', 'DESC')->get();
        return view('customize_orders',[
            'customize_orders'=>$customize_orders,

        ]);
       
    }
    public function delete($id)
    {
        $customize_order = \App\customize_order::findorfail($id);
        $customize_order->delete();
        return redirect('showCustoizeOrders');

    }
    public function store(Request $request)
    {

        $this->validation($request);

        $customize_order = new  \App\customize_order;
        $customize_order->contact_name=$request['contact_name'];
        $customize_order->email=$request['email'];
        $customize_order->phone=$request['phone'];
        $customize_order->category=$request['category'];
        $customize_order->quantity=$request['quantity'];
        $customize_order->save();
        return redirect('home');
    }
}
