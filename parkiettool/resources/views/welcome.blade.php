<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">

                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">

                            <h1 class="text-blue-800 font-bold text-xl">BVP - Parkietentool</h1>
                        </a>

                    </div>


                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                    </div>
                </div>

            </div>

    </header>


    <main>
        @vite ('resources/css/dashboard.css')
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

            <!-- Replace with your content -->

            <div class="px-4 py-6 sm:px-0">
                <h1 class="title">Welkom op de website van de Belgische Vereniging van Parkietenliefhebbers</h1>
                <h2 class="subTitle">Deze tool is gemaakt om het leven van parkietenliefhebbers makkelijker te maken.
                </h2>
                <img src="parkieten.jpg" alt="" class="img-hero">

                <h3>Info over BVP</h3>
                <br>
                <p>BVP of de Belgische Vereniging van Parkieten- en Papegaaienliefhebbers is een vereniging van
                    vogelliefhebbers die zich specialiseren in kromsnavels van parkieten tot en met papegaaien. BVP is
                    een vereniging zonder winstoogmerk, een vzw dus en wij draaien volledig met bestuursleden en
                    medewerkers op vrijwillige basis zonder financiële verloning.

                    De doelstellingen van onze vereniging vindt u elders op deze website. Wij leggen niet zozeer de
                    klemtoon op tentoonstellingen met de daaraan verbonden kampioentitels, maar wel aan het (raszuiver)
                    kweken van soorten om ze te behouden in avicultuur. Bij ons is elke kromsnavelliefhebber welkom: de
                    mutatiekweker, de wildvormkweker, de liefhebber die streeft naar de bescherming van de
                    papegaaiachtigen in het wild, de houder van huiskamerpapegaaien, de ervaren én de beginnende kweker.
                    Wij hechten heel veel belang aan het doorgeven en verstrekken van informatie. Iedereen is dan ook
                    meer dan welkom op onze infomomenten die in bijna elke provincie worden georganiseerd. Ook ons
                    tijdschrift verschijnt 11x per jaar en staat vol kleurenfoto’s en interessant leesvoer. We beperken
                    de hoeveelheid publiciteit tot vogel-gerelateerde advertenties en bewaken de hoeveelheid informatie.

                    BVP is een dynamische vereniging met tal van initiatieven voor onze leden: maandelijks tijdschrift,
                    ringendienst, nestkastendienst, lidkaartvoordelen, shows, vogelbeurzen, infomomenten, uitstappen,
                    website, website voor vraag en aanbod,… Wij zijn ook blij dat we onder onze leden en bestuursleden
                    heel wat jonge liefhebbers mogen tellen.
                    <br>
                    Veel plezier op deze website!
                    <br>
                    <br>
                    Bert Van Gils
                    <br>

                    Voorzitter BVP-Nationaal</p>
                <br>

                <div class="onze-producten">
                    <h2 class="producten-title">Onze Producten</h2>
                    <p>Hieronder vind u een overzicht van onze producten.</p>
                    <div class="producten">
                        <section class="product">
                            <img src="vogelring-2023.jpg" alt="">
                            <h4>Verharde ringen</h4>
                            <p>Deze ringen zijn gemaakt van aluminium en zijn verhard.</p>
                        </section>
                        <section class="product">
                            <img src="inox.jpg" alt="">
                            <h4>Inox ringen</h4>
                            <p>Deze ringen zijn gemaakt van inox en zijn niet verhard.</p>
                        </section>
                    </div>

                    <x-primary-button class="btn">
                        <a href="{{ route('order') }}">Bestel nu</a>
                    </x-primary-button>
                </div>
                <!-- /End replace -->
    </main>


</body>

</html>
