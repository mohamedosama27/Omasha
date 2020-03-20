@extends('bar')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      
    </tr>
  </thead>
  <tbody>
  @foreach($orders as $order)

    <tr>
      <th scope="row">{{$order->user->name}}</th>
      <td>{{$order->user->phone}}</td>
      <td>{{$order->address}}</td>
      <td>@mdo</td>
    </tr>
  @endforeach
  </tbody>
</table>
    @endsection