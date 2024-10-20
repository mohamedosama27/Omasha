@extends('bar')

@section('content')
    <link rel="stylesheet" href="/css/welcome.css">
    <link rel="stylesheet" href="/css/item_design.css">

    <!-- Top  Carousel -->
    @if (count($home_images) > 0)
        <div id="carousel-example-generic" class="carousel slide topCarousel mainCarousel" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach ($home_images as $home_image)
                    @if ($loop->first)
                        <div class="item active">
                            <img class="carouselImg" src={{ URL::asset("images/{$home_image->name}") }} width="100%">
                        </div>
                    @else
                        <div class="item">
                            <img class="carouselImg" src={{ URL::asset("images/{$home_image->name}") }} width="100%">
                        </div>
                    @endif
                @endforeach
                @if (count($home_images) > 1)
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <i class="fa fa-3x fa-angle-left carouselArrow-left"></i>

                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <i class="fa fa-3x fa-angle-right carouselArrow-right"></i>
                    </a>
                @endif
            </div>

            <!-- Controls -->

        </div>
    @endif
    <!-- End Top  Carousel -->

    <!-- SHOP LATEST ARRIVALSl SECTION-->

    <h3 class="text-center raleway titles mb-4 mt-4">{{ __('messages.best_sellers') }}</h3>
    <div class="container">
        <div class="row">
            @foreach ($newArrivals as $item)
                <div class="product col-xs-6 col-md-3">

                    <div class="productImg mb-3">

                        <img src={{ URL::asset("images/{$item->images->first()->name}") }} width="100%">
                        <button class="btn center-block" data-toggle="modal"
                            data-target="#myModal{{ $item->id }}">{{ __('messages.quick_view') }}</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal{{ $item->id }}" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content quickview">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div id="carousel{{ $item->id }}" class="carousel topCarousel" data-ride="carousel">
                                        <!-- Indicators -->
                                        {{-- <ol class="carousel-indicators">
                                            @foreach ($item->images as $image)
                                                @if ($loop->first)
                                                    <li data-target="#carousel{{ $item->id }}" data-slide-to="0"
                                                        class="active">
                                                        <img src={{ URL::asset('images/Logo-2.png') }} width="100%">

                                                    </li>
                                                @else
                                                    <li data-target="#carousel{{ $item->id }}" data-slide-to="1">
                                                        <img src={{ URL::asset('images/Logo-2.png') }} width="100%">

                                                    </li>
                                                @endif
                                            @endforeach
                                        </ol> --}}

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($item->images as $image)
                                                @if ($loop->first)
                                                    <div class="item active">
                                                        <img src={{ URL::asset("images/{$image->name}") }}>
                                                    </div>
                                                @else
                                                    <div class="item">
                                                        <img src={{ URL::asset("images/{$image->name}") }}>

                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel{{ $item->id }}" role="button"
                                            data-slide="prev">
                                            <i class="fa fa-3x fa-angle-left"></i>
                                        </a>
                                        <a class="right carousel-control" href="#carousel{{ $item->id }}"
                                            role="button" data-slide="next">
                                            <i class="fa fa-3x fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class='d-flex flex-column align-items-center text-center ml-1'>
                        <a href="{{ route('item.show', ['id' => $item->id]) }}">
                            <p>{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name }}</p>
                        </a>
                        <p class='ml-1'>{{ $item->price }} {{ __('messages.egp') }}</p>
                        {{-- <button class="btn brandcolor raleway btnWeight btn-addtocart mb-2"
                            data-value="{{ $item->id }}">
                            Add To Cart</button><br> --}}
                        <a data-value="{{ $item->id }}" class="btn-addToFavorite raleway addtowishlist ml-1">
                            @if (app()->getLocale() == 'en')
                                {{ __('messages.add_to_wishlist') }}
                                <img src="{{ URL::asset('images/favorite.svg') }}" class="ml-1" width="12"
                                    height="12">
                            @else
                                <img src="{{ URL::asset('images/favorite.svg') }}" class="mr-1" width="12"
                                    height="12">
                                {{ __('messages.add_to_wishlist') }}
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- END SHOP LATEST ARRIVALSl SECTION IN SM , MD , LG-->

    <!-- START LOGO -->
    <img class="slogo center-block" src={{ URL::asset('images/Slogan.png') }}>
    <!-- END LOGO -->

    @foreach ($parent_categories as $parentCategory)
        @if ($parentCategory->children->count() > 2)
            <section class="curtains-section raleway">
                <h3 class="text-center raleway titles mb-4">
                    {{ strtoupper(app()->getLocale() == 'ar' ? $parentCategory->name_ar : $parentCategory->name) }}</h3>
                <div class="slider-container">
                    <!-- Left Scroll Button -->
                    @if ($parentCategory->children->count() > 3)
                        <button class="slide-left brandcolor"
                            onclick="slideLeft('{{ $parentCategory->id }}')">&#10094;</button>
                    @endif
                    <div class="curtain-categories" id="slider-{{ $parentCategory->id }}">
                        @foreach ($parentCategory->children as $childCategory)
                            <div class="curtain-item">
                                <img src="{{ URL::asset('images/blackout.jpg') }}">
                                <div class="overlay">
                                    <span
                                        class="category-name">{{ app()->getLocale() == 'ar' ? $childCategory->name_ar : $childCategory->name }}</span>
                                    <a href="{{ route('ItemController.product', ['category_name' => $childCategory->name]) }}?num[]={{ $childCategory->id }}"
                                        class="view-button brandcolor">{{ __('messages.view') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($parentCategory->children->count() > 3)
                        <button class="slide-right brandcolor"
                            onclick="slideRight('{{ $parentCategory->id }}')">&#10095;</button>
                    @endif
                </div>
            </section>
        @endif
    @endforeach

    <!-- START SUBSCRIBE -->
    <div class="subscribe text-center">
        <h6 class="raleway">{{ __('messages.subscribe_for_updates') }}</h6>
        <form id="subscribe" class="form-inline">

            <input class="form-control" type="email" name="email" id="email"
                placeholder="{{ __('messages.enter_your_email') }}">
            <button type="submit" class="btn brandcolor raleway">{{ __('messages.subscribe') }}</button>
            @error('email')
                <br>

                <span role="alert" style="color:red;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </form>
    </div>
    <!-- END SUBSCRIBE -->


    @include('errormessage')


    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(document).on("click", '.btn-addToFavorite', function(e) {

            e.preventDefault();

            var id = $(this).data('value');;
            $.ajax({

                type: 'POST',

                url: 'addToFavorite',

                data: {
                    id: id
                },

                success: function(data) {

                    $('#messaga').text(data.message)
                    $('#errormessage').modal();
                    $(".countfavorites").text(data.countFavorites);

                }

            });
        });

        // $(document).on("click", '.btn-addtocart', function(e) {

        //     e.preventDefault();

        //     var str = $(this).data('value');;
        //     $.ajax({

        //         type: 'POST',

        //         url: "{{ route('item.addToCart') }}",

        //         data: {
        //             name: str
        //         },

        //         success: function(data) {

        //             if (data.message === undefined) {

        //                 $(".countCart").text(data.countCart);
        //                 $('#messaga').text("Added Sucessfully")
        //                 $('#errormessage').modal();
        //             } else {
        //                 $('#messaga').text(data.message)
        //                 $('#errormessage').modal();
        //             }

        //         }

        //     });
        // });


        $('#subscribe').on('submit', function(event) {
            event.preventDefault();

            email = $('#email').val();

            $.ajax({
                url: "{{ route('createSubscriber') }}",
                type: "POST",
                data: {
                    email: email,
                },
                success: function(response) {
                    $("#email").val('');
                    $('#messaga').text(response.success)
                    $('#errormessage').modal();

                },
            });
        });

        var currentIndex = {};

        function slideLeft(parentCategoryId) {
            var slider = document.getElementById('slider-' + parentCategoryId);
            var itemWidth = slider.querySelector('.curtain-item').offsetWidth + 20; // Item width plus margin

            if (!currentIndex[parentCategoryId]) currentIndex[parentCategoryId] = 0;

            // Calculate how many items we can scroll left
            var maxScrollLeft = Math.max(0, currentIndex[parentCategoryId] - 3);
            currentIndex[parentCategoryId] = maxScrollLeft;

            slider.scrollTo({
                left: maxScrollLeft * itemWidth,
                behavior: 'smooth'
            });
        }

        function slideRight(parentCategoryId) {
            var slider = document.getElementById('slider-' + parentCategoryId);
            var totalItems = slider.querySelectorAll('.curtain-item').length;
            var itemWidth = slider.querySelector('.curtain-item').offsetWidth + 20; // Item width plus margin

            if (!currentIndex[parentCategoryId]) currentIndex[parentCategoryId] = 0;

            // Calculate how many items we can scroll right, ensuring we don't scroll past the last item
            var maxScrollRight = Math.min(totalItems - 3, currentIndex[parentCategoryId] + 3);
            currentIndex[parentCategoryId] = maxScrollRight;

            slider.scrollTo({
                left: maxScrollRight * itemWidth,
                behavior: 'smooth'
            });
        }
    </script>
@endsection
