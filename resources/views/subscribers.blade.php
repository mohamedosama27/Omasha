@extends('bar')

@section('content')
<style>
    .distributorInfo{
        max-width:60%;
        word-break: break-all;

    }
    </style>
<table class="table" style="margin-top:100px;">
  <thead>
    <tr>
      <th scope="col">Subscriber</th>

      <th scope="col" colspan="3">Actions</th>
      

      
    </tr>
  </thead>
  <tbody>
  @foreach($subscribers as $subscriber)

    <tr>
    <td>{{$subscriber->email}}</td>

      <th scope="row">
      
      <td><a href="{{route('subscriber.delete',['id' => $subscriber->id])}}" onclick="return confirm('Are you sure to delete?')">
      <i class="fa fa-2x fa-trash"></i></a></td>

    </tr>
  @endforeach
  </tbody>
</table>
<script>

</script>
    @endsection