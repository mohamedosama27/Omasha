<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function store_title(Request $request)
    {
            $request->validate([
                'content' => ['required'],
            ]);

           $home_top_title = new  \App\home_top_title;
           $home_top_title->content = $request['content'];
           $home_top_title->save();
           return redirect('manage_home');

    }
    public function update_title(Request $request, $id)
    {
        $request->validate([
            'content' => ['required'],
        ]);
        $home_top_title = \App\home_top_title::findorfail($id);
        $home_top_title->content=$request['content'];
        $home_top_title->save();
        return redirect('manage_home');
    }
    public function destroy_title($id)
    {

        $home_top_title = \App\home_top_title::findorfail($id);
        $home_top_title->delete();
        return redirect('manage_home');

    }
    public function store_image(Request $request)
    {

        $request->validate([
            'img' => ['required'],
           ]);
                   $files = $request->file('img');
        foreach ($files as $file){
          $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
        $file->move("images", $name);

        $home_image = new  \App\home_image;
        $home_image->name = $name;
        $home_image->save();
       }

        return redirect('manage_home');
    }
    public function showAll()
    {


        $home_images = \App\home_image::orderBy('id', 'DESC')->get();
        $home_top_titles = \App\home_top_title::orderBy('id', 'DESC')->get();

        return view('manage_home',[
            'home_images'=>$home_images,
            'home_top_titles'=>$home_top_titles,

        ]);

    }

    public function destroy_image($id)
    {

        $home_image = \App\home_image::findorfail($id);
        $home_image->delete();
        return redirect('manage_home');

    }
}
