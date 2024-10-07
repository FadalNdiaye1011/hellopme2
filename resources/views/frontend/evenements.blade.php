@include('layouts.header')

@section('content')
    <body>
        <div class="content-head position-relative">
            <div class="container">
                <div class="row position-relative" style="padding-bottom: 5rem;">
                    <div class="col-lg-7 col-md-7">
                        <h1 class="title input-wrapper">Toutes les opportunités de croissance de votre PME en un clic</h1>
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


        <section class="content-body-home bg-grid" style="position: relative; top: -80px;">
                <div class="container">
                    <p class="sub-title">Evénements à venir</p>
                    <div class="row">
                        @foreach ($evenements as $evenement)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
                            <div class="card-opportunite d-flex flex-column">
                                <div class="firstBlock">
                                    <p class="description-opportinute">{{ Str::limit($evenement->titre, 60) }}</p>
                                    <div class="d-flex flex-column">
                                        <p class="secteur-title mb-3">{{ $evenement->lieu }}</p>
                                        <div class="d-flex mb-5">
                                            <span></span>
                                            <p class="secteur-title mr-3">Gratuit:</p>
                                            <div class="d-flex">
                                            <span></span>
                                            <p class="secteur-title">{{ \Carbon\Carbon::parse($evenement->dealine)->formatLocalized('%d %B %Y') }}</p>
                                        </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex">
                                    @if(Auth::guest())
                                        <form method="POST" action="{{ route('watchlist.add', $evenement) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sauvegarde p-0">
                                                <img src="{{asset('img/save.png')}}" alt="">
                                                Sauvegarder
                                            </button>
                                        </form>
                                    @elseif (auth()->user()->watchlists->contains('opportunity_id', $evenement->id))
                                        <form method="POST" action="{{ route('watchlist.remove', $evenement) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sauvegarde p-0">
                                                <img src="{{asset('img/save.png')}}" alt="">
                                                Supprimer
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('watchlist.add', $evenement) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sauvegarde p-0">
                                                <img src="{{asset('img/save.png')}}" alt="">
                                                Sauvegarder
                                            </button>
                                        </form>
                                    @endif
                                    <a href="" class="btn btn-inscrire p-0">
                                        <img src="{{asset('img/icon-inscrir.svg')}}" alt="">
                                        Je m’inscris
                                    </a>
                                    <a href="{{ route('home.detail_appel_offre', $evenement) }}" class="btn p-0">
                                        <img src="{{asset('img/details.png')}}" alt="">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
        </section>


    <section class="section-evenement-secteur bg-white">
        <div class="container">
            <p class="sub-title">Evénement par secteur d’activité</p>
            <div class="group-card d-flex flex-wrap">
                @foreach ($secteurs as $secteur)
                    <div class="card-element-accompagnement-pme d-flex justify-content-between align-items-center">
                        <div>
                            <p class="name-structure">{{ $secteur->secteur }}</p>
                            <p class="categori">{{ $secteur->nombre_evenements }} événements</p>
                        </div>
                        <a href="" class="">
                            <img src="{{asset('img/arrow.svg')}}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section-opportunite-pays">
        <div class="container">
            <p class="sub-title">Evénements par pays</p>
            <div class="row">
                @foreach ($evenements_by_pays as $evenement)
                <div class="col-lg-6 col-md-6">
                    <div class="card-pays d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <img class="flag" src="{{ asset('img/' . $evenement->code . '.png') }}" alt="">
                            <div>
                                <p class="name">{{ $evenement->nom }}</p>
                                <p class="number-opportunity">{{ $evenement->nombre_evenements }} événements</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <a style="text-decoration:none; color:#89c026" href="{{ route('opportunities.search', ['pays_partner_id' => $evenement->pays_partner_id, 'type_opportunity_id' => 3]) }}">Consulter</a>
                            <img class="arrow" src="{{asset('img/arrown-right.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="section-partenaires-financement">
        <div class="container">
            <p class="sub-title">Partenaires de formations</p>
            <div class="container mt-5 text-center my-3">
                <div class="row mx-auto my-auto">
                    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item carousel-item-modife active">
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
                            </div>

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
    @extends('layouts.footer')

        <script src="{{ asset('js/style.js') }}"></script>
    </body>
    </html>
