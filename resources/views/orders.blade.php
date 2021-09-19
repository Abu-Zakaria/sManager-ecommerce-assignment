@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($orders as $order)
                        <div class="card">
                            <div class="card-body">
                                <p>
                                    Order #{{ $order->id }}
                                </p>
                                <p>Products:</p>
                                @php
                                    $total_price = 0;
                                @endphp
                                @foreach($order->items as $item)
                                    <li>
                                        <p>{{ $item->product->name }}</p>
                                        <p>Price: {{ $item->product->price }} x {{ $item->quantity }}</p>
                                        @php
                                            $total_price += $item->product->price * $item->quantity;
                                        @endphp
                                    </li>
                                @endforeach

                                <p><b>Total Price</b>: {{ $total_price }}</p>
                                <p><b>Status</b>: {{ ucfirst($order->status) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection