@extends('bar')

@auth
    @if (Auth::user()->type == 1)
        @include('addpromocode')
    @endif
@endauth

@section('content')
    <div class="container">
        <h3 class="py-4">Promo Codes</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col" colspan='2'>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promoCodes as $promoCode)
                    <tr>
                        <form method="POST" action="{{ route('promocode.update', ['id' => $promoCode->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="Text" class="form-control" Name="name" value ="{{ $promoCode->code }}"
                                    required>
                            </td>
                            <td>
                                <select class="form-control type-select" name="type" id="type-{{ $promoCode->id }}" data-id="{{ $promoCode->id }}">
                                    <option value="percentage" {{ $promoCode->type == 'percentage' ? 'selected' : '' }}>
                                        Percentage
                                    </option>
                                    <option value="amount" {{ $promoCode->type == 'amount' ? 'selected' : '' }}>
                                        Amount
                                    </option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" id="amount-{{ $promoCode->id }}" name="amount"
                                    value="{{ $promoCode->amount }}" placeholder="Amount" min="1" style="display: {{ $promoCode->type == 'amount' ? 'block' : 'none' }};" {{ $promoCode->type == 'percentage' ? 'disabled' : '' }}>
                                <input type="number" class="form-control" id="percentage-{{ $promoCode->id }}" name="percentage"
                                    value="{{ $promoCode->amount }}" placeholder="Amount" min="1" max="100" style="display: {{ $promoCode->type == 'percentage' ? 'block' : 'none' }};" {{ $promoCode->type == 'amount' ? 'disabled' : '' }}>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ $promoCode->start_date }}" required>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="end_date"
                                    value="{{ $promoCode->end_date }}" required>
                            </td>
                            <td>
                                <button type="submit" name="submit" class="btn btn-primary mb-2">Save</button>
                        </form>
                        <a href="{{ route('promocode.delete', ['id' => $promoCode->id]) }}">
                            <button class="btn btn-danger mb-2">Delete</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5 ml-2">
            <button type="button" class="btn btn-primary brandcolor" data-toggle="modal" data-target="#addpromocode">
                <i class="fa fa-plus actionicons"></i> Add Promocode
            </button>
        </div>
    </div>
    <script>
        document.querySelectorAll('.type-select').forEach(function(dropdown) {
        dropdown.addEventListener('change', function() {
            var promoCodeId = this.getAttribute('data-id');
            var selectedType = this.value;
            var amountField = document.getElementById('amount-' + promoCodeId);
            var percentageField = document.getElementById('percentage-' + promoCodeId);

            if (selectedType === 'amount') {
                amountField.style.display = 'block';
                amountField.disabled = false;
                percentageField.style.display = 'none';
                percentageField.disabled = true;
            } else if (selectedType === 'percentage') {
                amountField.style.display = 'none';
                amountField.disabled = true;
                percentageField.style.display = 'block';
                percentageField.disabled = false;
            }
        });
    });

    // Initial setup on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.type-select').forEach(function(dropdown) {
            var promoCodeId = dropdown.getAttribute('data-id');
            var selectedType = dropdown.value;
            var amountField = document.getElementById('amount-' + promoCodeId);
            var percentageField = document.getElementById('percentage-' + promoCodeId);

            if (selectedType === 'amount') {
                amountField.style.display = 'block';
                amountField.disabled = false;
                percentageField.style.display = 'none';
                percentageField.disabled = true;
            } else if (selectedType === 'percentage') {
                amountField.style.display = 'none';
                amountField.disabled = true;
                percentageField.style.display = 'block';
                percentageField.disabled = false;
            }
        });
    });
    </script>
@endsection
