@extends('bar')

@section('content')
    <link rel="stylesheet" href="/css/shop.css">
    <link rel="stylesheet" href="/css/item_design.css">

    <div class="container my-5">
        <div class="row">
            @foreach ($items as $item)
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
                                            ...
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel{{ $item->id }}" role="button"
                                            data-slide="prev">
                                            <i class="fa fa-3x fa-angle-left"></i>

                                        </a>
                                        <a class="right carousel-control" href="#carousel{{ $item->id }}" role="button"
                                            data-slide="next">
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
                        <p class='ml-1'>{{ $item->price }} EGP</p>
                        <div>
                            @if (Auth::check() && Auth::user()->type == 1)
                                <p><b>Quantity : </b>{{ $item->quantity }}</p>
                                <a href="{{ route('item.delete', ['id' => $item->id]) }}"
                                    onclick="return confirm('Are you sure to delete {{ $item->name }}?')">
                                    <button type="button" class="btn btn-default  brandcolor">
                                        <i class="fa fa-lg fa-trash actionIcons"></i></button></a>

                                <a href="{{ route('item.edit', ['id' => $item->id]) }}">
                                    <button type="button" class="btn btn-default  brandcolor">
                                        <i class="fa fa-pencil actionIcons"></i></button></a>


                                <a href="{{ route('hideitem', ['id' => $item->id]) }}">
                                    <button type="button" class="btn btn-default  brandcolor">
                                        @if ($item->hide == 1)
                                            <i class="fa fa-eye actionIcons"></i>
                                        @else
                                            <i class="fa fa-eye-slash actionIcons"></i>
                                        @endif
                                    </button></a><br>
                                {{-- @else
                            <button class="btn brandcolor raleway btnWeight btn-addtocart mb-2"
                                data-value="{{ $item->id }}">
                                Add To Cart</button><br> --}}
                            @endif

                            <a data-value="{{ $item->id }}" class="btn-addToFavorite raleway addtowishlist ml-1">
                                @if (app()->getLocale() == 'en')
                                    {{ __('messages.add_to_wishlist') }}
                                    <img src={{ URL::asset('images/favorite.svg') }} class='ml-1' width="12"
                                        height="12">
                                @else
                                    <img src={{ URL::asset('images/favorite.svg') }} class='mr-1' width="12"
                                        height="12">
                                    {{ __('messages.add_to_wishlist') }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="custom-pagination-brand-blue text-center">
        {{ $items->links() }}
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

        $(document).on("click", '.btn-addtocart', function(e) {

            e.preventDefault();

            var str = $(this).data('value');;
            $.ajax({

                type: 'POST',

                url: "{{ route('item.addToCart') }}",

                data: {
                    name: str
                },

                success: function(data) {

                    if (data.message === undefined) {

                        $(".countCart").text(data.countCart);
                        $('#messaga').text("Added Sucessfully")
                        $('#errormessage').modal();
                    } else {
                        $('#messaga').text(data.message)
                        $('#errormessage').modal();
                    }

                }

            });
        });
    </script>
@endsection
