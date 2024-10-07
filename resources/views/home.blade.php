@include('layouts.header')

@section('content')

<body>
    <div class="content-head position-relative">
        <div class="container">
            <div class="row position-relative" style="padding-bottom: 5rem;">
                <div class="col-lg-7 col-md-7">
                    <h1 class="title">Toutes les opportunites de croissance de votre PME en un clic</h1>
                    <p class="description">Appels d'offres, financement, evenements, ... dans plus de 10 pays.</p>
                    <p class="nom-pays">
                        @foreach ($paysPartners as $pays_item)
                        @if($pays_item->opportunities_count > 0)
                        <a style="text-decoration:none; color:#89c026" href="{{ route('opportunities.search', ['pays_partner_id' => $pays_item->pays_partner_id]) }}">
                            <img class="" src="{{ asset('img/' . $pays_item->code . '.png') }}" style="width: 3%" alt="">
                            {{$pays_item->pays_name}}
                        </a>,&nbsp;
                        @endif
                        @endforeach
                        <b>+10 autres pays</b>
                    </p>
                </div>

                <div class="col-lg-5 col-md-5"">
                   <p class=" sub-title">A la une</p>
                    @include('./frontend._a_la_une')
                </div>
            </div>
        </div>
    </div>

    <div style="position: relative; top: -60px;">
        <section class="container">
            @include('./frontend._search')
        </section>
    </div>
        @if($opportunities->count() > 0)
            <section class="section-last-opportunite" style="position: relative; top: -60px;">
                <div class="container">
                    <p class="sub-title">Dernières opportunités</p>
                    <div class="row group-card">
                        @foreach ($opportunities as $opportunity)
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                @include('./frontend.opportunities._opportunity_card')
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-voir-tout" href="{{ route('opportunities.search', ['type' => 'all']) }}">Voir toutes les opportunités</a>
                </div>
            </section>
        @endif
            <section class="content-body-home">
                <div class="container">
                    <p class="sub-title">Opportunités par secteur d'activité</p>
                    <div class="row d-flex flex-wrap">
                        @foreach ($secteur_activites as $secteur)
                            @if($secteur->opportunities->count() > 0)
                            <div class="card-secteur-opportinute col-md-3">
                                <div class="block-img">
                                    <img src="{{asset('img/img-opportinute.png')}}" alt="">
                                </div>
                                <div>
                                    <p class="name">{{ $secteur->libelle }} </p>
                                    <p class="number-opportunity">{{ $secteur->opportunities->count() }} opportunités</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="section-opportunite-pays">
                <div class="container">
                    <p class="sub-title" style="color:white">Opportunités par pays</p>
                    <div class="row">
                        @foreach ($paysPartners as $pays_item)
                        @if($pays_item->opportunities_count > 0)
                            <div class="col-lg-6 col-md-6">
                                <div class="card-pays d-flex align-items-center justify-content-between">
                                    <div class="d-flex">
                                        <img class="flag" src="{{ asset('img/' . $pays_item->code . '.png') }}" alt="">
                                        <div>
                                            <p class="name"> {{  $pays_item->pay  }} </p>
                                            <p class="number-opportunity"> {{ $pays_item->opportunities_count }} opportunités</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a style="text-decoration:none; color:#89c026" href="{{ route('opportunities.search', ['pays_partner_id' => $pays_item->pays_partner_id]) }}">Consulter</a>
                                        <img class="arrow" src="{{asset('img/arrown-right.svg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </section>

        @include('layouts.footer')
</body>

</html>
