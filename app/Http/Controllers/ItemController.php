<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ItemController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $items = \App\item::all();

        return view('home',[
            'items'=>$items ?? 'Doesnot exist'
        ]);
       
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      

        $categories = \App\category::all();

        return view('additem',[
            'categories'=>$categories
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new  \App\item;
 
        $item->Name = $request['Name'];
        $item->description=$request['Description'];
        $item->quantity=$request['Quantity'];
        $item->price=$request['Price'];
        $item->barcode=$request['barcode'];
        $item->category_id=$request['Category'];
        $item->save();
    
        $item_id = $item->id;
        $files = $request->file('img');
            foreach ($files as $file){
             $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
             $file->move("images", $name);
            
             $image = new \App\image;
     
             $image->name = $name;
             $image->item_id=$item_id;
     
             $image->save();
           }
             return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = \App\item::find($id);

        return view('item',[
            'item'=>$item,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = \App\item::find($id);

        $categories = \App\category::all();
        return view('edititem',[
            'item'=>$item,
            'categories'=>$categories
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $item = \App\item::find($id);
        $item->Name = $request['Name'];
        $item->description=$request['Description'];
        $item->quantity=$request['Quantity'];
        $item->price=$request['Price'];
        $item->category_id=$request['Category'];
        $item->barcode=$request['barcode'];
        $item->save();
        $item_id = $item->id;
        if($files = $request->file('img')){
            foreach ($files as $file){
             $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
             $file->move("images", $name);
            
             $image = new \App\image;
     
             $image->name = $name;
             $image->item_id=$item_id;
     
             $image->save();
           }
        }

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = \App\item::find($id);

        $item->delete();
        return redirect('home');

    }
    public function deleteImage($id)
    {
        DB::table('images')->where('id', '=', $id)->delete();

        return redirect()->back();

    }
    public function ajaxRequestPost(Request $request)

    {
   
        return response()->json(['success'=>$request['name']]);

    }
}
