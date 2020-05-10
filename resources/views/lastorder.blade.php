@extends('bar')

@section('content')
<style>
.column1 {
  width: 25%;
}



.card {
    z-index: 0;
    background-color: #f5f5f0;
    padding-bottom: 20px;
    border-radius: 10px
}

.top {
    padding-top: 40px;
    padding-left: 13% !important;
    padding-right: 13% !important;
}
/* 
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 50%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar .step0:before {
    font-family: FontAwesome;
    content: "\f10c";
    color: #fff
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #C5CAE9;
    border-radius: 50%;
    margin: auto;
    padding: 0px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 12px;
    background: #C5CAE9;
    position: absolute;
    left: 0;
    top: 16px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:nth-child(2):after,
#progressbar li:nth-child(3):after {
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #651FFF
}

#progressbar li.active:before {
    font-family: FontAwesome;
    content: "\f00c"
}

.icon {
    width: 60px;
    height: 60px;
    margin-right: 15px
}

.icon-content {
    padding-bottom: 20px
} */
a{
    color:blue;
}
.details{
    margin:10px;
}
.EGP{
  margin-left:5px;
  font-size:12px;
  display:inline;
}
</style>
<div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="px-3 details">
            

                <p ><b>Created at : </b><span>{{$order->created_at->format('d/m/Y')}}</span></p>

                <p><span class="font-weight-bold">Items : </span>
                <ul>
                @foreach($order->items as $item)
        <li>{{$item->pivot->quantity}} of 
          <a href="{{route('item.show',['id' => $item->id])}}">{{$item->name}}</a></li>
        @endforeach
                    
                </ul>
                </p>

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