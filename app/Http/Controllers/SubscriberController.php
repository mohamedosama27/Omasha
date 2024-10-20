<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;

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
            return response()->json(['success'=>__('messages.add_success')]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success'=>__('messages.already_added')]);
        }

    }

    public function showAll()
    {
        $subscribers = \App\subscriber::all();
        return view('subscribers',[
            'subscribers'=>$subscribers,
        ]);
    }

    public function destroy($id)
    {
        $subscriber = \App\subscriber::findorfail($id);
        $subscriber->delete();
        return redirect()->back();
    }

    public function send_mails(Request $request)
    {
        $subscribers = \App\subscriber::all();
        foreach($subscribers as $subscriber)
        {
            \Mail::to($subscriber->email)->send(new SendMail($request['message'],'emails.send_to_subscribers'));
            //return redirect()->back();
            return response()->json(['success'=>'Sent Successfully']);

        }
    }

}
