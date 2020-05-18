@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/welcome.css">

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active" >
    <img class="carouselImg" src={{ URL::asset("images/cover1.jpg")}} width="100%" >      
    <div class="carousel-caption">
        <a class="btn  shopnowBtn brandcolor raleway">SHOP NOW</a>
      </div>
    </div>
    <div class="item">
    <img class="carouselImg" src={{ URL::asset("images/cover2.jpg")}} width="100%">      
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic"
   role="button" data-slide="prev">
  <i class="fa fa-3x fa-angle-left" style="padding-top:80%"></i>

  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
  <i class="fa fa-3x fa-angle-right" style="padding-top:80%"></i>
  </a>
</div>
<br>
<h3 class="text-center raleway sectionsTitle" > SHOP LATEST ARRIVALS</h3>
<div class="container">
    <div class="row">
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway addtocart">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway addtocart">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway addtocart">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway addtocart">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
    </div>
</div>
@endsection
