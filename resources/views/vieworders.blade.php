@extends('bar')

@section('content')
    <div class="container my-4">
        <h2 class="mb-4">All Orders</h2>

        <form action="{{ route('vieworders') }}" method="GET" class="mb-5 mt-5">
            <div class="form-group d-flex align-items-center">
                <label for="status" class="mr-3">Filter by Status:</label>
                <select name="status" id="status" class="form-control w-25">
                    <option value="">All</option>
                    <option value="Placed" {{ request('status') == 'Placed' ? 'selected' : '' }}>Placed</option>
                    <option value="Read" {{ request('status') == 'Read' ? 'selected' : '' }}>Read</option>
                    <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                <button type="submit" class="btn btn-primary ml-3">Filter</button>
            </div>
        </form>

        @foreach ($orders as $order)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <div class='d-flex align-items-center'>
                        <a href="{{ route('order.pdf', ['id' => $order->id]) }}" target="_blank">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-print"></i></button>
                        </a>
                        <h4 class="ml-2">Order Date: {{ $order->created_at->format('d M, Y') }}</h4>
                    </div>
                    <h4
                        class="@if ($order->status == 'Placed') text-warning
                        @elseif($order->status == 'Read') text-info
                        @elseif($order->status == 'Delivered') text-success @endif">
                        {{ $order->status }}</h4>
                </div>
                <div class="card-body">
                    <!-- Customer Information -->
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }} <br><br>
                        <strong>Phone:</strong> {{ $order->phone }} <br><br>
                        <strong>Email:</strong> {{ $order->email }} <br><br>
                        <strong>Address:</strong> {{ $order->address }}
                    </div>

                    <!-- Ordered Items -->
                    <div class="table-responsive">
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
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td><a
                                                href="{{ route('item.show', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                        </td>
                                        <td>{{ $item->pivot->color }}</td>
                                        <td>{{ $item->pivot->style ?? '-' }}</td>
                                        <td>{{ $item->pivot->size ?? '-' }}</td>
                                        <td>{{ $item->pivot->note ?? '-' }}</td>
                                        <td>{{ number_format((float) $item->pivot->price, 2) }} EGP</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>{{ number_format((float) $item->pivot->price * $item->pivot->quantity, 2) }}
                                            EGP
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Total -->
                    <div class="d-flex">
                        <h5><strong>Total Order Value: </strong></h5>
                        <h5 class='ml-2'><strong>{{ number_format($order->total_price, 2) }} EGP</strong></h5>
                    </div>

                    <div>
                        @if ($order->status == 'Placed')
                            <a href="{{ route('order.changestatus', ['id' => $order->id, 'status' => 'Read']) }}"> <button
                                    type='button' name='submit' class="btn btn-primary mt-4 mr-4 brandcolor">Mark as
                                    Read</button></a>
                        @endif
                        @if ($order->status == 'Read')
                            <a href="{{ route('order.changestatus', ['id' => $order->id, 'status' => 'Placed']) }}"><button
                                    type='button' name='submit' class="btn btn-secondary mt-4 mr-4 brandcolor">Mark as
                                    Unread</button></a>
                            <a href="{{ route('order.changestatus', ['id' => $order->id, 'status' => 'Delivered']) }}"><button
                                    type='button' name='submit' class="btn btn-primary mt-4">Mark as
                                    Delivered</button></a>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="my-4">
        @endforeach
    </div>
@endsection
