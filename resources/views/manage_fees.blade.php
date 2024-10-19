@extends('bar')

@section('content')
    <link href="css/wheretobuy.css" rel="stylesheet" type="text/css" media="all" />


    <div class="container my-4 text-center">
        <h3 class="mb-5">Delivery Fees by Governorate</h3>
        <form method="POST" class="form-inline text-center mb-3" action="{{ route('fee.store') }}">
            @csrf
            @method('PUT')
            <input class="form-control mb-2" name="name" placeholder="English" required>
            <input class="form-control mb-2" name="name_ar" placeholder="Arabic" required>
            <input class="form-control mb-2" name="value" placeholder="Delivery Fees" required>
            <button type="submit" class="btn brandcolor raleway mb-2">Add</button>
        </form>
        @foreach ($fees as $fee)
            <form method="POST" class="form-inline text-center mb-4" action="{{ route('fee.update', ['id' => $fee->id]) }}">
                @csrf
                @method('PUT')
                <input class="form-control mb-2" name="name" value="{{ $fee->name }}" required>
                <input class="form-control mb-2" name="name_ar" value="{{ $fee->name_ar }}" required>
                <input class="form-control mb-2" name="value" value="{{ $fee->value }}" required>
                <button type="submit" class="btn brandcolor raleway mb-2">Edit</button>
                <a href="{{ route('fee.delete', ['id' => $fee->id]) }}"
                    onclick="return confirm('Are you sure to delete {{ $fee->name }}?')" class="btn btn-danger raleway mb-2">
                    Delete
                </a>
            </form>
        @endforeach
    </div>
@endsection
