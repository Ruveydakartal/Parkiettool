<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold  text-gray-800 leading-tight">
            {{ __('Uw Winkelmandje') }}
        </h2>
    </x-slot>


    <main>
        @vite ('resources/css/cart.css')
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <h3>Jouw Ringen</h3>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Maat</th>
                        <th>Prijs/stuk</th>
                        <th>Aantal</th>
                        <th></th>
                        <th>Totaal</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($order)
                    @foreach ($order->orderItems as $orderItem)
                    <tr>
                        <td>{{ $orderItem->ring->name }}</td>
                        <td>{{ $orderItem->ring->size }} mm</td>
                        <td>€ {{ $orderItem->ring->price }}</td>
                        <td>{{ $orderItem->amount }}</td>
                        <td>
                            <form action="{{ route('cart.remove', ['orderItem' => $orderItem->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit" class="delete-button">🗑</x-secondary-button>
                            </form>
                        </td>
                        <td colspan="2">€ {{$orderItem->ring->price * $orderItem->amount }}</td>
                    </tr>
                    <tr colspan="4"></tr>
                    @endforeach
                    <tr>
                        <td colspan="4">Verzendingskosten</td>
                        <td></td>
                        <td>€{{ $selectedShippingOption ? $selectedShippingOption->price : 0 }}</td>
                    </tr>

                    <tr>
                        <td colspan="4">Totale Kosten (Verzendingskosten Inbegrepen)</td>
                        <td></td>
                        <td>€{{ $totalPrice }}</td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="4">Je hebt nog geen bestellingen.</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <form action="{{ route('cart.updateShipping') }}" method="POST">
                @csrf
                <select name="shipping_option">
                    @foreach ($shippingOptions as $option)
                    <option name="shipping_option" value="{{ $option->id }}" data-name="{{ $option->name }}"
                        {{ $selectedShippingOption && $selectedShippingOption->id == $option->id ? 'selected' : '' }}>
                        {{ $option->name }} - €{{ $option->price }}
                    </option>
                    @endforeach
                </select>
                <x-secondary-button type="submit">pas aan</x-secondary-button>
            </form>
            <br>
            <a href="{{ route('checkout')}}">
                <x-primary-button type="submit">Afrekenen</x-primary-button>
            </a>

    </main>

</x-app-layout>
