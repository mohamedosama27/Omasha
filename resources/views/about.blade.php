@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/about.css">

<img class="img-responsive center-block" src={{ URL::asset("images/Story.png")}} height="100" width="300" />
<h3 class="text-center raleway">Omasha based in Egypt/Dubai , Est. Aug 2017 along 8 Retail stores by 2019</h3>
<p class="center-block raleway about-paragraph">The story behind omasha began when the founder Mostafa Fatehy realized that he used to collect the tickets of “Dina el
Wadidi” concerts whenever he attended one, as many of us do collect cool little things to “capture moments and save memo-
ries”. He proposed the idea to his designer partner and co-founder Yara Amalah as he wanted to save people’s special moments
but there were no clue how! Until they came up with the idea of saving people’s special memories sharing with them their mo-
ments and favorite quotes, lyrics, memes by being part of their lives and memorable days in a shape of OMASHA wristband writ-
ten on it what they feel & live.</p>
<img class="pull-right pattern1 pattern" src={{ URL::asset("images/pattern1.png")}} />
<img class="center-block about-images" src={{ URL::asset("images/about_first_image.JPG")}} />
<br>
<p class="center-block raleway about-paragraph">Well we had a product that we loved we stitched our logo on but there’s no really an instruction on what to do next. So, our ex-
posure first was targeted to our friends and friends of friends until our first actual release “Cairokee Album release at Sawy cul-
ture wheel” we printed 500 wristbands and we got surprised after only 2 hours our boxes were SOLD! And from here came
omasha to the platform, it simply express people moments ,
You live it , We SAVE It...</p>
<br>
<img class="pull-right pattern2 pattern" src={{ URL::asset("images/pattern2.png")}} />
<img class="center-block about-images" src={{ URL::asset("images/about_second_image.JPG")}} />
@endsection