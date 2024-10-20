@extends('bar')

@section('content')
    <style>
        @media (max-width:768px) {
            .img-fluid {
                height: 390px;
            }

            .product-name {
                font-size: 16px;
            }

            .product-quantity {
                font-size: 14px;
            }

            .product-price {
                font-size: 18px;
            }

            .order-summary {
                margin-top: 40px;
            }
        }

        #total-after {
            display: none;
        }

        #total-after-label {
            display: none;
        }
    </style>

    <div class="container my-4 raleway">
        <div class="row">
            <!-- Customer and Delivery Details Form -->
            <div class="col-md-7 text-align-right left-details">
                <h3 class="mb-4"><strong>{{ __('messages.delivery_details') }}</strong></h3>
                <form method="POST" id="checkout-form" action="{{ route('checkout.order') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Customer Details -->
                    <div class="form-group">
                        <label class="mb-2" for="address">{{ __('messages.address') }}</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="city">{{ __('messages.city') }}</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="governorate">{{ __('messages.governorate') }}</label>
                        <select class="form-control" Name="governorate" id="governorate" required>
                            @foreach ($fees as $fee)
                                <option value="{{ $fee->id }}" data-value="{{ $fee->value }}">
                                    {{ app()->getLocale() == 'ar' ? $fee->name_ar : $fee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Delivery Details -->
                    <h3 class="mt-5 mb-4"><strong>{{ __('messages.customer_details') }}</strong></h3>
                    <div class="form-group">
                        <label class="mb-2" for="email">{{ __('messages.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="first_name">{{ __('messages.first_name') }}</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="last_name">{{ __('messages.last_name') }}</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="phone">{{ __('messages.phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-md-5 order-summary">
                <div class="card bg-light">
                    <div class="card-header text-align-right">
                        <h3>{{ __('messages.order_summary') }}</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <img src="images\{{ $item->item->images->first()->name }}" class="img-thumbnail"
                                        width="60">
                                    <div class="ml-3">
                                        <h5 class='product-name'>
                                            {{ app()->getLocale() == 'ar' ? $item->item->name_ar : $item->item->name }}
                                        </h5>
                                        <p class="mb-0 product-quantity">{{ $item->Quantity }} x
                                            {{ number_format($item->price, 2) }}
                                            {{ __('messages.egp') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-0 product-price">
                                        {{ number_format($item->Quantity * $item->price, 2) }}
                                        {{ __('messages.egp') }}</h4>
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <form method="POST" action="{{ route('promocode.apply') }}" class="d-flex mb-3 text-align-right">
                            @csrf
                            <input type="text" name="promo_code" class="form-control mr-2"
                                placeholder="{{ __('messages.enter_promo_code') }}"
                                value="{{ session('promoCodeApplied') ?? '' }}"
                                {{ session('promoCodeApplied') ? 'disabled' : '' }} required>
                            <button type="submit" class="btn btn-primary brandcolor mr-2"
                                {{ session('promoCodeApplied') ? 'disabled' : '' }}>{{ __('messages.apply') }}</button>
                        </form>

                        @if (session('error'))
                            <div class="text-danger mb-2 ml-2">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Display Success Message and New Total Amount -->
                        @if (session('success'))
                            <div class="text-success mb-2 ml-2">
                                {{ session('success') }}
                            </div>
                        @endif

                        @php
                            if (session('discount', 0) != 0) {
                                if (session('type') == 'percentage') {
                                    $totalAfter = $totalAmount * session('discount');
                                } else {
                                    $totalAfter = $totalAmount - session('discount');
                                }
                            }
                        @endphp

                        <div>
                            @if (app()->getLocale() == 'en')
                                <div class='d-flex justify-content-between reverse-flex'>
                                    <h6 id='total-before-label'>{{ __('messages.total') }}:</h6>
                                    <h5 class='product-price' id='total-before'>{{ number_format($totalAmount, 2) }}
                                        {{ __('messages.egp') }}
                                    </h5>
                                </div>
                                @if (session('discount', 0) != 0)
                                    <div class='d-flex justify-content-between reverse-flex'>
                                        <h6 id='total-after-label'>{{ __('messages.total') }}:</h6>
                                        <h5 class='product-price' id='total-after'>
                                            {{ number_format($totalAfter, 2) }}
                                            {{ __('messages.egp') }}
                                        </h5>
                                    </div>
                                @endif
                            @else
                                <div class='d-flex justify-content-between reverse-flex'>
                                    <h6 id='total-before-label'>:{{ __('messages.total') }}</h6>
                                    <h5 class='product-price' id='total-before'>{{ number_format($totalAmount, 2) }}
                                        {{ __('messages.egp') }}
                                    </h5>
                                </div>
                                @if (session('discount', 0) != 0)
                                    <div class='d-flex justify-content-between reverse-flex'>
                                        <h6 id='total-after-label'>:{{ __('messages.total') }}</h6>
                                        <h5 class='product-price' id='total-after'>
                                            {{ number_format($totalAfter, 2) }}
                                            {{ __('messages.egp') }}
                                        </h5>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="d-flex justify-content-between reverse-flex mt-1">
                            @if (app()->getLocale() == 'en')
                                <h6>{{ __('messages.delivery_fees') }}:</h6>
                                <h5 id='delivery-fees' class='product-price'></h5>
                            @else
                                <h6>:{{ __('messages.delivery_fees') }}</h6>
                                <h5 id='delivery-fees' class='product-price'></h5>
                            @endif
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between font-weight-bold reverse-flex">
                            @if (app()->getLocale() == 'en')
                                <h6>{{ __('messages.grand_total') }}:</h6>
                                <h5 id='grand-total' class='product-price'></h5>
                            @else
                                <h6>:{{ __('messages.grand_total') }}</h6>
                                <h5 id='grand-total' class='product-price'></h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class='d-flex justify-content-center'>
                    <button type='button' name='submit' onclick="submitForm()"
                        class="btn btn-primary mt-5 brandcolor w-75">{{ __('messages.confirm_order') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            document.getElementById('checkout-form').submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const governorateDropdown = document.getElementById('governorate');
            const deliveryFeesElement = document.getElementById('delivery-fees');
            const grandTotalElement = document.getElementById('grand-total');
            const totalBefore = document.getElementById('total-before');
            const totalBeforeLabel = document.getElementById('total-before-label');
            const totalAfter = document.getElementById('total-after');
            const totalAfterLabel = document.getElementById('total-after-label');

            function updateDeliveryFees() {
                const selectedOption = governorateDropdown.options[governorateDropdown.selectedIndex];
                const deliveryFee = parseFloat(selectedOption.getAttribute('data-value'));
                let discount = {{ session('discount', 0) }};
                let discountType = "{{ session('type', '') }}";
                console.log(discount);

                let totalAmount = {{ $totalAmount }};
                if (discountType == 'percentage') {
                    totalAmount *= discount;
                } else if (discountType == 'amount') {
                    totalAmount -= discount;
                }
                console.log(totalAmount);

                deliveryFeesElement.textContent = deliveryFee.toLocaleString('en-US', {
                    minimumFractionDigits: 2
                }) + ' {{ __('messages.egp') }}';

                const grandTotal = totalAmount + deliveryFee;
                grandTotalElement.textContent = grandTotal.toLocaleString('en-US', {
                    minimumFractionDigits: 2
                }) + ' {{ __('messages.egp') }}';
                if (discount != 0) {
                    totalBefore.style.textDecoration = 'line-through';
                    totalBeforeLabel.style.textDecoration = 'line-through';
                    totalAfter.style.display = 'block';
                    totalAfterLabel.style.display = 'block';
                }
            }

            updateDeliveryFees();

            governorateDropdown.addEventListener('change', function() {
                updateDeliveryFees();
            });

            @if (session('success'))
                updateDeliveryFees();
            @endif
        });
    </script>
@endsection
