<!-- Libelle Field -->
<div class="mb-4 col-sm-6">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'block text-gray-700 font-semibold mb-1']) !!}
    {!! Form::text('libelle', null, ['class' => 'border border-gray-300 rounded-md w-full py-2 px-3 focus:outline-none focus:ring focus:ring-blue-400', 'placeholder' => 'Saisir le libelle', 'required']) !!}
</div>

<!-- Secteur Activite Field -->
<div class="mb-4 col-sm-6">
    {!! Form::label('secteur', 'Secteur:', ['class' => 'block text-gray-700 font-semibold mb-1']) !!}
    {!! Form::select('secteur_activite_id', $secteurActivites->pluck('libelle', 'id'), null, ['class' => 'border border-gray-300 rounded-md w-full py-2 px-3 focus:outline-none focus:ring focus:ring-blue-400', 'placeholder' => 'Choisir un secteur ...', 'required']) !!}
</div>
