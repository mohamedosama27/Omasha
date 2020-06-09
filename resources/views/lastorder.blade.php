@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/lastorder.css">
@if( !empty($order) )

<div class="container px-1 px-md-4 py-5 mx-auto">
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
</div>
@else
        <h2 class="battalion text-center" style="margin-top:10%;font-size:26px;">You didn't order yet</h2>
@endif
@endsection