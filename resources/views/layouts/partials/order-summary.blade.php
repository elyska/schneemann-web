
<table class="table">
    @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->productId }}</td>
            <td>{{ $item->image }}</td>
            <td>
                {{-- Show title according to the language --}}
                @if(App::isLocale('cs'))
                    {{ $item->title_cz }}
                @else
                    {{ $item->title_en }}
                @endif
            </td>
            <td>
                {{ $item->quantity }} {{  __("ks") }}
            </td>

            {{-- Show currency according to the language --}}
            @if(App::isLocale('cs'))
                <td class="product-price">{{ App\Classes\CurrencyConversion::EURtoCZK($item->price) }} CZK</td>
                <td><span class="product-total">{{ App\Classes\CurrencyConversion::EURtoCZK($item->price) * $item->quantity }}</span> CZK</td>
            @else
                <td class="product-price">{{ $item->price }} EUR</td>
                <td><span class="product-total">{{ $item->price * $item->quantity }}</span> EUR</td>
            @endif

            <td>{{ $item->colour }}</td>
            <td>{{ $item->size }}</td>
        </tr>
    @endforeach
</table>
<table class="table">
    <tr>
        <td>{{  __("Subtotal") }}</td>
        <td>
        {{-- Show currency according to the language --}}
        @if(App::isLocale('cs'))
            {{ $subtotalCZK}} CZK
        @else
            {{ $subtotalEUR }} EUR
        @endif
        </td>
    </tr>
    @unless(is_null($postageEUR))
    <tr>
        <td>{{  __("Shipping") }}</td>
        <td>
            {{-- Show currency according to the language --}}
            @if(App::isLocale('cs'))
                {{ $postageCZK }} CZK
            @else
                {{ $postageEUR }} EUR
            @endif
        </td>
    </tr>
    @endunless
    <tr>
        <td>{{  __("Total") }}</td>
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
