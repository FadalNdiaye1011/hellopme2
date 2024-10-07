<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTabs">
        <li class="nav-item">
            <a class="nav-link active" id="premium-tab" data-toggle="tab" href="#premium">Premium</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" id="gold-tab" data-toggle="tab" href="#gold">GOLD</a>
        </li> --}}
    </ul>

    <div class="tab-content mt-5">
        <div class="tab-pane fade show active" id="premium">
            <div class="login-box">
                <div class="card card-connection">
                    <div class="card-body login-card-body">
                        <p class="title-connexion">Je m'abonne en Premium</p>
                        <form method="post" action="{{route('purchase') }}">
                            @csrf
                            @foreach ($abonnements as $abonnement)
                                @if($abonnement->type == "Premium")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="{{ $abonnement->id }}" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $abonnement->durations }} mois
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-se-connecter">Suivant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="gold">
            <div class="login-box">
                <div class="card card-connection">
                    <div class="card-body login-card-body">
                        <p class="title-connexion">Je m'abonne en Gold</p>
                        <form method="post" action="{{route('home.storeAbonnement') }}">
                            @csrf
                            <div class="form-check">
                                @foreach ($abonnements as $abonnement)
                                    @if($abonnement->type == "Gold")
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" value="{{ $abonnement->id }}" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{ $abonnement->durations }} mois
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            <button type="submit" class="btn btn-se-connecter">Suivant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
