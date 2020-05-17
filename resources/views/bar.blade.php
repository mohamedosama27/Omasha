<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href={{ URL::asset("images/icon.ico")}} >
<title>OMASHA</title>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content= "width=device-width, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/bootstrap.css">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/html5shiv.min.js"></script>
  <script src="/js/Respond.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
  <link rel="stylesheet" href="/css/bar.css">
  <link rel="stylesheet" href="/css/w3schools.css">


  </head>
  @auth
    @if(Auth::user()->type == 1)
@include('addcategory')
@endif
@endauth
  <div class="toptext text-center">&nbsp; FREE  DELIVERY  ON ORDERS  ABOVE 100  EGP &nbsp;</div>
  <nav class="navbar">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header ">
  

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
      data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="" href="{{route('home')}}">
      <img  class="toplogo " src={{ URL::asset("images/Logo-1.png")}} ></a>
    
      <div class="wrapper visible-xs">
      <a href="{{ Request::is('cart') ? route('home') : route('cart') }}">
      <img class="baricons" src={{ URL::asset("images/cart.svg")}} >
      
      <span class="badge countCart" id='countcart'>@if(session()->has('number_of_items')){{Session::get('number_of_items')}}@endif</span>
      
     

      </a> 
  </div>
  <div class="wrapper visible-xs">
      @auth 
    @if(Auth::user()->type == 1)
    <a href="javascript:void(0)"
      onclick="senders_open()"  >
      @else
      <a href="{{ route('chat',['id' => Auth::user()->id]) }}"  >
    @endif
    @else
    <a href="{{ route('login')}}" >
      @endauth 
      <img class="baricons" src={{ URL::asset("images/chat.svg")}} >
      </a>          
       <span class="badge countmessage"></span>
  </div>

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>  
      <a href="#"><div class="wheretobuy">
      <img class="locationicon hidden-xs" src={{ URL::asset("images/Location.svg")}} >
 
      <span class="raleway" >
      WHERE TO BUY</span></div>
      </a> 
  </li>
  <li>
    <a href="{{route('favorites')}}">
      <div class="visible-xs">
            <span class="raleway">
            WISHLIST</span>
      
        </div>
  </a>
  </li>
  @auth
    
   
  
    @if(Auth::user()->type == 1)
    <li class="dropdown visible-xs">
          <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown"
          role="button" aria-haspopup="true" aria-expanded="false">ACTIONS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
    
            <li><a href="{{route('addadminview')}}">
            <i class="fa fa-plus actionicons"></i>Add Admin</a></li>    
            
            <li><a href="{{route('item.create')}}">
            <i class="fa fa-plus actionicons"></i>Add Item</a></li>       

            <li><a href="{{route('vieworders')}}">
            <i class="fa fa-list actionicons"></i>View Orders</a></li>

            <li><a href="{{route('category.edit')}}">
            <i class="fa fa-edit actionicons"></i>Edit Categories</a></li>

            <li><a data-toggle="modal" data-target="#addcategory">
            <i class="fa fa-plus actionicons"></i>Add Category</a></li>

            <li><a href="{{route('report')}}">
            <i class="fa fa-clipboard actionicons"></i>Report</a></li>
          </ul>
    </li>
  
  
    @else
    <li>
      <a href="{{route('lastorder')}}" class="raleway visible-xs">LAST ORDER</a>
</li>




@endif

@endauth

  <li>
      <a href="#" class="raleway visible-xs">NEW ARRIVALS</a>
</li>
<li>
      <a href="#" class="raleway visible-xs">SHOP</a>
</li>
<li>
      <a href="#" class="raleway visible-xs">ABOUT</a>
</li>
<li class="dropdown visible-xs">
          <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown"
          role="button" aria-haspopup="true" aria-expanded="false">
          PRODUCTS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          @php( $categories = \App\category::all() )
    @foreach($categories as $category)
    <li><a href="{{route('category',['id' => $category->id])}}" style="font-size:20px;">
            {{$category->name}}</a></li>        
      @endforeach
          
          </ul>
        </li>
    @auth
    <li>
        <a href="{{ route('user.edit',['id' => Auth::user()->id]) }}" class=" visible-xs raleway">
        Edit profile</a>
</li>
    <li class=" login raleway visible-xs">
        <a href="{{route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
    </li>
    @else
        <li class=" login raleway visible-xs">     
      <a href="{{ Request::is('login') ? route('home') : route('login') }}">Log in</a> 
    </li>
    @endauth
      </ul>
    
     
  <ul class="nav navbar-nav navbar-right hidden-xs">
  @auth

    <li class=" login raleway ">
        <a href="{{route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
    </li>
    @else
    <li>     
      <a href="{{ Request::is('login') ? route('home') : route('login') }}" class="login raleway">Log in</a> 
    </li>
    @endauth

    <li>     
      <a href="{{route('favorites')}}">
        <img class="favoriteicon" src={{ URL::asset("images/search.svg")}} >
     </a> </li>



      <li>      
        <div class="wrapper">
      @auth 
        @if(Auth::user()->type == 1)
        <a href="javascript:void(0)"
          onclick="senders_open()" >
          @else
          <a href="{{ route('chat',['id' => Auth::user()->id]) }}">
        @endif
        @else
        <a href="{{ route('login')}}" >
          @endauth 
            <img class="baricons" src={{ URL::asset("images/chat.svg")}} >
            <span class="badge countmessage"></span>  
           </a>
        </div>
    </li>
        <li>      <div class="wrapper">
      <a href="{{ Request::is('cart') ? route('home') : route('cart') }}"><img class="baricons" src={{ URL::asset("images/cart.svg")}} >
</a>  <span class="badge countCart" id='countcart'>{{Session::has('number_of_items') ? Session::get('number_of_items'): ''}}</span>
  </div>
</li>
    <li>     
      <a href="{{route('favorites')}}">
        <img class="favoriteicon" src={{ URL::asset("images/favorite.svg")}} >
     
      </a>
    </li>


        
      </ul>
      
     
    </div><!-- /.navbar-collapse -->
    
    <div class="secondbar @auth secondBarForAuth @endauth hidden-xs">
      <ul class="nav navbar-nav ">
      <li>
      <a href="#" class="raleway">NEW ARRIVALS</a>
</li>
<li>
      <a href="#" class="raleway">SHOP</a>
</li>
<li>
      <a href="#" class="raleway">ABOUT</a>
</li>
<li class="dropdown">
          <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown"
          role="button" aria-haspopup="true" aria-expanded="false">PRODUCTS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          @php( $categories = \App\category::all() )
    @foreach($categories as $category)
    <li><a href="{{route('category',['id' => $category->id])}}" style="font-size:20px;">
            {{$category->name}}</a></li>        
      @endforeach
          </ul>
        </li>
        @auth

  
    @if(Auth::user()->type == 1)
    <li class="dropdown">
          <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown"
          role="button" aria-haspopup="true" aria-expanded="false">ACTIONS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
    
            <li><a href="{{route('addadminview')}}">
            <i class="fa fa-plus actionicons"></i>Add Admin</a></li>    
            
            <li><a href="{{route('item.create')}}">
            <i class="fa fa-plus actionicons"></i>Add Item</a></li>       

            <li><a href="{{route('vieworders')}}">
            <i class="fa fa-list actionicons"></i>View Orders</a></li>

            <li><a href="{{route('category.edit')}}">
            <i class="fa fa-edit actionicons"></i>Edit Categories</a></li>

            <li><a data-toggle="modal" data-target="#addcategory">
            <i class="fa fa-plus actionicons"></i>Add Category</a></li>

            <li><a href="{{route('report')}}">
            <i class="fa fa-clipboard actionicons"></i>Report</a></li>
          </ul>
    </li>
  
  
    @else
    <li>
      <a href="{{route('lastorder')}}" class="raleway">LAST ORDER</a>
</li>




@endif
<li>
        <a href="{{ route('user.edit',['id' => Auth::user()->id]) }}" class="raleway">
        EDIT PROFILE</a>
</li>

@endauth

</ul>
      </div>
  </div><!-- /.container-fluid -->
</nav>

<nav class="w3-sidebar w3-bar-block w3-white w3-top" style="z-index:3;width:250px;display:none;" id="senders">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="senders_close()" class="fa fa-remove w3-button w3-display-topright"></i>
    <h2 class="raleway w3-wide notificationHeader">
      <b>NOTIFICATIONS</b></h2>
  </div>
  <a href="{{route('users')}}" class="w3-bar-item w3-button w3-white">
  <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-light-blue">Show All</button>
</a>


  <div class="w3-padding-64 w3-large senders" style="font-weight:bold">
  
     </div>
  
</nav>
@yield('content')

<script>
  function senders_open() {
  document.getElementById("senders").style.display = "block";
  getSenders();
}
 
function senders_close() {
  document.getElementById("senders").style.display = "none";
}

$.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});
@auth
countmessages();

setInterval(countmessages, 2000);
@endauth
function countmessages() { 
$.ajax({

type:'POST',
_token: $('meta[name=csrf_token]').attr('content'),

url:"{{ route('countmessage') }}",

data:{},
datatype:'json',

success:function(data)
{
    if(data.countmessages != 0){
      $(".countmessage").text(data.countmessages);
    }
    else{
      $(".countmessage").text('');

    }
}

});
}

function getSenders() {

$.ajax({

type:'POST',
_token: $('meta[name=csrf_token]').attr('content'),

url:"{{ route('getSenders') }}",

data:{},
datatype:'json',

success:function(data)
{
  $( ".senders" ).html( $( data.senders ) );
}

});

}
</script>