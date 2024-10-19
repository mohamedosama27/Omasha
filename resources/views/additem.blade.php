@extends('bar')

@section('content')
    <style>
        label {
            margin: 5px;
        }

        .form-control {
            margin: 10px;
            width: 70%;
        }

        .color-form {
            width: 30%;
        }

        .custom-file-input {
            background-color: white;
        }

        .image-label {
            height: 40px;
        }

        .add-button {
            width: 150px;
            font-size: 16px;
        }

        .large-input {
            height: 100px;
            padding: 10px;
            overflow-y: auto;
        }

        .overflow-label {
            display: block;
            width: 75%;
            word-wrap: break-word;
            white-space: normal;
        }

        #price-variations {
            display: none;
        }

        .image-thumbnail-wrapper {
            display: inline-block;
            text-align: center;
            width: 150px;
        }

        .img-thumbnail {
            border: 1px solid #ddd;
            padding: 5px;
            display: block;
            margin: 0 auto;
        }

        .image-color {
            width: 100%;
            margin: 0 auto;
            /* Center the dropdown */
            display: block;
        }

        .tag {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 5px;
        }

        .tag .remove-tag {
            margin-left: 10px;
            cursor: pointer;
            color: white;
            font-weight: bold;
        }
    </style>
    {{-- Form of inserting a new Item --}}
    <div class="container raleway">
        <h3 class="py-4">Add New Product</h3>
        <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <div class='d-flex'>
                    <input type="text" name="name" class="form-control" id="name" placeholder="English"
                        value="{{ old('name') }}" required>
                    <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="Arabic"
                        value="{{ old('name_ar') }}" required>
                </div>
                @error('name')
                    <span role="alert" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span><br>
                @enderror
            </div>

            <!-- Product Images -->
            <div class="form-group">
                <label for="validatedCustomFile">Product Images</label>
                <input type="file" name="img[]" id="validatedCustomFile" class="form-control image-label"
                    accept="image/*" required multiple>
            </div>

            <div id="imagePreviewContainer" class="d-flex flex-wrap ml-3"></div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <div id="description-container">
                    <div class="description-line" id="description-lines">
                        <div class='d-flex' style="max-width: 1095px">
                            <input type="text" id="description" name="description[]" class="form-control mt-2"
                                value="{{ old('description') }}" placeholder="English">
                            <input type="text" id="description_ar" name="description_ar[]" class="form-control mt-2"
                                value="{{ old('description_ar') }}" placeholder="Arabic">
                        </div>
                        <button type="button" class="btn btn-secondary mt-2 ml-2 add-description-line">Add New
                            Line</button>
                    </div>
                </div>
            </div>

            <!-- Category Dropdown -->
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="color-container">
                <label for="color">Select a Color</label>
                <div class="d-flex align-items-center color-inputs" style="max-width: 1110px">
                    <input type="color" name="color[]" id="color" class="form-control color-form ml-3" required>
                    <input type="text" name="color-name[]" class="form-control color-form ml-5"
                        placeholder="Name in English" required>
                    <input type="text" name="color-name-ar[]" class="form-control color-form ml-2"
                        placeholder="Name in Arabic" required>
                </div>
                <button type="button" class="btn btn-secondary mt-2 ml-2 add-color-line">Add New
                    Line</button>
            </div>

            <div class="form-group">
                <label for="style">Styles</label>
                <div id="style-container">
                    <div class="style-line" id="style-lines">
                        <div class='d-flex' style="max-width: 1095px">
                            <input type="text" name="style[]" id="style" class="form-control mt-2 style-input"
                                placeholder="English">
                            <input type="text" name="style_ar[]" id="style_ar" class="form-control mt-2"
                                placeholder="Arabic">
                        </div>
                        <button type="button" class="btn btn-secondary mt-2 ml-2 add-style-line">Add New
                            Line</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="size">Sizes</label>
                <div id="size-container">
                    <div class="size-line" id="size-lines">
                        <input type="text" name="size[]" id="size" class="form-control mt-2 size-input"
                            placeholder="Enter a size">
                        <button type="button" class="btn btn-secondary mt-2 ml-2 add-size-line">Add New
                            Line</button>
                    </div>
                </div>
            </div>

            <div class="form-group" id="price-variations">
                <label for="prices">Prices for Styles and Sizes</label>
                <div id="price-container" class="ml-3">

                </div>
            </div>

            <!-- Price -->
            <div class="form-group" id="basic-price">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" id="price"
                    value="{{ old('price') }}" required>
                @error('price')
                    <span role="alert" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span><br>
                @enderror
            </div>

            <!-- Cost -->
            <div class="form-group" id="basic-cost">
                <label for="cost">Cost</label>
                <input type="number" step="0.01" name="cost" class="form-control" id="cost"
                    value="{{ old('cost') }}" required>
            </div>

            <!-- Quantity -->
            <div class="form-group" id="basic-quantity">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity"
                    value="{{ old('quantity') }}" required>
                @error('quantity')
                    <span role="alert" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span><br>
                @enderror
            </div>

            <div class="form-group" id="basic-after-sale-price">
                <label for="after_sale_price">After Sale Price</label>
                <input type="number" step="0.01" name="cost" class="form-control" id="after_sale_price"
                    value="{{ old('after_sale_price') }}" required>
            </div>

            <!-- Care Instructions -->
            <div class="form-group">
                <label for="care_instructions">Care Instructions</label>
                <div id="care-instructions-container">
                    <div class="care-instruction-line" id="instruction-lines">
                        <div class='d-flex' style="max-width: 1095px">
                            <input type="text" id="care_instructions" name="care_instructions[]"
                                class="form-control mt-2" placeholder="English">
                            <input type="text" id="care_instructions_ar" name="care_instructions_ar[]"
                                class="form-control mt-2" placeholder="Arabic">
                        </div>
                        <button type="button" class="btn btn-secondary mt-2 ml-2 add-care-instruction-line">Add New
                            Line</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Refund Policy</label>
                <div class='d-flex'>
                    <textarea name="refund_policy" class="form-control large-input" id="refund_policy" placeholder="English"
                        value="{{ old('refund_policy') }}"></textarea>
                    <textarea name="refund_policy_ar" class="form-control large-input" id="refund_policy_ar" placeholder="Arabic"
                        value="{{ old('refund_policy_ar') }}"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="keywordInput">Keywords</label>
                <div class="d-flex align-items-center">
                    <input type="text" id="keywordInput" class="form-control" placeholder="Enter keyword">
                    <button type="button" id="addKeywordBtn" class="btn btn-secondary ml-2">Add Keyword</button>
                </div>
                <div id="keywordTags" class="mt-3"></div>
                <input type="hidden" name="keywords" id="keywordsInput">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-5 ml-2 brandcolor add-button">Add Product</button>
        </form>
    </div>

    <script>
        // var form = document.getElementById('upload');
        // var request = new XMLHttpRequest();
        // form.addEventLisener('submit', function(e) {
        //     e.preventDefault();
        //     var formdata = new FormData(form);

        //     request.open('post', '/createitem');
        //     request.addEventListener('load', transferComplete);
        //     request.send(
        //         formdata);
        // });

        // function transferComplete(data) {
        //     console.log(data.currentTarget.response);

        // }

        // Dynamically add new description line
        function createDescriptionLine() {
            const newDescriptionLine = document.createElement('div');
            newDescriptionLine.classList.add('description-line', 'd-flex', 'align-items-center');
            newDescriptionLine.innerHTML = `
    <input type="text" name="description[]" class="form-control mt-2" placeholder="English" required>
    <input type="text" name="description_ar[]" class="form-control mt-2" placeholder="Arabic" required>
    <button type="button" class="btn btn-secondary ml-2 remove-description-line"><i class="fas fa-trash"></i></button>
`;
            return newDescriptionLine;
        }

        function createStyleLine() {
            const newStyleLine = document.createElement('div');
            newStyleLine.classList.add('style-line', 'd-flex', 'align-items-center');
            newStyleLine.innerHTML = `
    <input type="text" name="style[]" class="form-control mt-2 style-input" placeholder="English" required>
    <input type="text" name="style_ar[]" class="form-control mt-2" placeholder="Arabic" required>
    <button type="button" class="btn btn-secondary ml-2 remove-style-line"><i class="fas fa-trash"></i></button>
`;
            return newStyleLine;
        }

        function createSizeLine() {
            const newSizeLine = document.createElement('div');
            newSizeLine.classList.add('size-line', 'd-flex', 'align-items-center');
            newSizeLine.innerHTML = `
    <input type="text" name="size[]" class="form-control mt-2 size-input" placeholder="Enter a size" required>
    <button type="button" class="btn btn-secondary ml-2 remove-size-line"><i class="fas fa-trash"></i></button>
`;
            return newSizeLine;
        }

        function createColorLine() {
            const newColorLine = document.createElement('div');
            newColorLine.classList.add('description-line', 'd-flex', 'align-items-center', 'color-inputs');
            newColorLine.innerHTML = `
    <input type="color" name="color[]" class="form-control color-form ml-3" required>
    <input type="text" name="color-name[]" class="form-control color-form ml-5" placeholder="Name in English" required>
    <input type="text" name="color-name-ar[]" class="form-control color-form ml-2" placeholder="Name in Arabic" required>
    <button type="button" class="btn btn-secondary ml-2 remove-color-line"><i class="fas fa-trash"></i></button>
`;
            const colorNameInput = newColorLine.querySelector('input[name="color-name[]"]');
            colorNameInput.addEventListener('input', updateColorDropdowns);
            const colorHexInput = newColorLine.querySelector('input[name="color[]"]');
            colorHexInput.addEventListener('input', updateColorDropdowns);
            return newColorLine;
        }

        // Dynamically add new description line
        document.addEventListener('DOMContentLoaded', function() {
            firstStyleInput = document.getElementById('style');
            firstSizeInput = document.getElementById('size');

            firstStyleInput.addEventListener('input', function() {
                updatePriceFields();
            });

            firstSizeInput.addEventListener('input', function() {
                updatePriceFields();
            });

            const descriptionContainer = document.getElementById('description-container');
            const descriptionLines = document.getElementById('description-lines');
            document.querySelector('.add-description-line').addEventListener('click', function() {
                const newDescriptionLine = createDescriptionLine();
                descriptionLines.insertBefore(newDescriptionLine, descriptionContainer.querySelector(
                    '.add-description-line'));
            });

            // Delete a description line when the delete button is clicked
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-description-line') || e.target.closest(
                        '.remove-description-line')) {
                    e.target.closest('.description-line').remove();
                }
            });

            const styleContainer = document.getElementById('style-container');
            const styleLines = document.getElementById('style-lines');
            document.querySelector('.add-style-line').addEventListener('click', function() {
                const newStyleLine = createStyleLine();
                styleLines.insertBefore(newStyleLine, styleContainer.querySelector(
                    '.add-style-line'));

                const styleInput = newStyleLine.querySelector('input');
                styleInput.addEventListener('input', function() {
                    updatePriceFields();
                });

                newStyleLine.querySelector('.remove-style-line').addEventListener('click', function() {
                    styleLines.removeChild(newStyleLine);
                    updatePriceFields();
                });
            });

            const sizeContainer = document.getElementById('size-container');
            const sizeLines = document.getElementById('size-lines');
            document.querySelector('.add-size-line').addEventListener('click', function() {
                const newSizeLine = createSizeLine();
                sizeLines.insertBefore(newSizeLine, sizeContainer.querySelector(
                    '.add-size-line'));

                const sizeInput = newSizeLine.querySelector('input');
                sizeInput.addEventListener('input', function() {
                    updatePriceFields();
                });

                newSizeLine.querySelector('.remove-size-line').addEventListener('click', function() {
                    sizeLines.removeChild(newSizeLine);
                    updatePriceFields();
                });
            });

            const colorContainer = document.getElementById('color-container');
            // const colorLines = document.getElementById('description-lines');
            document.querySelector('.add-color-line').addEventListener('click', function() {
                const newColorLine = createColorLine();
                colorContainer.insertBefore(newColorLine, colorContainer.querySelector(
                    '.add-color-line'));
            });

            // Delete a description line when the delete button is clicked
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-color-line') || e.target.closest(
                        '.remove-color-line')) {
                    e.target.closest('.color-inputs').remove();
                    updateColorDropdowns();
                }
            });

            // Dynamically add new care instruction line
            const careInstructionsContainer = document.getElementById('care-instructions-container');
            const instructionLines = document.getElementById('instruction-lines');
            document.querySelector('.add-care-instruction-line').addEventListener('click', function() {
                const newCareInstructionLine = document.createElement('div');
                newCareInstructionLine.classList.add('care-instruction-line', 'd-flex',
                    'align-items-center');
                newCareInstructionLine.innerHTML = `
    <input type="text" name="care_instructions[]" class="form-control mt-2" placeholder="English" required>
    <input type="text" name="care_instructions_ar[]" class="form-control mt-2" placeholder="Arabic" required>
    <button type="button" class="btn btn-secondary ml-2 remove-care-instruction-line"><i class="fas fa-trash"></i></button>
`;
                instructionLines.insertBefore(newCareInstructionLine, careInstructionsContainer
                    .querySelector('.add-care-instruction-line'));
            });

            // Delete a care instruction line
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-care-instruction-line') || e.target.closest(
                        '.remove-care-instruction-line')) {
                    e.target.closest('.care-instruction-line').remove();
                }
            });

            const priceContainer = document.getElementById('price-container');
            const priceDiv = document.getElementById('price-variations');
            const basicPriceDiv = document.getElementById('basic-price');
            const basicQuantityDiv = document.getElementById('basic-quantity');
            const basicCostDiv = document.getElementById('basic-cost');
            const basicAfterSaleDiv = document.getElementById('basic-after-sale-price');
            const priceInput = document.getElementById('price');
            const costInput = document.getElementById('cost');
            const quantityInput = document.getElementById('quantity');
            const afterSaleInput = document.getElementById('after_sale_price');

            function showPriceVariations() {
                priceDiv.style.display = 'block';
                basicPriceDiv.style.display = 'none';
                basicCostDiv.style.display = 'none';
                basicQuantityDiv.style.display = 'none';
                basicAfterSaleDiv.style.display = 'none';
                priceInput.removeAttribute('required');
                costInput.removeAttribute('required');
                quantityInput.removeAttribute('required');
                afterSaleInput.removeAttribute('required');
            }

            function updatePriceFields() {
                priceContainer.innerHTML = '';

                const styles = document.getElementsByClassName('style-input');
                const sizes = document.getElementsByClassName('size-input');

                if (sizes.length == 1 && styles.length > 1) {
                    let size = "";
                    if (sizes[0].value != null && sizes[0].value != "") {
                        size = sizes[0].value;
                    } else {
                        size = "none"
                    }
                    Array.from(styles).forEach(function(style) {
                        if (style.value != null && style.value != "") {
                            const priceInput = document.createElement('div');
                            priceInput.classList.add('d-flex', 'align-items-center', 'mt-2',
                                'mb-1',
                                'price-input');

                            priceInput.innerHTML = `
                    <label class="mr-1 overflow-label">Fields for Style: "${style.value}":</label>
                    <input type="number" name="prices[${style.value}][${size}]" class="form-control" placeholder="Price" required>
                    <input type="number" name="costs[${style.value}][${size}]" class="form-control" placeholder="Cost" required>
                    <input type="number" name="quantities[${style.value}][${size}]" class="form-control" placeholder="Quantity" required>
                    <input type="number" name="after_sale_prices[${style.value}][${size}]" class="form-control" placeholder="After Sale Price" required>
                `;

                            priceContainer.appendChild(priceInput);
                        }
                    });
                    showPriceVariations();
                } else if (styles.length == 1 && sizes.length > 1) {
                    let style = "";
                    if (styles[0].value != null && styles[0].value != "") {
                        style = styles[0].value;
                    } else {
                        style = "none"
                    }
                    Array.from(sizes).forEach(function(size) {
                        if (size.value != null && size.value != "") {
                            const priceInput = document.createElement('div');
                            priceInput.classList.add('d-flex', 'align-items-center', 'mt-2',
                                'mb-1',
                                'price-input');

                            priceInput.innerHTML = `
                    <label class="mr-1 overflow-label">Fields for Size: "${size.value}":</label>
                    <input type="number" name="prices[${style}][${size.value}]" class="form-control" placeholder="Price" required>
                    <input type="number" name="costs[${style}][${size.value}]" class="form-control" placeholder="Cost" required>
                    <input type="number" name="quantities[${style}][${size.value}]" class="form-control" placeholder="Quantity" required>
                    <input type="number" name="after_sale_prices[${style.value}][${size.value}]" class="form-control" placeholder="After Sale Price" required>
                `;

                            priceContainer.appendChild(priceInput);
                        }
                    });
                    showPriceVariations();
                } else if (styles.length > 1 || sizes.length > 1) {
                    Array.from(styles).forEach(function(style) {
                        if (style.value != null && style.value != "") {
                            Array.from(sizes).forEach(function(size) {
                                if (size.value != null && size.value != "") {
                                    const priceInput = document.createElement('div');
                                    priceInput.classList.add('d-flex', 'align-items-center', 'mt-2',
                                        'mb-1',
                                        'price-input');

                                    priceInput.innerHTML = `
                    <label class="mr-1 overflow-label">Fields for Style: "${style.value}" and Size: "${size.value}":</label>
                    <input type="number" name="prices[${style.value}][${size.value}]" class="form-control" placeholder="Price" required>
                    <input type="number" name="costs[${style.value}][${size.value}]" class="form-control" placeholder="Cost" required>
                    <input type="number" name="quantities[${style.value}][${size.value}]" class="form-control" placeholder="Quantity" required>
                    <input type="number" name="after_sale_prices[${style.value}][${size.value}]" class="form-control" placeholder="After Sale Price" required>
                `;

                                    priceContainer.appendChild(priceInput);
                                }
                            });
                        }
                    });
                    showPriceVariations();
                } else {
                    priceDiv.style.display = 'none';
                    basicPriceDiv.style.display = 'block';
                    basicCostDiv.style.display = 'block';
                    basicQuantityDiv.style.display = 'block';
                    basicAfterSaleDiv.style.display = 'block';
                    priceInput.setAttribute('required', 'true');
                    costInput.setAttribute('required', 'true');
                    quantityInput.setAttribute('required', 'true');
                    afterSaleInput.setAttribute('required', 'true');
                }
            }
        });

        document.querySelectorAll('input[name="color-name[]"]').forEach(input => {
            input.addEventListener('input', updateColorDropdowns);
        });

        function updateColorDropdowns() {
            // Select all inputs with name 'color-name[]'
            var colorHexInputs = document.querySelectorAll('input[name="color[]"]');
            var colorInputs = document.querySelectorAll('input[name="color-name[]"]');

            // Get all select elements with class 'image-color'
            var dropdowns = document.querySelectorAll('.image-color');

            // Get the values from all color input fields
            var colorHexes = Array.from(colorHexInputs).map(input => input.value);
            var colorValues = Array.from(colorInputs).map(input => input.value);

            // Update each dropdown's options with the color values
            dropdowns.forEach(dropdown => {
                // Clear the previous options
                dropdown.innerHTML = '';

                // Create and append new options
                for (let i = 0; i < colorHexes.length; i++) {
                    const option = document.createElement('option');
                    option.value = colorHexes[i];
                    option.textContent = colorValues[i];
                    dropdown.appendChild(option);
                }
            });
        }

        document.getElementById('validatedCustomFile').addEventListener('change', function(event) {
            const files = event.target.files;
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');

            // Clear previous thumbnails if any
            imagePreviewContainer.innerHTML = '';

            // Convert the FileList to an array of promises
            const fileReadPromises = Array.from(files).map((file, index) => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('image-thumbnail-wrapper', 'mr-4', 'mb-3');
                        imageWrapper.style.position = 'relative';

                        // Create image element
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.classList.add('img-thumbnail');
                        imgElement.style.width = '150px';
                        imgElement.style.height = '150px';
                        imgElement.style.objectFit = 'cover';

                        // Create dropdown menu element
                        const dropdown = document.createElement('select');
                        dropdown.name = `image_dropdown[]`;
                        dropdown.classList.add('form-control', 'mt-2', 'image-color');

                        // Append image and dropdown to wrapper
                        imageWrapper.appendChild(imgElement);
                        imageWrapper.appendChild(dropdown);

                        // Resolve with the completed image wrapper to keep track of its index
                        resolve(imageWrapper);
                    };

                    // Read the image file
                    reader.onerror = reject; // Handle errors
                    reader.readAsDataURL(file);
                });
            });

            // Use Promise.all to wait for all FileReader operations to complete
            Promise.all(fileReadPromises).then(imageWrappers => {
                // Append all image wrappers in the correct order
                imageWrappers.forEach(wrapper => {
                    imagePreviewContainer.appendChild(wrapper);
                });

                // Once all images are processed and displayed, update the color dropdowns
                updateColorDropdowns();
            }).catch(error => {
                console.error('Error processing images:', error);
            });
        });

        document.getElementById('addKeywordBtn').addEventListener('click', function() {
            const keywordInput = document.getElementById('keywordInput');
            const keywordValue = keywordInput.value.trim();

            if (keywordValue) {
                // Create a new tag element
                const tag = document.createElement('span');
                tag.classList.add('tag');
                tag.innerHTML = `${keywordValue} <span class="remove-tag">&times;</span>`;

                // Add the tag to the keywordTags container
                const keywordTags = document.getElementById('keywordTags');
                keywordTags.appendChild(tag);

                // Clear the input field
                keywordInput.value = '';

                updateKeywordsInput();

                // Add event listener to remove tag
                tag.querySelector('.remove-tag').addEventListener('click', function() {
                    tag.remove();
                    updateKeywordsInput();
                });
            }
        });

        function updateKeywordsInput() {
            const keywordTags = document.querySelectorAll('#keywordTags .tag');
            const tagsArray = Array.from(keywordTags).map(tag => tag.textContent.trim().replace('×', ''));
            document.getElementById('keywordsInput').value = tagsArray.join(',');
            console.log(document.getElementById('keywordsInput').value);
        }
    </script>
@endsection
