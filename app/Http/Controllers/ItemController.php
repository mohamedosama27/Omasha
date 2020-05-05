<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class ItemController extends Controller
{
    
    protected $items_per_page = 10;
   public function validation($request)
   {
      //validate data passed from add item view or edit item view

      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'quantity' => ['required', 'numeric'],
        'price' => ['required', 'numeric'],
        'cost' => ['required', 'numeric'],
        'barcode' => ['required','string', 'max:255']

  ]);

   }
    public function index(Request $request) {

      //retieve 10 items from items table

      if(\App\item::count()>10){
        if (Auth::user() && auth()->user()->type==1)
        {
        $items = \App\item::orderBy('id', 'DESC')->paginate($this->items_per_page);
        }
        else{
          $items = \App\item::where('hide','=',NULL)->orderBy('id', 'DESC')->paginate($this->items_per_page);

        }
        if($request->ajax()) {
          return [
              'items' => view('ajax.index')->with(compact('items'))->render(),
              'next_page' => $items->nextPageUrl(),
              'numberofitems'=>count($items)
          ];
      }
      
        return view('home')->with(compact('items'));
      
      }
      else{
        if (Auth::user() && auth()->user()->type==1)
        {
          $items = \App\item::orderBy('id', 'DESC')->get();
        }
        else{
          $items = \App\item::where('hide','=',NULL)->orderBy('id', 'DESC')->get();

        }
        return view('home')->with(compact('items'));

      }
        

    }

    public function fetchNextitemsSet($page) {

    }

   

    public function create(Request $request)
    {
      //retieve all categories and passed to add item view

        $categories = \App\category::all();

        return view('additem',[
            'categories'=>$categories
        ]);

    }


    public function store(Request $request)
    {
      //create new item in items table and create images in images table 

      $this->validation($request);
        $item = new  \App\item;
        $item->name = $request['name'];
        $item->description=$request['description'];
        $item->quantity=$request['quantity'];
        $item->price=$request['price'];
        $item->cost=$request['cost'];
        $item->barcode=$request['barcode'];
        $item->category_id=$request['category'];
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

   
    public function show($id)
    {
      //retrieve show single item by id

        $item = \App\item::findorfail($id);

        return view('item',[
            'item'=>$item,
        ]);
        
    }

   
    public function edit($id)
    {
      //retieve all categories and item data to pass to edit item view

        $item = \App\item::findorfail($id);
        $categories = \App\category::all();
        return view('edititem',[
            'item'=>$item,
            'categories'=>$categories
        ]);

    }


    public function update(Request $request, $id)
    {
      //update item with new data passed

      $this->validation($request);  
        $item = \App\item::find($id);
        $item->name = $request['name'];
        $item->description=$request['description'];
        $item->quantity=$request['quantity'];
        $item->price=$request['price'];
        $item->cost=$request['cost'];
        $item->category_id=$request['category'];
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


    public function destroy($id)
    {
      //delete item with passed item

        $item = \App\item::findorfail($id);
        $item->delete();
        return redirect('home');

    }
    public function deleteImage($id)
    {
      //delete image from images table with passed id

        $image = \App\image::find($id);
        DB::table('images')->where('id', '=', $id)->delete();
        echo $image->name;
        if(\File::exists(public_path('images/'.$image->name))){

            \File::delete(public_path('images/'.$image->name));
        
          }else{
        
           echo 'File does not exists.';
        
          }

        return redirect()->back();

    }
    function action(Request $request)
    {
      //search for item in items table by item name

     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
        if (Auth::user() && auth()->user()->type==1)
        {
          $data = \App\item::where('name', 'like', '%'.$query.'%')
          ->orderBy('id', 'DESC')->get();        }
        else{
          $data = \App\item::where('hide','=',NULL)->where('name', 'like', '%'.$query.'%')
          ->orderBy('id', 'DESC')->get();
        }

         
      }
      
    
   
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $item)
       {
        $images=DB::table('images')->where('item_id', '=',$item->id)->get();
        
        $output .= '<div class="w3-col l3 s6">
        <div class="w3-container div3">
        
         <div id="myCarousel'.$item->id.'" class="carousel slide" data-ride="carousel" data-interval="false" >
     
  
     
      
      <div class="carousel-inner div1" >';
     
      foreach($images as $index => $image){
        $url=asset('images/'.$image->name);
      if ($index == 0) {
        
        $output .='
        <div class="item active">
        
        <a href="'.route("item.show",["id" => $item->id]).'"> <img src="'.$url.'"></a>
        </div> ';
      }   
       else{
       $output .='<div class="item">
       <a href="'.route("item.show",["id" => $item->id]).'">  <img height="150" width="110" src="'.$url.'"></a>
          
        </div>';
    }
    }
       
     
    $output .='</div>
  
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel'.$item->id.'" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control"  href="#myCarousel'.$item->id.'" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div> ';
    
    if($item->quantity <= 0){
        $output .='<p style="color:red;">Available Soon</p>';
        }
        else{
          
        $output .='<p><a href="'.route("item.show",["id" => $item->id]).'">'.$item->name.'</a></p>';
        }
        $output .='<b>$'.$item->price.'</b><br>';

        if (Auth::check()) {
            if(Auth::user()->type == 1){
              $output .='<b>Quantity : '.$item->quantity.'</b><br>';
            $output .='<a href="'.route("item.delete",["id" => $item->id]).'"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a>
            <a  href="'.route("item.edit",["id" => $item->id]).'"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Edit</b></button></a>
            <a href="'.route("hideitem",["id" => $item->id]).'">
            <button type="button" class="btn btn-default" style="margin-bottom:10px;color:black;">
            <b>';
            if($item->hide == 1)
            {
              $output .='unHide';
            }
            else {
              $output .='Hide';

            } 
            $output .='</b></button></a>';
          
          }
    
            else{
              if($item->quantity <= 0){
              $output .=' <button type="button" class="btn btn-default btn-addtocart column1" data-value="'.$item->id.'" style="margin-bottom:10px;" style="color:black;" disabled><b>Add to Cart</b></button>';
              }
              else{
                $output .=' <button type="button" class="btn btn-default btn-addtocart column1" data-value="'.$item->id.'" style="margin-bottom:10px;" style="color:black;"  ><b>Add to Cart</b></button>';

              }
            }

      }
      else{
        if($item->quantity <= 0){

          $output .=' <button type="button" class="btn btn-default btn-addtocart column1" data-value="'.$item->id.'" style="margin-bottom:10px;" style="color:black;" disabled ><b>Add to Cart</b></button>';
        }
        else{
          $output .=' <button type="button" class="btn btn-default btn-addtocart column1" data-value="'.$item->id.'" style="margin-bottom:10px;" style="color:black;"  ><b>Add to Cart</b></button>';

        }
        
        }  
        $output.=' <button type="button" data-value="'.$item->id.'" class="btn btn-default btn-addToFavorite column" style="margin-bottom:10px;">
        <i class="fa fa-heart"></i></button>';
       
      $output .='  <hr>
    </div>
    
    </div>
    
    ';
    
       }
      }
      else
      {
       $output = '
       <div class="alert alert-dark">
       <h3 >No items with this name</h3>
       </div>       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
    public function hide($id)
    {
      $item = \App\item::findorfail($id);
      if($item->hide!=1){
        $item->hide=1;
      }
      else
      {
        $item->hide=NULL;
      }
      $item->save();
      return redirect()->back();

    }
}

