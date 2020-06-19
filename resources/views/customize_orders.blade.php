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
      <th scope="col">Order</th>

      <th scope="col" colspan="3">Actions</th>
      

      
    </tr>
  </thead>
  <tbody>
  @foreach($customize_orders as $customize_order)

    <tr>
    <td><ul>
                
                

                <li class="distributorInfo">
                    <b>Contact Name : </b>{{$customize_order->contact_name}} </li>

                <li class="distributorInfo">
                    <b>Email: </b>{{$customize_order->email}} </li>

                <li class="distributorInfo">
                    <b>Phone : </b>{{$customize_order->phone}} </li>

                <li class="distributorInfo">
                    <b>Category : </b>{{$customize_order->category}} </li>

                <li class="distributorInfo">
                    <b>Quantity : </b>{{$customize_order->quantity}} </li>

                



        </ul>
        </td>
      <th scope="row">
     

      <!-- <td><a id="accept" href="" target="_blank" class="acceptOrder">
      <i class="fa fa-2x fa-check-circle" style="color:green;"></i></a></td>

      <td><a href="">
      <i class="fa fa-2x fa-times-circle" style="color:red"></i></a></td> -->
     
      <td><a href="{{route('customize.delete',['id' => $customize_order->id])}}" 
        onclick="return confirm('Are you sure to delete?')">
      <i class="fa fa-2x fa-trash"></i></a></td>

    </tr>
  @endforeach
  </tbody>
</table>
<script>

</script>
    @endsection