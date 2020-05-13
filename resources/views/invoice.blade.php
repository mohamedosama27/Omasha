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
    margin-left:80%;
    width:20%;
}
</style>
<body>
Date :{{$order->created_at}}<br>
Name : {{$order->user->name}}<br>
Email : {{$order->user->email}}<br>
Phone : {{$order->user->phone}}<br>
Address : {{$order->address}}<br><br>

  <table border="1" CELLPADDING=3 CELLSPACING=1>
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
      <tr>
      <td colspan="4"></td>

      </tr>
      <tr>
      <td colspan="2"></td>
        <td>Subtotal</td>
        <td>{{$order->total_price - 10}}</td>
      </tr>
      <tr>
      <td colspan="2"></td>

        <td>Delivery</td>
        <td>10</td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td>Total </td>
        <td>{{$order->total_price}}</td>
      </tr>

    </tbody>
  </table>



</body>
</html>
