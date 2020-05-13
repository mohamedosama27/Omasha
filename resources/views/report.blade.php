@extends('bar')

@section('content')
<style>
.column1 {
  width: 25%;
}



.card {
    z-index: 0;
    background-color: #FBFBFB;
    padding-bottom: 20px;
    border-radius: 10px
}

a{
    color:blue;
}
.details{
    margin:10px;
}
*{
    font-size:20px;
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
            
        <form method="GET" action="{{route('report')}}" enctype="multipart/form-data">

            <div class="form-group row">
                <label class="col-lg-3  col-4  col-form-label">From</label>
                <div class="col-lg-3 col-7">
                    <input class="form-control" name="from"type="date" value="{{$from}}">
                </div>
            </div>  
            <div class="form-group row">
                <label class="col-lg-3 col-4 col-xs-6  col-form-label">To</label>
                <div class="col-lg-3 col-7">
                    <input class="form-control" name="to" type="date" value="{{$to}}" >
                </div>
            </div>  
            <button type="submit" class="btn btn-primary offset-7">Submit</button> 
        </form>
        <hr style="border: 1px solid black;">
                <p><span class="font-weight-bold">Sold Items : </span>
                <ul>
                @foreach($items as $item)
        <li>{{$item ->Quantity}} of 
          <a href="{{route('item.show',['id' => $item->item->id])}}">{{$item->item->name}}</a></li>
        @endforeach
                    
                </ul>
                </p><br>
       <b>Total price : </b>{{$totalprice}}<p class="EGP"> EGP</p><br>
        <b> Total cost : </b>{{$totalcost}}<p class="EGP"> EGP</p><br>
        <b>Total profit : </b>{{$totalprice - $totalcost}}<p class="EGP"> EGP</p><br>
        

         </div>

    </div>
</div>
@endsection