@php
$none_entity = '...';
$created_at = ($opportunity->created_at) ? \Carbon\Carbon::create($opportunity->created_at)->translatedFormat('d M Y') : $none_entity;
$deadline = ($opportunity->deadline) ? \Carbon\Carbon::create($opportunity->deadline)->translatedFormat('d M Y') : $none_entity;

$statut_prescripteur = ($opportunity->type_opportunity_id == 1) ? 'ACHETEUR' : 'STRUCTURE';
@endphp


<a href="{{ route('home.detail_appel_offre', $opportunity) }}" class="card-link">
    <div class="card-opportunite">
        <div class="head">
            <div class="pays d-flex ">
                @if($opportunity->pays_partner)
                <img src="{{ asset('img/' . $opportunity->pays_partner->one_pays->code_pays . '.png') }}" alt="">
                <p class="nom_pays">{{ $opportunity->pays_partner->one_pays->fr}}</p>
                @endif
            </div>
            <p class="sub-categorie margin-element" style="margin:.5rem 0;">
                @if($opportunity->typeOpportunity){{ $opportunity->typeOpportunity->libelle }} @endif
            </p>
            <div class="d-flex align-items-center">
                <p class="secteur-title mr-1">Secteur d'activités:</p>
                <p class="sub-categorie">
                    @if($opportunity->secteur_activite_children->secteurActivite){{ $opportunity->secteur_activite_children->secteurActivite->libelle }} @endif
                </p>
            </div>
        </div>
        <p class="description-opportinute">{{ Str::limit($opportunity->titre, 50) }}</p>
        <div class="footer-card d-flex flex-column">
        <div class="d-flex flex-column">
            <div class="element-footer d-flex" style="margin-bottom: .5rem;">
                <p class="secteur-title" style="margin-right: 1rem;">Date de publication</p>
                <p class="sub-categorie"> {{ $created_at }}</p>
            </div>
            <div class="element-footer deadline-block d-flex" style="margin-bottom: .5rem;">
                <p class="secteur-title" style="margin-right: 1rem;">Deadline:</p>
                <p class="sub-categorie"> {{ $deadline }} </p>
            </div>
            @if($opportunity->prescripteur)
            <div class="element-footer d-flex" style="margin-bottom: .5rem;">
                    <p class="secteur-title" style="margin-right: 1rem;">{{ $statut_prescripteur }}</p>
                    <p class="sub-categorie"> {{ $opportunity->prescripteur->libelle }}</p>
            </div>
            @endif
        </div>
            <div class="d-flex mt-4">
                @if(Auth::guest())
                <form method="POST" action="{{ route('watchlist.add', $opportunity) }}">
                    @csrf
                    <button type="submit" class="btn mr-2 text_button">
                        <img src="{{asset('img/save.png')}}" alt="">
                        Sauvegarder
                    </button>
                </form>
                @elseif (auth()->user()->watchlists->contains('opportunity_id', $opportunity->id))
                <form method="POST" action="{{ route('watchlist.remove', $opportunity) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn mr-2 text_button">
                        <img src="{{asset('img/save.png')}}" alt="">
                        Supprimer
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('watchlist.add', $opportunity) }}">
                    @csrf
                    <button type="submit" class="text_button btn mr-2">
                        <img src="{{asset('img/save.png')}}" alt="">
                        Sauvegarder
                    </button>
                </form>
                @endif
                <a href="{{ route('home.detail_appel_offre', $opportunity) }}">
                    <button class="btn text_button">
                        <img src="{{asset('img/details.png')}}" alt="">
                        Voir détails
                    </button>
                </a>
            </div>
        </div>
    </div>
</a>
