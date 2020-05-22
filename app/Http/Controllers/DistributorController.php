<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function validation($request)
    {
 
       $request->validate([
         'business_name' => ['required', 'string', 'max:255'],
         'contact_name' => ['required', 'string','max:255'],
         'email' => ['required', 'string', 'max:255'],
         'phone' => ['required', 'string', 'max:11','min:11'],
         'address' => ['required', 'string', 'max:255'],
         'city' => ['required','string', 'max:255'],
         'social_media' => ['required','string', 'max:255']
 
        ]);
 
    }
    public function showAll()
    {

        $distributors = \App\distributor::orderBy('id', 'DESC')->get();
        return view('distributors',[
            'distributors'=>$distributors,

        ]);
       
    }
    public function delete($id)
    {

        $distributor = \App\distributor::findorfail($id);
        $distributor->delete();
        return redirect('showDistributors');

    }
    public function store(Request $request)
    {

        $this->validation($request);

        $distributor = new  \App\distributor;
        $distributor->business_name = $request['business_name'];
        $distributor->contact_name=$request['contact_name'];
        $distributor->email=$request['email'];
        $distributor->phone=$request['phone'];
        $distributor->address=$request['address'];
        $distributor->city=$request['city'];
        $distributor->social_media=$request['social_media'];
        $distributor->save();
        return redirect('home');
    }
}
