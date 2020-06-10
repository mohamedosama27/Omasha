@extends('bar')

@section('content')
<link href="css/wheretobuy.css" rel="stylesheet" type="text/css" media="all" />


<form method="POST" class="form-inline text-center" action="{{route('contact.store')}}">
@csrf
    @method('PUT')
        <input class="form-control" name="contact" placeholder="Enter contact">
        <button type="submit" class="btn brandcolor raleway">Add</button>
    </form>
    @foreach($contacts as $contact)

<form method="POST" class="form-inline text-center" 
    action="{{route('contact.update',['id' => $contact->id])}}">
    @csrf
    @method('PUT')   
    <input class="form-control" name="contact" value="{{$contact->contact}}"> 
        <button type="submit" class="btn brandcolor raleway">Edit</button>
        <a href="{{route('contact.delete',['id' => $contact->id])}}"
            onclick="return confirm('Are you sure to delete {{$contact->contact}}?')"    
            class="btn btn-danger raleway">
            Delete
        </a>
    </form>

@endforeach

@endsection