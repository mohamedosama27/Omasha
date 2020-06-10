<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function validation($request)
    {
 
       $request->validate([
         'contact' => ['required', 'string', 'max:255'],
        ]);
 
    }
    public function store(Request $request)
    {

        $this->validation($request);

        $contact = new  \App\contact;
        $contact->contact = $request['contact'];
        $contact->save();
        return redirect('manage_contacts');
    }
    public function showAll()
    {

        $contacts = \App\contact::orderBy('id', 'DESC')->get();
        return view('manage_contacts',[
            'contacts'=>$contacts,

        ]);
       
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
        $contact = \App\contact::findorfail($id);
        $contact->contact=$request['contact'];
        $contact->save();
        return redirect('manage_contacts');
    }
    public function destroy($id)
    {
        
        $contact = \App\contact::findorfail($id);
        $contact->delete();
        return redirect('manage_contacts');

    }
    
}
