<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        h2,
        h4 {
            text-align: center;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 250px;
        }

        .customer-details {
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="{{ asset('images/Logo-2.jpeg') }}" alt="Logo">
    </div>
    <h2>Order Details</h2>
    <h4>Order Date: {{ $order->created_at->format('d M, Y') }}</h4>
    <h4>Status: {{ $order->status }}</h4>

    <div class="customer-details">
        <h5>Customer Name: {{ $order->first_name }} {{ $order->last_name }}</h5>
        <h5>Email: {{ $order->email }}</h5>
        <h5>Phone: {{ $order->phone }}</h5>
        <h5>Address: {{ $order->address }}</h5>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Image</th>
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
            @foreach ($order->items as $item)
                <tr>
                    <td>
                        <img src="{{ asset('images/' . $item->images->first()->name) }}" alt="{{ $item->name }}"
                            class="product-img">
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->color }}</td>
                    <td>{{ $item->pivot->style ?? '-' }}</td>
                    <td>{{ $item->pivot->size ?? '-' }}</td>
                    <td>{{ $item->pivot->note ?? '-' }}</td>
                    <td>{{ number_format($item->pivot->price, 2) }} EGP</td>
                    <td>{{ $item->pivot->quantity }}</td>
                    <td>{{ number_format($item->pivot->price * $item->pivot->quantity, 2) }} EGP</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Order Value: {{ number_format($order->total_price, 2) }} EGP</h4>
</body>

</html>
