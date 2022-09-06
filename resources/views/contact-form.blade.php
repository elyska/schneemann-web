@extends('layouts.app')

@section('title')
    {{ __('Contact Details') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')

    <main>
        <article>
            <a href="/products">{{  __("Continue shopping") }}</a>

            <form action="/contact-form" method="POST">
                @csrf
                <fieldset>

                    <legend><h2>{{  __("Delivery Details") }}</h2></legend>

                    <p>
                        <label for="name">{{  __("Name") }} *</label><br />
                        <input type="text" name="name" maxlength="255" required />
                    </p>

                    <p>
                        <label for="email">{{  __("E-mail") }} *</label><br />
                        <input type="email" name="email" maxlength="60" required/>
                    </p>

                    <p>
                        <label for="phone">{{  __("Phone Number with Country Code") }} *</label><br />
                        <input type="tel" name="phone" maxlength="20" required/>
                    </p>

                    <p>
                        <label for="delAddressLine1">{{  __("Address Line") }} 1 *</label><br />
                        <input type="text" name="delAddressLine1" maxlength="80" required />
                    </p>

                    <p>
                        <label for="delAddressLine2">{{  __("Address Line") }} 2</label><br />
                        <input type="text" name="delAddressLine2" maxlength="80"/>
                    </p>

                    <p>
                        <label for="delAddressLine3">{{  __("Address Line") }} 3</label><br />
                        <input type="text" name="delAddressLine3" maxlength="80"/>
                    </p>

                    <p>
                        <label for="delPostcode">{{  __("Postcode") }} *</label><br />
                        <input type="text" name="delPostcode" maxlength="15" required />
                    </p>
                    <p>
                        <label for="delCity">{{  __("City") }} *</label><br />
                        <input type="text" name="delCity" maxlength="80" required />
                    </p>

                    <p>
                        <label for="delCountry">{{  __("Country") }} *</label><br />
                        <input name="delCountry" value="{{ __($destination) }}" readonly />
                    </p>

                </fieldset>

                <fieldset>

                    <input type="checkbox" name="sameBilAddress" id="sameBilAddress" checked />
                    <label for="sameBilAddress">{{  __("Billing details are the same as delivery details") }}</label>

                </fieldset>

                <fieldset>

                    <legend><h2>{{  __("Billing Details") }}</h2></legend>

                    <p>
                        <label for="bilAddressLine1">{{  __("Address Line") }} 1 *</label><br />
                        <input type="text" name="bilAddressLine1" maxlength="80"/>
                    </p>
                    <p>
                        <label for="bilAddressLine2">{{  __("Address Line") }} 2</label><br />
                        <input type="text" name="bilAddressLine2" maxlength="80"/>
                    </p>
                    <p>
                        <label for="bilAddressLine3">{{  __("Address Line") }} 3</label><br />
                        <input type="text" name="bilAddressLine3" maxlength="80"/>
                    </p>

                    <p>
                        <label for="bilPostcode">{{  __("Postcode") }} *</label><br />
                        <input type="text" name="bilPostcode" maxlength="15"/>
                    </p>
                    <p>
                        <label for="bilCity">{{  __("City") }} *</label><br />
                        <input type="text" name="bilCity" maxlength="80"/>
                    </p>

                    <p>
                        <label for="bilCountry">{{  __("Country") }} *</label><br />
                        <input type="text" name="bilCountry" maxlength="60"/>
                    </p>

                </fieldset>

                <p>
                    <input type="checkbox" name="agreement" id="agreement" required />
                    <label for="agreement">{{  __("I agree with the") }} <a href="/terms-conditions" target="_blank">{{  __("terms and conditions") }}</a>.</label>
                </p>
                <input type="submit" value="{{  __("Place Order") }}" />

            </form>
        </article>

    </main>

@endsection

@section('script')
    <script type="module" src="/script/cart.js"></script>
    <script type="module" src="/script/contact-form.js"></script>
@endsection
