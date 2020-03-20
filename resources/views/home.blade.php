@extends('bar')

@section('content')
 
<style>
    .cardspace{
        margin:10px;
    }
 
   
    .div1{
     height:170px;
      width:130px;
    }
    .div2{
      height:220px;
      width:130px;
    }
    img{
      height:150px;
      width:130px;
    }
    .div3
    {
      max-height:220px;
      display: table;

    }
    p 
    {
     color:black;
     max-width: 110px;
     height :20px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
    }
    

</style>
<br>


  <div class="w3-card cardspace ">

<div class="cardspace">
  <div class=" w3-grayscale">
  @foreach($items as $item)
    <div class="w3-col l3 s6 div2  div3">
      <div class="w3-container">

  <div id="myCarousel{{$loop->iteration}}" class="carousel slide div1" data-ride="carousel" data-interval="false" >
   

    <!-- Wrapper for slides -->
    
    <div class="carousel-inner div1" >
   
    @foreach($item->images as $image)
    @if ($loop->first)
    <div class="item active">
        <img src="images\{{$image->name}}">
      </div>    
     @else
      <div class="item">
        <img height="150" width="110" src="images\{{$image->name}}">
        
      </div>
      @endif
      @endforeach

   
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel{{$loop->iteration}}" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel{{$loop->iteration}}" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <p>{{$item->name}}<br><b>${{$item->price}}</b></p>
  
      @auth
        @if(Auth::user()->type == 1)
        <a href="{{route('item.delete',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a>
        <a href="{{route('item.edit',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Edit</b></button></a>


        @else
        <a href="{{route('item.addToCart',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Add to Cart</b></button></a>

        @endif
        @else
        <a href="{{route('item.addToCart',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Add to Cart</b></button></a>

      @endauth
        <hr>
</div>

</div>

@endforeach
  </div>
</div>
</div>


@endsection