@extends('layouts.app')

@section('title')
    {{ __('Cart') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')

    <main>
        <a href="/products">Continue shopping</a>

        <h1>Cart</h1>

        @if(count($cartItems) == 0)
            <p>Cart is empty.</p>
        @else
            <table class="table">
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->productId }}</td>
                        <td>{{ $item->image }}</td>
                        <td>
                            <a href="/products/{{ $item->url }}/{{ $item->colour }}">
                                {{-- Show title according to the language --}}
                                @if(App::isLocale('cs'))
                                    {{ $item->title_cz }}
                                @else
                                    {{ $item->title_en }}
                                @endif
                            </a>
                        </td>
                        <td>
                            <form action="/change-quantity" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $item->productId }}">
                                <input type="hidden" name="colour" value="{{ $item->colour }}">
                                <input type="hidden" name="size" value="{{ $item->size }}">

                                <input type="number" name="quantity" min="1" value="{{ $item->quantity }}">
                            </form>
                        </td>
                        {{-- Show currency according to the language --}}
                        @if(App::isLocale('cs'))
                            <td class="product-price">{{ App\Classes\CurrencyConversion::EURtoCZK($item->price) }} CZK</td>
                            <td>
                                <span class="product-total">
                                    {{ App\Classes\CurrencyConversion::EURtoCZK($item->price) * $item->quantity }}
                                </span> CZK
                            </td>
                        @else
                            <td class="product-price">{{ $item->price }} EUR</td>
                            <td><span class="product-total">{{ $item->price * $item->quantity }}</span> EUR</td>
                        @endif

                        <td>{{ $item->colour }}</td>
                        <td>{{ $item->size }}</td>
                        <td>
                            <form action="/remove-from-cart" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $item->productId }}">
                                <input type="hidden" name="colour" value="{{ $item->colour }}">
                                <input type="hidden" name="size" value="{{ $item->size }}">
                                <button type="submit">Remove from cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            <a href="{{ route('deliveryPayment') }}">Continue</a>

        @endif

    </main>

@endsection

@section('script')
    <script type="module" src="/script/cart.js"></script>
@endsection
