@extends('layouts.app')

@section('title')
    {{ __('Delivery') }} {{ __('and') }} {{ __('Payment') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')

    <main>
        <a href="/cart">Back to cart</a>
        <h1>Delivery and Payment</h1>

        <h2>Destination</h2>
        <form action="/select-destination" method="post">
            @csrf

            <select name="destination" required>
                <option value="" disabled {{Request::cookie('destination') == false ? 'selected':''}} hidden>
                    Select destination
                </option>

                @foreach($countries as $country)
                    <option value="{{$country->country}}" {{Request::cookie('destination') == $country->country ? 'selected':''}}>
                        {{$country->country}}
                    </option>
                @endforeach
            </select>

            @if (session('status'))
                <div class="alert alert-danger">{{ session('status') }}</div>
            @endif

            <br />
            <br />
            <h2>Payment</h2>

            <input type="radio" name="payment" id="card" value="card" {{ Request::cookie('payment') == "transfer" ? '' : 'checked' }}>
            <label for="card">Card</label><br>
            <input type="radio" name="payment" id="transfer" value="transfer"
                   {{ Request::cookie('payment') == "transfer" ? 'checked' : '' }}>
            <label for="transfer">Bank transfer</label><br>
        </form>

        <br />
        <h2>Order Summary</h2>
        <section id="order-summary">
            @include("layouts.partials.order-summary")
        </section>

        <a href="/contact-details">Continue</a>
    </main>

@endsection

@section('script')
    <script type="module" src="/script/cart.js"></script>
    <script type="module" src="/script/delivery-payment-selection.js"></script>
@endsection
