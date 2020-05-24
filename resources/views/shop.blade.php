@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/shop.css">

<div class="container">
    <div class="row">
    @foreach($items as $item)

        <div class="product col-xs-6 col-md-3">

            <div class="productImg">
                <img src="images\{{$item->images->first()->name}}" width="100%">      
                <button class="btn center-block" data-toggle="modal" data-target="#myModal{{$item->id}}">Quick View</button>
              </div>
               <!-- Modal -->
  <div class="modal fade" id="myModal{{$item->id}}" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content quickview">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div id="carousel{{$item->id}}" class="carousel topCarousel" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  @foreach($item->images as $image)
  @if ($loop->first)

    <li data-target="#carousel{{$item->id}}" data-slide-to="0" class="active">
      <img src={{ URL::asset("images/Logo-2.png")}} width="100%">      

    </li>
    @else

    <li data-target="#carousel{{$item->id}}" data-slide-to="1">
      <img  src={{ URL::asset("images/Logo-2.png")}} width="100%">      

    </li>
    @endif
  @endforeach
  </ol>

  <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
        @foreach($item->images as $image)

    @if ($loop->first)
    <div class="item active" >
    <a href="{{route('item.show',['id' => $item->id])}}"> <img src={{ URL::asset("images/{$image->name}")}}></a>
      </div>    
    @else
      <div class="item">
      <a href="{{route('item.show',['id' => $item->id])}}"> 
        <img src={{ URL::asset("images/{$image->name}")}}></a>
        
      </div>
  

  @endif
  @endforeach
          ...
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel{{$item->id}}"
        role="button" data-slide="prev">
        <i class="fa fa-3x fa-angle-left"></i>

        </a>
        <a class="right carousel-control" href="#carousel{{$item->id}}" role="button" data-slide="next">
        <i class="fa fa-3x fa-angle-right" ></i>
        </a>
      </div>      
      </div>

      </div>
      
    </div>
  </div>
            <p>{{$item->name}}</p>
            <p>{{$item->price}} EGP</p>
            <button class="btn brandcolor raleway btnWeight btn-addtocart" data-value="{{$item->id}}">
              Add To Cart</button><br>
            <a data-value="{{$item->id}}"  class="btn-addToFavorite raleway addtowishlist">Add To Wishlist</a>

        </div>
       @endforeach
    </div>
</div>

<div class="custom-pagination-brand-blue text-center">
{{ $items->links() }}
</div>
@endsection
