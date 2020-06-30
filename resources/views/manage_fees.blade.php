@extends('bar')

@section('content')
<link href="css/wheretobuy.css" rel="stylesheet" type="text/css" media="all" />



<form method="POST" class="form-inline text-center" action="{{route('fee.store')}}">
@csrf
    @method('PUT')
        <input class="form-control" name="name" placeholder="Enter city name">
        <input class="form-control" name="value" placeholder="Enter value">
        <button type="submit" class="btn brandcolor raleway">Add</button>
    </form>
    @foreach($fees as $fee)

<form method="POST" class="form-inline text-center" 
    action="{{route('fee.update',['id' => $fee->id])}}">
    @csrf
    @method('PUT')   
    <input class="form-control" name="name" value="{{$fee->name}}"> 
        <input class="form-control" name="value" value="{{$fee->value}}">
        <button type="submit" class="btn brandcolor raleway">Edit</button>
        <a href="{{route('fee.delete',['id' => $fee->id])}}"
            onclick="return confirm('Are you sure to delete {{$fee->name}}?')"    
            class="btn btn-danger raleway">
            Delete
        </a>
    </form>

@endforeach
@endsection