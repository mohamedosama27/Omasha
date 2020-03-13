@extends('bar')

@section('content')
 
<style>
    .cardspace{
        margin:10px;
    }
  

</style>
<br>
<div class="w3-card cardspace">

<div class="cardspace">
  <div class=" w3-grayscale">
  @foreach($items as $item)
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <img src="{{$item->image}}" style="width:100%">
        <p>{{$item->name}}<br><b>${{$item->price}}</b></p>
        <a href="{{route('item.addToCart',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;">Add to Cart</button></a>
      </div>
     
    </div>
   

    @endforeach

    
  </div>
  </div>
  </div>

@endsection