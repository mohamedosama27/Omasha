@extends('bar')

@section('content')
    <link rel="stylesheet" href="/css/item_design.css">
    <style>
        @media (max-width:450px) {
            .remove-product {
                font-size: 13px;
                padding: 4px 3px;
            }

            .btn-addtocart {
                padding: 5px 5px;
                font-size: 12px;
            }
        }
    </style>
    <div class="container my-4">
        <div class="row">
            @forelse($items as $item)
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
                                        <ol class="carousel-indicators">
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
                                        </ol>

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
                        <p>{{ $item->price }} LE</p>
                        <div class='text-align-right'>
                            {{-- <button class="btn brandcolor raleway btnWeight btn-addtocart"
                                data-value="{{ $item->id }}">
                                {{ __('messages.add_to_cart') }}</button> --}}

                            <a href="{{ route('removefromfavorites', ['id' => $item->id]) }}">
                                <button class="remove-product btn btn-secondary">
                                    <i class="fa fa-lg fa-trash"></i>
                                </button>
                        </div>
                        </a>
                    </div>


                </div>
            @empty
                <div class="alert alert-dark" style="text-align:center;margin-bottom:20px;" role="alert">
                    <h1 style="display:center;font-size:26px;" class="battalion">{{ __('messages.empty_wishlist') }}</h1>
                </div>
            @endforelse
        </div>
    </div>


    @include('errormessage')

    {{-- <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

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
    </script> --}}
@endsection
