@extends('layouts.app')

@section('title')
    {{ __('Products') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')
    <div class="container">
        <h1>{{  __("Products") }}</h1>

        <table class="table">
            <tr>
                <td>Id</td>
                <td>{{  __("Title") }}</td>
                <td>Url</td>
                <td>Image</td>
                <td>{{  __("Colour") }}</td>
                <td>{{  __("Size") }}</td>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title_cz }}</td>
                    <td>
                        <a href="/products/{{ $product->url }}@if(count($product->colours) > 0)/{{ $product->colours[0]->colour }} @endif">
                            {{ $product->url }}
                        </a>
                    </td>
                    <td>{{ $product->images[0]->file_name }}</td>
                    <td>
                        @if(count($product->colours) > 0) {{ $product->colours[0]->colour }} @endif
                    </td>
                    <td>
                        @if(count($product->colours) > 0 && count($product->colours[0]->sizes) > 0) size @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
