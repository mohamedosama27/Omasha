@extends('bar')

@section('content')
<link rel="stylesheet" href="/css/lastorder.css">

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
 <!-- Add class 'active' to progress -->
        <!-- <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li class="active step0"></li>
                    
                    <li class="step0 @if($order->status == 1) active @endif"></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-between top ">
            <div class="row d-flex icon-content column1"> 
            <i class="fa fa-4x fa-hourglass icon"></i>
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Wating</p>
                </div>
            </div>
            <div class="row d-flex icon-content column1"> 
            <i class="fa fa-4x fa-truck icon fa-flip-horizontal"></i>

                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Shipped</p>
                </div>
            </div>
          
        </div> -->
    </div>
</div>
@endsection