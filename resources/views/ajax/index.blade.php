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

    <a class="carousel-control-prev left carousel-control" href="#myCarousel{{$item->id}}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next right carousel-control" href="#myCarousel{{$item->id}}" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
</a>
  </div>
  @if($item->quantity <= 0)
  <p style="color:red;">Available Soon</p>
  @else
  <p><a href="{{route('item.show',['id' => $item->id])}}">{{$item->name}}</a></p>
  @endif
  <b>{{$item->price}}</b><p class="EGP">EGP</p><br>
  @auth
        @if(Auth::user()->type == 1)
        <b>Quantity : {{$item->quantity}}</b><br>

        <div class="btn-group btn-group-sm" role="group">

        <a href="{{route('item.delete',['id' => $item->id])}}" onclick="return confirm('Are you sure to delete {{$item->name}}?')">
        <button type="button" class="btn btn-default actions"><i class="fa fa-lg fa-trash actionIcons"></i></button></a>
        <a href="{{route('item.edit',['id' => $item->id])}}">
        <button type="button" class="btn btn-default actions" ><i class="fa fa-pencil actionIcons"></i></button></a>
       
      
        <a href="{{route('hideitem',['id' => $item->id])}}">
        <button type="button" class="btn btn-default actions" >
        @if($item->hide == 1)<i class="fa fa-eye actionIcons" ></i>@else <i class="fa fa-eye-slash actionIcons" ></i> @endif</button></a>
         <a>  <button type="button" data-value="{{$item->id}}" class=" btn-addToFavorite btn btn-default actions" >
           <i class="fa fa-heart actionIcons" style="margin-left:-7px;"></i></button></a>
</div>
        
        @else
       
        <button 
        @if($item->quantity <= 0)
        disabled
        @endif type="button" class="btn btn-default btn-addtocart column1" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;" ><b>Add to cart</b></button>
        <button type="button" data-value="{{$item->id}}" class="btn btn-default btn-addToFavorite column" style="margin-bottom:10px;">
           <i class="fa fa-heart"></i></button>
        @endif
        @else
        <button  @if($item->quantity <= 0)
        disabled
        @endif
         type="button" class="btn btn-default btn-addtocart column1" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;" ><b>Add to cart</b></button>
         <button type="button" data-value="{{$item->id}}" class="btn btn-default btn-addToFavorite column" style="margin-bottom:10px;">
           <i class="fa fa-heart"></i></button>
         @endauth


        <hr>
</div>

</div>


@endforeach