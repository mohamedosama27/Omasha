
@extends('bar')

@section('content')
 
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
  
 
.fa-heart{
  font-size:18px;
  color:red;
  }
img {
  max-width: 100%; 
  max-height:400px;
  max-width:200px;
  
   }
   @media screen and (min-width: 996px) {
     .card{
       margin-right:100px;
     }
   }



  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 20px;
  background:rgb(250, 250, 250);
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }





.product-title, .price,{
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .product-description, .price,  {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }







 .EGP{
  margin-left:5px;
  font-size:12px;
  display:inline;
}


@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }
        

</style>
	
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
          @foreach($item->images as $image)
             @if ($loop->first)
						  <div class="tab-pane active" id="pic-{{$loop->iteration}}"><img src={{ URL::asset("images/{$image->name}")}} alt="{{$image->name}}" /></div>
						  @else
              <div class="tab-pane" id="pic-{{$loop->iteration}}"><img max-height="200" max-width="200" src={{ URL::asset("images/{$image->name}")}} alt="{{$image->name}}" /></div>
              @endif
          @endforeach
            </div>
						<ul class="preview-thumbnail nav nav-tabs">
            @foreach($item->images as $image)
             @if ($loop->first)
             
						  <li class="active"><a data-target="#pic-{{$loop->iteration}}" data-toggle="tab"><img src={{ URL::asset("images/{$image->name}")}} /></a></li>
						  @else
              <li><a data-target="#pic-{{$loop->iteration}}" data-toggle="tab"><img src={{ URL::asset("images/{$image->name}")}} /></a></li>
              @endif
          @endforeach
            </ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{$item->name}}</h3>
						
						<p class="product-description">{{$item->description}}</p>
						<h4 class="price">current price: <span>{{$item->price}} <p class="EGP">LE</p></span></h4>
					
				
						<div class="action">
        @if(Auth::check() && Auth::user()->type == 1)

        <p><b>Quantity : </b>{{$item->quantity}}</p>

        <a href="{{route('item.delete',['id' => $item->id])}}" onclick="return confirm('Are you sure to delete {{$item->name}}?')"><button type="button" class=" btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a>
        
        <a href="{{route('item.edit',['id' => $item->id])}}">

        <button type="button" class=" btn btn-default" style="margin-bottom:10px;color:black;"><b>Edit</b></button></a>

        <a href="{{route('hideitem',['id' => $item->id])}}">

        <button type="button" class="btn btn-default" style="margin-bottom:10px;color:black;">
        
        <b>@if($item->hide == 1)un Hide @else Hide @endif</b></button></a>

        @else
        <button type="button" class="btn btn-default btn-addtocart" data-value="{{$item->id}}" style="margin-bottom:10px;" style="color:black;"><b>Add to Cart</b></button>
        
        @endif
       						
      	<button class=" btn btn-default btn-addToFavorite" data-value="{{$item->id}}" type="button" style="margin-bottom:10px;color:black;"><span class="fa fa-heart"></span></button>
            </div>

					</div>
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

$(document).on("click", '.btn-addToFavorite', function(e) { 

e.preventDefault();

    var id =  $(this).data('value');;
 $.ajax({

    type:'POST',

    url:"{{ route('addToFavorite') }}",

    data:{id:id},

    success:function(data){

      $('#messaga').text(data.message)
      $('#errormessage').modal(); 
      $(".countfavorites").text(data.countFavorites);

         }

 });
});
$(document).on("click", '.btn-addtocart', function(e) { 

   e.preventDefault();

       var str =  $(this).data('value');
    $.ajax({

       type:'POST',

       url:"{{ route('item.addToCart') }}",
       data:{name:str},
       
       success:function(data){

        if(data.message===undefined)
            {

              $("#countcart").text(data.countCart);
              $('#messaga').text("Added Sucessfully")
                $('#errormessage').modal();
            }
            else
            {
              $('#messaga').text(data.message)
              $('#errormessage').modal();
            }          
       }

    });
  });
  </script>

@endsection
