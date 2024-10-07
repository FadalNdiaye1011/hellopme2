@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-5">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header de l'acteur financier -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-5 flex justify-between items-center">
            <h3 class="text-xl font-bold">{{ $acteurFinance->libelle }}</h3>
            <a href="{{ route('acteur-finances.index') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-4 py-2 rounded-lg text-sm shadow-sm">Retour</a>
        </div>

        <div class="px-6 py-6">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Image de l'acteur -->
                <div class="w-[10rem] h-[10rem] rounded-full border-4 border-blue-500 shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $acteurFinance->photo) }}" alt="{{ $acteurFinance->libelle }}" class="w-full h-full object-cover">
                </div>

                <!-- Informations générales -->
                <div class="md:ml-8 mt-4 md:mt-0">
                    <h5 class="text-blue-700 font-semibold text-lg">Informations générales</h5>
                    <p class="text-gray-700 mt-2"><strong>Libellé :</strong> {{ $acteurFinance->libelle }}</p>
                    <p class="text-gray-700"><strong>Déclaration :</strong> {{ $acteurFinance->declaration }}</p>
                    <p class="text-gray-700"><strong>Pays :</strong> {{ $acteurFinance->pays_partners->pays->fr ?? 'Non spécifié' }}</p>
                    <p class="text-gray-700"><strong>Type de financement :</strong> {{ $acteurFinance->typeFinance->libelle }}</p>
                    <p class="text-gray-700"><strong>Date de création :</strong> {{ $acteurFinance->created_at->format('d/m/Y H:i') }}</p>
                    <p class="text-gray-700"><strong>Dernière mise à jour :</strong> {{ $acteurFinance->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <!-- Section Contacts -->
            <div class="mt-10">
                <h5 class="text-blue-700 font-semibold text-lg">Contacts associés</h5>

                @if($acteurFinance->contacts->isEmpty())
                    <p class="text-gray-500 mt-2">Aucun contact disponible pour cet acteur.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        @foreach($acteurFinance->contacts as $contact)
                            <div class="bg-blue-50 p-4 rounded-lg shadow-md border border-blue-200">
                                <h6 class="font-bold text-blue-700">{{ $contact->nom_responsable }}</h6>
                                <p class="text-gray-600"><strong>Fonction :</strong> {{ $contact->fonction }}</p>
                                <p class="text-gray-600"><strong>Téléphone :</strong> {{ $contact->phone }}</p>
                                <p class="text-gray-600"><strong>Email :</strong> {{ $contact->email }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Section Services -->
            <div class="mt-10">
                <h5 class="text-blue-700 font-semibold text-lg">Services offerts</h5>

                @if($acteurFinance->services->isEmpty())
                    <p class="text-gray-500 mt-2">Aucun service disponible pour cet acteur.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        @foreach($acteurFinance->services as $service)
                            <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                                <h6 class="font-bold text-blue-700">{{ $service->libelle }}</h6>
                                <p class="text-gray-600"><strong>Commentaire :</strong> {{ $service->pivot->commentaire ?? 'Pas de commentaire' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
