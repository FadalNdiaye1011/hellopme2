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

    <!-- <section class="section-last-opportunite" style="position: relative; top: -80px;">
        <div class="container">
            @if($financements->count() > 0)
            <p class="sub-title">Derniers opportunités de financement</p>
            <div class="row group-card">
                @foreach ($financements as $financement)
                @php
                $prescripteur = App\Models\Prescripteur::find($financement->prescripteur_id);
                if(empty($prescripteur))
                    continue;
                $url = asset('img/logo-shredded.png');
                $logoFinance = ($prescripteur->logo) ? Storage::disk('s3')->url('prescripteurs/logos/'. $prescripteur->logo) : $url;
                @endphp
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card-opportunite-financement">
                        @if ($financement->pays_partner)
                                    <div class="pays d-flex pb-4">
                                        <img src="{{ asset('img/' . $financement->pays_partner->one_pays->code_pays . '.png') }}" alt="">
                                        <p class="name-pays">{{ $financement->pays_partner->one_pays->fr}}</p>
                                    </div>
                        @endif
                        <div class="d-flex align-items-center mb-2">
                            <div class="block-img">
                                <img src="{{$logoFinance}}" alt="">
                            </div>
                            <div>
                                <p class="title-financement">{{ Str::limit($financement->titre, 50) }}</p>
                            </div>
                        </div>
                        <div class="">
                            <div class="element-detail-financement d-flex w-100">
                                <p class="secteur-title">Date de publication: <span class="sub-categorie">{{ \Carbon\Carbon::parse($financement->created_at)->formatLocalized('%d %B %Y') }}</span></p>

                            </div>
                            <div class="element-detail-financement w-100">
                                <p class="secteur-title ">Deadline: <span class="sub-categorie">{{ \Carbon\Carbon::parse($financement->deadline)->formatLocalized('%d %B %Y') }}</span></p>
                            </div>
                            @if(Auth::guest())
                            <form class="d-flex justify-content-end" method="POST" action="{{ route('watchlist.add', $financement) }}">
                                @csrf
                                <button type="submit" class="btn mr-2">
                                    <img src="{{asset('img/save.png')}}" alt="">
                                    Sauvegarder
                                </button>
                            </form>
                            @elseif (auth()->user()->watchlists->contains('opportunity_id', $financement->id))
                            <form method="POST" action="{{ route('watchlist.remove', $financement) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn mr-2">
                                    <img src="{{asset('img/save.png')}}" alt="">
                                    Supprimer
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('watchlist.add', $financement) }}">
                                @csrf
                                <button type="submit" class="btn mr-2">
                                    <img src="{{asset('img/save.png')}}" alt="">
                                    Sauvegarder
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="btn btn-voir-tout" href="{{ route('opportunities.search', ['type' => 'all']) }}">Voir toutes les opportunités</a>
            @endif
        </div>
    </section> -->


    <!-- typefinances -->
    <section class="section-last-opportunite" style="position: relative; top: -80px;">
        <div class="container">
            @if($financements->count() > 0)
            <p class="sub-title">Derniers opportunités de financement</p>
            <div class="row group-card g-3">
            @foreach ($typefinances as $typefinance)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="bg-primary text-white">
                        <a href="{{ route('typeFinance.list', [$typefinance->id]) }}" class="text-white">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $typefinance->libelle }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
            <a class="btn btn-voir-tout" href="{{ route('opportunities.search', ['type' => 'all']) }}">Voir toutes les opportunités</a>
            @endif
        </div>
    </section>



    <section class="content-body-home">
        <div class="container">
            <p class="sub-title">Derniers ressources de financement</p>
            <div class="content-card-ressources-financemeent d-flex flex-wrap">
                <div class="card-ressources-financement">
                    <div class="head d-flex justify-content-between">
                        <p class="structure">ECOBANK</p>
                        <div class="pays d-flex">
                            <img src="{{asset('img/CI-flag.png')}}" alt="">
                            <p class="name-pays">cote d'ivoire</p>
                        </div>
                    </div>
                    <p class="title">Conditions d'ouverture
                        d'une PME</p>
                    <p class="description">Notre imagination n'a pas de limites pour booster, chaque jour,
                        la performance des entreprises et des individus en Afrique. Nous sommes ensemble, et le meilleur est à venir !</p>
                    <a href="" class="btn">Voir les détails</a>
                </div>
                <div class="card-ressources-financement">
                    <div class="head d-flex justify-content-between">
                        <p class="structure">ECOBANK</p>
                        <div class="pays d-flex">
                            <img src="{{asset('img/CI-flag.png')}}" alt="">
                            <p class="name-pays">cote d'ivoire</p>
                        </div>
                    </div>
                    <p class="title">Conditions de crédits</p>
                    <p class="description">Notre imagination n'a pas de limites pour booster, chaque jour, la performance des entreprises et des individus en Afrique. Nous sommes ensemble, et le meilleur est à venir !</p>
                    <a href="" class="btn">Voir les détails</a>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($finances))
    <section class="section-partenaires-financement">
        <div class="container">
            <p class="sub-title">Partenaires de financement des PME</p>
            <div class="container mt-5 text-center my-3">
                <div class="row mx-auto my-auto">
                    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            @php
                            $i = 0;
                            foreach($finances as $finance):
                            $prescripteur = App\Models\Prescripteur::where('finance_id', $finance->id)->first();

                            if(empty($prescripteur))
                            continue;

                            $url = asset('img/logo-shredded.png');
                            $logo = ($prescripteur->logo) ? Storage::disk('s3')->url('prescripteurs/logos/'. $prescripteur->logo) : $url;
                            @endphp
                            <div class="carousel-item carousel-item-modife active">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="$logo" alt="">
                                    </div>
                                </div>
                            </div>
                            @php
                            if($i == 12)
                            break;
                            endforeach;
                            @endphp
                            {{--
                            <div class="carousel-item carousel-item-modife active">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p2.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p3.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p2.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p1.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p3.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p1.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p2.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-item-modife">
                    <div class="col-md-2 col-sm-4">
                        <div class="card-partenaire-de-financement">
                            <img src="{{asset('img/p3.png')}}" alt="">
                        </div>
                    </div>
                </div> --}}

            </div>
            <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                <img src="{{asset('img/arrow-left.png')}}" alt="">
            </a>
            <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                <img src="{{asset('img/arrow-right.png')}}" alt="">
            </a>
        </div>
        </div>
        </div>

        </div>
    </section>
    @endif
    @extends('layouts.footer')
</body>

</html>
