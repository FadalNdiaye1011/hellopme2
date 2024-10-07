@extends('layouts.app')

@section('styles')
<style>
    .label_search {
        --border: #677B44 ;
        --bgLabel: #677B44 ;
        --bgInput: rgba(255, 255, 255, 1);
        --color-light: #677B44 ;
        --color-light-a: rgb(133, 123, 150);
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: min-content min-content;
        background: var(--bgLabel);
        position: relative;
        font-size: .65rem;
        transition: all .3s ease-out;
    }

    .label_search>.label_search-title {
        border: 1px solid var(--color-light);
        color: var(--color-light);
        box-shadow: 0 2px 2px rgba(120, 120, 120, .25);
        padding: .25em .5em;
        background-color: var(--bgInput);
        grid-column: 1/span 1;
        grid-row: 1/span 1;
        position: relative;
        border-radius: 4px;
        translate: 10px -10px;
        transition: all .5s ease-out .5s;
        z-index: 10;
    }

    .label_search:focus .input_search,
    .label_search:focus-within .input_search {
        background-color: var(--bgInput);
        padding: 1em;
        color: var(--color-light);
        border: 2px solid var(--color-light);
        outline: 2px solid var(--color-light);
        outline-offset: -2px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(98, 0, 255, .25), 0 -5px 20px rgba(98, 0, 255, .1);
        scale: 1.15;
        transition: all .5s cubic-bezier(0, 1.46, 1, 1.62) .3s;
    }

    .label_search:focus,
    .label_search:focus-within .label_search-title {
        translate: 10px -20px;
        border-radius: 4px 4px 0 0;
        z-index: 0;
        transition: all .3s cubic-bezier(0, 1.46, 1, 1.62);
    }

    .input_search {
        appearance: none;
        border-top: 2px solid transparent;
        border-right: 2px solid transparent;
        border-bottom: 2px solid var(--color-light);
        border-left: 2px solid transparent;
        background-color: var(--bgInput);
        caret-color: var(--color-light);
        min-width: 200px;
        padding: 1.25em 1em .25em;
        outline: 0px solid var(--color-light);
        grid-column: 1/-1;
        grid-row: 1 / -1;
        position: relative;
        transition: all .3s cubic-bezier(.5, .6, .5, .62);
        z-index: 0;
    }

    .input_search,
    .input_search::placeholder {
        color: var(--color-light-a);
    }
</style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 px-6 flex items-center justify-between">
            <div class="col-sm-6">
                <!-- <input type="text" id="search" placeholder="Rechercher..." class="w-full px-3 py-2 border rounded"> -->
                <label for="search" class="label_search">
                    <span class="label_search-title">Recherche</span>
                    <input id="search" class="input_search" name="text" placeholder="Ecrire ici..." type="text">
                </label>
            </div>
            <a href="{{ route('secteur-activite-children.create') }}" class="flex justify-end">
                <button
                    class="flex items-center border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    style="background-color: #5865F2;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" width="800px" height="800px" viewBox="0 0 24 24" fill="#FFFFFF">
                        <path d="M4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM11 11H7V13H11V17H13V13H17V11H13V7H11V11Z"></path>
                    </svg>

                    <span>Add New</span>

                </button>
            </a>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('flash::message')

    <div class="clearfix"></div>

    <!-- Ajoute l'ID ici -->
    <div id="secteur-list" class="card">
        @include('secteur_activite_children.table')
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        var search = this.value;

        // Appel Ajax pour actualiser uniquement le tableau
        fetch('{{ route("secteur-activite-children.index") }}?search=' + search, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                // Mettre à jour uniquement la section du tableau
                document.getElementById('secteur-list').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection
