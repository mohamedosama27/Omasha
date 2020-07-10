@extends('bar')

@section('content')
<link href="css/wheretobuy.css" rel="stylesheet" type="text/css" media="all" />



<form method="POST" class="form-inline text-center" action="{{route('Zone.store')}}">
@csrf
    @method('PUT')
        <input class="form-control" name="name" placeholder="Enter city name">
        <button type="submit" class="btn brandcolor raleway">Add</button>
    </form>
    @foreach($zones as $zone)

<form method="POST" class="form-inline text-center" 
    action="{{route('Zone.update',['id' => $zone->id])}}">
    @csrf
    @method('PUT')   
    <input class="form-control" name="name" value="{{$zone->name}}"> 
        <button type="submit" class="btn brandcolor raleway">Edit</button>
        <a href="{{route('Zone.delete',['id' => $zone->id])}}"
            onclick="return confirm('Are you sure to delete {{$zone->name}}?')"    
            class="btn btn-danger raleway">
            Delete
        </a>
    </form>

@endforeach
@endsection