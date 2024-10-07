@extends('layouts.app')

@section('content')
<div class="bg-gray-100  transition-colors duration-300">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Créer une opportunité</h1>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Veuillez fournir les informations de l'opportunité.</p>
            @include('databanks.fields')
            <div class="flex justify-end space-x-4">
                {!! Form::submit('Enregistrer', ['class' => 'px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-colors']) !!}
                <a href="{{ route('databanks.index') }}" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">
                    Annuler
                </a>
            </div>
        </div>

    </div>
</div>

@endsection













<!-- <div class="flex justify-end space-x-4">
                    <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-colors">
                        Enregistrer
                    </button>
                    <a href="{{ route('databanks.index') }}" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">
                        Annuler
                    </a>
                </div> -->
