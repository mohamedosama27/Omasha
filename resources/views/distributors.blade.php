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
      <th scope="col">Distributor</th>

      <th scope="col" colspan="3">Actions</th>
      

      
    </tr>
  </thead>
  <tbody>
  @foreach($distributors as $distributor)

    <tr>
    <td><ul>
                
                <li class="distributorInfo">
                    <b>Business Name : </b>{{$distributor->business_name}} </li>

                <li class="distributorInfo">
                    <b>Contact Name : </b>{{$distributor->contact_name}} </li>

                <li class="distributorInfo">
                    <b>Email: </b>{{$distributor->email}} </li>

                <li class="distributorInfo">
                    <b>Phone : </b>{{$distributor->phone}} </li>

                <li class="distributorInfo">
                    <b>Address : </b>{{$distributor->address}} </li>

                <li class="distributorInfo">
                    <b>City : </b>{{$distributor->city}} </li>

                <li class="distributorInfo">
                    <b>Social Media : </b>{{$distributor->social_media}} </li>



        </ul>
        </td>
      <th scope="row">
     

      <td><a id="accept" href="" target="_blank" class="acceptOrder">
      <i class="fa fa-2x fa-check-circle" style="color:green;"></i></a></td>

      <td><a href="">
      <i class="fa fa-2x fa-times-circle" style="color:red"></i></a></td>
     
      <td><a href="{{route('distributor.delete',['id' => $distributor->id])}}" onclick="return confirm('Are you sure to delete?')">
      <i class="fa fa-2x fa-trash"></i></a></td>

    </tr>
  @endforeach
  </tbody>
</table>
<script>

</script>
    @endsection