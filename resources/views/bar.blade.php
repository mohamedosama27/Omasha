<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" sizes="96x96" href={{ URL::asset('images/Logo-1.jpeg') }}>
    <title>Spot Fabrics</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/Respond.js"></script>
    <link rel="stylesheet" href="/css/bar.css">
    <link rel="stylesheet" href="/css/w3schools.css">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
</head>

<body>
    <!-- Start Search Modal -->
    <div class="modal fade px-5 py-1" id="searchModel" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <img src={{ URL::asset('images/search.svg') }}>
                <input class="form-control" id="searchInput" type="text" placeholder="{{ __('messages.search') }}" />
                <div class="searchResult">

                </div>

            </div>

        </div>
    </div>
    <!-- End Search Modal -->

    @php
        $home_top_title = \App\home_top_title::first();
        if ($home_top_title != null) {
            if (app()->getLocale() == 'ar') {
                $content = $home_top_title->content_ar;
            } else {
                $content = $home_top_title->content;
            }
        }
    @endphp

    @if ($home_top_title != null)
        <div class="sliding-text">
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
            <span>{{ $content }} -</span>
        </div>
    @endif

    @php($parent_categories = \App\category::where('is_child', false)->get())
    <nav class="navbar brandcolor">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed navbar-icon brandcolor" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <i class="fas fa-bars" style="font-size: 20px;"></i>
                </button>

                <a href="{{ route('home') }}">
                    <img class="toplogo " src={{ URL::asset('images/Logo-1.jpeg') }}></a>


                <div class="wrapper visible-xs">
                    <a href="{{ Request::is('cart') ? route('home') : route('cart') }}">
                        <i class="fas fa-shopping-cart text-white baricons" style="font-size: 20px;"></i>
                        @if (session()->has('number_of_items'))
                            <span class="badge countCart" id='countcart'>
                                {{ Session::get('number_of_items') }}
                            </span>
                        @endif
                    </a>
                </div>
                <div class="wrapper visible-xs">
                    <a href="{{ route('favorites') }}" class="visible-xs">
                        <i class="fas fa-heart text-white baricons" style="font-size: 20px;"></i>
                        @auth
                            @if (Auth::user()->favorites()->count() > 0)
                                <span class="badge countfavorites">
                                    @php($x = Auth::user()->favorites()->count()){{ $x }}
                                </span>
                            @endif @endauth
                        </a>
                    </div>

                    <a data-toggle="modal" data-target="#searchModel">
                        {{-- <img class="searchlogo visible-xs" src={{ URL::asset('images/search.svg') }}> --}}
                        <i class="fas fa-search text-white baricons searchlogo visible-xs" style="font-size: 20px;"></i>
                    </a>
                </div>

                <div class="collapse navbar-collapse mobile-margin brandcolor" id="bs-example-navbar-collapse-1"
                    style="margin-top: 0;">
                    <ul class="nav navbar-nav ml-1">
                        @auth
                            @if (Auth::user()->type == 1)
                                <li class="dropdown visible-xs">
                                    <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">ACTIONS
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu ml-3">

                                        <li><a href="{{ route('addadminview') }}">
                                                <i class="fa fa-plus actionicons"></i>Add Admin</a></li>


                                        <li><a href="{{ route('item.create') }}">
                                                <i class="fa fa-plus actionicons"></i>Add Item</a></li>

                                        <li><a href="{{ route('vieworders') }}">
                                                <i class="fa fa-list actionicons"></i>View Orders</a></li>

                                        <li><a href="{{ route('category.edit') }}">
                                                <i class="fa fa-edit actionicons"></i>Edit Categories</a></li>

                                        {{-- <li><a href="{{ route('report') }}">
                                                <i class="fa fa-clipboard actionicons"></i>Report</a></li> --}}

                                        {{-- <li><a href="{{ route('distributor.showAll') }}">
                                                <i class="fa fa-list actionicons"></i>Show Distributors</a></li> --}}

                                        {{-- <li><a href="{{ route('subscribers') }}">
                                                <i class="fa fa-users actionicons"></i>Show Subscribers</a>
                                        </li> --}}

                                        {{-- <li><a href="{{ route('contact.showAll') }}">
                                                <i class="fa fa-phone actionicons"></i>Manage Contacts</a>
                                        </li>

                                        <li><a href="{{ route('customize.showAll') }}">
                                                <i class="fa fa-list actionicons"></i>Show customize orders</a> --}}
                                </li>
                                <li><a href="{{ route('fee.showAll') }}">
                                        <i class="fa fa-truck actionicons"></i>Manage fees</a>
                                </li>
                                {{-- <li><a href="{{ route('Zone.showAll') }}">
                                                <i class="fa fa-map-marker actionicons"></i>Manage zones</a>
                                        </li> --}}

                                <li><a href="{{ route('home.images.showAll') }}">
                                        <i class="fa fa-edit actionicons"></i>Edit home page </a>
                                </li>

                        </ul>
                        </li>
                        @endif

                    @endauth

                    <li>
                        <a href="{{ route('welcome') }}" class="raleway visible-xs">{{ __('messages.home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}" class="raleway visible-xs">{{ __('messages.shop') }}</a>
                    </li>
                    <li class="dropdown visible-xs">
                        <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">{{ __('messages.products') }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu text-align-right ml-3">
                            @foreach ($parent_categories as $parentCategory)
                                @php($childIds = $parentCategory->children->pluck('id')->toArray())
                                <li class='mt-2'><a class="raleway"
                                        href="{{ route('ItemController.product', ['category_name' => $parentCategory->name]) }}?num[]={{ implode('&num[]=', $childIds) }}">
                                        {{ app()->getLocale() == 'ar' ? $parentCategory->name_ar : $parentCategory->name }}</a>
                                </li>
                                <li class='mt-2'><a class="raleway"
                                        href="{{ route('ItemController.product', ['category_name' => $parentCategory->name]) }}?num[]={{ implode('&num[]=', $childIds) }}">
                                        {{ app()->getLocale() == 'ar' ? $parentCategory->name_ar : $parentCategory->name }}</a>
                                </li>
                                @foreach ($parentCategory->children as $childCategory)
                                    <li class="{{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-4' }}"><a class="raleway"
                                            href="{{ route('ItemController.product', ['category_name' => $childCategory->name]) }}?num[]={{ $childCategory->id }}">
                                            {{ app()->getLocale() == 'ar' ? $childCategory->name_ar : $childCategory->name }}</a>
                                    </li>
                                @endforeach
                            @endforeach
                            <li class='mt-2'><a class="raleway" href="{{ route('shop') }}">
                                    {{ __('messages.view_all') }}</a></li>
                        </ul>
                    </li>

                    @auth
                        @if (Auth::user()->type != 1)
                            <li>
                                <a href="{{ route('myorders') }}"
                                    class="raleway visible-xs">{{ __('messages.my_orders') }}</a>
                            </li>
                        @endif
                    @endauth

                    {{-- <li class="dropdown visible-xs">
                        <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            COLLECTION
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @php($categories = \App\category::all())
                            @foreach ($categories as $category)
                            <li><a href="{{ route('category', ['id' => $category->id]) }}" class="raleway">
                                    {{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('about') }}" class="raleway visible-xs">{{ __('messages.about') }}</a>
                    </li> --}}
                    @auth
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class=" visible-xs raleway">
                                {{ __('messages.edit_profile') }}</a>
                        </li>
                        <li class=" login raleway visible-xs">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('messages.sign_out') }}</a>

                        </li>
                    @else
                        <li class=" login raleway visible-xs">
                            <a
                                href="{{ Request::is('login') ? route('home') : route('login') }}">{{ __('messages.sign_in') }}</a>
                        </li>
                    @endauth

                    <li role="separator" class="divider"></li>

                    <!-- Second list item after the divider -->
                    <div class='d-flex justify-content-center pb-2 mobile-language'>
                        <li>
                            <div class="wrapper">
                                <a href="{{ route('switch.language', ['locale' => 'en']) }}">English</a>
                            </div>
                        </li>

                        <li>
                            <div class="wrapper ml-4">
                                <a href="{{ route('switch.language', ['locale' => 'ar']) }}">العربية</a>
                            </div>
                        </li>
                    </div>

                    </ul>

                    <ul class="nav navbar-nav navbar-left hidden-xs mb-3 mt-3 ml-3">
                        <li>
                            <div class="wrapper">
                                <a href="{{ route('switch.language', ['locale' => 'en']) }}">English</a>
                            </div>
                        </li>

                        <li>
                            <div class="wrapper ml-4">
                                <a href="{{ route('switch.language', ['locale' => 'ar']) }}">العربية</a>
                            </div>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right hidden-xs mb-3">
                        @auth
                            <li class="dropdown raleway mr-4">
                                <div class='wrapper d-flex justify-content-center'>
                                    <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user text-white baricons" style="font-size: 22px;"></i>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                    <ul class="dropdown-menu"
                                        style="left: 40%; transform: translateX(-50%); position: absolute; top: 95%; text-align: center;">
                                        <li><a class="raleway" href="{{ route('user.edit', ['id' => Auth::user()->id]) }}">
                                                {{ __('messages.edit_profile') }}</a></li>
                                        <li><a class="raleway" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                                {{ __('messages.sign_out') }}</a></li>
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li class='mr-4'>
                                <div class='wrapper'>
                                    <a href="{{ route('login') }}" class="raleway d-flex align-items-center">
                                        <span class='mt-3 mr-3'>{{ __('messages.sign_in') }}</span>
                                        <i class="fas fa-user text-white baricons" style="font-size: 22px;"></i>
                                    </a>
                                </div>
                            </li>
                        @endauth

                        {{-- <li>
                        <a data-toggle="modal" data-target="#searchModel" class="iconsLink">
                            <i class="fas fa-search text-white baricons" style="font-size: 22px;"></i>
                            <img class="favoriteicon" src={{ URL::asset('images/search.svg') }}>
                        </a>
                    </li> --}}



                        <li>
                            <div class="wrapper">
                                <a data-toggle="modal" data-target="#searchModel" class="iconsLink">
                                    {{-- <img class="baricons" src={{ URL::asset('images/chat.svg') }}> --}}
                                    {{-- <i class="fas fa-comments text-white baricons" style="font-size: 22px;"></i> --}}
                                    <i class="fas fa-search text-white baricons" style="font-size: 22px;"></i>
                                    {{-- <span class="badge countmessage"></span> --}}
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="wrapper">
                                <a href="{{ route('favorites') }}" class="iconsLink">
                                    {{-- <img class="baricons" src={{ URL::asset('images/favorite.svg') }}> --}}
                                    <i class="fas fa-heart text-white baricons" style="font-size: 22px;"></i>
                                    @auth
                                        @if (Auth::user()->favorites()->count() > 0)
                                            <span class="badge countfavorites">
                                                @php($x = Auth::user()->favorites()->count()){{ $x }}
                                            </span>
                                        @endif
                                    @endauth
                                </a>
                            </div>

                        </li>
                        <li>
                            <div class="wrapper">
                                <a href="{{ Request::is('cart') ? route('home') : route('cart') }}">
                                    {{-- <img class="baricons" src={{ URL::asset('images/cart.svg') }}> --}}
                                    <i class="fas fa-shopping-cart text-white baricons" style="font-size: 22px;"></i>
                                    <span class="badge countCart"
                                        id='countcart'>{{ Session::has('number_of_items') ? Session::get('number_of_items') : '' }}</span>
                                </a>
                            </div>
                        </li>
                    </ul>

                </div>

                <div class="secondbar @auth secondBarForAuth @endauth hidden-xs">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('welcome') }}" class="raleway">{{ __('messages.home') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}" class="raleway">{{ __('messages.shop') }}</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle raleway" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">{{ __('messages.products') }}
                                <span class="caret"></span></a>
                            {{-- <ul class="dropdown-menu">
                                <li><a class="raleway" href="{{ route('ItemController.product', ['num' => 0]) }}">
                                        Curtains</a></li>
                                <li><a class="raleway" href="{{ route('ItemController.product', ['num' => 1]) }}">
                                        Cushions</a></li>
                                <li><a class="raleway" href="{{ route('shop') }}">
                                        View all</a></li>
                            </ul> --}}
                            <ul class="dropdown-menu text-align-right">
                                @foreach ($parent_categories as $parentCategory)
                                    @php($childIds = $parentCategory->children->pluck('id')->toArray())
                                    <li class='mt-2'><a class="raleway"
                                            href="{{ route('ItemController.product', ['category_name' => $parentCategory->name]) }}?num[]={{ implode('&num[]=', $childIds) }}">
                                            {{ app()->getLocale() == 'ar' ? $parentCategory->name_ar : $parentCategory->name }}</a>
                                    </li>
                                    @foreach ($parentCategory->children as $childCategory)
                                        <li class="{{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-4' }}"><a class="raleway"
                                                href="{{ route('ItemController.product', ['category_name' => $childCategory->name]) }}?num[]={{ $childCategory->id }}">
                                                {{ app()->getLocale() == 'ar' ? $childCategory->name_ar : $childCategory->name }}</a>
                                        </li>
                                    @endforeach
                                @endforeach
                                <li class='mt-2'><a class="raleway" href="{{ route('shop') }}">
                                        {{ __('messages.view_all') }}</a></li>
                            </ul>
                        </li>

                        {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle raleway  " data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">COLLECTION
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @php($categories = \App\category::all())
                            @foreach ($categories as $category)
                            <li><a class="raleway" href="{{ route('category', ['id' => $category->id]) }}">
                                    {{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li> --}}
                        {{-- <li>
                            <a href="{{ route('about') }}" class="raleway  ">{{ __('messages.about') }}</a>
                        </li> --}}
                        @auth
                            @if (Auth::user()->type == 1)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle raleway  " data-toggle="dropdown"
                                        role="button" aria-haspopup="true"
                                        aria-expanded="false">{{ __('messages.actions') }}
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="direction: ltr;">

                                        <li>
                                            <a href="{{ route('addadminview') }}">
                                                <i class="fa fa-plus actionicons mr-2"></i>Add Admin</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('item.create') }}">
                                                <i class="fa fa-plus actionicons mr-2"></i>Add Item</a>
                                        </li>

                                        <li><a href="{{ route('vieworders') }}">
                                                <i class="fa fa-list actionicons mr-2"></i>View Orders</a>
                                        </li>

                                        <li><a href="{{ route('category.edit') }}">
                                                <i class="fa fa-edit actionicons mr-2"></i>Edit Categories</a>
                                        </li>

                                        <li><a href="{{ route('promocode.edit') }}">
                                                <i class="fa fa-edit actionicons mr-2"></i>Edit Promo Codes</a>
                                        </li>

                                        {{-- <li>
                                <a href="{{ route('report') }}">
                                    <i class="fa fa-clipboard actionicons"></i>Report</a>
                            </li> --}}

                                        {{-- <li>
                                <a href="{{ route('distributor.showAll') }}">
                                    <i class="fa fa-list actionicons"></i>Show Distributors</a>
                            </li> --}}

                                        {{-- <li>
                                <a href="{{ route('subscribers') }}">
                                    <i class="fa fa-users actionicons"></i>Show Subscribers</a>
                            </li> --}}

                                        {{-- <li>
                                <a href="{{ route('contact.showAll') }}">
                                    <i class="fa fa-phone actionicons"></i>Manage Contacts</a>
                            </li> --}}
                                        <li><a href="{{ route('fee.showAll') }}">
                                                <i class="fa fa-truck actionicons"></i>Manage fees</a>
                                        </li>
                                        <li><a href="{{ route('home.images.showAll') }}">
                                                <i class="fa fa-edit actionicons"></i>Edit home page </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('myorders') }}" class="raleway">{{ __('messages.my_orders') }}</a>
                                </li>
                            @endif
                        @endauth

                    </ul>
                </div>
            </div>

        </nav>

        <nav class="w3-sidebar w3-bar-block w3-white w3-top" style="z-index:3;width:250px;display:none;" id="senders">
            <div class="w3-container w3-display-container w3-padding-16">
                <i onclick="senders_close()" class="fa fa-remove w3-button w3-display-topright"></i>
                <h2 class="raleway w3-wide notificationHeader">
                    <b>NOTIFICATIONS</b>
                </h2>
            </div>
            <a href="{{ route('users') }}" class="w3-bar-item w3-button w3-white">
                <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-light-blue">Show All</button>
            </a>


            <div class="w3-padding-64 w3-large senders" style="font-weight:bold">

            </div>

        </nav>

        @yield('content')


        <!-- START FOOTER SECTION-->
        <section class="footer brandcolor">
            <div class="container-fluid">
                <div class="row footer-flex">
                    <div class=" col-lg-3 col-xs-12 footer-margin">
                        <div class="col-xs-6 d-flex align-items-center justify-content-center">
                            <img class="logo" src={{ URL::asset('images/Logo-1.jpeg') }}>
                        </div>
                        <div class="col-xs-6 text-align-right">

                            <h5>{{ __('messages.follow_us') }}</h5>
                            <a href="https://www.facebook.com/spot.fabric/">
                                <img class="socialIcon" src={{ URL::asset('images/fb.png') }}>
                            </a>

                            <a href="https://www.instagram.com/spot.fabrics/">
                                <img class="socialIcon mt-1" src={{ URL::asset('images/instagram.png') }}>
                            </a>
                        </div>
                    </div>

                    {{-- <div class="col-lg-3 col-xs-12 footer-margin">
                        <h5>CUSTOMER SERVICE</h5>
                        <p>GET IN TOUCH</p>
                        <a href="{{ route('customize_order_form') }}">
                        <p><u>CUSTOMIZE AN ORDER</u></p>
                    </a>
                    </div> --}}

                    <div class="col-lg-3 col-xs-12 footer-margin text-align-right">
                        <h5>{{ __('messages.contact_us') }}</h5>
                        @php($contacts = \App\contact::all())
                        @foreach ($contacts as $contact)
                            <p>{{ $contact->contact }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script>
        $(document).ready(function() {
            $('.dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });

            // When clicking outside of the navbar, close it and re-enable body scroll
            // $('.navbar-collapse').on('click', function(e) {
            //     e.stopPropagation();
            // });

            $('.navbar-toggle').on('click', function() {
                if ($(this).hasClass('collapsed')) {
                    // Navbar is opening, check if there are any open dropdowns
                    $('.dropdown').removeClass('show');
                    $('.dropdown-menu').removeClass('show');
                }
            });

            // Also collapse any dropdowns when the navbar is manually closed
            $('.navbar-collapse').on('hidden.bs.collapse', function() {
                $('.dropdown').removeClass('show');
                $('.dropdown-menu').removeClass('show');
            });

            $(document).on('click', function(e) {
                if (!$('.navbar-collapse').is(e.target) && $('.navbar-collapse').has(e.target).length ===
                    0) {
                    // Close the navbar and re-enable body scroll
                    $('.navbar-collapse').removeClass('in');
                    $('.dropdown').removeClass('show');
                    $('.dropdown-menu').removeClass('show');
                }
            });
        });

        $('.dropdown').on('click', function(e) {
            if ($(window).width() <= 767) {
                e.preventDefault();

                // Close any other open dropdowns
                $('.dropdown').not(this).removeClass('show');
                $('.dropdown-menu').not($(this).find('.dropdown-menu')).removeClass('show');

                // Toggle the clicked dropdown
                $(this).toggleClass('show');
                $(this).find('.dropdown-menu').toggleClass('show');
            }
        });
        $('#searchInput').keyup(function() {
            var query = $(this).val();


            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ItemController.search') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {

                    $('.searchResult').html(data.result)

                }
            });

        });

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
        // @auth
        // countmessages();

        // setInterval(countmessages, 2000);
        // @endauth
        // function countmessages() {
        //     $.ajax({

        //         type: 'POST',
        //         _token: $('meta[name=csrf_token]').attr('content'),

        //         url: "{{ route('countmessage') }}",

        //         data: {},
        //         datatype: 'json',

        //         success: function(data) {
        //             if (data.countmessages != 0) {
        //                 $(".countmessage").text(data.countmessages);
        //             } else {
        //                 $(".countmessage").text('');

        //             }
        //         }

        //     });
        // }

        // function getSenders() {

        //     $.ajax({

        //         type: 'POST',
        //         _token: $('meta[name=csrf_token]').attr('content'),

        //         url: "{{ route('getSenders') }}",

        //         data: {},
        //         datatype: 'json',

        //         success: function(data) {
        //             $(".senders").html($(data.senders));
        //         }

        //     });

        // }
    </script>
