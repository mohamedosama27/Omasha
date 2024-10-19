@extends('bar')

@section('content')

<div class="container my-4">
    <h2 class="mb-4">All Orders</h2>

    @foreach($orders as $order)
    <div class="card mb-4">
        <div class="card-header">
            <h4>Order Date: {{ $order->created_at->format('d M, Y') }}</h4>
        </div>
        <div class="card-body">
            <!-- Customer Information -->
            <div class="mb-3">
                <strong>Username:</strong> {{ $order->user->name }} <br><br>
                <strong>Phone:</strong> {{ $order->user->phone }} <br><br>
                <strong>Address:</strong> {{ $order->address }}
            </div>

            <!-- Ordered Items -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Style</th>
                        <th>Size</th>
                        <th>Note</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td><a href="{{route('item.show',['id' => $item->id])}}">{{$item->name}}</a></td>
                        <td>{{ $item->pivot->color }}</td>
                        <td>{{ $item->pivot->style }}</td>
                        <td>{{ $item->pivot->size }}</td>
                        <td>{{ $item->pivot->note }}</td>
                        <td>{{ number_format((float)$item->pivot->price, 2) }} EGP</td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>{{ number_format((float)$item->pivot->price * $item->pivot->quantity, 2) }} EGP</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Order Total -->
            <div class="d-flex">
                <h5><strong>Total Order Value: </strong></h5>
                <h5 class='ml-2'><strong>{{ number_format($order->total_price, 2) }} EGP</strong></h5>
            </div>
        </div>
    </div>
    <hr class="my-4">
    @endforeach
</div>

{{-- <table class="table" style="margin-top:100px;">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">items</th>
      <th scope="col" colspan="3">Actions</th>



    </tr>
  </thead>
  <tbody>
  @foreach($orders as $order)

    <tr>
      <th scope="row">
        <a href="{{ route('chat',['id' =>$order->user->id ]) }}">
          {{$order->user->name}}</a></th>
      <td>{{$order->user->phone}}</td>
      <td>{{$order->address}}</td>
      <td><ul>
      @foreach($order->items as $item)
        <li>{{$item->pivot->quantity}} of
          <a href="{{route('item.show',['id' => $item->id])}}">{{$item->name}}</a></li>
        @endforeach

      </ul>
      </td>
      @if($order->status==NULL)
      <td><a id="accept" href="{{route('order.accept',['id' => $order->id])}}" target="_blank" class="acceptOrder">
      <i class="fa fa-2x fa-check-circle" style="color:green;"></i></a></td>

      <td><a href="{{route('order.reject',['id' => $order->id])}}">
      <i class="fa fa-2x fa-times-circle" style="color:red"></i></a></td>
      @endif

      <td><a href="{{route('order.invoice',['id' => $order->id])}}">
      <i class="fa fa-2x fa-print"></i></a></td>

      <td><a href="{{route('order.delete',['id' => $order->id])}}" onclick="return confirm('Are you sure to delete {{$order->user->name}} order?')">
      <i class="fa fa-2x fa-trash"></i></a></td>

    </tr>
  @endforeach
  </tbody>
</table> --}}

    @endsection
