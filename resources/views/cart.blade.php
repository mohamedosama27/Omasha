@extends('bar')

@section('content')
    @php
        $totalprice = 0;
    @endphp
    @if (Session::get('number_of_items') != 0)
        <link href="css/cart.css" rel="stylesheet" type="text/css" media="all" />

        <div class="container my-4">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-8 left-details">
                    <h3 class="mb-5 text-align-right">{{ __('messages.your_cart') }}</h3>
                    <div class="cart-items">
                        @foreach ($items as $item)
                            <div class="cart-item mb-3 pb-4 border-bottom">
                                <div class="d-flex">
                                    <img src="{{ 'images/' . $item->item->images->first()->name }}"
                                        alt="{{ $item->item->name }}" width="100" class="item-image mt-2">
                                    <div class="d-flex justify-content-between w-100">
                                        <div class="ml-4 product-description">
                                            <p class="large-font mb-2 mt-1">
                                                {{ app()->getLocale() == 'ar' ? $item->item->name_ar : $item->item->name }}
                                            </p>

                                            <div class="small-font text-muted mb-3 extra-details">
                                                @if (app()->getLocale() == 'ar')
                                                    @if ($item->style_ar != null)
                                                        <p class="mb-1"><span
                                                                dir="rtl">{{ $item->style_ar ?? '-' }}</span>
                                                            :{{ __('messages.style') }}</p>
                                                    @endif
                                                    <p class="mb-1"><span
                                                            dir="rtl">{{ $item->color_ar ?? '-' }}</span>
                                                        :{{ __('messages.color') }}</p>
                                                    @if ($item->size != null)
                                                        <p class="mb-1"><span
                                                                dir="rtl">{{ $item->size ?? '-' }}</span>
                                                            :{{ __('messages.size') }}</p>
                                                    @endif
                                                    @if ($item->note != null)
                                                        <p class="mb-1"><span
                                                                dir="rtl">{{ $item->note ?? '-' }}</span>
                                                            :{{ __('messages.note') }}</p>
                                                    @endif
                                                @else
                                                    @if ($item->style != null)
                                                        <p class="mb-1">{{ __('messages.style') }}:
                                                            {{ $item->style ?? '-' }}</p>
                                                    @endif
                                                    <p class="mb-1">{{ __('messages.color') }}:
                                                        {{ $item->color ?? '-' }}</p>
                                                    @if ($item->size != null)
                                                        <p class="mb-1">{{ __('messages.size') }}:
                                                            {{ $item->size ?? '-' }}
                                                    @endif
                                                    </p>
                                                    @if ($item->note != null)
                                                        <p class="mb-1">{{ __('messages.note') }}:
                                                            {{ $item->note ?? '-' }}
                                                    @endif
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-outline-secondary mr-3 btn-decrement"
                                                    style="font-size: 10px;" type="button" data-id="{{ $item->id }}"
                                                    data-value={{ $item->Quantity }}>
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <p id="quantity{{ $item->id }}" class="inline mr-3 mt-2">
                                                    {{ $item->Quantity }}</p>
                                                <button class="btn btn-outline-secondary btn-sm btn-increment mr-2"
                                                    style="font-size: 10px;" type="button" data-id="{{ $item->id }}"
                                                    data-value={{ $item->Quantity }}>
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <p class="mb-0">x {{ number_format($item->price, 2) }}
                                                    {{ __('messages.egp') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-center price-area">
                                            <p class="mb-5 mt-2 font-weight-bold large-font">
                                                <span
                                                    id="totalprice{{ $item->id }}">{{ number_format($item->price * $item->Quantity, 2) }}</span>
                                                <span>{{ __('messages.egp') }}</span>
                                            </p>
                                            <a href="{{ route('removefromcart', ['id' => $item->item->id]) }}">
                                                <button class="btn btn-secondary"><i class="fa fa-trash"></i></button>
                                            </a>
                                            <form method="POST">
                                                @csrf
                                                @method('DELETE')

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $totalprice += $item->price * $item->Quantity @endphp
                        @endforeach
                    </div>
                </div>


                <!-- Order Summary -->
                <div class="col-md-4 order-summary">
                    <div class="large-font">
                        <div class="card-header text-align-right">
                            <h3>{{ __('messages.order_summary') }}</h3>
                        </div>
                        <div class="card-body">
                            {{-- <div class="d-flex justify-content-between mb-3">
                                <p>Subtotal:</p>
                                <p>{{ number_format(6465, 2) }} EGP</p>
                            </div> --}}
                            {{-- <div class="d-flex justify-content-between mb-3">
                                <p>Delivery Fees:</p>
                                <p>{{ number_format(50, 2) }} EGP</p>
                            </div>
                            <div class="form-group">
                                <label class="mb-3" for="governorate">Governorate</label>
                                <select name="governorate" id="governorate" class="form-control">
                                    <option value="cairo">Cairo</option>
                                    <option value="alexandria">Alexandria</option>
                                    <option value="giza">Giza</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div> --}}
                            {{-- <hr> --}}
                            <div class="d-flex justify-content-between font-weight-bold mt-3 mb-5 reverse-flex">
                                @if (app()->getLocale() == 'en')
                                    <p class="large-font">{{ __('messages.subtotal') }}:</p>
                                @else
                                    <p class="large-font">:{{ __('messages.subtotal') }}</p>
                                @endif
                                <p class="large-font"><span id="cart-subtotal">{{ number_format($totalprice, 2) }}</span>
                                    <span>{{ __('messages.egp') }}</span>
                                </p>
                            </div>
                            <button onclick="window.location.href='{{ route('checkout') }}';"
                                class="btn btn-primary btn-block mt-4 brandcolor p-2 large-font">{{ __('messages.checkout') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- @foreach ($items as $selecteditem)
            <div class="row mt-5">
                <div class="col-xs-12 col-md-4 text-center">
                    <img src="images\{{ $selecteditem->item->images->first()->name }}" height="150">
                </div>
                <a href="{{ route('item.show', ['id' => $selecteditem->item->id]) }}">
                    <p class="col-xs-12 col-md-3 text-center">{{ $selecteditem->item->name }}</p>
                </a>
                <span class="col-xs-4 col-md-2"> {{ $selecteditem->item->price }} <p class="EGP">LE</p></span>
                <div class="col-xs-3 col-md-2 quantityDiv">

                    <button type="button" class="btn-increment " data-value="{{ $selecteditem->item->id }}">
                        <i class="fa fa-plus-square"></i></button>


                    <p id="quantity{{ $selecteditem->item->id }}" class="inline">{{ $selecteditem->Quantity }}</p>


                    <button type="button" class="btn-decrement" data-value="{{ $selecteditem->item->id }}">
                        <i class="fa fa-minus-square"></i>
                    </button>

                </div>
                <a href="{{ route('removefromcart', ['id' => $selecteditem->item->id]) }}"
                    class="col-xs-3 col-md-1 btn-danger">
                    Remove
                </a>
                <div class="col-xs-7 col-md-2 pull-right raleway">
                    <b>Total price : </b>
                    <div class="inline" id="totalprice{{ $selecteditem->item->id }}">
                        {{ $selecteditem->item->price * $selecteditem->Quantity }}</div>

                    <p class="EGP">LE</p>
                </div>

            </div>
            <hr>
            @php $totalprice+=$selecteditem->item->price*$selecteditem->Quantity @endphp
        @endforeach
        <hr>
        <div class="col-xs-8  col-sm-5  col-md-4 pull-right">
            <div class="price invoice">
                <label class="raleway">Subtotal : </label>
                <div class=" inline" id="cart-subtotal">{{ $totalprice }}</div>
            </div>

            @include('errormessage')
            @include('addaddress')
            <a @auth href="{{ route('checkout') }}" @else href=" login" @endauth>
                <button class="checkoutButton btn brandcolor">Checkout</button>
        </div>
        </div> --}}
    @else
        <h2 style="margin-top:10%;font-size:26px;" class="battalion text-center">Your cart is empty</h2>
    @endif

    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $('#city').change(function() {
            var city_fee = $('#city option:selected').data('value');
            $("#cart-tax").text(city_fee);
        });
        $(document).on("click", '.btn-decrement', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var quantity = parseInt($("#quantity" + id).text(), 10);
            if (quantity <= 1) {
                return;
            }
            $.ajax({

                type: 'POST',

                url: "{{ route('decrementItem') }}",

                data: {
                    id: id
                },
                datatype: 'json',

                success: function(data) {
                    $("#cart-subtotal").text(parseFloat(data.totalprice).toFixed(2));
                    $("#quantity" + id).text(data.quantity);
                    $("#totalprice" + id).text(parseFloat(data.item_total_price).toFixed(2))
                    // $("#countcart").text(data.countCart);
                }

            });

        });
        $(document).on("click", '.btn-increment', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            $.ajax({

                type: 'POST',

                url: "{{ route('incrementItem') }}",

                data: {
                    id: id
                },
                datatype: 'json',

                success: function(data) {

                    if (data.message === undefined) {

                        $("#quantity" + id).text(data.quantity);
                        $("#totalprice" + id).text(parseFloat(data.item_total_price).toFixed(2))
                        // $("#countcart").text(data.countCart);
                        $("#cart-subtotal").text(parseFloat(data.totalprice).toFixed(2));

                    } else {
                        $('#messaga').text(data.message)
                        $('#errormessage').modal();
                    }
                }
            });
        });
    </script>
@endsection
