
<table class="table">
    @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->productId }}</td>
            <td>{{ $item->image }}</td>
            <td>{{ $item->title_cz }}</td>
            <td>
                {{ $item->quantity }} ks
            </td>
            <td class="product-price">{{ $item->price }} EUR</td>
            <td><span class="product-total">{{ $item->price * $item->quantity }}</span> EUR</td>
            <td>{{ $item->colour }}</td>
            <td>{{ $item->size }}</td>
        </tr>
    @endforeach
</table>
<table class="table">
    <tr>
        <td>Subtotal</td>
        <td>{{ $subtotalEUR }} EUR</td>
    </tr>
    @unless(is_null($postageEUR))
    <tr>
        <td>Shipping</td>
        <td>{{ $postageEUR }} EUR</td>
    </tr>
    @endunless
    <tr>
        <td>Total</td>
        <td>{{ $subtotalEUR + $postageEUR }} EUR</td>
    </tr>
</table>
