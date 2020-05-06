<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<style>
.total{
    margin-left:60%;
    width:40%;
}
</style>
<body>

<div class="container">
<p><b>Date : </b>{{$order->created_at}}</p>
<p><b>Name : </b>{{$order->user->name}}</p>
<p><b>Email : </b>{{$order->user->email}}</p>
<p><b>Phone : </b>{{$order->user->phone}}</p>
<p><b>Address : </b>{{$order->address}}</p>

  <table class="table table-striped" border="1" cellspacing="0" cellpadding="1">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
      </tr>
    </thead>
    <tbody>
    @foreach($order->items as $item)
      <tr>
     
       <td>{{$item->name}}</td>
        <td >{{$item->price}}</td>
        <td>{{$item->pivot->quantity}}</td>
        <td>{{$item->price * $item->pivot->quantity}}</td>
      </tr>
      @endforeach

    
    </tbody>
  </table>
  <br>
  <br>

  <div class="container total">
  <table class="table" border="1" cellspacing="0" cellpadding="1">

    <tbody>
      <tr>
        <td>Subtotal</td>
        <td>{{$order->total_price - 10}}</td>
      </tr>
      <tr>
        <td>Delivery</td>
        <td>10</td>
      </tr>
      <tr>
        <td>Total </td>
        <td>{{$order->total_price}}</td>
      </tr>
    </tbody>
  </table>
  </div>
</div>


</body>
</html>
