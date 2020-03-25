@extends('bar')

@section('content')
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>

    .div1{
      width:130px;
      height:170px;

    }
  
    img{
      width:130px;
    }
    .div3
    {
      display: table;
      
    }
    p{
      max-width: 110px;

    }

  
    .cardspace{
        margin:10px;
    }
 

 
    img{
      width:130px;
      height:150px;
      
    }
    .div3
    {
      max-height:220px;
      
    }
    p 
    {
     color:black;
     height :20px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
    }
    

</style>


<br>

  <div class="w3-card cardspace ">

<div class="cardspace">

  <div class=" w3-grayscale" id="results">
  
  @foreach($items as $item)
<form>

<div class="w3-col l3 s6">
      <div class="w3-container div3">
      
  <div id="myCarousel{{$loop->iteration}}" class="carousel slide" data-ride="carousel" data-interval="false" >
   

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
  @if($item->quantity == 0)
  <p style="color:red;">Available Soon</p>
  @else
  <p><a href="{{route('item.show',['id' => $item->id])}}">{{$item->name}}</a></p>
  @endif
  <b>${{$item->price}}</b><br>
      @auth
        @if(Auth::user()->type == 1)
        <a href="{{route('item.delete',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a>
        <a href="{{route('item.edit',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Edit</b></button></a>


        @else
        <button type="button" class="btn btn-default btn-submit" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;"><b>Add to Cart</b></button>

        @endif
        @else
        <a href="{{route('item.addToCart',['id' => $item->id])}}">
        <button type="button" class="btn btn-default btn-submit" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;"><b>Add to Cart</b></button></a>
      @endauth

        <hr>
</div>

</div>

</form>
@endforeach
  </div>
</div>
</div>
<script type="text/javascript">

   

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

   

    $(".btn-submit").click(function(e){

  

       e.preventDefault();

           var str =  $(this).data('value');;
        $.ajax({

           type:'POST',

           url:"{{ route('item.addToCart') }}",

           data:{name:str},

           success:function(data){

              $("#countcart").text(data.success);
              
           }

        });

  

	});

</script>

@endsection