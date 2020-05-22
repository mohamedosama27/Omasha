<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function validation($request)
    {
 
       $request->validate([
         'city' => ['required', 'string', 'max:255'],
         'address' => ['required', 'string','max:255'],
        ]);
 
    }
    public function store(Request $request)
    {

        $this->validation($request);

        $location = new  \App\location;
        $location->city = $request['city'];
        $location->address=$request['address'];
        $location->save();
        return redirect('wheretobuy');
    }
    public function showAll()
    {

        $locations = \App\location::orderBy('id', 'DESC')->get();
        return view('wheretobuy',[
            'locations'=>$locations,

        ]);
       
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
        $location = \App\location::findorfail($id);
        $location->city=$request['city'];
        $location->address=$request['address'];
        $location->save();
        return redirect('wheretobuy');
    }
    public function destroy($id)
    {
        
        $location = \App\location::findorfail($id);
        $location->delete();
        return redirect('wheretobuy');

    }

}
