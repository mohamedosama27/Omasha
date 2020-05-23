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
  <i class="fa fa-3x fa-angle-left"></i>

  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
  <i class="fa fa-3x fa-angle-right" ></i>
  </a>
</div>
  <!-- End Top  Carousel -->

<br>
  <!-- SHOP LATEST ARRIVALSl SECTION-->

<h3 class="text-center raleway sectionsTitle titles" > SHOP LATEST ARRIVALS</h3>
<div class="container">
    <div class="row">
        <div class="product col-xs-6 col-md-3">
            <div class="productImg">
                <img src={{ URL::asset("images/77742.png")}} width="100%">      
                <button class="btn center-block" data-toggle="modal" data-target="#myModal">Quick View</button>
              </div>
               <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content quickview">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div id="carousel-example-generic1" class="carousel slide topCarousel" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic1" data-slide-to="0" class="active">
      <img src={{ URL::asset("images/Logo-2.png")}} width="100%">      

    </li>
    <li data-target="#carousel-example-generic1" data-slide-to="1">
      <img  src={{ URL::asset("images/Logo-2.png")}} width="100%">      

    </li>
  </ol>

  <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active" >
          <img class="carouselImg" src={{ URL::asset("images/cover1.jpg")}} width="100%" >      
         
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
        <a class="left carousel-control" href="#carousel-example-generic1"
        role="button" data-slide="prev">
        <i class="fa fa-3x fa-angle-left"></i>

        </a>
        <a class="right carousel-control" href="#carousel-example-generic1" role="button" data-slide="next">
        <i class="fa fa-3x fa-angle-right" ></i>
        </a>
      </div>      
      </div>

      </div>
      
    </div>
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

<h3 class="ralway text-center titles">OMASHA’S FAVORITES</h3>


  <div class="container-fluid">
  

        <img src={{ URL::asset("images/Fav2.png")}} class="first">  
        <img src={{ URL::asset("images/Fav1.png")}} class="second">  
        <img src={{ URL::asset("images/Fav3.jpg")}} class="third">
        <img src={{ URL::asset("images/Fav4.jpg")}} class="fourth">  

 

  </div>
  <div class="text-center">
    <a class="btn brandcolor raleway btnWeight">VIEW ALL</a><br>
    </div>
</section>
    <!--END OMASHA 'S FAVORITES --> 



    <!-- START OMASHA CELEBRITIES SECTION -->
    <section class="celebritiesSection center-block">
      <div class="container">
        <img class="center-block" src={{ URL::asset("images/Celebrities.png")}} width="300" height="150" >
        <div class="row ">
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
              <p class="brandcolor text-center battalion">ElMoraba3</p>

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

    <!-- START SHOP COLLECTION SECTION-->
    <div class="container-fluid shopCollection">
    <h3 class="ralway text-center titles">SHOP COLLECTION</h3>
      <div class="row center-block">
          <div class="imageDiv ">
            <img src={{ URL::asset("images/Mashro3Leila.png")}}>
            <p>MASHRO3 LEILA</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/AhmedKamel.png")}}>
            <p>AHMED KAMEL</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/Englishquotes.png")}}>
            <p>ENGLISH QUOTES</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/RAP.png")}}>
            <p>RAP</p>
          </div>
          
          <div class="imageDiv ">
            <img src={{ URL::asset("images/Horoscopes.png")}}>
            <p>HOROSCOPES</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/Socks.png")}}>
            <p>SOCKS</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/Sharmofers.png")}}>
            <p>SHARMOFERS</p>
          </div>
          
          <div class="imageDiv ">
            <img src={{ URL::asset("images/Pinkfloyd.png")}}>
            <p>PINK FLOYD</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/Cairokeeee.png")}}>
            <p>CAIROKEE</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/Masaregbari.png")}}>
            <p>MASAR EGBARI</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/MixBands.png")}}>
            <p>MIX BANDS</p>
          </div>

          <div class="imageDiv ">
            <img src={{ URL::asset("images/Randomarabic.png")}}>
            <p>RANDOM ARABIC</p>
          </div>

      </div>
    </div>

    <!-- END SHOP COLLECTION SECTION-->


    <!-- START LOGO -->
    <img class="slogo center-block" src={{ URL::asset("images/Slogan.png")}}>

    <!-- END LOGO -->

    <!-- START SUBSCRIBE -->
<div class="subscribe text-center">
  <h6 class="raleway">SUBSCRIBE FOR UPDATES ABOUT NEW ARIVALLS, EXCLUSIVE NEWS, AND SPECIAL SALES</h6>
    <form class="form-inline" action="/action_page.php">
        <input class="form-control"type="email" id="email" placeholder="Enter your email">
      <button type="submit" class="btn brandcolor raleway">SUBSCRIBE</button>
    </form>
</div>
<!-- END SUBSCRIBE -->



@endsection
