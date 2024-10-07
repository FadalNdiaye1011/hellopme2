@php
$secteur = ($secteurActiviteChild->secteur_activite_id) ? \App\Models\SecteurActivite::find($secteurActiviteChild->secteur_activite_id) : "None";
@endphp

<div class="grid grid-cols-1 gap-4">
    <!-- Libelle Field -->
    <div class="col-sm-12">
        {!! Form::label('libelle', 'Libelle:', ['class' => 'font-semibold']) !!}
        <p class="mt-1">{{ $secteurActiviteChild->libelle }}</p>
    </div>

    <div class="col-sm-12">
        {!! Form::label('secteur_libelle', 'Secteur:', ['class' => 'font-semibold']) !!}
        <p class="mt-1">{{ $secteur->libelle }}</p>
    </div>

    <!-- Created At Field -->
    <div class="col-sm-12">
        {!! Form::label('created_at', 'Created At:', ['class' => 'font-semibold']) !!}
        <p class="mt-1">{{ $secteurActiviteChild->created_at }}</p>
    </div>

    <!-- Updated At Field -->
    <div class="col-sm-12">
        {!! Form::label('updated_at', 'Updated At:', ['class' => 'font-semibold']) !!}
        <p class="mt-1">{{ $secteurActiviteChild->updated_at }}</p>
    </div>
</div>
