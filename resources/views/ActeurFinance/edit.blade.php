@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li class="text-red-600">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900">Modifier un acteur de financement</h1>

            {!! Form::model($acteurFinance, ['route' => ['acteur-finances.update', $acteurFinance->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Libelle -->
                <div class="mb-4">
                    <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                    {!! Form::text('libelle', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                </div>

                <!-- Type Finance -->
                <div class="mb-4">
                    <label for="type_finance_id" class="block text-sm font-medium text-gray-700">Type de financement</label>
                    <select name="type_finance_id" id="type_finance_id" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">-- Choisir un type de financement --</option>
                        @foreach($typesFinances as $typeFinance)
                        <option value="{{ $typeFinance->id }}" {{ $typeFinance->id == $acteurFinance->type_finance_id ? 'selected' : '' }}>
                            {{ $typeFinance->libelle }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pays -->
                <div class="mb-4">
                    <label for="pays_partners_id" class="block text-sm font-medium text-gray-700">Pays</label>
                    <select name="pays_partners_id" id="pays_partners_id" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @foreach ($pays as $pay)
                        <option value="{{ $pay['id'] }}" {{ $acteurFinance->pays_partners_id == $pay['id'] ? 'selected' : '' }}>{{ $pay['fr'] }} ({{ $pay['code_pays'] }})</option>
                        @endforeach
                    </select>
                </div>

                 <!-- ville -->
                 <div class="mb-4">
                    <label for="ville" class="block text-sm font-medium text-gray-700">ville</label>
                    {!! Form::text('ville', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => false]) !!}
                </div>

                 <!-- website -->
                 <div class="mb-4">
                    <label for="website" class="block text-sm font-medium text-gray-700">website</label>
                    {!! Form::text('website', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => false]) !!}
                </div>



                 <!-- Photo -->
                 <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    {!! Form::file('photo', ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md']) !!}
                    @if ($acteurFinance->photo)
                    <img src="{{ asset('storage/' . $acteurFinance->photo) }}" alt="Photo de l'acteur" class="mt-2 w-20 h-20">
                    @endif
                </div>


            </div>

                <!-- Déclaration -->
                <div class="mb-4">
                    <label for="declaration" class="block text-sm font-medium text-gray-700">Déclaration</label>
                    {!! Form::textarea('declaration', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                </div>


            <div id="contacts-section" class="mt-4">
                <h2 class="text-lg font-semibold">Contacts</h2>

                <div id="contact-fields">
                    @foreach($acteurFinance->contacts as $index => $contact)
                    <div class="contact-item flex space-x-4 mb-4">
                        <input type="hidden" name="contacts[{{ $index }}][id]" value="{{ $contact->id }}">
                        <div class="mb-4 w-full">
                            <label for="contacts[{{ $index }}][nom_responsable]" class="block text-sm font-medium text-gray-700">Nom Responsable</label>
                            <input type="text" name="contacts[{{ $index }}][nom_responsable]" value="{{ $contact->nom_responsable }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4 w-full">
                            <label for="contacts[{{ $index }}][phone]" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" name="contacts[{{ $index }}][phone]" value="{{ $contact->phone }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4 w-full">
                            <label for="contacts[{{ $index }}][email]" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="contacts[{{ $index }}][email]" value="{{ $contact->email }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4 w-full">
                            <label for="contacts[{{ $index }}][fonction]" class="block text-sm font-medium text-gray-700">Fonction</label>
                            <input type="text" name="contacts[{{ $index }}][fonction]" value="{{ $contact->fonction }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <button type="button" class="remove-contact-btn px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 focus:outline-none mt-6">
                            Supprimer
                        </button>
                    </div>
                    @endforeach
                </div>

                <!-- Bouton pour ajouter un autre contact -->
                <button type="button" id="add-contact-btn" class="px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 focus:outline-none transition-colors">
                    Ajouter un autre contact
                </button>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end space-x-4 mt-4">
                {!! Form::submit('Enregistrer', ['class' => 'px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-colors']) !!}
                <a href="{{ route('acteur-finances.index') }}" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">
                    Annuler
                </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Script pour ajouter/supprimer dynamiquement des champs de contact -->
<script>
    let contactCount = {{ count($acteurFinance->contacts) }}; // Commencer à partir du nombre de contacts existants

    // Ajouter un autre contact
    document.getElementById('add-contact-btn').addEventListener('click', function() {
        const contactSection = document.getElementById('contact-fields');
        const newContact = `
            <div class="contact-item flex space-x-4 mb-4">
                <input type="hidden" name="contacts[${contactCount}][id]" value="">
                <div class="mb-4 w-full">
                    <label for="contacts[${contactCount}][nom_responsable]" class="block text-sm font-medium text-gray-700">Nom Responsable</label>
                    <input type="text" name="contacts[${contactCount}][nom_responsable]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4 w-full">
                    <label for="contacts[${contactCount}][phone]" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="contacts[${contactCount}][phone]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4 w-full">
                    <label for="contacts[${contactCount}][email]" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="contacts[${contactCount}][email]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4 w-full">
                    <label for="contacts[${contactCount}][fonction]" class="block text-sm font-medium text-gray-700">Fonction</label>
                    <input type="text" name="contacts[${contactCount}][fonction]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <button type="button" class="remove-contact-btn px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 focus:outline-none mt-6">
                    Supprimer
                </button>
            </div>
        `;
        contactSection.insertAdjacentHTML('beforeend', newContact);
        contactCount++;
    });

    // Supprimer un contact
    document.getElementById('contact-fields').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-contact-btn')) {
            e.target.closest('.contact-item').remove();
        }
    });
</script>

@endsection
