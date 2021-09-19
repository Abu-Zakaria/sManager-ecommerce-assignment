@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/checkout">
                        @csrf
                        <label><b>Select a payment method</b></label>
                        <br>
                        <label>
                            <input type="radio" name="payment_method" value="cod" id="cod_radio"> Cash On Delivery
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="payment_method" value="online_payment" id="online_payment_radio"> Online Payment
                        </label>

                        <div id="cod_details" style="display: none;">
                            <label>
                                District
                                <input type="text" name="district" class="form-control">
                                @if($errors->has('district'))
                                    <p class="text-danger">{{ $errors->first('district') }}</p>
                                @endif
                            </label>
                            <label>
                                Division
                                <input type="text" name="division" class="form-control">
                                @if($errors->has('division'))
                                    <p class="text-danger">{{ $errors->first('division') }}</p>
                                @endif
                            </label>
                            <label>
                                Address
                                <input type="text" name="address" class="form-control">
                                @if($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </label>

                            <button class="btn btn-primary">Submit</button>
                        </div>
                        <div style="display: none;" id="online_payment_details">
                            Not implemented
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        setTimeout(function(){
            console.log('asd');
            var cod_details = document.getElementById("cod_details");
            var online_payment_details = document.getElementById("online_payment_details");

            var cod_radio = document.getElementById('cod_radio');
            var online_payment_radio = document.getElementById('online_payment_radio');

            cod_radio.addEventListener('change', function(e)
                {
                    cod_details.style.display = "block";
                    online_payment_details.style.display = 'none';
                });
            online_payment_radio.addEventListener('change', function(e)
                {
                    cod_details.style.display = "none";
                    online_payment_details.style.display = "block";
                })
        }, 1000)
    </script>
@endsection