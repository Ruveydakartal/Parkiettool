<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold  text-gray-800 leading-tight">
            {{ __('Ringen Bestellen') }}
        </h2>
    </x-slot>


    <main>
        @vite ('resources/css/order.css')
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

            <!-- Replace with your content -->

            <div class="px-4 py-6 sm:px-0">
                <h3> Hieronder vind u ons aanbod. </h3>
                <p>Je kan verschillende ringen kopen in verschillende maten.</p>

            </div>
            <br>



            <h3>Verharde Jaarkleurringen</h3>
            <div class="producten">
                @foreach ($aluRingen as $aluRing)
                <section class="ring_card">
                    <p> {{$aluRing->name}} </p>
                    <p>{{$aluRing->type->color}}</p>
                    <p>{{$aluRing->size}} mm</p>
                    <p> €{{ $aluRing->price }} </p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ring_id" value="{{ $aluRing->id }}">
                        <input type="number" name="amount" min="10" max="50" step="5">
                        <x-primary-button type="submit" class="btn btn-success">bestel</x-primary-button>
                    </form>
                </section>

                @endforeach
            </div>


            <h3>RVS ringen</h3>
            <div class="producten">
                @foreach ($rvsRingen as $rvsRing)
                <section class="ring_card">
                    <p> {{$rvsRing->name}} </p>
                    <p>{{$rvsRing->color}}</p>
                    <p>{{$rvsRing->size}} mm</p>
                    <p> €{{ $rvsRing->price }} </p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ring_id" value="{{ $rvsRing->id }}">
                        <input type="number" name="amount" min="1" max="50">
                        <x-primary-button type="submit" class="btn btn-success">bestel</x-primary-button>
                    </form>
                </section>

                @endforeach

                {{-- @foreach ($typesWithRings as $type)
            <h3>{{ $type->name }}</h3>
                <ul>
                    @foreach ($type->rings as $ring)
                    <li>{{ $ring->name }}</li>
                    @endforeach
                </ul>
                @endforeach --}}
                <!-- /End replace -->
    </main>

</x-app-layout>
