@include('layouts.header')
@php
    $deadline = ($opportunity->deadline) ? \Carbon\Carbon::create($opportunity->deadline)->translatedFormat('d M Y') : 'None';
    $attachments = \App\Models\Attachment::where('opportunity_id', $opportunity->id)->whereNotNull('url')->get();
@endphp
@section('content')
    <body>
    <div class="content-head-detail">
        <div class="container">
            <div class="d-flex">
                <a href="" class="element-nav">Accueil /</a>
                <a href="" class="element-nav">Appels d'offres /</a>
                <a href="" class="element-nav">{{ Str::limit($opportunity->titre, 50) }}</a>
            </div>
        </div>
    </div>
    <section class="content-body-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <p class="title-detail-offre">
                        {{ $opportunity->titre}}
                    </p>
                    @guest
                        <p class="description-detail-offre">{!! Str::words($opportunity->description, 100) !!}</p>
                        <a href="/login" class="btn btn-voir-tout">Connectez-vous pour voir les détails</a>
                    @endguest
                    @auth
                        <p class="description-detail-offre">{!! $opportunity->description !!}</p>
                    @endauth
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card-detail-activite">
                        <div class="sub-block">
                            <p class="title">Pays</p>
                            @if ($opportunity->pays_partner)
                            <p class="sub-title">{{ $opportunity->pays_partner->one_pays->fr}}</p>
                            @endif
                        </div>
                        <div class="sub-block">
                            <p class="title">Deadline</p>
                            <p class="sub-title">{{ $deadline }}</p>
                        </div>
                        @if ($opportunity->secteur_activite_children->secteurActivite)
                        <div class="sub-block">
                            <p class="title">Secteur d'activité</p>
                            <p class="sub-title">{{ $opportunity->secteur_activite_children->secteurActivite->libelle }}</p>
                        </div>
                        @endif
                        <div class="sub-block">
                            <p class="title">Type</p>
                            @if($opportunity->typeOpportunity)
                            <p class="sub-title">{{ $opportunity->typeOpportunity->libelle }}</p>
                            @endif
                        </div>
                        @if(isset($attachments[0]))
                        <div class="piece-jointe-block">
                            <p class="title">Pièces jointes</p>
                            @php
                                foreach ( $attachments as $attachment ):
                                    if(!$attachment->url)
                                        continue;

                                    echo '<div class="element-doc d-flex">
                                            <img src="'.asset('img/pdf.png').'" alt="">
                                            <div>
                                                <a class="name" href="'.$attachment->url.'" target="_blank"> Cliquer pour voir </a>
                                                <p class="number-mb">1.0 Mb</p>
                                            </div>
                                          </div>';
                                endforeach
                            @endphp
                        </div>
                        @endif
                    </div>
                    <div class="card-partage d-flex justify-content-between align-items-center">
                        <p>Partager</p>
                        <div class="d-flex">
                            <a href="">
                                <img src="{{asset('img/twitter-white.svg')}}" alt="">
                            </a>
                            <a href="">
                                <img src="{{asset('img/facebook-white.svg')}}" alt="">
                            </a>
                            <a href="">
                                <img src="{{asset('img/linkedin-whiite.svg')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="block-img-marketing">
                        <img src="{{asset('img/marketing.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="content-appels-offres">
                @if($appels_offres->count() > 0)
                    <p class="sub-title">Ces autres appels d'offres pourraient vous intérésser ...</p>
                    <div class="group-card-appel-offre d-flex flex-wrap">
                        @foreach ($appels_offres as $offre)
                        <div class="card-appel-offres">
                            <div class="pays d-flex">
                                @if ($offre->pays_partner)
                                <img src="{{ asset('img/' . $offre->pays_partner->one_pays->code_pays . '.png') }}" alt="">
                                <p class="name-pays">{{ $offre->pays_partner->one_pays->fr}}</p>
                                @endif
                            </div>
                            <p class="title-card-appel-offres">{{ Str::limit($offre->titre, 60) }}</p>
                            <div class="footer-card-offre d-flex flex-wrap">
                                <div class="element-detail-financement">
                                    <p class="secteur-title">Secteur d'activités</p>
                                    @if($offre->secteur_activite_children)
                                    <p class="sub-categorie">{{ $offre->secteur_activite_children->libelle }}</p>
                                    @endif
                                </div>
                                <div class="element-detail-financement">
                                    <p class="secteur-title">Type d'opportunités</p>
                                    @if($offre->typeOpportunity)
                                    <p class="sub-categorie">{{ $offre->typeOpportunity->libelle }}</p>
                                    @endif
                                </div>
                                <div class="element-detail-financement">
                                    <p class="secteur-title">Date de publication</p>
                                    <p class="sub-categorie"> {{ \Carbon\Carbon::parse($offre->created_at)->formatLocalized('%d %B %Y') }}</p>
                                </div>
                                <div class="element-detail-financement">
                                    <p class="secteur-title">Deadline</p>
                                    <p class="sub-categorie">{{ \Carbon\Carbon::parse($offre->deadline)->formatLocalized('%d %B %Y') }}</p>
                                </div>
                                <div class="d-flex w-100">
                                    @auth
                                        @if (auth()->user()->watchlists->contains('opportunity_id', $offre->id))
                                        <form method="POST" action="{{ route('watchlist.remove', $offre) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn mr-2">
                                                <img src="{{asset('img/save.png')}}" alt="">
                                                Supprimer
                                            </button>
                                        </form>
                                        @else
                                        <form method="POST" action="{{ route('watchlist.add', $offre) }}">
                                            @csrf
                                            <button type="submit" class="btn mr-2">
                                                <img src="{{asset('img/save.png')}}" alt="">
                                                Sauvegarder
                                            </button>
                                        </form>
                                        @endif
                                    @endauth

                                    {{-- @guest
                                        <form method="POST" action="{{ route('watchlist.add', $offre) }}">
                                            @csrf
                                            <button type="submit" class="btn mr-2">
                                                <img src="{{asset('img/save.png')}}" alt="">
                                                Sauvegarder
                                            </button>
                                        </form>
                                    @endguest --}}
                                    <a href="{{ route('home.detail_appel_offre', $offre) }}" class="btn">
                                        <img src="{{asset('img/details.png')}}" alt="">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-voir-tout">Voir toutes les appels d'offres</a>
                @endif
            </div>
        </div>
    </section>
    @extends('layouts.footer')
    </body>
    </html>
