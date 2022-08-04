@extends('layouts.app')

@section('title')
    {{ __('Cart') }} | {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')
    <div class="container">
        <h1>Košík</h1>

        <table class="table">
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->productId }}</td>
                    <td>{{ $item->title_cz }}</td>
                    <td>{{ $item->image }}</td>
                    <td>{{ $item->quantity }} ks</td>
                    <td>{{ $item->price }} EUR</td>
                    <td>{{ $item->colour }}</td>
                    <td>{{ $item->size }}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
