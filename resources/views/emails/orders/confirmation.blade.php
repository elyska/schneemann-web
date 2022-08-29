@component('mail::message')
Dear Customer,

thank you for your order. You can find the order details below.

@component('mail::table')
    | Your Order    |               |          |
    | :------------ |---------------| ---------|
    @foreach($products as $product)
    | {{ $product->title_cz }} | {{ $product->quantity }} pcs | {{ $product->price * $product->quantity }} EUR |
    @endforeach
    | Subtotal      |       | {{ $subtotalEUR }} EUR |
    |  Shipping     |       | {{ $postageEUR }} EUR |
    |    Total      |       | {{ $subtotalEUR + $postageEUR }} EUR |
@endcomponent


{!! '<table style="width: 100%">' !!}
@foreach($products as $product)
    {!! "<tr>" !!}

    {!! "<td>" !!}
    {{ $product->title_cz }}
    {!! "</td>" !!}
    {!! "<td>" !!}
    {{ $product->quantity }} ks
    {!! "</td>" !!}
    {!! "<td>" !!}
    {{ $product->price * $product->quantity }} EUR
    {!! "</td>" !!}

    {!! "</tr>" !!}
@endforeach
{!! "</table>" !!}

{!! '<table style="width: 100%">' !!}
@foreach($products as $product)
    {!! '<tr>' !!}
        {!! '<td style="border-top: 1px solid #edeff2">' !!}
            Total
        {!! "</td>" !!}
        {!! '<td style="border-top: 1px solid #edeff2">' !!}
            {{ $subtotalEUR + $postageEUR }} EUR
        {!! "</td>" !!}
    {!! "</tr>" !!}
@endforeach
{!! "</table>" !!}

<br />
<br />

Kind regards, <br />
{{ config('app.name') }}
@endcomponent
