
<p>
    {{  __("Dear customer") }},

    <br />
    <br />
    {{  __("thank you for your order") }}. <br />
    @if($bankTransfer)

    {{  __("Here are the payment details for your order") }}: <br />
    {{  __("Account number") }}: xxxx-xxxxxxxxxx/xxxx <br />
    {{  __("Amount") }}:
        {{-- Show currency according to the language --}}
        @if(App::isLocale('cs'))
            {{ $subtotalCZK + $postageCZK }} CZK
        @else
            {{ $subtotalEUR + $postageEUR }} EUR
        @endif <br />

    @endif
    {{  __("You can find the order details below") }}.
</p>

<h1>Your Order</h1>
<table style="width: 100%">
@foreach($products as $product)
    <tr>
        <td style="border-top: 1px solid #edeff2">
            {{-- Show title according to the language --}}
            @if(App::isLocale('cs'))
                {{ $product->title_cz }}
            @else
                {{ $product->title_en }}
            @endif
            @if($product->colour) <br /> @endif
            {{ $product->colour }} @if($product->size) <br /> @endif
            {{ $product->size }} <br />
        </td>
        <td style="border-top: 1px solid #edeff2">
            {{ $product->quantity }} ks
        </td>
        <td style="border-top: 1px solid #edeff2">
        {{-- Show currency according to the language --}}
        @if(App::isLocale('cs'))
            {{ App\Classes\CurrencyConversion::EURtoCZK($product->price) * $product->quantity }} CZK
        @else
            {{ $product->price * $product->quantity }} EUR
        @endif
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="2" style="border-top: 1px solid #edeff2">
            Subtotal
        </td>
        <td style="border-top: 1px solid #edeff2">
            {{-- Show currency according to the language --}}
            @if(App::isLocale('cs'))
                {{ $subtotalCZK}} CZK
            @else
                {{ $subtotalEUR }} EUR
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">
            Shipping
        </td>
        <td>
            {{-- Show currency according to the language --}}
            @if(App::isLocale('cs'))
                {{ $postageCZK }} CZK
            @else
                {{ $postageEUR }} EUR
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">
            Total
        </td>
        <td>

            {{-- Show currency according to the language --}}
            @if(App::isLocale('cs'))
                {{ $subtotalCZK + $postageCZK }} CZK
            @else
                {{ $subtotalEUR + $postageEUR }} EUR
            @endif
        </td>
    </tr>
</table>

<br />

<p>
    Kind regards, <br />
    {{ config('app.name') }}
</p>

