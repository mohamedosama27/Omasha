@extends('bar')

@section('content')
<link href="css/wheretobuy.css" rel="stylesheet" type="text/css" media="all" />


@if(Auth::check() && Auth::user()->type == 1)

<form method="POST" class="form-inline text-center" action="{{route('location.store')}}">
@csrf
    @method('PUT')
        <input class="form-control" name="city" placeholder="Enter city name">
        <input class="form-control" name="address" placeholder="Enter full address">
        <button type="submit" class="btn brandcolor raleway">Add</button>
    </form>
    @foreach($locations as $location)

<form method="POST" class="form-inline text-center" 
    action="{{route('location.update',['id' => $location->id])}}">
    @csrf
    @method('PUT')   
    <input class="form-control" name="city" value="{{$location->city}}"> 
        <input class="form-control" name="address" value="{{$location->address}}">
        <button type="submit" class="btn brandcolor raleway">Edit</button>
        <a href="{{route('location.delete',['id' => $location->id])}}"
            onclick="return confirm('Are you sure to delete {{$location->city}}?')"    
            class="btn btn-danger raleway">
            Delete
        </a>
    </form>

@endforeach
@else
@foreach($locations as $location)
<div class="city center-block">
<h3 class="raleway text-center">{{$location->city}}</h3>
</div>
<p class="raleway text-center address">{{$location->address}}</p>
@endforeach
@endif
@endsection