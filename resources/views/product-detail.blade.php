@extends('layouts.app')

@section('title')
    {{ __('Products') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')
    <div class="container">
        {{ $product->id }}

        {{-- Show title according to the language --}}
        @if(App::isLocale('cs'))
            <h1>{{ $product->title_cz }}</h1>
        @else
            <h1>{{ $product->title_en }}</h1>
        @endif

        {{-- ********* Product does not have colour variants ******* --}}
        @if(count($product->colours) == 0)
            Product images
            <ul>
                @foreach($product->images as $image)
                    <li>{{ $image->file_name }}</li>
                @endforeach
            </ul>

        {{-- ************** Product has colour variants ************ --}}
        @else
            Colour Images
            <ul>
                @foreach($product->colours[0]->images as $image)
                    <li>{{ $image->file_name }}</li>
                @endforeach
            </ul>

            {{-- Product has sizes --}}
            @if(count($product->colours[0]->sizes) > 0)
                Sizes
                <ul>
                    @foreach($product->colours[0]->sizes as $size)
                        <li>{{ $size->size }}</li>
                    @endforeach
                </ul>
            @endif

            Other colour variants
            <ul>
                @foreach($otherColours->colours as $colourVariant)

                    <li  @if($colourVariant->colour == $colour) style="color: red" @endif>
                        {{ $colourVariant->colour }}
                        <a href="/products/{{ $product->url }}/{{ $colourVariant->colour }}">
                            {{ $colourVariant->images[0]->file_name }}
                        </a>
                    </li>
                @endforeach
            </ul>

        @endif

        {{-- Show currency and description according to the language --}}
        @if(App::isLocale('cs'))
            <p>{{ App\Classes\CurrencyConversion::EURtoCZK($product->price) }} CZK</p>
            <p>{{ $product->description_cz }}</p>
        @else
            <p>{{ $product->price }} EUR</p>
            <p>{{ $product->description_en }}</p>
        @endif

        <form action="/add-to-cart" method="post">
            @csrf

            <input type="hidden" name="product-id" value="{{ $product->id }}">

            {{-- Save colour, if colours are available --}}
            @if(count($product->colours) > 0)
                <input type="hidden" name="colour" value="{{ $product->colours[0]->colour }}">

                {{-- Select size, if sizes are available --}}
                @if(count($product->colours[0]->sizes) > 0)
                    <p>
                        <label for="size">{{  __("Select size") }}</label>
                        <select name="size">
                            @foreach($product->colours[0]->sizes as $size)
                                <option value="{{ $size->size }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                    </p>
                @endif

            @endif

            <p>
                <label for="quantity">{{  __("Quantity") }}</label>
                <input type="number" name="quantity" value="1" min="1">
            </p>

            <button type="submit">{{  __("Add to cart") }}</button>
        </form>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

@endsection
