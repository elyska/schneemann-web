
<p>
    Dear Customer,

    <br />
    <br />
    thank you for your order. You can find the order details below.
</p>

<h1>Your Order</h1>
<table style="width: 100%">
@foreach($products as $product)
    <tr>
        <td style="border-top: 1px solid #edeff2">
            {{ $product->title_cz }} @if($product->colour) <br /> @endif
            {{ $product->colour }} @if($product->size) <br /> @endif
            {{ $product->size }} <br />
        </td>
        <td style="border-top: 1px solid #edeff2">
            {{ $product->quantity }} ks
        </td>
        <td style="border-top: 1px solid #edeff2">
            {{ $product->price * $product->quantity }} EUR
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="2" style="border-top: 1px solid #edeff2">
            Subtotal
        </td>
        <td style="border-top: 1px solid #edeff2">
            {{ $subtotalEUR }} EUR
        </td>
    </tr>
    <tr>
        <td colspan="2">
            Shipping
        </td>
        <td>
            {{ $postageEUR }} EUR
        </td>
    </tr>
    <tr>
        <td colspan="2">
            Total
        </td>
        <td>
            {{ $subtotalEUR + $postageEUR }} EUR
        </td>
    </tr>
</table>

<br />

<p>
    Kind regards, <br />
    {{ config('app.name') }}
</p>

