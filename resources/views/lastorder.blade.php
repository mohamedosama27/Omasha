@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/lastorder.css">
@if( !empty($order) )

<div class="container my-5">
    <h2 class="mb-4">Order Details</h2>

    <!-- Order Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Order Summary</h4>
        </div>
        <div class="card-body">
            <!-- Order Date -->
            <div class="mb-4">
                <strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}
            </div>

            <!-- Total Price -->
            <div class="mb-4">
                <strong>Total Price:</strong> {{ number_format($order->total_price, 2) }} EGP
            </div>

            <!-- Number of Items -->
            {{-- <div class="mb-3">
                <strong>Number of Items:</strong> {{ $order->items->count() }}
            </div> --}}

            <!-- Delivery Address -->
            <div class="mb-3">
                <strong>Delivery Address:</strong> {{ $order->address }}
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="card">
        <div class="card-header">
            <h4>Items Ordered</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr class='mb-4'>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->pivot->price, 2) }} EGP</td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>{{ number_format($item->pivot->price * $item->pivot->quantity, 2) }} EGP</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="px-3 details">

            <br>
                <p ><b>Created at : </b><span>{{$order->created_at->format('d/m/Y')}}</span></p>

                <p><span class="font-weight-bold"><b>Items : </b></span>
                <ul>
                @foreach($order->items as $item)
        <li>{{$item->pivot->quantity}} of
          <a href="{{route('item.show',['id' => $item->id])}}" class="itemsLink">{{$item->name}}</a></li>
        @endforeach

                </ul>
                </p>
                <br>

            <b>Total Price : {{$order->total_price}}</b><p class="EGP"> EGP</p>
            <br>
            <br>
            <b>Address : </b>{{$order->address}}
            <br>
            <br>

            <b>Status : </b>@if($order->status == 1) Shipped <i class="fa fa-truck  fa-flip-horizontal"></i>
            @else Wating for response <i class="fa fa-hourglass icon"></i> @endif
        </div>


    </div>
</div> --}}
@else
        <h2 class="battalion text-center" style="margin-top:10%;font-size:26px;">You didn't order yet</h2>
@endif
@endsection
