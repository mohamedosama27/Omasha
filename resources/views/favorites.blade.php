@extends('bar')

@section('content')

<!-- <link href="css/cart.css" rel="stylesheet" type="text/css" media="all" /> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .div1{
    height:150px;
     width:auto;
   }
     .product  {
    text-align: center;
  }
    .product img {
    width: 100px;
  }
    .product:after {
    content: '';
    display: table;
    clear: both;
  }

  .product-details {
    line-height: 1.4em;
    
    float: left;
  }
  .cardspace{
       margin:10px;
   }
   .EGP{
  margin-left:5px;
  font-size:12px;
  display:inline;
}
.item{
      text-align:center;
      }
     
      .carousel img {
        width:100%;
        height: 100%!important;
        display:inline-block  !important;
      }

/* Create two equal columns that floats next to each other */
.column1 {
  float: left;
  width: 50%;
  padding: 10px;
}

.product-description {
    
    line-height: 1.4em;
  }

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {

    .product-details {
    line-height: 1.4em;
    
    float: left;
  }
  
  .column1 {
    width: 100%;
  }
}
.product-details{
  width: auto;
}
.remove-product{
display:inline;
margin-left:10%;
border: 0;
    padding: 4px 8px;
    background-color: #c66;
    color: #fff;
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    font-size: 12px;
    border-radius: 3px;
}
</style>

<br>
<div class="w3-card cardspace">

<div class="cardspace">
<div class="shopping-cart">

<br>


@forelse($items as $item)
  <div class="product row" >
    <div class="column1">
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
 </div>
 <div class="column1">
 <a href="{{route('item.show',['id' => $item->id])}}"><h3>{{$item->name}}</h3></a>
    <div class="product-details">
      
      <p class="product-description">{{$item->description}}</p>
      
    </div><br><br>
    <b >Price : </b> {{$item->price}}<p class="EGP">EGP</p>
      <a href="{{route('removefromfavorites',['id' => $item->id])}}">
    <button class="remove-product">
        Remove
      </button></a>
    
    </div>
   
    
    
    
    
  
  </div>
  @empty
    <h1 style="margin-left:13%">No items</h1>

  @endforelse
  </div>
  </div>
  </div>


</div>


@endsection