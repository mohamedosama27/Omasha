@extends('bar')

@section('content')
    <link rel="stylesheet" href="/css/lastorder.css">
    @if (!empty($orders))
        <div class="container my-4 text-align-right">
            <h2 class="mb-4">{{ __('messages.all_orders') }}</h2>

            @foreach ($orders as $order)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('messages.order_date') }}:
                            {{ app()->getLocale() == 'en' ? $order->created_at->format('d M, Y') : $order->created_at->locale('ar')->translatedFormat('d M, Y') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Customer Information -->
                        <div class="mb-3">
                            <strong>{{ __('messages.address') }}:</strong> {{ $order->address }}
                        </div>

                        <!-- Ordered Items -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.color') }}</th>
                                        <th>{{ __('messages.style') }}</th>
                                        <th>{{ __('messages.size') }}</th>
                                        <th>{{ __('messages.note') }}</th>
                                        <th>{{ __('messages.unit_price') }}</th>
                                        <th>{{ __('messages.quantity') }}</th>
                                        <th>{{ __('messages.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td><a
                                                    href="{{ route('item.show', ['id' => $item->id]) }}">{{ app()->getLocale() == 'en' ? $item->name : $item->name_ar }}</a>
                                            </td>
                                            <td>{{ app()->getLocale() == 'en' ? $item->pivot->color : $item->pivot->color_ar }}
                                            </td>
                                            <td>{{ app()->getLocale() == 'en' ? $item->pivot->style ?? '-' : $item->pivot->style_ar ?? '-' }}
                                            </td>
                                            <td>{{ $item->pivot->size ?? '-' }}</td>
                                            <td>{{ $item->pivot->note ?? '-' }}</td>
                                            <td>{{ number_format((float) $item->pivot->price, 2) }}
                                                {{ __('messages.egp') }}</td>
                                            <td>{{ $item->pivot->quantity }}</td>
                                            <td>{{ number_format((float) $item->pivot->price * $item->pivot->quantity, 2) }}
                                                {{ __('messages.egp') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Order Total -->
                        <div class="d-flex">
                            <h5><strong>{{ __('messages.total_order_value') }}:&nbsp;</strong></h5>
                            <h5 class='ml-2'><strong>{{ number_format($order->total_price, 2) }}
                                    {{ __('messages.egp') }}</strong></h5>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
            @endforeach
        </div>
    @else
        <h2 class="battalion text-center" style="margin-top:10%;font-size:26px;">{{ __('messages.no_orders') }}</h2>
    @endif
@endsection
