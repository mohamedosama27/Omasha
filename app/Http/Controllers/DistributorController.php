<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function validation($request)
    {
 
       $request->validate([
         'business_name' => ['required', 'string', 'max:255'],
         'contact_name' => ['required', 'string'],
         'email' => ['required', 'string', 'max:255'],
         'phone' => ['required', 'string', 'max:11','min:11'],
         'address' => ['required', 'string', 'max:255'],
         'city' => ['required','string', 'max:255'],
         'social_media' => ['required','string', 'max:255']
 
        ]);
 
    }
    public function store(Request $request)
    {

        $this->validation($request);

        $item = new  \App\distributor;
        $item->business_name = $request['business_name'];
        $item->contact_name=$request['contact_name'];
        $item->email=$request['email'];
        $item->phone=$request['phone'];
        $item->address=$request['address'];
        $item->city=$request['city'];
        $item->social_media=$request['social_media'];
        $item->save();
        return redirect('home');
    }
}
