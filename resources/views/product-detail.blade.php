@extends('layouts.app')

@section('title')
    {{ __('Products') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')
    <div class="container">
        {{ $product->id }}
        <h1>{{ $product->title_cz }}</h1>
        {{-- ******************************************************* --}}
        @if(count($product->colours) == 0)
            Product images
            <ul>
                @foreach($product->images as $image)
                    <li>{{ $image->file_name }}</li>
                @endforeach
            </ul>

        {{-- ******************************************************* --}}
        @else
            Colour Images
            <ul>

                @foreach($product->colours as $col)
                    @if($col->colour == $colour)
                        @foreach($col->images as $image)
                            <li>{{ $image->file_name }}</li>
                        @endforeach
                    @endif
                @endforeach


            </ul>

            Other colour variants
            <ul>
                @foreach($product->colours as $colour)
                    <li>
                        <a href="/products/{{ $product->url }}/{{ $colour->colour }}">
                            @foreach($colour->images as $image)
                                @if($image->main)
                                    {{ $image->file_name }}
                                @endif
                            @endforeach
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif





        <p>{{ $product->price }} EUR</p>
        <p>{{ $product->description_cz }}</p>
    </div>

@endsection
