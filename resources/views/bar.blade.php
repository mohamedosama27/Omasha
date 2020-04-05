<!DOCTYPE html>
<html>
<link rel="icon" type="image/png" href={{ URL::asset("images/icon.ico")}} >
<title>OMASHA</title>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/w3schools.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
a{
  color:black;
}
.wrapper{
position: relative;
}
.wrapper .countCart{
position: absolute;
top: -2px;
right: -2px; 
}
.countCart{
  background-color:red;
}
body{
  margin-top:70px;
}
.icon {
  margin:5px;
  display:inline-block;
}
.toptitle
{
  margin:-5px;
  margin-bottom:-10px;
  letter-spacing: 6px;
  font-size: 25px;
}
@media (max-width:330px){
  .toptitle
{
  margin:-2px;
  margin-bottom:-10px;
  letter-spacing: 0px;
  font-size: 20px;
}
}
</style>
@auth
    @if(Auth::user()->type == 1)
@include('addcategory')
@endif
@endauth
<body >

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h2 class="w3-wide">
  <span class="icon">

<img width="50" height="50" class="manImg" src={{ URL::asset("images/icon.png")}}></img>

</span><b>OMASHA</b></h2>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a href="{{route('home')}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-home" style="margin-right:5px;"></i>Home</a>
    @auth
    @if(Auth::user()->type == 1)
    <a href="register" class="w3-bar-item w3-button w3-white"><i class="fa fa-plus" style="margin-right:5px;"></i>Add Admin</a>

    <a href="{{route('item.create')}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-plus" style="margin-right:5px;"></i>Add Item</a>
    <a href="{{route('vieworders')}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-list" style="margin-right:5px;"></i>View Orders</a>
    <a href="{{route('category.edit')}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-edit" style="margin-right:5px;"></i>Edit Categories</a>
    <a data-toggle="modal" data-target="#addcategory" class="w3-bar-item w3-button w3-white"><i class="fa fa-plus" style="margin-right:5px;"></i>Add Category</a>
    <a href="{{route('viewmails')}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-envelope" style="margin-right:5px;"></i>View Mails</a> 

@endif
@endauth

    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
    <i class='fa fa-product-hunt'></i> Products <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
    @php( $categories = \App\category::all() )
    @foreach($categories as $category)
      <a href="{{route('category',['id' => $category->id])}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-caret-right w3-margin-right"></i>{{$category->name}}</a>
        
      @endforeach
    </div>
    <a href="#" class="w3-bar-item w3-button w3-white">
      <i class='fa fa-phone' style="margin-right:5px;">
    </i>Contact</a>
    <a href="{{route('viewmails')}}" class="w3-bar-item w3-button w3-white"><i class="fa fa-envelope" style="margin-right:5px;"></i>Mail Us</a> 
  </div>
  
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-black w3-large" style="margin-bottom:40px;">
<a href="{{route('home')}}" style="color:white;">
<div class="w3-bar-item w3-padding-24 w3-wide toptitle"><b>OMASHA</b></div></a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-lg fa-bars"></i></a>
  <a href="{{ Request::is('cart') ? route('home') : route('cart') }}" class="w3-bar-item w3-button w3-padding-24 w3-right" >
  <div class="wrapper">
  <i class="fa fa-shopping-cart fa-lg  w3-margin-right"></i>
  <span class="badge countCart" id='countcart'>{{Session::has('number_of_items') ? Session::get('number_of_items'): ''}}</span>
  </div>
  </a>
  @guest
                            
                                <a class="w3-bar-item w3-button w3-padding-24 w3-right" href="{{ Request::is('login') ? route('home') : route('login') }}">
                                <i class="fa fa-sign-in fa-lg " style="margin-right:5px;"></i></a>
                                @else
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="w3-bar-item w3-button w3-padding-24 w3-right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user" ></i> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.edit',['id' => Auth::user()->id]) }}"
                                       >
                                        Edit Profile
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
</div>
                        @endguest
                            <!-- @if (Route::has('register'))
                               
                                    <a class="w3-bar-item w3-button" href="{{ route('register') }}"></a>
                                
                            @endif -->
                   
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"> </div>
  
  @yield('content')

 







</div>



<script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
// Click on the "Jeans" link on page load to open the accordion for demo purposes
// document.getElementById("myBtn").click();
// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>
</body>
</html>