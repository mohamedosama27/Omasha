@extends('bar')

@section('content')

<!-- <link href="css/cart.css" rel="stylesheet" type="text/css" media="all" /> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="/css/favorites.css">


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
   <i class="fa fa-3x fa-angle-left"></i>

   </a>
   <a class="right carousel-control" href="#myCarousel{{$loop->iteration}}" data-slide="next">
   <i class="fa fa-3x fa-angle-right"></i>

   </a>
 </div>
 </div>
 <div class="column1">
 <a href="{{route('item.show',['id' => $item->id])}}"><h5>{{$item->name}}</h5></a>
    <div class="product-details">
      
      
      
    </div><br><br>
    <button class="btn brandcolor raleway btnWeight btn-addtocart" data-value="{{$item->id}}">
              Add To Cart</button>
      <a href="{{route('removefromfavorites',['id' => $item->id])}}">
    <button class="remove-product">
        Remove
      </button></a>
    
    </div>
    <div class="pull-right price"><b >Price : </b> {{$item->price}}<p class="EGP">EGP</p></div>

   
    
    
    
    
  
  </div>
  <hr>
  @empty
  <div class="alert alert-dark"  style="text-align:center;margin-bottom:20px;" role="alert">
<h1 style="display:center;font-size:26px;" class="battalion" >wish list is empty</h1>
</div>
<br>

  @endforelse
  </div>
  </div>
  </div>


</div>
@include('errormessage')
<script type="text/javascript">


    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

  $(document).on("click", '.btn-addtocart', function(e) { 

        e.preventDefault();

            var str =  $(this).data('value');;
          $.ajax({

            type:'POST',

            url:"{{ route('item.addToCart') }}",

            data:{name:str},

            success:function(data){

              if (data.message === undefined) {

                $(".countCart").text(data.countCart);
                $('#messaga').text("Added Sucessfully")
                $('#errormessage').modal();
                } else {
                $('#messaga').text(data.message)
                $('#errormessage').modal();
                }
                                
            }

          });
    });

    </script>

@endsection