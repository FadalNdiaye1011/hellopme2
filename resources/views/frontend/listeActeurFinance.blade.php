@include('layouts.header')

@section('content')

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        /* Déplace la carte légèrement vers le haut */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Ajoute une ombre plus marquée */
    }
</style>

<body>


    <div class="container">
        <div class="row justify-content-center g-3 p-4">
            @foreach($typeFinance->acteurFinances as $acteur)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <img src="{{ $acteur->photo ? asset('storage/' . $acteur->photo) : asset('images/logo-shredded.png') }}"
                            alt="{{ $acteur->libelle }}"
                            class="img-fluid rounded-circle"
                            style="width: 150px; height: 150px; object-fit: contains;">
                        <h5 class="card-title mt-3">{{ $acteur->libelle }}</h5>
                        <!-- <p class="card-text">{{ Str::limit($acteur->declaration, 50) }}</p> -->
                        <!-- Bouton pour ouvrir le modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#acteurModal{{ $acteur->id }}">
                            Voir plus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal pour chaque acteur -->
            <div class="modal fade" id="acteurModal{{ $acteur->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $acteur->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $acteur->id }}">{{ $acteur->libelle }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $acteur->photo) }}" alt="{{ $acteur->libelle }}" class="img-fluid rounded">
                                </div>
                                <div class="col-md-8">
                                    <h5><strong>Banque:</strong> {{ $acteur->libelle }}</h5>
                                    <p><strong>Date de création:</strong> {{ \Carbon\Carbon::parse($acteur->created_at)->format('d M Y') }}</p>
                                    <p><strong>Pays:</strong> {{ $acteur->pays_partners->pays->fr }}</p>
                                    <p><strong>Dernière mise à jour:</strong> {{ \Carbon\Carbon::parse($acteur->updated_at)->format('d M Y') }}</p>
                                </div>
                            </div>
                            <hr>

                            <!-- Section des contacts -->
                            <h5 class="mt-4">Contacts:</h5>
                            <div class="row">
                                @foreach($acteur->contacts as $contact)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $contact->nom_responsable }} ({{ $contact->fonction }})</h6>
                                            <p class="card-text"><strong>Téléphone:</strong> {{ $contact->phone }}</p>
                                            <p class="card-text"><strong>Email:</strong> {{ $contact->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <hr>

                            <!-- Section des services -->
                            <h5 class="mt-4">Services:</h5>
                            <div class="row">
                                @if($acteur->services)
                                @foreach($acteur->services as $service)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $service->libelle }}</h6>
                                            @if($service->commentaire)
                                            <p class="card-text"><strong>Commentaire:</strong> {{ $service->commentaire }}</p>
                                            @else
                                            <p class="card-text"><em>Aucun commentaire disponible.</em></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p class="card-text"><em>Aucun Service disponible.</em></p>
                                @endif
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>

    @extends('layouts.footer')

    <!-- Bootstrap JS (assurez-vous d'inclure jQuery et Popper.js pour les anciens projets Bootstrap 4) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
