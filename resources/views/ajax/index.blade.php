@foreach($items as $item)


<div class="w3-col l3 s6">

      <div class="w3-container div3">
      
  <div id="myCarousel{{$item->id}}" class="carousel slide" data-ride="carousel" data-interval="false" >
   

    <!-- Wrapper for slides -->
    
    <div class="carousel-inner div1" >
   
    @foreach($item->images as $image)
    @if ($loop->first)
    <div class="item active">
    <a href="{{route('item.show',['id' => $item->id])}}">  <img src={{ URL::asset("images/{$image->name}")}}></a>
      </div>    
     @else
      <div class="item">
      <a href="{{route('item.show',['id' => $item->id])}}">  <img src={{ URL::asset("images/{$image->name}")}}></a>
        
      </div>
      @endif
      @endforeach

   
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel{{$item->id}}" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel{{$item->id}}" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  @if($item->quantity <= 0)
  <p style="color:red;">Available Soon</p>
  @else
  <p><a href="{{route('item.show',['id' => $item->id])}}">{{$item->name}}</a></p>
  @endif
  <b>${{$item->price}}</b><br>
  @auth
        @if(Auth::user()->type == 1)
        <b>Quantity : {{$item->quantity}}</b><br>

        <a href="{{route('item.delete',['id' => $item->id])}}" onclick="return confirm('Are you sure to delete {{$item->name}}?')"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a>
        <a href="{{route('item.edit',['id' => $item->id])}}"><button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Edit</b></button></a>
        <a href="{{route('hideitem',['id' => $item->id])}}">
        <button type="button" class="btn btn-default" style="margin-bottom:10px;color:black;">
        <b>@if($item->hide == 1)unHide @else Hide @endif</b></button></a>

        @else
        
        <button 
        @if($item->quantity <= 0)
        disabled
        @endif type="button" class="btn btn-default btn-addtocart column1" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;" ><b>Add to cart</b></button>

        @endif
        @else
        <button  @if($item->quantity <= 0)
        disabled
        @endif
         type="button" class="btn btn-default btn-addtocart column1" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;" ><b>Add to cart</b></button>
          
         @endauth

           <button type="button" data-value="{{$item->id}}" class="btn btn-default btn-addToFavorite column" style="margin-bottom:10px;">
           <i class="fa fa-heart"></i></button>
        <hr>
</div>

</div>


@endforeach