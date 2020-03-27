@extends('bar')

@section('content')
<link href="css/cart.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/cart.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />
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
    button{
      padding: 0;
      border: none;
      background: none;
      outline: none;
      }
      .fa-plus-square , .fa-minus-square{
        color:blue;
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

    <button type="button" class="btn-increment" data-value="{{$selecteditem->item->id}}" style="margin-bottom:10px;" style="color:black;">
    <i class="fa fa-plus-square"></i></button>

  
      <p id="quantity{{$selecteditem->item->id}}">{{$selecteditem->Quantity}}</p>

      <button type="button" class="btn-decrement" data-value="{{$selecteditem->item->id}}" style="margin-bottom:10px;" style="color:black;">
      <i class="fa fa-minus-square"></i>
      </button>
  
</div>
    
    <div class="product-removal">
    <a href="{{route('removefromcart',['id' => $selecteditem->item->id])}}">
    <button class="remove-product">
        Remove
      </button></a>
    </div>
    <div class="product-line-price" id="totalprice{{$selecteditem->item->id}}">{{$selecteditem->item->price*$selecteditem->Quantity}}</div>
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

<script type="text/javascript">

   

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(document).on("click", '.btn-decrement', function(e) { 

        e.preventDefault();

            var id =  $(this).data('value');
        $.ajax({

            type:'POST',

            url:"{{ route('decrementItem') }}",

            data:{id:id},
            datatype:'json',

            success:function(data){
              $("#quantity"+id).text(data.quantity);              
              $("#totalprice"+id).text(data.totalprice);
              $("#countcart").text(data.countCart);
       
            }

        });

});
    $(document).on("click", '.btn-increment', function(e) { 


  

       e.preventDefault();

           var id =  $(this).data('value');
        $.ajax({

           type:'POST',

           url:"{{ route('incrementItem') }}",

           data:{id:id},
           datatype:'json',

           success:function(data){
              $("#quantity"+id).text(data.quantity);              
              $("#totalprice"+id).text(data.totalprice);   
              $("#countcart").text(data.countCart);
    
           }

        });

	});

 

</script>

@endsection