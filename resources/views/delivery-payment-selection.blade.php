@extends('layouts.app')

@section('title')
    {{ __('Delivery') }} {{ __('and') }} {{ __('Payment') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')

    <main>
        <a href="/cart">{{  __("") }}Back to cart</a>
        <h1>{{  __("Delivery") }} {{  __("and") }} {{  __("Payment") }}</h1>

        <h2>{{  __("Destination") }}</h2>
        <form action="/select-destination" method="post">
            @csrf

            <select name="destination" required>
                <option value="" disabled {{Request::cookie('destination') == false ? 'selected':''}} hidden>
                    {{  __("Select destination") }}
                </option>

                @foreach($countries as $country)
                    <option value="{{$country->country}}" {{Request::cookie('destination') == $country->country ? 'selected':''}}>
                        {{ __($country->country) }}
                    </option>
                @endforeach
            </select>

            @if (session('status'))
                <div class="alert alert-danger">{{ session('status') }}</div>
            @endif

            <br />
            <br />
            <h2>{{  __("Payment") }}</h2>

            <input type="radio" name="payment" id="card" value="card" {{ Request::cookie('payment') == "transfer" ? '' : 'checked' }}>
            <label for="card">{{  __("Card") }}</label><br>
            <input type="radio" name="payment" id="transfer" value="transfer"
                   {{ Request::cookie('payment') == "transfer" ? 'checked' : '' }}>
            <label for="transfer">{{  __("Bank transfer") }}</label><br>
        </form>

        <br />
        <h2>{{  __("Order Summary") }}</h2>
        <section id="order-summary">
            @include("layouts.partials.order-summary")
        </section>

        <a href="/contact-details">{{  __("Continue") }}</a>
    </main>

@endsection

@section('script')
    <script type="module" src="/script/cart.js"></script>
    <script type="module" src="/script/delivery-payment-selection.js"></script>
@endsection
