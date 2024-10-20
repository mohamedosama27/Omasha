@extends('bar')

@section('content')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .fa-heart {
            font-size: 18px;
            color: red;
        }

        .large-font {
            font-size: 16px;
        }

        .larger-font {
            font-size: 18px;
        }

        .expandable:hover {
            color: darkred;
        }

        .list-style-circle {
            list-style-type: circle;
            padding-left: 30px;
        }

        .active-thumbnail {
            border: 1px solid #007bff;
        }

        .thumbnail-wrapper {
            width: 500px;
            /* Limit width to show only 5 images at a time */
            display: flex;
            scroll-behavior: smooth;
            /* Smooth scrolling when using the arrows */
            overflow-x: auto;
            /* Allow horizontal scrolling */
            white-space: nowrap;
        }

        .arrow-btn {
            background-color: white;
            border: none;
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
        }

        .thumbnail-container {
            position: relative;
        }

        /* Hide scrollbars for aesthetics */
        .thumbnail-wrapper::-webkit-scrollbar {
            display: none;
        }

        .thumbnail-wrapper {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .img-fluid {
            width: 500px;
            height: 450px;
        }

        @media (min-width:768px) {
            .mobile-description {
                display: none !important;
            }

            .mobile-reviews {
                display: none !important;
            }
        }

        .product-reviews {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-reviews h4 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .product-reviews ul {
            padding-left: 0;
        }

        .product-reviews li {
            list-style: none;
        }

        .product-reviews .fas.fa-star,
        .product-reviews .far.fa-star {
            margin-right: 5px;
            font-size: 16px;
        }

        .product-reviews .text-muted {
            color: #6c757d;
        }


        @media (max-width:768px) {
            .img-fluid {
                width: 100%;
                height: 350px;
            }

            .product-description {
                display: none !important;
            }

            .mobile-description ul {
                padding-inline-start: 20px;
            }

            .product-details {
                margin-top: 2rem;
            }

            .desktop-reviews {
                display: none !important;
            }
        }
    </style>

    <div class="container my-4 raleway">
        <div class="row">
            <!-- Left Column: Product Images and Description -->
            <div class="col-md-6">
                <!-- Main Product Image -->
                <div class="product-image">
                    <img id="main-image" src="{{ URL::asset("images/{$item->images[0]->name}") }}"
                        alt="{{ $item->images[0]->name }}" class="img-fluid">
                </div>
                <!-- Smaller Thumbnail Images -->
                <div class="thumbnail-container d-flex align-items-center mt-3">
                    <!-- Left Arrow (conditionally displayed if more than 5 images) -->
                    <button id="left-arrow" class="arrow-btn" style="display: none;">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <!-- Scrollable Thumbnails -->
                    <div id="thumbnail-wrapper" class="thumbnail-wrapper d-flex overflow-auto">
                        @foreach ($item->images as $index => $image)
                            <img src="{{ URL::asset("images/{$image->name}") }}" alt="{{ $image->name }}"
                                class="img-thumbnail small-image mx-1 {{ $index === 0 ? 'active-thumbnail' : '' }}"
                                data-index="{{ $index }}" data-hex="{{ $image->color_hex }}"
                                style="width: 100px; cursor: pointer;">
                        @endforeach
                    </div>

                    <!-- Right Arrow (conditionally displayed if more than 5 images) -->
                    <button id="right-arrow" class="arrow-btn" style="display: none;">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <!-- Product Description -->
                @php
                    if (app()->getLocale() == 'ar') {
                        $descriptions = json_decode($item->description_ar);
                    } else {
                        $descriptions = json_decode($item->description);
                    }
                @endphp

                <div class="pt-4 product-description" style="max-width: 500px">
                    @if (!empty($descriptions))
                        <ul class="list-style-circle text-align-right">
                            @foreach ($descriptions as $descriptionLine)
                                <li class="mt-3">
                                    <h5>{{ $descriptionLine }}</h5>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="pt-2 product-reviews desktop-reviews" style="max-width: 500px">
                    <h4 class='mb-4'>{{ __('messages.reviews') }}</h4>
                    <ul class="list-unstyled">
                        {{-- @foreach ($reviews as $review) --}}
                        <li class="mb-4">
                            <div class="d-flex align-items-center">
                                <!-- Display star ratings -->
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= 4)
                                        <i class="fas fa-star text-warning"></i> <!-- Full star -->
                                    @else
                                        <i class="far fa-star text-warning"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>
                            <!-- Display comment -->
                            <p class="mt-3 mb-1"><strong> Saher </strong></p>
                            <p class="text-muted">Product is Awesome!</p>
                        </li>
                        <hr style="border: 1px solid #ccc;">
                        <li class="mb-4">
                            <div class="d-flex align-items-center">
                                <!-- Display star ratings -->
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= 2)
                                        <i class="fas fa-star text-warning"></i> <!-- Full star -->
                                    @else
                                        <i class="far fa-star text-warning"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>
                            <!-- Display comment -->
                            <p class="mt-3 mb-1"><strong> John </strong></p>
                            <p class="text-muted">Product not so great</p>
                        </li>
                        {{-- @endforeach --}}
                    </ul>
                </div>
            </div>

            <!-- Right Column: Product Details -->
            <div class="col-md-4 text-align-right product-details">
                <h2 class="font-weight-bold">{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name }}</h2>
                <h3 class="mt-4" id="price">{{ number_format($item->price, 2) }} EGP</h3>

                <div class="pt-3 mobile-description" style="max-width: 500px">
                    @if (!empty($descriptions))
                        <ul class="list-style-circle text-align-right">
                            @foreach ($descriptions as $descriptionLine)
                                <li class="mt-3">
                                    <h5>{{ $descriptionLine }}</h5>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Color Picker -->
                <div class="mt-4">
                    <label id="color-label">
                        <h5>{{ __('messages.color') }}</h5>
                    </label>
                    <div class="d-flex mt-2">
                        @foreach (json_decode($item->colors) as $color)
                            <div class="color-picker" data-color="{{ $color->name }}" data-toggle="tooltip"
                                data-hex="{{ $color->hex }}" data-placement="top"
                                title="{{ app()->getLocale() == 'ar' ? $color->name_ar : $color->name }}"
                                style="background-color: {{ $color->hex }}; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; margin-right: 15px;">
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" id="selected-color" name="selected_color" value="">
                </div>

                <!-- Style Dropdown -->
                @php
                    if (app()->getLocale() == 'ar') {
                        $styles = json_decode($item->styles_ar);
                    } else {
                        $styles = json_decode($item->styles);
                    }
                    $sizes = json_decode($item->sizes);
                @endphp

                @if (!empty($styles))
                    <div class="mt-4">
                        <label for="style">
                            <h5>{{ __('messages.style') }}</h5>
                        </label>
                        <select id="style" name="style" class="form-control mt-1">
                            @foreach ($styles as $index => $style)
                                <option value="{{ $index }}">{{ $style }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if (!empty($sizes))
                    <div class="mt-4">
                        <label for="size">
                            <h5>{{ __('messages.size') }}</h5>
                        </label>
                        <select id="size" name="size" class="form-control mt-1">
                            @foreach ($sizes as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Quantity and Add to Cart -->
                <div class="mt-4">
                    <label for="quantity">
                        <h5>{{ __('messages.quantity') }}</h5>
                    </label>
                    <div class='d-flex align-items-center mt-1'>
                        <button class="btn btn-outline-secondary minus-btn" type="button" style="font-size: 10px;"><i
                                class="fas fa-minus"></i></button>
                        <input type="number" id="quantity" name="quantity" value="1" class="form-control ml-2 mr-2"
                            style="width: 80px;" readonly>
                        <button class="btn btn-outline-secondary plus-btn" style="font-size: 10px;" type="button"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="note">
                        <h5>{{ __('messages.note') }}</h5>
                    </label>
                    <textarea type="text" id="note" name="note" class="form-control mt-1"></textarea>
                </div>

                <button class="btn btn-primary btn-block mt-4 brandcolor large-font mb-5 btn-addtocart"
                    data-value="{{ $item->id }}">{{ __('messages.add_to_cart') }}</button>

                @php
                    if (app()->getLocale() == 'ar') {
                        $careInstructions = json_decode($item->care_instructions_ar);
                    } else {
                        $careInstructions = json_decode($item->care_instructions);
                    }
                @endphp

                @if (!empty($careInstructions))
                    <div class="mt-5">
                        <div id="toggle-care-instructions"
                            class="d-flex justify-content-between align-items-center expandable" style="cursor: pointer;"
                            data-toggle="collapse" data-target="#careInstructions">
                            <p class="mb-0 larger-font">{{ __('messages.care_instructions') }}</p>
                            <i id="toggle-instructions-icon" class="fas fa-plus"></i>
                        </div>
                        <div id="careInstructions" class="collapse">
                            <ul class="mt-4 list-style-circle">
                                @foreach ($careInstructions as $careInstruction)
                                    <li class="mt-3">
                                        <h6>{{ $careInstruction }}</h6>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="mt-4">
                    </div>
                @endif

                @if ($item->return_policy != null)
                    <div class="mt-2">
                        <div id="toggle-refund-policy"
                            class="d-flex justify-content-between align-items-center expandable" style="cursor: pointer;"
                            data-toggle="collapse" data-target="#refundPolicy">
                            <p class="mb-0 larger-font">{{ __('messages.refund_policy') }}</p>
                            <i id="toggle-refund-icon" class="fas fa-plus"></i>
                        </div>
                        <div id="refundPolicy" class="collapse">
                            <h6 class="pt-3 ml-4">
                                {{ app()->getLocale() == 'ar' ? $item->return_policy_ar : $item->return_policy }}<h6>
                        </div>
                        <hr class="mt-4">
                    </div>
                @endif

                <div class="pt-2 product-reviews mobile-reviews" style="max-width: 500px">
                    <h4 class='mb-4'>{{ __('messages.reviews') }}</h4>
                    <ul class="list-unstyled">
                        {{-- @foreach ($reviews as $review) --}}
                        <li class="mb-4">
                            <div class="d-flex align-items-center">
                                <!-- Display star ratings -->
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= 4)
                                        <i class="fas fa-star text-warning"></i> <!-- Full star -->
                                    @else
                                        <i class="far fa-star text-warning"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>
                            <!-- Display comment -->
                            <p class="mt-3 mb-1"><strong> Saher </strong></p>
                            <p class="text-muted">Product is Awesome!</p>
                        </li>
                        <hr style="border: 1px solid #ccc;">
                        <li class="mb-4">
                            <div class="d-flex align-items-center">
                                <!-- Display star ratings -->
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= 2)
                                        <i class="fas fa-star text-warning"></i> <!-- Full star -->
                                    @else
                                        <i class="far fa-star text-warning"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>
                            <!-- Display comment -->
                            <p class="mt-3 mb-1"><strong> John </strong></p>
                            <p class="text-muted">Product not so great</p>
                        </li>
                        {{-- @endforeach --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    @php
        $productPrices = json_decode($item->priceVariations);
        $styles_en = json_decode($item->styles);
        $styles_ar = json_decode($item->styles_ar);
        $colors = json_decode($item->colors);
    @endphp

    @include('errormessage')

    <script type="text/javascript">
        document.querySelector('.minus-btn').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) { // Prevents going below 1
                quantityInput.value = currentValue - 1;
            }
        });

        document.querySelector('.plus-btn').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
        });
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        const thumbnailWrapper = document.getElementById('thumbnail-wrapper');
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');
        const smallImages = document.querySelectorAll('.small-image');
        const mainImage = document.getElementById('main-image');

        const productPrices = @json($productPrices);
        const styleDropdown = document.getElementById('style');
        const sizeDropdown = document.getElementById('size');
        const priceDisplay = document.getElementById('price');

        function initPrice() {
            if (productPrices.length != 0) {
                const minPriceObject = productPrices.reduce((min, product, index) => {
                    return (product.price < min.price) ? product : min;
                });
                styleDropdown.value = minPriceObject.style;
                sizeDropdown.value = minPriceObject.size;
            }
        }

        initPrice();

        function updatePrice() {
            productPrices.forEach(function(item) {
                if (item.size == sizeDropdown.value && item.style == styleDropdown.value) {
                    let price = parseFloat(item.price);
                    priceDisplay.textContent = price.toFixed(2) + ' EGP';
                }
            });
        }

        if (styleDropdown != null) {
            styleDropdown.addEventListener('change', updatePrice);
        }
        if (sizeDropdown != null) {
            sizeDropdown.addEventListener('change', updatePrice);
        }


        // Conditionally display arrows if more than 5 thumbnails
        if (smallImages.length > 5) {
            leftArrow.style.display = 'block';
            rightArrow.style.display = 'block';
        }

        // Function to handle updating the main image and highlighting the active thumbnail
        function updateMainImage(thumbnail) {
            // Change the main image to the clicked thumbnail
            mainImage.src = thumbnail.src;

            // Remove 'active-thumbnail' class from all thumbnails
            smallImages.forEach(img => img.classList.remove('active-thumbnail'));

            // Add 'active-thumbnail' class to the clicked thumbnail
            thumbnail.classList.add('active-thumbnail');
        }

        // Add event listeners for each thumbnail to change the main image
        smallImages.forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function() {
                updateMainImage(thumbnail);
            });
        });

        // Handle scrolling through the thumbnails
        leftArrow.addEventListener('click', function() {
            thumbnailWrapper.scrollBy({
                left: -100, // Scroll to the left
                behavior: 'smooth'
            });
        });

        rightArrow.addEventListener('click', function() {
            thumbnailWrapper.scrollBy({
                left: 100, // Scroll to the right
                behavior: 'smooth'
            });
        });

        const careInstructions = document.getElementById('toggle-care-instructions')

        if (careInstructions != null) {
            careInstructions.addEventListener('click', function() {
                const icon = document.getElementById('toggle-instructions-icon');
                if (icon.classList.contains('fa-plus')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                } else {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            });
        }

        const refundPolicy = document.getElementById('toggle-refund-policy')

        if (refundPolicy != null) {
            refundPolicy.addEventListener('click', function() {
                const icon = document.getElementById('toggle-refund-icon');
                if (icon.classList.contains('fa-plus')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                } else {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            });
        }

        const colorPickers = document.querySelectorAll('.color-picker');
        const hiddenColorInput = document.getElementById('selected-color');

        if (colorPickers.length > 0) {
            const firstPicker = colorPickers[0];
            firstPicker.style.boxShadow = '0 0 0 4px lightblue'; // Add shadow to the first picker
            hiddenColorInput.value = firstPicker.dataset.hex; // Set hidden input value

            // Automatically set the corresponding thumbnail image if needed
            const correspondingThumbnail = [...smallImages].find(
                img => img.dataset.hex === hiddenColorInput.value
            );

            if (correspondingThumbnail) {
                // Update the main image to show the corresponding thumbnail image
                mainImage.src = correspondingThumbnail.src;
                mainImage.alt = correspondingThumbnail.alt;

                // Add a visual indicator to the selected thumbnail
                smallImages.forEach(img => img.classList.remove('active-thumbnail'));
                correspondingThumbnail.classList.add('active-thumbnail');
            }
        }

        colorPickers.forEach(picker => {
            picker.addEventListener('click', function() {
                // Remove border from previously selected color
                colorPickers.forEach(picker => picker.style.boxShadow = 'none');

                // Add border to the clicked color to indicate selection
                this.style.boxShadow = '0 0 0 4px lightblue';

                // Update the hidden input with the selected color's hex value
                hiddenColorInput.value = this.dataset.hex;

                const correspondingThumbnail = [...smallImages].find(
                    img => img.dataset.hex === hiddenColorInput.value
                );

                if (correspondingThumbnail) {
                    // Update the main image to show the corresponding thumbnail image
                    mainImage.src = correspondingThumbnail.src;
                    mainImage.alt = correspondingThumbnail.alt;

                    // Add a visual indicator to the selected thumbnail
                    smallImages.forEach(img => img.classList.remove('active-thumbnail'));
                    correspondingThumbnail.classList.add('active-thumbnail');
                }
            });
        });

        $(document).on("click", '.btn-addToFavorite', function(e) {

            e.preventDefault();

            var id = $(this).data('value');;
            $.ajax({

                type: 'POST',

                url: "{{ route('addToFavorite') }}",

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

            var str = $(this).data('value');
            var note = $('#note').val();
            var quantity = $('#quantity').val();
            var style = parseInt($('#style').val());
            var size = $('#size').val();
            var color = $('#selected-color').val();
            var styles = {!! json_encode($styles_en) !!};
            var styles_ar = {!! json_encode($styles_ar) !!};
            var colors = {!! json_encode($colors) !!};

            var selectedStyle = styles?.[style] ?? null;
            var selectedStyleAr = styles_ar?.[style] ?? null;

            var selectedColor = colors.find(function(item) {
                return item.hex === color;
            });

            var selectedColorEn = selectedColor.name;
            var selectedColorAr = selectedColor.name_ar;

            var messages = {
                'add_success': "{{ __('messages.add_success') }}",
            };

            $.ajax({

                type: 'POST',

                url: "{{ route('item.addToCart') }}",
                data: {
                    name: str,
                    size: size,
                    quantity: parseInt(quantity),
                    note: note,
                    style: selectedStyle,
                    style_ar: selectedStyleAr,
                    color: selectedColorEn,
                    color_ar: selectedColorAr
                },

                success: function(data) {

                    if (data.message === undefined) {

                        $("#countcart").text(data.countCart);
                        $('#messaga').text(messages['add_success'])
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
