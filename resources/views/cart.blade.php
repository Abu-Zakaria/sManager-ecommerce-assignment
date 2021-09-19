@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products in your cart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/cart">
                        @csrf
                        @method("PATCH")
                        @if(count($products))
                            @foreach($products as $key => $product)
                                <div class="card">
                                    <div class="card-body">
                                        <li class="cart-product-item">
                                            <p>{{ $product->name }}</p>
                                            <label>Quantity: </label> <input type="text" name="data[cart-quantity-product-{{ $product->id }}]" value="{{ $cart_quantities[$key] }}">
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No product in cart. Go to <a href="/">Home</a> and add some!</p>
                        @endif

                        @if(count($products))
                            <button class="btn btn-primary float-right">Update</button>
                            <a href="/checkout">
                                <button class="btn btn-warning float-right" type="button">Checkout</button>
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
