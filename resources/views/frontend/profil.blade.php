@include('layouts.header')

@section('content')
    <div class="content-head-detail">
        <div class="container">
            <div class="d-flex">
                <a href="" class="element-nav">Accueil /</a>
                <a href="" class="element-nav">Profil</a>
            </div>
        </div>
    </div>
    <section class="section-first-profil bg-white">
        <div class="container">
            <div class="content-tab">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 blockFirstTabs">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-compte-tab" data-toggle="pill" href="#v-pills-compte" role="tab" aria-controls="v-pills-compte" aria-selected="true">Mon compte</a>
                                <a class="nav-link" id="v-pills-centres-tab" data-toggle="pill" href="#v-pills-centres" role="tab" aria-controls="v-pills-centres" aria-selected="false">Mes centres d'intérêt</a>
                                <a class="nav-link" id="v-pills-sauvegardes-tab" data-toggle="pill" href="#v-pills-sauvegardes" role="tab" aria-controls="v-pills-sauvegardes" aria-selected="false">Mes sauvegardes</a>
                                <a class="nav-link" id="v-pills-abonnement-tab" data-toggle="pill" href="#v-pills-abonnement" role="tab" aria-controls="v-pills-abonnement" aria-selected="false">Mon abonnement</a>
                                {{-- <a class="nav-link" id="v-pills-demandes-tab" data-toggle="pill" href="#v-pills-demandes" role="tab" aria-controls="v-pills-demandes" aria-selected="false">Mes demandes d'assistance</a> --}}
                            </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-compte" role="tabpanel" aria-labelledby="v-pills-compte-tab">
                                <div class="block-detail-profil d-flex justify-content-between align-items-center">
                                    <div class="name-block">
                                        <p class="name">{{ $user->first_name }} {{ $user->last_name }}</p>
                                        {{-- <p class="profession">CEO, MBG Consulting</p> --}}
                                        <p class="profession">{{ $user->email }}</p>
                                        <a href="" class="btn btn-modifier">Profil</a>
                                    </div>
                                    <div class="expire-block d-flex align-items-center">
                                        {{-- @if($user->abonnements->count() > 0)
                                        <p>Expire le {{$user->abonnements->first()->end_date->format('d M Y') }}</p>
                                        <a href="#v-pills-abonnement" id="v-pills-abonnement-tab" data-toggle="pill">Renouveler</a>
                                        @else
                                            <a id="v-pills-abonnement-tab" data-toggle="pill" href="#v-pills-abonnement">Abonnement</a>
                                        @endif --}}
                                        <a id="v-pills-abonnement-tab" href="#v-pills-abonnement">Premium</a>
                                    </div>
                                </div>
                                <div class="other-block-detail d-flex flex-wrap justify-content-between">
                                    <div class="content-block">
                                        <p class="label-title">Prénom</p>
                                        <p class="content">{{ $user->first_name }} </p>
                                    </div>
                                    <div class="content-block">
                                        <p class="label-title">Nom</p>
                                        <p class="content">{{ $user->last_name }}</p>
                                    </div>
                                    <div class="content-block">
                                        <p class="label-title">Centre d'intérêt</p>
                                        <p class="content">
                                            @foreach ($typeOpportunities as $typeOpportunity)
                                                {{$typeOpportunity->libelle}} |
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="content-block">
                                        <p class="label-title">Adresse mail</p>
                                        <p class="content">{{ $user->email }}</p>
                                    </div>
                                    <div class="content-block">
                                        <p class="label-title">Téléphone</p>
                                        <p class="content">{{ $user->phone ?: '(xxx) xxx xx' }}</p>
                                    </div>
                                    <div class="content-block">
                                        <p class="label-title">Abonnement</p>
                                        {{-- <p class="content">@if ($user->abonnements && $user->abonnements->first()->abonnement) {{ $user->abonnements->first()->abonnement->type}} @endif</p> --}}
                                        <p class="content">Free</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-centres" role="tabpanel" aria-labelledby="v-pills-centres-tab">
                                <div class="block-detail-profil d-flex justify-content-between align-items-center">
                                    <div class="name-block">
                                        @foreach ($typeOpportunities as $typeOpportunity)
                                            <a href="#" class="btn btn-modifier" style="color:white">{{$typeOpportunity->libelle}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-sauvegardes" role="tabpanel" aria-labelledby="v-pills-sauvegardes-tab">
                                <div class="block-detail-profil d-flex justify-content-between align-items-center">
                                    <div class="name-block">
                                        @foreach ($watchlists as $opportunity)
                                            <a href="{{$opportunity['permalink']}}" class="content" style="color:#2A3C31">{{$opportunity['titre']}}</a><br><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-abonnement" role="tabpanel" aria-labelledby="v-pills-abonnement-tab">
                                    @include('./frontend._abonnement')
                            </div>
                            <div class="tab-pane fade" id="v-pills-demandes" role="tabpanel" aria-labelledby="v-pills-demandes-tab"></div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
    </section>
    @extends('layouts.footer')
