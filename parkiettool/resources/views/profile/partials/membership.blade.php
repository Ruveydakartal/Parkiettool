<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Jaarlijks Lidgeld') }}
    </h2>
    
    <p class="mt-1 text-sm text-gray-600">
        {{ __('Je moet je jaarlijks lidgeld betaald hebben om ringen te kunnen bestellen.') }}
    </p>
    
    <p class="mt-1 text-s text-blue-600">
        {{ __('€30') }}
    </p>
</header>
<br>
<a href="{{route('payment')}}">
    <x-primary-button>Betaal</x-primary-button>
</a>
