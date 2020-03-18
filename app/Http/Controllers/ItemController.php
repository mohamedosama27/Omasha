<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
      


    //    $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
    //    $request->file('img')->move("images", $name);
    $item = new  \App\item;
 
    $item->Name = $request['Name'];
    $item->description=$request['Description'];
    $item->quantity=$request['Quantity'];
    $item->price=$request['Price'];
    $item->category_id=$request['Category'];
    $item->save();
        // DB::table('items')->insert(
        //     ['Name' => $request['Name'],'Description' => $request['Description'], 'Price' => $request['Price'], 'Quantity' => $request['Quantity'], 'category_id' => $request['Category']]);
        // // echo "<script>alert('Inserted successfully')</script>";
        // $item_id = response()->json(array('success' => true, 'last_insert_id' => $item->id), 200);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }
}
