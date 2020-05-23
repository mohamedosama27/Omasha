<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function validation($request)
    {
       //validate data passed from add item view or edit item view
 
       $request->validate([
        'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
        ]);
 
    }
    public function store(Request $request)
    {
        $this->validation($request);

        $subscriber = new  \App\subscriber;
        $subscriber->email = $request['email'];
        $subscriber->save();
        return redirect('welcome');
    }
    public function showAll(Request $request)
    {

        $subscribers = \App\subscriber::all();

        return view('subscribers',[
            'subscribers'=>$subscribers,
        ]);
    }
    public function destroy($id)
    {
        //delete category from table categories by passed id
        
        $subscriber = \App\subscriber::findorfail($id);
        $subscriber->delete();
        return redirect()->back();

    }

}
