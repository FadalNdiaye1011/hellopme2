@extends('layouts.app')

@section('content')

<div class="content px-3">
    @include('flash::message')

    <div class="clearfix"></div>

    <!-- header page start-->
    <div class="header p-4">
        <div class="text-2xl font-bold mb-5 w-full bg-gray-100 rounded-lg shadow-lg py-3 px-2 border-x-4  border-[#459BF1] mt-4">
            Type Finance
        </div>
    </div>
    <!-- header page end-->

    <!-- Formulaire d'ajout/modification -->
    <div class="card p-4">
        <!-- <h2>{{ isset($typeFinance) ? 'Modifier le type de financement' : 'Ajouter un nouveau type de financement' }}</h2> -->

        <!-- Formulaire avec condition pour ajouter ou modifier -->
        <form action="{{ isset($typeFinance) ? route('type-finances.update', $typeFinance->id) : route('type-finances.store') }}" method="POST">
            @csrf

                <div class="w-full max-w-xs p-5 bg-white rounded-lg font-mono">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="unique-input"
                    >Libelle</label
                >
                <input
                    class="text-sm custom-input w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm transition duration-300 ease-in-out transform focus:-translate-y-1 focus:outline-blue-300 hover:shadow-lg hover:border-blue-300 bg-gray-100"
                    placeholder="Enter text here"
                    type="text"
                    name="libelle"
                    id="libelle"
                    value="{{ isset($typeFinance) ? $typeFinance->libelle : old('libelle') }}"
                    required
                />

                <div class="flex space-x-4 mt-3">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ isset($typeFinance) ? 'Mettre à jour' : 'Ajouter' }}
                    </button>
                    @if(isset($typeFinance))
                    <a href="{{ route('type-finances.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Annuler
                    </a>
                @endif
                </div>
                </div>

        </form>
    </div>

    <!-- Tableau des types de financement -->
    <div class="card mt-4">
        @include('type_finances.table')
    </div>
</div>



@endsection
