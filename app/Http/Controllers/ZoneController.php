<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function validation($request)
    {
 
       $request->validate([
         'name' => ['required', 'string', 'max:255'],
        ]);
 
    }
    public function store(Request $request)
    {

        $this->validation($request);

        $zone = new  \App\zone;
        $zone->name = $request['name'];
        $zone->save();
        return redirect('manage_Zones');
    }
    public function showAll()
    {

        $zones = \App\zone::orderBy('id', 'DESC')->get();
        return view('manage_Zones',[
            'zones'=>$zones,

        ]);
       
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
        $zone = \App\zone::findorfail($id);
        $zone->name=$request['name'];
        $zone->save();
        return redirect('manage_Zones');
    }
    public function destroy($id)
    {
        
        $zone = \App\zone::findorfail($id);
        $zone->delete();
        return redirect('manage_Zones');

    }
}
