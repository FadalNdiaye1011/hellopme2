<!-- Libelle Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->libelle }}</p>
</div>

<!-- Logo Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('logo', 'Logo:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->logo }}</p>
</div>

<!-- Titre Responsable Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('titre_responsable', 'Titre Responsable:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->titre_responsable }}</p>
</div>

<!-- Nom Responsable Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('nom_responsable', 'Nom Responsable:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->nom_responsable }}</p>
</div>

<!-- Phone Responsable Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('phone_responsable', 'Phone Responsable:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->phone_responsable }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('created_at', 'Created At:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'font-semibold']) !!}
    <p class="mt-1 text-gray-700">{{ $prescripteur->updated_at }}</p>
</div>
