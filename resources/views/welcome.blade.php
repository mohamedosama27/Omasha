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


  </head>
  <div class="toptext text-center">&nbsp;&nbsp;&nbsp;&nbsp; FREE  DELIVERY  ON ORDERS  ABOVE 100  EGP &nbsp;&nbsp;</div>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header ">
  

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="" href="#">
      <img  class="toplogo " src={{ URL::asset("images/Logo-1.png")}} ></a>
    
      <div class="wrapper visible-xs">
      <a href="#">
      <img class="baricons" src={{ URL::asset("images/cart.svg")}} >
 
      <span class="badge countCart" id='countcart'>
      {{Session::has('number_of_items') ? Session::get('number_of_items'): '4'}}</span>
      </a> 
  </div>
  <div class="wrapper visible-xs">
      <a href="#">
      <img class="baricons" src={{ URL::asset("images/chat.svg")}} >
      </a>          
       <span class="badge countmessage" id='countmessages'>4</span>
  </div>

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>  
      <a href="#"><div class="wheretobuy">
      <img class="locationicon" src={{ URL::asset("images/Location.svg")}} >
 
      <span class="raleway" >
      WHERE TO BUY</span></div>
      </a> 
  </li>
  <li>
    <a href="#">
      <div class="visible-xs">
        <img class="favoriteicon" src={{ URL::asset("images/favorite.svg")}} >
            <span class="raleway">
            FAVORITES</span>
      
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
        <i class="fa fa-address-card actionicons"></i>
        Edit profile</a>
</li>
    <li class=" login raleway visible-xs">
        <a href="{{route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                    class="w3-bar-item w3-button w3-white"><i class="fa fa-sign-out" style="margin-right:5px;"></i>Logout</a>
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
                document.getElementById('logout-form').submit();"
                    class="w3-bar-item w3-button w3-white">Log out</a>
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
      <a href="#">
        <img class="favoriteicon" src={{ URL::asset("images/search.svg")}} >
     </a> </li>



      <li>      <div class="wrapper">
      <a href="#"><img class="baricons" src={{ URL::asset("images/chat.svg")}} >
      <span class="badge countmessage" id='countmessages'>4</span>  
</a>
</div></li>
        <li>      <div class="wrapper">
      <a href="#"><img class="baricons" src={{ URL::asset("images/cart.svg")}} >
</a>  <span class="badge countCart" id='countcart'>{{Session::has('number_of_items') ? Session::get('number_of_items'): '4'}}</span>
  </div>
</li>
<li>     
      <a href="#"><img class="favoriteicon" src={{ URL::asset("images/favorite.svg")}} >
     
</a> </li>


        
      </ul>
      
     
    </div><!-- /.navbar-collapse -->
    
    <div class="secondbar hidden-xs">
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