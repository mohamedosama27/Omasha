@extends('bar')

@section('content')
 
<style>
    .cardspace{
        margin:10px;
    }
 
   
    .div1{
     height:150px;
      width:110px;
    }
    .div2{
      height:200px;
      width:110px;
    }
    img{
      height:100%;
      width:100%;
    }

</style>
<br>
<!-- <div class="w3-card cardspace">

<div class="cardspace">
  <div class=" w3-grayscale">
  @foreach($items as $item)
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <img height="150" width="110"src="{{$item->image}}" style="width:100%">
        <p>{{$item->name}}<br><b>${{$item->price}}</b></p>
        <a href="{{route('item.addToCart',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;">Add to Cart</button></a>
      </div>
     
    </div>
   

    @endforeach

    
  </div>
  </div>
  </div> -->

  <div class="w3-card cardspace ">

<div class="cardspace">
  <div class=" w3-grayscale">
  @foreach($items as $item)
    <div class="w3-col l3 s6 div2">
      <div class="w3-container div2">

  <div id="myCarousel{{$loop->iteration}}" class="carousel slide div1" data-ride="carousel" data-interval="false" >
   

    <!-- Wrapper for slides -->
    
    <div class="carousel-inner div1" >
   
    @foreach($item->images as $image)
    @if ($loop->first)
    <div class="item active div1">
        <img src="images\{{$image->name}}" height="150" width="110">
      </div>    
     @else
      <div class="item div1">
        <img height="150" width="110" src="images\{{$image->name}}">
        
      </div>
      @endif
      @endforeach

      <!-- <div class="item">
        <img src="images/2.jpg" alt="Chicago" >
      </div>
    
      <div class="item">
        <img src="images/3.jpg" alt="New york">
      </div> -->
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
        <a href="{{route('item.addToCart',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;">Add to Cart</button></a>
     
</div>
</div>
@endforeach
  </div>
</div>
</div>


@endsection