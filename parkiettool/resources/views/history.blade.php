<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold  text-gray-800 leading-tight">
            {{ __('Bestel Geschiedenis') }}
        </h2>
    </x-slot>

    <main>
        @vite ('resources/css/history.css')
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1> Hier kan je je bestelgeschiedenis zien en je eigendomsbewijs genereren.</h1>
                <br>
                @if(Auth::id() == 1)
                <form action="{{ route('export.orders') }}" method="get">
                    <label for="start-date">Start Datum:</label>
                    <input type="date" id="start-date" name="start_date">

                    <label for="end-date">Eind Datum:</label>
                    <input type="date" id="end-date" name="end_date">

                    <x-primary-button type="submit">Bestellingen Downloaden</x-primary-button>
                </form>
                @endif
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Refentienummer</th>
                            <th>Status</th>
                            <th>Datum</th>
                            <th>Totaal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->count() > 0)
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->user->firstname}} {{$order->user->lastname}}</td>
                            <td>{{ $order->reference }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->updated_at->format('Y-m-d') }}</td>
                            <td>€ {{ $order->total_price }}</td>
                            @if($order->status == 'Betaald')
                            <td>
                                <form action="{{ route('history.download') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <x-secondary-button type="submit" class="download-button">📥</x-secondary-button>
                                </form>
                            </td>
                            @else
                            <td></td>
                            @endif
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="no-orders">Je hebt nog geen bestellingen.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</x-app-layout>
