@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/welcome.css">
  <!-- Top  Carousel -->
<div id="carousel-example-generic" class="carousel slide topCarousel" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
      <img src={{ URL::asset("images/Logo-2.png")}} width="100%">      

    </li>
    <li data-target="#carousel-example-generic" data-slide-to="1">
      <img  src={{ URL::asset("images/Logo-2.png")}} width="100%">      

    </li>
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
  <!-- End Top  Carousel -->

<br>
  <!-- SHOP LATEST ARRIVALSl SECTION-->

<h3 class="text-center raleway sectionsTitle" > SHOP LATEST ARRIVALS</h3>
<div class="container">
    <div class="row">
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway btnWeight">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway btnWeight">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway btnWeight">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>

        </div>
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                    <img src={{ URL::asset("images/77742.png")}} width="100%">      
            </div>
            <p>Pink folyd</p>
            <p>15 EGP</p>
            <a class="btn brandcolor raleway btnWeight">Add To Cart</a><br>
            <a class="raleway addtowishlist">Add To Wishlist</a>
            

        </div>
    </div>
</div>
  <!-- END SHOP LATEST ARRIVALSl SECTION IN SM , MD , LG-->


    <!-- START CRAFTSMANSHIP SECTION-->
<section class="craftsmanship hidden-xs">
  <div class="col-xs-9 brandcolor">
    <div class="row">
      <img src={{ URL::asset("images/Craftsmanship.png")}} class="col-md-4 col-xs-9 CraftsmanshipImg" >  
      <div class="col-sm-6 col-sm-push-6 col-xs-9 raleway">   
        <h3>CRAFTSMANSHIP</h3>
        <p> OMASHA is all about the revival of the world’s rich history, vast cul-
            tures, and art to the betterment of today’s creativity. Each Omasha
            product has a unique provenance with deep cultural associations.
            To manufacture their products, Aya and Mounaz felt compelled to
            take a philanthropic approach to their work by joining forces with arti-
            sans from Egypt, Italy, Spain, and Dubai.
        </p>
      </div> 
    </div>
  </div>
  <img src={{ URL::asset("images/pattern1.png")}} class="col-xs-2 pull-right pattern" >  

</section>
    <!-- END CRAFTSMANSHIP SECTION IN SM , MD , LG-->


        <!-- START CRAFTSMANSHIP SECTION IN XS -->
<section class="craftsmanship visible-xs">
  <div class="container">
    <div class="row">
      <div class="col-xs-9 raleway brandcolor ">   
        <h3>CRAFTSMANSHIP</h3>
        <p> OMASHA is all about the revival of the world’s rich history, vast cul-
            tures, and art to the betterment of today’s creativity. Each Omasha
            product has a unique provenance with deep cultural associations.
            To manufacture their products, Aya and Mounaz felt compelled to
            take a philanthropic approach to their work by joining forces with arti-
            sans from Egypt, Italy, Spain, and Dubai.
        </p>

      </div> 
      <div class="col-xs-6 img pull-right">
      <img src={{ URL::asset("images/Craftsmanship.png")}} class="CraftsmanshipImg " >  

      </div>

    </div>
  </div>

  <!-- <img src={{ URL::asset("images/pattern1.png")}} class="col-xs-2 pull-right pattern" >   -->

</section>
    <!-- END CRAFTSMANSHIP SECTION IN-->
<br>
    <!--START OMASHA 'S FAVORITES --> 
<section class="favoritesSection">

  <div class="container-fluid">
  
    <div class="row">
    <h3 class="ralway text-center">OMASHA’S FAVORITES</h3>

      <div class="col-xs-7 col-xs-push-1">
        <img src={{ URL::asset("images/Fav2.png")}} class="first">  
        <img src={{ URL::asset("images/Fav1.png")}} class="second">  
        <img src={{ URL::asset("images/Fav4.jpg")}} class="fourth">  

      </div>
      <div class="col-xs-3 col-xs-push-1">
         <img src={{ URL::asset("images/Fav3.jpg")}} class="third">
      </div>

    </div>
    <div class="text-center">
    <a class="btn brandcolor raleway btnWeight">VIEW ALL</a><br>
    </div>
  </div>
</section>
   
    <!--END OMASHA 'S FAVORITES --> 

    <!-- START OMASHA CELEBRITIES SECTION -->
    <section class="celebritiesSection">
      <div class="container">
      <!-- <h3 class="text-center raleway btnWeight">OMASHA X<span class="battalion"> celebrities</span></h3> -->
        <img class="center-block" src={{ URL::asset("images/Celebrities.png")}} width="300" height="150" >
        <div class="row">
            <div class="col-sm-3 col-xs-4">
              <img src={{ URL::asset("images/AzizMarka.png")}}> 
              <p class="brandcolor text-center battalion">Aziz Marka</p>
            </div>
            <div class="col-sm-3 col-xs-4">
              <img src={{ URL::asset("images/ZapTharwat.png")}}>
              <p class="brandcolor text-center battalion">Zap Tharwat</p>

            </div>

            <div class="col-sm-3 col-xs-4">
              <img src={{ URL::asset("images/SaraSabry.png")}}> 
              <p class="brandcolor text-center battalion">Sara Sabry</p>
            
            </div>

            <div class="col-sm-3 col-xs-4">
              <img src={{ URL::asset("images/Pablo.png")}}>
              <p class="brandcolor text-center battalion">Pablo</p>
            </div>
            <div class="visible-lg">
              <br clear="all" >
            </div>
            <div class="col-sm-3 col-xs-4">
              <img src={{ URL::asset("images/Cairokee.png")}}> 
              <p class="brandcolor text-center battalion">Cairokee</p>
            </div>
            <div class="col-sm-3 col-xs-4">
              <img src={{ URL::asset("images/ElMotaba3.png")}}>
              <p class="brandcolor text-center battalion">Zap Tharwat</p>

            </div>

            <div class="col-sm-3   col-xs-4">
              <img src={{ URL::asset("images/MasarEgbari.png")}}> 
              <p class="brandcolor text-center battalion">Masar Egbari</p>
            
            </div>

            <div class="col-sm-3   col-xs-4">
              <img src={{ URL::asset("images/Mashro3leila.png")}}>
              <p class="brandcolor text-center battalion">Mashro3 leila</p>
            </div>
            
          </div>
        </div>

      
    </section>
    <!-- START OMASHA CELEBRITIES SECTION  -->


@endsection
