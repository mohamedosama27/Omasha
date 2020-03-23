@extends('bar')

@section('content')
<link href="css/cart.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/cart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>   .div1{
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
    .cardspace{
        margin:10px;
    }
    .margintop{
        margin-top:10px;
    }
    p{
        word-break: break-all;
    }
</style>
<br>
<div class="w3-card cardspace">

<div class="cardspace">
<div class="shopping-cart">

<br>

@php
$totalprice=0
@endphp
@foreach($items as $selecteditem)
  <div class="product " >
    
  <div id="myCarousel{{$loop->iteration}}" class="carousel slide div1" data-ride="carousel" data-interval="false" >
   

   <!-- Wrapper for slides -->
   
   <div class="carousel-inner div1" >
  
   @foreach($selecteditem->item->images as $image)
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

    <div class="product-details">
      <div class="product-title">{{$selecteditem->item->name}}</div>
      <p class="product-description">{{$selecteditem->item->description}}</p>
    </div>
    <div class="product-price">{{$selecteditem->item->price}}</div>
    <div class="row product-quantity" >
    <a href="{{route('incrementItem',['id' => $selecteditem->item->id])}}">
      <i class="fa fa-plus-square"></i>
  </a>
      <p>{{$selecteditem->Quantity}}</p>
      <a href="{{route('decrementItem',['id' => $selecteditem->item->id])}}">
      <i class="fa fa-minus-square"></i>
  </a>
</div>
    
    <div class="product-removal">
    <a href="{{route('removefromcart',['id' => $selecteditem->item->id])}}">
    <button class="remove-product">
        Remove
      </button></a>
    </div>
    <div class="product-line-price">{{$selecteditem->item->price*$selecteditem->Quantity}}</div>
  </div>
  @php $totalprice+=$selecteditem->item->price*$selecteditem->Quantity @endphp
  @endforeach



  <div class="totals">
    <div class="totals-item">
      <label>Subtotal</label>
      <div class="totals-value" id="cart-subtotal">{{$totalprice}}</div>
    </div>
    <div class="totals-item">
      <label>Tax (5%)</label>
      <div class="totals-value" id="cart-tax">3.60</div>
    </div>
    <div class="totals-item">
      <label>Shipping</label>
      <div class="totals-value" id="cart-shipping">15.00</div>
    </div>
    <div class="totals-item totals-item-total">
      <label>Grand Total</label>
      <div class="totals-value" id="cart-total">{{$totalprice}}</div>
    </div>
  </div>
  @include('addaddress')

  <a  @auth data-toggle="modal" data-target="#addaddress" @else href=" login" @endauth >
  <button class="checkout">Checkout</button>
</div>
<br>

</div>
</div>

@endsection