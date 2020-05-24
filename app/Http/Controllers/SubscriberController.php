<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
 
    public function store(Request $request)
    {
         $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            ]);

       try {
        
        $subscriber = new  \App\subscriber;
        $subscriber->email = $request['email'];
        $subscriber->save();
        return response()->json(['success'=>'Added Successfully']);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success'=>"Already Added"]);
        }
    

       
       
            
           

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
