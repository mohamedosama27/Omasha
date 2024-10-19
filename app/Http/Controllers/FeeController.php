<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function validation($request)
    {

       $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'name_ar' => ['required', 'string', 'max:255'],
         'value' => ['required', 'numeric'],
        ]);

    }
    public function store(Request $request)
    {

        $this->validation($request);

        $fee = new  \App\fee;
        $fee->name = $request['name'];
        $fee->name_ar = $request['name_ar'];
        $fee->value=$request['value'];
        $fee->save();
        return redirect('manage_fees');
    }
    public function showAll()
    {

        $fees = \App\fee::orderBy('id', 'DESC')->get();
        return view('manage_fees',[
            'fees'=>$fees,

        ]);

    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
        $fee = \App\fee::findorfail($id);
        $fee->name=$request['name'];
        $fee->name_ar=$request['name_ar'];
        $fee->value=$request['value'];
        $fee->save();
        return redirect('manage_fees');
    }
    public function destroy($id)
    {

        $fee = \App\fee::findorfail($id);
        $fee->delete();
        return redirect('manage_fees');

    }
}
