@extends('layouts.app')

@section('content')
<div class="bg-gray-100  transition-colors duration-300 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-black dark:text-black text-center">Créer un acteur de financement</h1>
            <p class="text-gray-700 dark:text-gray-700 mb-6 text-center">Veuillez fournir les informations de l'acteur.</p>

            <!-- Formulaire -->
            {!! Form::open(['route' => 'acteur-finances.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <div class="grid grid-cols-2 gap-6">
                <!-- Libelle -->
                <div class="mb-4">
                    <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                    {!! Form::text('libelle', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                </div>

                <!-- Type Finance -->
                <div class="mb-4">
                    <label for="type_finance_id" class="block text-sm font-medium text-gray-700">Type de financement</label>
                    <select name="type_finance_id" id="type_finance_id" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                        <option value="">-- Choisir un type de financement --</option>
                        @foreach($typesFinance as $typeFinance)
                            <option value="{{ $typeFinance->id }}">{{ $typeFinance->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pays -->
                <div class="mb-4">
                    <label for="pays_partners_id" class="block text-sm font-medium text-gray-700">Pays</label>
                    <select name="pays_partners_id" id="pays_partners_id" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                    @foreach ($pays as $pay)
                        <option value="{{ $pay['id'] }}">{{ $pay['fr'] }} ({{ $pay['code_pays'] }})</option>
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
                    {!! Form::file('photo', ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'id' => 'photo',]) !!}
                    <img id="preview" class="mt-4 hidden h-32 w-32 object-cover">
                </div>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="declaration" class="block text-sm font-medium text-gray-700">Déclaration</label>
                {!! Form::textarea('declaration', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
            </div>

            <!-- Section des contacts -->
            <div id="contacts-section" class="mb-6">
                <h2 class="text-lg font-semibold mb-4">Contacts</h2>
                <div id="contact-fields">
                    <div class="contact-item grid grid-cols-5 gap-4 items-center">
                        <div class="mb-4">
                            <label for="contacts[0][nom_responsable]" class="block text-sm font-medium text-gray-700">Nom Responsable</label>
                            {!! Form::text('contacts[0][nom_responsable]', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                        </div>

                        <div class="mb-4">
                            <label for="contacts[0][phone]" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            {!! Form::text('contacts[0][phone]', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                        </div>

                        <div class="mb-4">
                            <label for="contacts[0][email]" class="block text-sm font-medium text-gray-700">Email</label>
                            {!! Form::email('contacts[0][email]', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                        </div>

                        <div class="mb-4">
                            <label for="contacts[0][fonction]" class="block text-sm font-medium text-gray-700">Fonction</label>
                            {!! Form::text('contacts[0][fonction]', null, ['class' => 'mt-1 block w-full p-2 border border-gray-300 rounded-md', 'required' => true]) !!}
                        </div>

                        <!-- Bouton pour supprimer un contact -->
                        <button type="button" class="remove-contact-btn px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 transition-colors">
                            Supprimer
                        </button>
                    </div>
                </div>

                <!-- Bouton pour ajouter un autre contact -->
                <button type="button" id="add-contact-btn" class="mt-4 px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 transition-colors">
                    Ajouter un autre contact
                </button>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end space-x-4">
                {!! Form::submit('Enregistrer', ['class' => 'px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 transition-colors']) !!}
                <a href="{{ route('acteur-finances.index') }}" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">
                    Annuler
                </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Script pour prévisualisation de l'image et gestion des contacts dynamiques -->
<script>
    document.getElementById('photo').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview').src = event.target.result;
            document.getElementById('preview').classList.remove('hidden');
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    let contactCount = 1;
    document.getElementById('add-contact-btn').addEventListener('click', function() {
        const contactSection = document.getElementById('contact-fields');
        const newContact = `
            <div class="contact-item grid grid-cols-5 gap-4 items-center">
                <div class="mb-4">
                    <label for="contacts[${contactCount}][nom_responsable]" class="block text-sm font-medium text-gray-700">Nom Responsable</label>
                    <input type="text" name="contacts[${contactCount}][nom_responsable]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="contacts[${contactCount}][phone]" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="contacts[${contactCount}][phone]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="contacts[${contactCount}][email]" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="contacts[${contactCount}][email]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="contacts[${contactCount}][fonction]" class="block text-sm font-medium text-gray-700">Fonction</label>
                    <input type="text" name="contacts[${contactCount}][fonction]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <button type="button" class="remove-contact-btn px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 transition-colors">
                    Supprimer
                </button>
            </div>`;
        contactSection.insertAdjacentHTML('beforeend', newContact);
        contactCount++;
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-contact-btn')) {
            e.target.closest('.contact-item').remove();
        }
    });
</script>
@endsection
