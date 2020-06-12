@extends('bar')

@section('content')
<style>
  .send-mails-button{
    width:40%;
    font-size:16px;
    font-weight:bold;
    color:white;
    margin-right:10px;
  }

</style>
<br>
<button type="button" class="btn brandcolor pull-right send-mails-button" data-toggle="modal"
        data-target="#send_mails">Send mails</button>
        @include('errormessage')
        @include('send-mails')

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

    @endsection